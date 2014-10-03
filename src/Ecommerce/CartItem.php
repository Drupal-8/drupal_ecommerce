<?php

namespace Drupal\ecommerce\Ecommerce;

class CartItem {

  protected $amount;
  protected $product;

  /**
   * @return mixed
   */
  public function getAmount() {
    return $this->amount;
  }

  /**
   * @return mixed
   */
  public function getProduct() {
    return $this->product;
  }

  function __construct($product, $amount = 1) {
    $this->product = $product;
    $this->amount = $amount;
  }

  public function getProductReference() {
    return $this->getProduct()->getReference();
  }

  public function lineCartAmount() {
    return $this->getAmount() *  $this->getProduct()->getPrice();
  }

  public function increaseAmount($increment) {
    $this->amount += $increment;
  }

  public static function create($product, $amount = 1) {
    return new static($product, $amount);
  }

}