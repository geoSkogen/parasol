<?php

class Parasol_Profile_Template {

  protected $favicon_filename = 'tao-75-black-svg.png';
  protected $icon_path;
  protected $field_names;
  protected $field_labels;

  public function __construct() {
    $this->icon_path = site_url() . '/wp-content/plugins/parasol/records/images/' . $this->favicon_filename;
    $this->field_names = ['uname','email','pword','re-pword'];
    $this->field_labels = ['User Name','Email','Password','Re-Type Password'];
  }

  public function app_html() {

    $html =
  "<div id='form-wrap' class='flex-col flex-start'>
    <h1 class='flex-row flex-center'>
      <div id='badge-frame'>
          <img src='$this->icon_path' />
        </div>
      new profile
    </h1>
    <h2>☰  ☱  ☲  ☳  ☴  ☵  ☶  ☷</h2>
    <div id='new-profile-psuedo-form'>";
    $i = 0;
    foreach($this->field_names as $field_name) {
     //
      $placeholder= $this->field_labels[$i];
      $type  = strpos( $field_name, 'pword' )>-1 ? 'password' : 'text';
      $html .=
      "<div class='form-wrapper flex-row flex-center' $field_name-wrap' >
       <input type='$type' name='$field_name'
         id='new-profile-$field_name' class='new-profile-input'
         placeholder='$placeholder' />
      </div>";
      $i++;
    }

    $html .=
      "<div class='form-wrapper flex-row flex-center'>
        <div id='new-profile-submit' class='no-button'>create profile</div>
      <div/>";
    $html .=
    "</div>
  </div>";

    return $html;
  }

}

?>
