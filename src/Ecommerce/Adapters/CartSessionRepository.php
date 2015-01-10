<?php

namespace Drupal\ecommerce\Ecommerce\Adapters;

use Symfony\Component\HttpFoundation\Session\Session;

use malotor\ecommerce\Adapters\CartRepositoryInterface;
use malotor\ecommerce\Cart;

class CartSessionRepository implements CartRepositoryInterface {

  public function get() {
    $cart = new Cart();
    $session = new Session();

    if ($shoppingCart = $session->get ('shoppingCart')) $cart = unserialize ($shoppingCart);

    return $cart;
  }

  public function save($shoppingCart) {

    $session = new Session();
    $session->set (
      'shoppingCart',
      serialize ($shoppingCart)
    );

    $session->save ();

  }

}