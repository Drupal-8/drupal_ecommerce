<?php

namespace Drupal\ecommerce\Services;

use Drupal\ecommerce\Components\Printer\FactoryPrinter;

class PrinterService {

  private $printer;
  private $ecommerceManager;

  public function __construct($ecommerceManager) {
    $this->ecommerceManager = $ecommerceManager;
    //Default display;
    $this->setDisplay('full');
  }

  public function setDisplay($display) {
    $this->printer = FactoryPrinter::create($display);
  }

  public function render() {
    return $this->printer->render(
      $this->ecommerceManager->getCartItems(),
      $this->ecommerceManager->getCartTotalAmunt()
    );
  }

}