<?php

namespace Drupal\ecommerce\Ecommerce;

class EcommercePrinter {

  static public function printShortShoppingCart($shoppingCart) {
    $printer = new CartTemplatePrinter($shoppingCart);
    return $printer->render();
  }

  public function printShoppingCart($shoppingCart) {

    //Create the printer and render
    $printer = new CartTablePrinter($shoppingCart);
    return $printer->render();
  }

}