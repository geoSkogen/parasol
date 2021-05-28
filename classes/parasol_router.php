<?php

class Parasol_Router {

  protected $subdomain;
  protected $err_msg;

  public function __construct($subdomain) {
    $this->subdomain = $subdomain;
    $this->err_msg = "<h1>The requested resource object doesn't exist.</h1>";
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

        $app_html = $err_msg;
    }

    return $app_html->app_html();

  }

}

?>
