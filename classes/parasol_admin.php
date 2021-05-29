<?php

class Parasol_Admin {

  protected $options;
  protected $suboptions;

  public $style_handles;
  public $script_handles;

  public function __construct($script_handles,$style_handles) {

    $this->style_handles = $style_handles;
    $this->script_handles = $script_handles;

    //
    add_action(
     'admin_menu',
     [$this,'parasol_register_options_pages']
    );
    //
    add_action(
      'admin_init',
      [$this,'parasol_init_settings_api']
    );
    //
    add_action('wp_admin_enqueue_scripts',[$this,'add_assets']);
    //
  }


  public static function add_assets() {
    //
    foreach ($this->style_handles as $style_handle) {
      wp_register_style(
        $style_handle,
        plugin_dir_url(__FILE__) .
        '../style/' . 'parasol_admin_' . $style_handle . '_style.css'
      );
    }
    //
    foreach ($this->script_handles as $script_handle) {
      wp_register_script(
        $script_handle,
        plugin_dir_url(__FILE__) .
        '../lib/' . 'parasol_admin_' . $script_handle . '_script.js',
        array(),
        null,
        true
      );
    }
    //
  }


  public function parasol_register_options_pages () {
    //
    add_menu_page(
      'Parasol Options', // Page Title
      'Parasol',  // Menu Title
      'manage_options', //capability
      'parasol',  //menu_slug
      [$this,'parasol_options_page'],//cb function
      'dashicons-flag',
      22
    );
    //
    add_submenu_page(
      'parasol', // parent slug
      'Parasol Sub-Options', // Page Title
      'Parasol Sub-Options',  // Menu Title
      'manage_options', //capability
      'parasol_suboptions',  //menu_slug
      [$this,'parasol_suboptions_page']//cb function
    );
  }


  public function parasol_init_settings_api() {
    //
    add_settings_section(
      'parasol',         //unique id
      'Parasol Options Section',         //title
      [$this,'parasol_options_section'],    //call back function
      'parasol'        //page_slug
    );
    //
    add_settings_field(
      'api_key', //id
      'Parasol API Key', //label
      [$this,'parasol_api_key_field'],    //call back function
      'parasol',    // page slug
      'parasol'     //section (parent settings-section uniqueID)
    );
    //
    add_settings_section(
      'parasol_suboptions',         //unique id
      'Parasol Suboptions Section',         //title
      [$this,'parasol_suboptions_section'],    //call back function
      'parasol_suboptions'        //page_slug
    );
    //
    add_settings_field(
      '1', //id
      'Parasol Suboption 1', //label
      [$this,'parasol_suboption_1_field'],    //call back function
      'parasol_suboptions',    // page slug
      'parasol_suboptions'     //section (parent settings-section uniqueID)
    );

    register_setting(
      'parasol',
      'parasol'
    );

    register_setting(
      'parasol_suboptions',
      'parasol_suboptions'
    );
  }


  protected function collect_section_overhead($prop_slug,$db_slug,$path_slug) {
    //
    $db_slug = ($db_slug) ? '_' . $db_slug : '';
    //
    $this->{$prop_slug} =
      !empty( get_option('parasol' . $db_slug) ) ?
        get_option('parasol' . $db_slug) : [];
    //
    if (in_array($path_slug,$this->style_handles)) {
      wp_enqueue_style($path_slug);
    }
    //
    if (in_array($path_slug,$this->script_handles)) {
      wp_enqueue_script($path_slug);
    }
  }


  public function parasol_options_section() {
    //
    $this->collect_section_overhead('options','','main');
    //
    ?>
    <div class="parasol-signal">
      This is the Options Section of the Options Page
    </div>
    <?php
    //
  }


  public function parasol_api_key_field() {
    //
    $val = !empty($this->options['api_key']) ? $this->options['api_key'] : '';
    $att = ($val) ? 'value' : 'placeholder';
    $val = ($val) ? $val : 'not set';
    //
    ?>
    <label for="parasol_api_key">API Key:</label>
    <input type="text" id="api-key" class="parasol-admin"
     name="parasol[api_key]" <?php echo $att ."='". $val  ."'"?> />
    <?php
    //
  }


  public function parasol_suboptions_section () {
    //
    $this->collect_section_overhead('suboptions','suboptions','main');
    //
    ?>
    <div class="parasol-signal">
      This is the Sub-Options Section of the Sub-Options Page
    </div>
    <?php
    //
  }


  public function parasol_suboption_1_field() {
    //
    $val = !empty($this->suboptions[1]) ? $this->suboptions[1] : '';
    $att = ($val) ? 'value' : 'placeholder';
    $val = ($val) ? $val : 'not set';
    //
    ?>
    <label for="parasol_suboption_1"></label>
    <input type="text" id="suboption-1" class="parasol-admin"
     name="parasol_suboptions[1]" <?php echo $att ."='". $val  ."'"?> />
    <?php
    //
  }


  public function parasol_options_page () {
    //
    $this->parasol_options_form('parasol');
  }


  public function parasol_suboptions_page () {
    //
    $this->parasol_options_form('parasol_suboptions');
  }


  protected function parasol_options_form ($prop) {
    //
    echo "<form method='POST' action='options.php' id='$prop'>";
    //
    settings_fields( $prop );
    do_settings_sections( $prop );
    submit_button();
    //
    echo '</form>';
  }

}

?>
