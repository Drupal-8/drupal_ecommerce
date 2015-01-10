<?php

namespace Drupal\ecommerce\Ecommerce\Adapters;

use Symfony\Component\HttpFoundation\Session\Session;

use malotor\ecommerce\Adapters\CartRepositoryInterface;
use malotor\ecommerce\Cart;

class CartSessionRepository implements CartRepositoryInterface {


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

}