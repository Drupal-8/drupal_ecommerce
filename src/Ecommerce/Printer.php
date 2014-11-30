<?php

namespace Drupal\ecommerce\Ecommerce;

class Printer {


  static public function printShortShoppingCart($shoppingCart) {
    
    $cartLines = $shoppingCart->getCartLines();
    foreach ($cartLines as $key => $cartline) {
      $items[] = $cartline->getAmount() . ' x ' . $cartline->getProduct()->getName();
    }
    return array(
      'cartitems' => array(
        '#theme' => 'item_list',
        '#items' => $items,
      ),
      'carttotal' => array(
        '#markup' => 'Total: ' . self::formatPrice($shoppingCart->totalAmount())
      ),
    );

  }


  static public function printShoppingCart($shoppingCart) {

    $tranlationManager = \Drupal::translation();

    $cartLines = $shoppingCart->getCartLines();
    foreach ($cartLines as $key => $cartline) {
      $rows[] = array(
        $cartline->getAmount(),
        $cartline->getProduct()->getName(),
        $cartline->getProduct()->getPrice(),
        self::formatPrice($cartline->lineCartAmount())
      );
    }

    $header = array(
      $tranlationManager->translate('Amount'),
      $tranlationManager->translate('Product'),
      $tranlationManager->translate('Price'),
      $tranlationManager->translate('Total'),
    );


    return array(
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#attributes' => array('class' => array('table-class'))
    );
  }


  static public function formatPrice($price) {
    return number_format($price,2) . "€";
  }

}