<?php

class Parasol_Templater {

  public  $script_handles;
  public  $style_handles;
  protected $router;

  public function __construct($router, $scripts_arr, $styles_arr) {
    $this->script_handles = $scripts_arr;
    $this->style_handles = $styles_arr;
    $this->router = $router;
    //
    add_shortcode( 'parasol_template',
      [$this,'print_parasol_template']
    );
    //
    add_action('wp_enqueue_scripts',[$this,'add_assets']);
  }


  public static function add_assets() {
    //
    foreach ($this->style_handles as $style_handle) {
      wp_register_style(
        $style_handle,
        plugin_dir_url(__FILE__) .
        '../style/' . $style_handle . '.css'
      );
    }
    //
    foreach ($this->script_handles as $script_handle) {
      wp_register_script(
        $script_handle,
        plugin_dir_url(__FILE__) .
        '../lib/' . $script_handle . '.js',
        array(),
        null,
        true
      );
    }
    //
  }


  public static function print_parasol_template($atts = []) {
    //
    extract(shortcode_atts(array(
      'style_slug' => '',
      'script_slugs' => ''
     ), $atts));
    $script_paths = [''];
    //
    $style_slug = !empty($atts['style_slug']) ? $atts['style_slug'] : '';
    $script_slugs = !empty($atts['script_slugs']) ? explode(',',$atts['script_slugs']) : $script_paths;

    // main stylesheet is always enqueued -
    wp_enqueue_style("parasol_templater_style");
    // stylesheet arg option - no arg, no additional styles
    if ( $style_slug && in_array("parasol{$style_slug}_templater_style", $this->style_handles) ) {
      wp_enqueue_style("parasol{$style_slug}_templater_style");
    }
    // javascript doc args option - no args defaults to generic script, if one's injected
    foreach($script_slugs as $script_slug) {
      if ( in_array("parasol{$script_slug}_templater_script", $this->script_handles) ) {
        wp_enqueue_script("parasol{$script_slug}_templater_script");
      }
    }
    // show the shortcode the path
    if (strpos(site_url(),'localhost')) {
      // kludge against LAMP staging site URL
      $url_arr= explode('/',site_url());
      $domain = $url_arr[count($url_arr)-1] ?
        $url_arr[count($url_arr)-1] : $url_arr[count($url_arr)-2];
      //error_log('staging domain');
      //error_log($domain);
      //
      $path = str_replace('/' . $domain . '/', '', $_SERVER['REQUEST_URI']);
    } else {
      //
      $path = substr(1,$_SERVER['REQUEST_URI']);
    }
    //error_log('PATH');
    //error_log($path);
    // print the routed app template onto the page
    echo $this->router->get($path);
  }

}
