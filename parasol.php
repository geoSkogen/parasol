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
  // inject the subdomain of your app here:
  $router = new Parasol_Router('parasol');

  // add names of main css and js files
  $frontend = new Parasol_Templater(
    $router,
    ['main'],
    ['main'],
    'parasol.png',
    'child-style'
  );

  add_action( 'wp_head', [$fontend,'favicon_tag'], 2, null );

}

?>
