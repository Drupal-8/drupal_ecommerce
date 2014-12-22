<?php

namespace Drupal\ecommerce\Ecommerce;

class EcommercePrinter {

  public function printShortShoppingCart($shoppingCart) {

    $twig = \Drupal::service('twig');

    $chartIterator = $shoppingCart->getIterator();
    foreach ($chartIterator as $key => $cartline) {
      $items[] = $cartline->getQuantity() . ' x ' . $cartline->getProduct()->getName();
    }

    $path = drupal_get_path('module', 'ecommerce') ;
    $params = array(
      'items' => $items,
      'total' => self::formatPrice($shoppingCart->totalAmount()),
    );
    $template = $twig->loadTemplate($path . '/templates/shoppingCart.html.twig');

    $markup = array (
      '#markup' => $template->render($params),
      '#attached' => [
        'css' =>[
          $path . '/assets/css/ecommerce.css'
        ]
      ]
    );

    return $markup;

  }


  static public function printShoppingCart($shoppingCart) {

    $tranlationManager = \Drupal::translation();

    $chartIterator = $shoppingCart->getIterator();
    foreach ($chartIterator as $key => $cartline) {
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