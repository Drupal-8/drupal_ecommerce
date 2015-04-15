<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 08/03/15
 * Time: 11:27
 */

namespace Drupal\ecommerce\Ecommerce\Adapters;

use malotor\shoppingcart\Application\CartLineFactory;
use malotor\shoppingcart\Application\CartLineRepositoryInterface;
use malotor\shoppingcart\Domain\CartLineInterface;

class DBLineCartRepository implements CartLineRepositoryInterface {

  public function __construct($current_user, $productRepository) {
    $this->account = $current_user;
    $this->itemRepository = $productRepository;
    $this->userId = $this->account->id();
    $this->dbConnection = \Drupal::service("database");
  }

  public function getAll() {

    $result = $this->dbConnection->select('linecart', 'ln')
      ->fields('ln')
      ->condition('user_id', $this->userId,'=')
      ->execute();

    $domainCartLines = array();

    foreach ($result as $row) {
      $item = $this->itemRepository->get($row->item_id);
      $domainCartLines[] = CartLineFactory::create($item,$row->quantity);
    }
    return $domainCartLines;
  }

  public function removeAll() {

    $this->dbConnection->delete('linecart')
      ->condition('user_id', (int) $this->userId)
      ->execute();
  }

  public function save(CartLineInterface $cartLine) {

    $fields = array(
      'user_id' => (int) $this->userId,
      'item_id' => (int) $cartLine->getItem()->getId(),
      'quantity' => (int) $cartLine->getQuantity(),
    );

    $this->dbConnection->insert('linecart')
      ->fields($fields)
      ->execute();
  }
} 