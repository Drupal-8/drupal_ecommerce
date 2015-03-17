<?php

namespace Drupal\ecommerce\Ecommerce;

class EcommercePrinter {

  public function __construct($ecommerceManager) {
    $this->ecommerceManager = $ecommerceManager;
  }

  public function render($display) {
    switch($display) {
      case 'short':
        $printer = new CartTemplatePrinter($this->ecommerceManager->getCartItems(), $this->ecommerceManager->getCartTotalAmunt());
        break;

      case 'full':
        $printer =  new CartTablePrinter($this->ecommerceManager->getCartItems());
        break;
    }
    return $printer->render();
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('ecommerce.manager')
    );
  }
}