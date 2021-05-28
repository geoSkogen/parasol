<?php

class Parasol_Thrigrams_Template {

  public function __construct() {
    error_log('throw template');
  }

  public function app_html() {

    error_log('this is app html!!!');
    ob_start();
    ?>
    <h1>Trigrams</h1>
    <?php

    $html = ob_get_clean();

    return $html;
  }

}

?>
