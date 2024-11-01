<?php

class PopupcontentController {
  private $function_kind;

  public function __construct() {
    $this->function_kind = ((isset($_REQUEST['function_kind']) && $_REQUEST['function_kind'] != '') ? sanitize_text_field(stripslashes($_REQUEST['function_kind'])) : '');
  }

  public function execute() {
    $task = isset($_REQUEST['task']) ? sanitize_text_field(stripslashes($_REQUEST['task'])) : 'display';
    if ( method_exists($this, $task) ) {
      $this->$task();
    }
    else {
      $this->display();
    }
  }

  public function display() {
    require_once WD_WDTI_DIR . '/popupcontent/model.php';
    $model = new PopupcontentModel();
    require_once WD_WDTI_DIR . '/popupcontent/view.php';
    $view = new PopupcontentView($this->function_kind, $model);
    $view->execute();
  }
}
