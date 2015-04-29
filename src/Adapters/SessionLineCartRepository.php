<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 08/03/15
 * Time: 11:27
 */

namespace Drupal\ecommerce\Adapters;

use Symfony\Component\HttpFoundation\Session\Session;

use malotor\shoppingcart\Application\CartLineFactory;
use malotor\shoppingcart\Application\CartLineRepositoryInterface;
use malotor\shoppingcart\Domain\CartLineInterface;

class SessionLineCartRepository implements CartLineRepositoryInterface {

  public function __construct($current_user, $productRepository) {
    $this->account = $current_user;
    $this->itemRepository = $productRepository;
    $this->userId = $this->account->id();
    $this->session = new Session();
  }

  public function getAll() {
    $cartLines = $this->session->get('cartLines', array());

    $domainCartLines = [];
    foreach($cartLines as $cartLine) {
      $item = $this->itemRepository->get($cartLine['id']);
      $domainCartLines[] = CartLineFactory::create($item,$cartLine['quantity']);
    }
    return $domainCartLines;
  }

  public function removeAll() {
    $this->session->set('cartLines', array());
  }

  public function save(CartLineInterface $cartLine) {

    $cartLineArray['id'] = $cartLine->getItem()->getId();
    $cartLineArray['quantity'] = $cartLine->getQuantity();

    $cartLines = $this->session->get('cartLines', array());

    $cartLines[] = $cartLineArray;

    $this->session->set('cartLines', $cartLines);
  }
} 