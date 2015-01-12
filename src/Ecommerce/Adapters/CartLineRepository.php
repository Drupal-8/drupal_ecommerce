<?php

namespace Drupal\ecommerce\Ecommerce\Adapters;

use malotor\ecommerce\CartLine;

class CartLineRepository {

  public function __construct($current_user, $productRepository) {
    $this->account = $current_user;
    $this->productRepository = $productRepository;
    $this->userId = $this->account->id();
  }

  public function getCartLines() {
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

  public function deleteCartLines() {
    db_delete('CartLine')
      ->condition('user_id', $this->userId)
      ->execute();
  }

  public function insertCartLines($cartline) {

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