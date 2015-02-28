<?php

namespace Drupal\ecommerce\Ecommerce\Adapters;

use malotor\shoppingcart\Ports\CartRepositoryInterface;
use malotor\shoppingcart\Domain\Cart;

class CartDBRepository implements CartRepositoryInterface {

  public function __construct($cartLineRepository) {
    $this->cartLineRepository = $cartLineRepository;
  }

  public function get() {

    $carLines = $this->cartLineRepository->getCartLines();
    $cart = new Cart();
    foreach ($carLines as $carLine) {
      $cart->addItem($carLine);
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