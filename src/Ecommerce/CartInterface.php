<?php


namespace Drupal\ecommerce\Ecommerce;

interface CartInterface {

  /*
   * @Todo change function name to countItem()
   */
  public function countProducts();
  public function countItems();
  /*
   * @Todo change function name to addCartItem
   */
  public function addItem(CartLineInterface $newLineCart);
  /*
   * @Todo change function name to removeCartItem
   */
  public function removeProduct($productReference);

  public function totalAmount();

  public function getCartLines();

  public function getCartItem($position);
}