<?php

namespace Drupal\ecommerce\Ecommerce;

class Printer {


  static public function printShoppingCart($shoppingCart) {

    $cartLines = $shoppingCart->getCartLines();
    foreach ($cartLines as $key => $cartline) {
      $rows[] = array(
        $cartline->getAmount(),
        $cartline->getProduct()->getName(),
        $cartline->getProduct()->getPrice(),
        $cartline->lineCartAmount()
      );
    }

    $header = array(
      $this->t('Amount'),
      $this->t('Product'),
      $this->t('Price'),
      $this->t('Total'),
    );


    return array(
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#attributes' => array('class' => array('table-class'))
    );
  }

}