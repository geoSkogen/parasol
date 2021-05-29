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
    ['main'],
    ['main']
  );

} else {
  // frontend resources
  if ( !class_exists( 'Parasol_Templater' ) ) {
     include_once 'classes/parasol_templater.php';
  }

  if ( !class_exists( 'Parasol_Router' ) ) {
     include_once 'classes/parasol_router.php';
  }

  $router = new Parasol_Router('book-of-changes');

  $frontend = new Parasol_Templater(
    $router,
    ['nav_modal','touch_wheel','throw_control'],
    ['main','throw'],
    'child-style'
  );

}

?>
