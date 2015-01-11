<?php

namespace Drupal\ecommerce\Ecommerce\Adapters;

//use Symfony\Component\HttpFoundation\Session\Session;

use malotor\ecommerce\Adapters\CartRepositoryInterface;
use malotor\ecommerce\CartLine;
use malotor\ecommerce\Cart;

class CartDBRepository implements CartRepositoryInterface {

  private $userId;

  public function __construct($current_user, $productRepository) {
    $this->account = $current_user;
    $this->productRepository = $productRepository;
    $this->userId = $this->account->id();
  }

  private function getCartLines() {
    $result = db_select('CartLine', 'c')
      ->fields('c')
      ->condition('c.user_id', $this->userId)
      ->execute();
    $cartLines = [];
    foreach ($result as $record) {
      $cartLines[] = CartLine::create($this->productRepository->getProductByReference($record->item_id), $record->item_quantity);
    }
    return $cartLines;
  }

  private function deleteCartLines() {
    db_delete('CartLine')
      ->condition('user_id', $this->userId)
      ->execute();
  }

  private function insertCartLines($cartline) {

    $fields = array(
      'user_id' => $this->userId,
      'item_id' => $cartline->getItemReference(),
      'item_quantity' => $cartline->getQuantity(),
    );
    db_insert('CartLine')
      ->fields($fields)
      ->execute();
  }

  public function get() {

    $carLines = $this->getCartLines();
    $cart = new Cart();
    foreach ($carLines as $carLine) {
      $cart->addCartLine($carLine);
    }
    return $cart;

  }

  public function save($shoppingCart) {

    $this->deleteCartLines();
    $chartIterator = $shoppingCart->getIterator();
    foreach ($chartIterator as $cartline) {
      $this->insertCartLines($cartline);
    }
  }

}