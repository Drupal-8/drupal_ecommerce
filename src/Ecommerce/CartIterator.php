<?php

namespace Drupal\ecommerce\Ecommerce;

use Drupal\ecommerce\Ecommerce\CartInterface;

class CartIterator implements \Iterator {
  protected $cart;
  protected $position = 0;

  public function __construct( $cart) {
    $this->cart = $cart;
    $this->cartLines = $this->cart->getCartLines();
  }
  public function current() {
    if ($this->cart->countProducts() == 0 ) return null;
    return $this->cartLines[$this->position];
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
    return isset($this->cartLines[$this->position]);
  }
} 