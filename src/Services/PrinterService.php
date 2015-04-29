<?php

namespace Drupal\ecommerce\Controller;

use Drupal\ecommerce\Ecommerce\Components\Printer;

class PrinterService {

  private $printer;
  private $ecommerceManager;

  public function __construct($ecommerceManager) {
    $this->ecommerceManager = $ecommerceManager;
  }

  public function setPrinter($display) {
    $this->printer = Printer\FactoryPrinter::create($display);
  }

  public function render() {
    return $this->printer->render(
      $this->ecommerceManager->getCartItems(),
      $this->ecommerceManager->getCartTotalAmunt()
    );
  }

}