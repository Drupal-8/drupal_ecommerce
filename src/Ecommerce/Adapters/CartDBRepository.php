<?php

namespace Drupal\ecommerce\Ecommerce\Adapters;

//use Symfony\Component\HttpFoundation\Session\Session;

use malotor\ecommerce\Adapters\CartRepositoryInterface;
use malotor\ecommerce\CartLine;
use malotor\ecommerce\Cart;

class CartDBRepository implements CartRepositoryInterface {

  private $userId;

  public function __construct() {
    $this->account = \Drupal::service("current_user");
    $this->productRepository = \Drupal::service("ecommerce.product_dao");
    $this->userId = $this->account->id();
  }

  public function get() {
    $result = db_select('CartLine', 'c')
      ->fields('c')
      ->condition('c.user_id', $this->userId)
      ->execute();
    $cart = new Cart();

    foreach ($result as $record) {
      $cart->addCartLine(CartLine::create($this->productRepository->getProductByReference($record->item_id), $record->item_quantity));
    }

    return $cart;

  }

  public function save($shoppingCart) {

    db_delete('CartLine')
      ->condition('user_id', $this->userId)
      ->execute();

    $chartIterator = $shoppingCart->getIterator();

    foreach ($chartIterator as $key => $cartline) {
      $fields = array(
        'user_id' => $this->userId,
        'item_id' => $cartline->getItemReference(),
        'item_quantity' => $cartline->getQuantity(),
      );

      db_insert('CartLine')
        ->fields($fields)
        ->execute();
    }
  }

}