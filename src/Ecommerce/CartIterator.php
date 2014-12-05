<?php


namespace Drupal\ecommerce\Ecommerce;

use Drupal\ecommerce\Ecommerce\CartInterface;

class CartIterator {
  protected $cart;
  protected $position = 0;

  public function __construct(CartInterface $cart) {
    $this->cart = $cart;
  }
  public function current() {
    $cartLines = $this->cart->getCartLines();
    if ($this->cart->countProducts() == 0 ) return null;
    return $cartLines[$this->position];
  }
} 