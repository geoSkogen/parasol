<?php
/*
Plugin Name:  parasol
Description:  basic frontend plugin shell
Version:      0
Author:       geoskogen
Author URI:   https://joseph-scoggins.com
Text Domain:  parasol
*/

defined( 'ABSPATH' ) or die( 'We make the path by walking.' );

if (is_admin()) {

  if ( !class_exists( 'Parasol_Admin' ) ) {
     include_once 'classes/parasol_admin.php';
  }

  
  $admin= new Parasol_Admin(
    ['parasol_admin_script'],
    ['parasol_admin_style']
  );


} else {

  if ( !class_exists( 'Parasol_Templater' ) ) {
     include_once 'classes/parasol_templater.php';
  }

  $frontend = new Parasol_Templater(
    ['parasol_templater_script'],
    ['parasol_templater_style']
  );

}

?>
