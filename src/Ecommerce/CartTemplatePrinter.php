<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 13/01/15
 * Time: 21:14
 */

namespace Drupal\ecommerce\Ecommerce;


class CartTemplatePrinter extends TemplatePrinter {
  public function setTemplate() {
    return EcommerceTools::getBasePath() . '/templates/shoppingCart.html.twig';
  }
  public function prepareParams() {
    $items = [];
    $chartIterator = $this->shoppingCart->getIterator();
    foreach ($chartIterator as $key => $cartline) {
      $items[] = $cartline->getQuantity() . ' x ' . $cartline->getItem()->getName();
    }

    return array(
      'items' => $items,
      'total' => EcommerceTools::formatPrice($this->shoppingCart->totalAmount()),
    );
  }
}