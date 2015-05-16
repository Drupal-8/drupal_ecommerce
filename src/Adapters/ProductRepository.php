<?php

namespace Drupal\ecommerce\Adapters;

use malotor\shoppingcart\Application\Repository\ProductRepository as ProductRepositoryInterface;
use malotor\shoppingcart\Application\Factory\ProductFactory;

class ProductRepository implements ProductRepositoryInterface {

  private $entityStorage;

  const ENTITY_NAME = "node";

  public function __construct($entityManager) {
    $this->entityStorage = $entityManager->getStorage(self::ENTITY_NAME);
  }

  public function get($id) {
    $nodeProduct = $this->entityStorage->load($id);
    
    $productStdObj = new \stdClass();
    $productStdObj->id = $nodeProduct->id();
    $productStdObj->price = $nodeProduct->field_price->value;
    return ProductFactory::create($productStdObj);
  }

}