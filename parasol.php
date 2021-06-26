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


if (!class_exists('BOC_Archive')) {
    include_once 'classes/parasol_archive.php';
  }

  $archive = new BOC_Archive();

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
    // javascript documents to register - enqueued as needed
    ['nav_modal','hex_control','touch_wheel','throw_control','build_control',
     'trigrams_control','hexagrams_control','profile-editor','messenger-control',
     'archive-control','archive-filter','archive-post-handler'],
    // css docs to register
    ['main','throw','build','trigrams','hexagrams','profile','users','archive'],
    // active theme stylesheet handle - to dequeque as needed
    'tao-75-red.png',
    'child-style'
  );

  add_action( 'wp_head', [$frontend,'favicon_tag'], 2, null );

}

?>
