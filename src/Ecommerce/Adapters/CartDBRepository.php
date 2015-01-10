<?php

namespace Drupal\ecommerce\Ecommerce\Adapters;

//use Symfony\Component\HttpFoundation\Session\Session;

use malotor\ecommerce\Adapters\CartRepositoryInterface;
use malotor\ecommerce\CartLine;
use malotor\ecommerce\Cart;

class CartRepository implements CartRepositoryInterface {

  public function __construct() {
    $this->account = \Drupal::service("current_user");
    $this->productRepository = \Drupal::service("ecommerce.product_dao");
  }

  public function get() {

    $id = $this->account->id();

    $result = db_select('CartLine', 'c')
      ->fields('c')
      ->condition('c.user_id', $id)
      ->execute();


    $cart = new Cart();

    foreach ($result as $record) {
      $cart->addCartLine(CartLine::create($this->productRepository->getProductByReference($record->item_id), $record->item_quantity));
    }

    return $cart;

  }

  public function save($shoppingCart) {

    $id = $this->account->id();




    db_delete('CartLine')
      ->condition('user_id', $id)
      ->execute();



    $chartIterator = $shoppingCart->getIterator();
    foreach ($chartIterator as $key => $cartline) {

      $fields = array(
        'user_id' => $id,
        'item_id' => $cartline->getItemReference(),
        'item_quantity' => $cartline->getQuantity(),
      );



      $result = db_insert('CartLine')
        ->fields($fields)
        ->execute();

    }

  }
  /*
   public function get() {

    $session = new Session();
    $shoppingCart = $session->get ('shoppingCart');

    if ($shoppingCart)
      return unserialize ($shoppingCart);
    else return new Cart();

  }

  public function save($shoppingCart) {

    $session = new Session();
    $session->set (
      'shoppingCart',
      serialize ($shoppingCart)
    );

    $session->save ();

  }
  */
}