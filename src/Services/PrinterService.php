<?php

namespace Drupal\ecommerce\Services;

use Drupal\ecommerce\Components\Printer\FactoryPrinter;

class PrinterService {

  private $printer;
  private $ecommerceManager;

  public function __construct($ecommerceManager) {
    $this->ecommerceManager = $ecommerceManager;
    $this->setDisplay('full');
  }

  public function setDisplay($display) {
    $this->printer = FactoryPrinter::create($display);
  }

  public function render() {
    return $this->printer->render(
      $this->ecommerceManager->getProductsFromBasket(),
      $this->ecommerceManager->getBasketTotalAmount()
    );
  }

}