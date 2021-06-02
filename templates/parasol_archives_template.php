<?php

class Parasol_Archives_Template {

  public function __construct() {
    error_log('archives template');
  }

  public function app_html() {

    error_log('this is app html!!!');
    ob_start();
    ?>
    <h1>Archives</h1>
    <?php

    $html = ob_get_clean();

    return $html;
  }

}

?>
