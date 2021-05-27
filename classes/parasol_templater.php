<?php

class Parasol_Templater {

  public  $script_handles;
  public  $style_handles;

  public function __construct($scripts_arr, $styles_arr) {
    $this->script_handles = $scripts_arr;
    $this->style_handles = $styles_arr;
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

  public static function print_parasol_template() {
    //
    foreach ($this->style_handles as $style_handle) {
      wp_enqueue_style($style_handle);
    }
    foreach ($this->script_handles as $script_handle) {
      wp_enqueue_script($script_handle);
    }
    //
    ?>
    <h1 id="parasol-text-render" class="parasol-demo">This is the Parasol templater HTML text content.</h1>
    <h2 id="parasol-style-render" class="parasol-demo"></h1>
    <h2 id="parasol-script-render" class="parasol-demo"></h1>
    <?php
    //
  }
}
