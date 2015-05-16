<?php

namespace Drupal\ecommerce\Adapters;

use Symfony\Component\HttpFoundation\Session\Session;

use malotor\shoppingcart\Application\Factory\BasketFactory;
use malotor\shoppingcart\Application\Repository\BasketRepository as BasketRepositoryInterface;


class BasketRepository implements BasketRepositoryInterface {

  public function __construct($current_user, $productDAO) {
    $this->account = $current_user;
    $this->productDAO = $productDAO;
    $this->userId = $this->account->id();
    $this->dbConnection = \Drupal::service("database");
  }

  public function get($baskedId) {

  	$result = $this->dbConnection->select('linecart', 'ln')
      ->fields('ln')
      ->condition('user_id', $this->userId,'=')
      ->execute();

    $products = array();
    foreach ($result as $row) {
      
      $productEntity = $this->productDAO->get($row->item_id);
      
      $productStdObject = new \stdClass();
      $productStdObject->id = $row->item_id;
      $productStdObject->price = $productEntity->field_price->value;
      $productStdObject->quantity = $row->quantity;
    	
    	$products[] = $productStdObject;
    }

    return BasketFactory::create($products);
  }

  public function save($basket) {

  	$this->dbConnection->delete('linecart')
      ->condition('user_id', (int) $this->userId)
      ->execute();

    foreach ($basket->getItems() as $product) {
    	$fields = array(
	      'user_id' => (int) $this->userId,
	      'item_id' => (int) $product->getId(),
	      'quantity' => (int) $product->getQuantity(),
	    );

	    $this->dbConnection->insert('linecart')
	      ->fields($fields)
	      ->execute();
	    }
  	}

} 