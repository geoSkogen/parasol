<?php

class Parasol_Router {

  public $subdomain;
  protected $templates_path;


  public function __construct($subdomain) {
    $this->subdomain = $subdomain;
    $this->templates_path = __DIR__ . '../../templates/';
  }

  public function get($uri) {
    // html str
    $resource = str_replace($this->subdomain,'',$uri);

    switch($resource) {

      case '/' :

        if (!class_exists('Parasol_Throw_Template')) {
          include_once $this->templates_path . 'parasol_throw_template.php';
        }
        $app_html = new Parasol_Throw_Template();
        break;

      case '/build/' :

        if (!class_exists('Parasol_Build_Template')) {
          include_once $this->templates_path . 'parasol_build_template.php';
        }
        $app_html = new Parasol_Build_Template();
        break;

      case '/hexagrams/' :

        if (!class_exists('Parasol_Hexagrams_Template')) {
          include_once $this->templates_path . 'parasol_hexagrams_template.php';
        }
        $app_html = new Parasol_Hexagrams_Template();
        break;

      case '/trigrams/' :

        if (!class_exists('Parasol_Trigrams_Template')) {
          include_once $this->templates_path . 'parasol_trigrams_template.php';
        }
        $app_html = new Parasol_Trigrams_Template();
        break;

      case '/profile/' :
        break;
      default :
        if (!class_exists('Parasol_Default_Template')) {
          include_once $this->templates_path . 'parasol_default_template.php';
        }
        $app_html = new Parasol_Default_Template();
    }

    return $app_html->app_html();

  }

}

?>
