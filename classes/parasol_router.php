<?php

class Parasol_Router {

  protected $subdomain;
  protected $templates_path;

  public function __construct($subdomain) {
    $this->subdomain = $subdomain;
    $this->templates_path = __DIR__ . '../../templates/';
  }

  public function get($uri) {

    $resource = str_replace($this->subdomain,'',$uri);
    //error_log($resource);
    switch($resource) {

      case '/' :

        if (!class_exists('Parasol_Throw_Template')) {
          include_once $this->templates_path . 'parasol_throw_template.php';
        }
        $app_html = new Parasol_Throw_Template();
        break;

      case '/build' :
        break;
      case '/hexagarams' :
        break;
      case '/trigrams' :
        break;
      case '/profile' :
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
