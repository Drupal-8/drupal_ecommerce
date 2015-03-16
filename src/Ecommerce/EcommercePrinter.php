<?php

namespace Drupal\ecommerce\Ecommerce;

class EcommercePrinter {

  static public function printShortShoppingCart($shoppingCart,$shoppingCartTotal) {
    $printer = new CartTemplatePrinter($shoppingCart,$shoppingCartTotal);

    /*
    $printer->setParams([
      'cartLines' => $shoppingCart,
      'cartTotalAmount' => $shoppingCartTotal
    ]);
    */
    return $printer->render();
  }

  public function printShoppingCart($shoppingCart) {

    //Create the printer and render
    $printer = new CartTablePrinter($shoppingCart);
    /*
    $printer->setParams([
      'cartLines' => $shoppingCart,
      'cartTotalAmount' => $shoppingCartTotal
    ]);
    */
    return $printer->render();
  }

}