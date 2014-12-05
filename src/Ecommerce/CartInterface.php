<?php


namespace Drupal\ecommerce\Ecommerce;

interface CartInterface {

  /*
   * @Todo change function name to countItem()
   */
  public function countProducts();

  /*
   * @Todo change function name to addCartItem
   */
  public function addItem($newLineCart);
  /*
 * @Todo change function name to removeCartItem
 */
  public function removeProduct($productReference);

  public function totalAmount();

  public function getCartLines();
}