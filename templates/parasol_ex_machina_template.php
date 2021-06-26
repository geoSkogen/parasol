<?php

class Parasol_Ex_Machina_Template {

  public function __construct() {
    error_log('build template');
  }

  public function app_html() {

    //error_log('this is app html!!!');
    ob_start();
    ?>
    <?php

    $html = ob_get_clean();

    return $html;
  }

}

?>
