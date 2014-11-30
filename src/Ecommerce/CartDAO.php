<?php

namespace Drupal\ecommerce\Ecommerce;

use Symfony\Component\HttpFoundation\Session\Session;

class CartDAO {

  static public function get() {

    $session = new Session();
    $shoppingCart = $session->get('shoppingCart');

    if ($shoppingCart) return unserialize($shoppingCart);
    else return new Cart();

  }

  static public function save($shoppingCart) {

    $session = new Session();
    $session->set (
      'shoppingCart',
      serialize($shoppingCart)
    );

    $session->save();

  }

}