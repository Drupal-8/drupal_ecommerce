<?php

namespace Drupal\ecommerce\Adapters;

use Symfony\Component\HttpFoundation\Session\Session;

use malotor\shoppingcart\Application\Factory\BasketFactory;
use malotor\shoppingcart\Application\Repository\BasketRepository as BasketRepositoryInterface;


class BasketSessionRepository implements BasketRepositoryInterface {

  public function __construct($current_user, $productDAO) {
    $this->account = $current_user;
    $this->productDAO = $productDAO;
    $this->userId = $this->account->id();
    
    $this->session = new Session();
  }

  public function get($baskedId) {

    $cartLines = $this->session->get('cartLines', array());

    foreach ($cartLines as $row) {
      
      $productEntity = $this->productDAO->get($row['item_id']);
      
      $productStdObject = new \stdClass();
      $productStdObject->id = $row['item_id'];
      $productStdObject->price = $productEntity->field_price->value;
      $productStdObject->quantity = $row['quantity'];
    	
    	$products[] = $productStdObject;
    }

    return BasketFactory::create($products);
  }

  public function save($basket) {

  	$this->session->set('cartLines', array());

    $cartLines = array();
    foreach ($basket->getItems() as $product) {
    	$cartLine = array(
	      'user_id' => (int) $this->userId,
	      'item_id' => (int) $product->getId(),
	      'quantity' => (int) $product->getQuantity(),
	    );

	    $cartLines[] = $cartLine;
   	}

    $this->session->set('cartLines', $cartLines);
  }
} 