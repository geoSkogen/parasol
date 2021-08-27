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
     
	 case '/ex-machina/' :
	 
	    if (!class_exists('Parasol_Ex_Machine_Template')) {
          include_once $this->templates_path . 'parasol_ex_machina_template.php';
        }
        $app_html = new Parasol_Ex_Machina_Template();
        break;
		
      case '/i-ching/' :
	  
	    if (!class_exists('Parasol_I_Ching_Template')) {
          include_once $this->templates_path . 'parasol_i_ching_template.php';
        }
        $app_html = new Parasol_I_Ching_Template();
        break;
		
      case '/profile/' :
	  
        if (!class_exists('Parasol_Profile_Template')) {
          include_once $this->templates_path . 'parasol_profile_template.php';
        }
		$app_html = new Parasol_Profile_Template();
        break;
		
      case '/archives/' :
		
		 if (!class_exists('Parasol_Archives_Template')) {
          include_once $this->templates_path . 'parasol_archives_template.php';
        }
		$app_html = new Parasol_Archives_Template();
        break;
	    
        break;
		
      case '/contacts/' :
	  
		 if (!class_exists('Parasol_Users_Template')) {
          include_once $this->templates_path . 'parasol_users_template.php';
        }
		$app_html = new Parasol_Users_Template();
        break;
  
      case '/cred/' :
	  
        
      case '/history/' :
	  
        
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
