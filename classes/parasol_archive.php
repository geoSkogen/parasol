<?php

class BOC_Archive {

  public function __construct() {

    if (!post_type_exists('boc-archive')) {

      add_action( 'init', [$this,'register_custom_post_type'] );

      add_filter( 'rest_route_for_post', [$this,'register_rest_route_for_custom_post'], 10, 2 );

    }

    add_action( 'rest_api_init', [$this, 'prefix_register_boc_archive_route'] );
  }
  // Create the custom post type for Reviews
  public static function define_custom_post_type(){
       $labels = array(
  		'name'               =>  'Archives' ,
  		'singular_name'      =>  'Archive' ,
  		'menu_name'          =>  'Archives'
  	);

  	$args = array(
  		'labels'             => $labels,
  		'public'             => false,
  		'publicly_queryable' => true,
  		'show_ui'            => true,
  		'show_in_menu'       => true,
      'menu_position'      => 24,
      'menu_icon'          => 'dashicons-book-alt',
  		'query_var'          => true,
  		'rewrite'            => [ 'slug' => 'boc-archive'],
  		'capability_type'    => 'page',
  		'has_archive'        => false,
  		'hierarchical'       => false,
      'show_in_rest'       => true,
      'rest_controller_class' => 'WP_REST_Posts_Controller',
  		'supports'           => ['title', 'editor', 'author', 'thumbnail', 'revisions', 'custom-fields' ]
  	);

    register_post_type( 'boc-archive' , $args);
  }

  public function register_rest_route_for_custom_post( $route, $post ) {
    if ( $post->post_type === 'boc-archive' ) {
        $route = '/wp/v2/boc-archive/' . $post->ID;
    }
    return $route;
  }

  public function register_custom_post_type() {

    $this->define_custom_post_type();

    flush_rewrite_rules();
  }

  public function prefix_register_boc_archive_route() {

    register_rest_route( 'boc-archive/v1', '/boc_archives', array(
        // Notice how we are registering multiple endpoints the 'schema' equates to an OPTIONS request.
        array(
            'methods'  => 'GET',
            'callback' => 'prefix_get_boc_archive_sample',
        ),
        // Register our schema callback.
        'schema' => 'prefix_get_boc_archive_schema',
    ) );
  }

/**
 * Grabs the five most recent boc_archives and outputs them as a rest response.
 *
 * @param WP_REST_Request $request Current request.
 */
 public function prefix_get_boc_archive_sample( $request ) {
    $args = array(
        'number' => 5,
    );
    $boc_archives = $this->get_boc_archives( $args );

    $data = [];

    if ( empty( $boc_archives ) ) {
        return rest_ensure_response( $data );
    }

    foreach ( $boc_archives as $boc_archive ) {
        $response = $this->prefix_rest_prepare_boc_archive( $boc_archive, $request );
        $data[] = $this->prefix_prepare_for_collection( $response );
    }

    // Return all of our boc_archive response data.
    return rest_ensure_response( $data );
  }

/**
 * Matches the boc_archive data to the schema we want.
 *
  * @param WP_boc_archive $boc_archive The boc_archive object whose response is being prepared.
 */
  protected function prefix_rest_prepare_boc_archive( $boc_archive, $request ) {
    $boc_archive_data = array();

    $schema = $this->prefix_get_boc_archive_schema();

    // We are also renaming the fields to more understandable names.
    if ( isset( $schema['properties']['id'] ) ) {
        $boc_archive_data['id'] = (int) $boc_archive->boc_archive_ID;
    }

    if ( isset( $schema['properties']['author'] ) ) {
        $boc_archive_data['author'] = (int) $boc_archive->user_id;
    }

    if ( isset( $schema['properties']['body'] ) ) {
        $boc_archive_data['body'] = apply_filters( 'boc_archive_text', $boc_archive->boc_archive_body, $boc_archive );
    }

    return rest_ensure_response( $boc_archive_data );
  }

/**
 * Prepare a response for inserting into a collection of responses.
 *
 * This is copied from WP_REST_Controller class in the WP REST API v2 plugin.
 *
 * @param WP_REST_Response $response Response object.
 * @return array Response data, ready for insertion into collection data.
 */
  protected function prefix_prepare_for_collection( $response ) {
    if ( ! ( $response instanceof WP_REST_Response ) ) {
        return $response;
    }

    $data  = (array) $response->get_data();
    $links = rest_get_server()::get_compact_response_links( $response );

    if ( ! empty( $links ) ) {
        $data['_links'] = $links;
    }

    return $data;
  }

/**
 * Get our sample schema for boc_archives.
 */
  public function prefix_get_archive_schema() {
    $schema = array(
        // This tells the spec of JSON Schema we are using which is draft 4.
        '$schema'              => 'http://json-schema.org/draft-04/schema#',
        // The title property marks the identity of the resource.
        'title'                => 'boc-archive',
        'type'                 => 'object',
        // In JSON Schema you can specify object properties in the properties attribute.
        'properties'           => array(
            'id' => array(
                'description'  => esc_html__( 'Unique identifier for the object.', 'boc-archive' ),
                'type'         => 'integer',
                'context'      => array( 'view', 'edit', 'embed' ),
                'readonly'     => true,
            ),
            'author' => array(
                'description'  => esc_html__( 'The id of the user object, if author was a user.', 'boc-archive' ),
                'type'         => 'integer',
            ),
            'body' => array(
                'description'  => esc_html__( 'The content for the object.', 'boc-archive' ),
                'type'         => 'string',
            ),
        ),
    );

    return $schema;
  }
}

?>
