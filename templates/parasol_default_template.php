<?php

class Parasol_Default_Template {

  public function __construct() {
    error_log('throw template');
  }

  public function app_html() {

    error_log('this is the error shell');
    ob_start();
    ?>
    <!-- a bell is a cup - until it is struck -->
    <?php

    $html = ob_get_clean();

    return $html;
  }

}

?>
