<?php

class Parasol_Router {

  protected $subdomain;
  protected $err_msg;

  public function __construct($subdomain) {
    $this->subdomain = $subdomain;
  }


  public function get($uri) {

    $resource = str_replace($this->subdomain,'',$uri);

    switch($resource) {

      case '/' :

        if (!class_exists('Parasol_Home_Template')) {
          include_once __DIR__ . '../../templates/parasol_home_template.php';
        }
        $app_html = new Parasol_Home_Template();
        break;

      default :
        if (!class_exists('Parasol_Home_Template')) {
          include_once __DIR__ . '../../templates/parasol_default_template.php';
        }
        $app_html = new Parasol_Default_Template();
    }

    return $app_html->app_html();

  }

}

?>
