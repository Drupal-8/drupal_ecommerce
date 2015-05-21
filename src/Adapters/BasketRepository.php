<?php

namespace Drupal\ecommerce\Adapters;

use Symfony\Component\HttpFoundation\Session\Session;

use malotor\shoppingcart\Application\Factory\BasketFactory;
use malotor\shoppingcart\Application\Repository\BasketRepository as BasketRepositoryInterface;

use malotor\shoppingcart\Domain\Entity\Basket;

class BasketRepository implements BasketRepositoryInterface {

  public function __construct($couponRepository, $lineCartDataProvider) {
    $this->couponRepository = $couponRepository;
    $this->dataProvider =  $lineCartDataProvider;
  }

  public function get($baskedId) {
    $cartLines = $this->dataProvider->getAll();
    $products = array();
    foreach ($cartLines as $row) {
      $coupon = $this->couponRepository->load($row->item_id);
      
      $object = new \stdClass();
      $object->id = $row->item_id;
      $object->price = $coupon->field_price->value;
      $object->quantity = $row->quantity;
    	
      $products[] = $object;
    }

    return BasketFactory::create($products);
  }

  public function save(Basket $basket) {
    $lineCarts = $basket->getItems();
  	$this->dataProvider->save($lineCarts);
  }
} 