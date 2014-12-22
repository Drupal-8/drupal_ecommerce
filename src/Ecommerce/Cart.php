<?php

namespace Drupal\ecommerce\Ecommerce;

class Cart implements CartInterface {

  protected $lineCarts;

  public function __construct() {
    $this->lineCarts = array();
  }

  /**
   * @deprecated Replace by countItems()
   */
  public function countProducts() {
    return $this->countItems();
  }
  public function countItems() {
    return count($this->lineCarts);
  }

  /*
   * @Todo change function name to addCartItem
   */
  public function addItem(CartLineInterface $newLineCart) {

    $flag = true;
    foreach ($this->lineCarts as $lineCart) {
      if ($newLineCart->getProductReference() == $lineCart->getProductReference() ) {
        $lineCart->increaseAmount($newLineCart->getQuantity());
        $flag = false;
      }
    }
    //@Todo remove flag
    if ($flag) $this->lineCarts[] = $newLineCart;
  }

  /*
  * @Deprecated
  */
  public function removeProduct($productReference) {
    $this->removeItem($productReference);
  }

  public function removeItem($itemReference) {
    foreach ($this->lineCarts as $key => $lineCart) {
      if ($itemReference ==  $lineCart->getProductReference() ) {
        unset($this->lineCarts[$key]);
      }
    }
  }

  public function totalAmount() {
    $result = 0;
    foreach ($this->lineCarts as $lineCart) {
      $result += $lineCart->lineCartAmount();
    }
    return $result;
  }

  public function getCartLines() {
    return $this->lineCarts;
  }

  public function getCartItem($index) {
    if (isset($this->lineCarts[$index]))
      return $this->lineCarts[$index];
    else return null;
  }

  public function getIterator() {
    return new CartIterator($this);
  }
}