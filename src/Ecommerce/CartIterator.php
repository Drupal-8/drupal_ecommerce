<?php

namespace Drupal\ecommerce\Ecommerce;

use Drupal\ecommerce\Ecommerce\CartInterface;

class CartIterator implements \Iterator {
  protected $cart;
  protected $position = 0;

  public function __construct(CartInterface $cart) {
    $this->cart = $cart;
    //$this->cartLines = $this->cart->getCartLines();
  }
  public function current() {
    if ($this->cart->countItems() == 0 ) return null;
    return $this->cart->getCartItem($this->position);
  }
  public function next() {
    $this->position++;
  }

  public function key() {
    return $this->position;
  }
  public function rewind() {
    $this->position = 0;
  }
  public function valid() {
    return $this->cart->getCartItem($this->position);
  }
} 