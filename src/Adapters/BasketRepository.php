<?php

namespace Drupal\ecommerce\Adapters;

use Symfony\Component\HttpFoundation\Session\Session;

use malotor\shoppingcart\Application\Factory\BasketFactory;
use malotor\shoppingcart\Application\Repository\BasketRepository as BasketRepositoryInterface;

//use Drupal\ecommerce\Components\DataProvider\LineCartDatabaseProvider;

class BasketRepository implements BasketRepositoryInterface {

  public function __construct($productRepository, $lineCartDataProvider) {
    $this->productRepository = $productRepository;
    $this->dataProvider =  $lineCartDataProvider;
  }

  public function get($baskedId) {
  	
    $cartLines = $this->dataProvider->getAll();

    $products = array();

    foreach ($cartLines as $row) {
      
      $productEntity = $this->productRepository->get($row->item_id);
      
      $productStdObject = new \stdClass();
      $productStdObject->id = $row->item_id;
      $productStdObject->price = $productEntity->field_price->value;
      $productStdObject->quantity = $row->quantity;
    	
    	$products[] = $productStdObject;
    }

    return BasketFactory::create($products);
  }

  public function save($basket) {
    $lineCarts = $basket->getItems();
  	$this->dataProvider->save($lineCarts);
  }
} 