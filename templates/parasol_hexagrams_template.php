<?php

class Parasol_Hexagrams_Template {

  public function __construct() {
    error_log('throw template');
  }

  public function app_html() {

    error_log('this is app html!!!');
    ob_start();
    ?>
    <h1>Hexagrams</h1>
    <?php

    $html = ob_get_clean();

    return $html;
  }

}

?>
