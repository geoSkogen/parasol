<?php

class Parasol_Templater {

  public  $script_handles;
  public  $style_handles;
  protected $router;
  protected $theme_handle;

  public function __construct($router, $scripts_arr, $styles_arr, $theme_style_handle) {
    $this->script_handles = $scripts_arr;
    $this->style_handles = $styles_arr;
    $this->router = $router;
    $this->theme_handle = $theme_style_handle;
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
        '../style/' . 'parasol_templater_' . $style_handle . '_style.css'
      );
    }

    //
    foreach ($this->script_handles as $script_handle) {
      wp_register_script(
        $script_handle,
        plugin_dir_url(__FILE__) .
        '../lib/' . 'parasol_templater_' . $script_handle . '_script.js',
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
    //
    $style_slug = !empty($atts['style_slug']) ? $atts['style_slug'] : '';
    $script_slugs = !empty($atts['script_slugs']) ? explode(',',$atts['script_slugs']) : [];
    //
    error_log('slugs passed to templater');
    error_log($style_slug);
    error_log(print_r($script_slugs,true));
    //
    wp_dequeue_style($this->theme_handle);
    wp_deregister_style($this->theme_handle);
    wp_enqueue_style(
      'font-awesome-5',
      'https://use.fontawesome.com/releases/v5.3.0/css/all.css',
      array(),
      '5.3.0'
    );
    // main stylesheet is always enqueued -
    wp_enqueue_style('main');
    // stylesheet arg option - no arg, no additional styles
    if ( $style_slug && in_array($style_slug, $this->style_handles) ) {
      wp_enqueue_style($style_slug);
    }
    // javascript doc args option - no args defaults to generic script, if one's injected
    foreach($script_slugs as $script_slug) {
      if ( in_array($script_slug, $this->script_handles) ) {
        wp_enqueue_script($script_slug);
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
