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
  protected $item;

  function __construct(CartLineItemInterface $cartLineItem, $quantity = 1) {
    $this->item = $cartLineItem;
    $this->quantity = $quantity;
  }

  /**
   * @deprecated Replace by getQuantity
   */
  public function getAmount() {
    return $this->getQuantity();
  }
  /**
   * @deprecated Replace by getItem
   */
  public function getProduct() {
    return $this->getItem();
  }

  public function getItem() {
    return $this->item;
  }

  public function getQuantity() {
    return $this->quantity;
  }

  /*
   * @todo here we depende from object Product, instead we must depend from a interface.
   */
  public function getProductReference() {
    return $this->getItem()->getReference();
  }

  public function lineCartAmount() {
    return $this->getQuantity() *  $this->getItem()->getPrice();
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

  public static function create(CartLineItemInterface $item, $quantity = 1) {
    return new static($item, $quantity);
  }

}