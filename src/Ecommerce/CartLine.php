<?php

namespace Drupal\ecommerce\Ecommerce;


/*
 * @Todo Extend from LineItem and this class must convert into ProductLinecar
 *
 * In LineItem abstract Class must be
 *
 * getReference()
 *
 *  cart -> cartLine -> cartLineItem
 *
 * cartLine must implement getReference();
 *
 * @Todo The diferenc between the number of items and de total price is nos clear
 */
class CartLine implements CartLineInterface {

  protected $amount;
  protected $product;

  function __construct(CartLineItemInterface $product, $quantity = 1) {
    $this->product = $product;
    $this->quantity = $quantity;
  }

  /**
   * @deprecated Replace by getQuantity
   */
  public function getAmount() {
    return $this->getQuantity();
  }

  public function getProduct() {
    return $this->product;
  }

  public function getQuantity() {
    return $this->quantity;
  }

  /*
   * @todo here we depende from object Product, instead we must depend from a interface.
   */
  public function getProductReference() {
    return $this->getProduct()->getReference();
  }

  public function lineCartAmount() {
    return $this->getQuantity() *  $this->getProduct()->getPrice();
  }

  /**
   * @deprecated Replace by increaseQuantity
   */
  public function increaseAmount($increment = 1) {
    $this->increaseQuantity($increment);
  }
  public function increaseQuantity($increment = 1) {
    $this->quantity += $increment;
  }

  public static function create($product, $quantity = 1) {
    return new static($product, $quantity);
  }

}