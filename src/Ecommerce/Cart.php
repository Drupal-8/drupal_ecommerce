<?php

namespace Drupal\ecommerce\Ecommerce;

class Cart  {

  protected $lineCarts;

  public function __construct() {
    $this->lineCarts = array();
  }

  /*
   * @Todo change function name to countItem()
   * @Deprecated see countItem()
   *
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
  public function addItem($newLineCart) {

    $flag = true;
    foreach ($this->lineCarts as $lineCart) {
      if ($newLineCart->getProductReference() == $lineCart->getProductReference() ) {
        $lineCart->increaseAmount($newLineCart->getAmount());
        $flag = false;
      }
    }
    //@Todo remove flag
    if ($flag) $this->lineCarts[] = $newLineCart;
  }

  /*
  * @Todo change function name to removeCartItem
  * @Todo is key don´ exists we must throw an exception
  */
  public function removeProduct($productReference) {
    foreach ($this->lineCarts as $key => $lineCart) {
      if ($productReference ==  $lineCart->getProductReference() ) {
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
    return $this->lineCarts[$index];
  }

  public function getIterator() {
    return new CartIterator($this);
  }
}