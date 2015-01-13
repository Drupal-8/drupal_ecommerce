<?php

namespace Drupal\ecommerce\Ecommerce;

abstract class TablePrinter {

  protected $header;
  protected $rows;

  public function __construct() {
    $this->header = [];
    $this->rows = [];
  }

  abstract protected function prepareRows();
  abstract protected function prepareHeader();

  public function render($params = []) {

    $this->prepareHeader();

    $this->prepareRows();

    return array(
      '#theme' => 'table',
      '#header' => $this->header,
      '#rows' => $this->rows,
      '#attributes' => array('class' => array('table-class'))
    );
  }
}