<?php

namespace Drupal\ecommerce\Ecommerce\Adapters;

use malotor\ecommerce\Adapters\CartRepositoryInterface;
use malotor\ecommerce\Cart;

class CartDBRepository implements CartRepositoryInterface {

  public function __construct($cartLineRepository) {
    $this->cartLineRepository = $cartLineRepository;
  }

  public function get() {

    $carLines = $this->cartLineRepository->getCartLines();
    $cart = new Cart();
    foreach ($carLines as $carLine) {
      $cart->addCartLine($carLine);
    }
    return $cart;

  }

  public function save($shoppingCart) {

    $this->cartLineRepository->deleteCartLines();
    $chartIterator = $shoppingCart->getIterator();
    foreach ($chartIterator as $cartline) {
      $this->cartLineRepository->insertCartLines($cartline);
    }
  }

}