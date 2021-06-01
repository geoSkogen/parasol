<?php

class Parasol_Router {

  protected $subdomain;
  protected $templates_path;
  protected $favicon_filename;

  public function __construct($subdomain,$favicon_filename) {
    $this->subdomain = $subdomain;
    $this->templates_path = __DIR__ . '../../templates/';
    $this->favicon_filename = $favicon_filename;
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

      case '/build' :
        break;
      case '/hexagarams' :
        break;
      case '/trigrams' :
        break;
      case '/profile' :
        break;
      default :
        if (!class_exists('Parasol_Default_Template')) {
          include_once $this->templates_path . 'parasol_default_template.php';
        }
        $app_html = new Parasol_Default_Template();
    }

    return $app_html->app_html();

  }

  public static function favicon_tag() {
    // void - echo
    $uri_arr = explode('/',$_SERVER['REQUEST_URI']);
    if (in_array($this->subdomain,$uri_arr)) {

      $href = site_url() . '/wp-content/plugins/parasol/records/images/' . $this->favicon_filename;
      $tag = "<link rel='icon' href='{$href}' type='image/x-icon' />";
      error_log($href);
      echo $tag;
    }
  }

}

?>
