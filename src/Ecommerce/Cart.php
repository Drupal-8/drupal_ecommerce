<?php

namespace Drupal\ecommerce\Ecommerce;

class Cart  {

  protected $lineCarts;

  public function __construct() {
    $this->lineCarts = array();
  }

  /*
   * @Todo change function name to countItem()
   */
  public function countProducts() {
    return count($this->lineCarts);
  }

  /*
   * @Todo change function name to addCartItem
   */
  public function addItem($newLineCart) {

    foreach ($this->lineCarts as $lineCart) {
      if ($newLineCart->getProductReference() ==  $lineCart->getProductReference() ) {
        $newLineCart->increaseAmount($lineCart->getAmount());
      }
    }

    $this->lineCarts[ $newLineCart->getProductReference() ]= $newLineCart;
  }

  /*
 * @Todo change function name to removeCartItem
 */
  public function removeProduct($productReference) {
    unset($this->lineCarts[$productReference]);
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
}