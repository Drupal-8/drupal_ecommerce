<?php

namespace Drupal\ecommerce\Adapters;

use malotor\shoppingcart\Application\Repository\ProductRepository as ProductRepositoryInterface;
use malotor\shoppingcart\Application\Factory\ProductFactory;

class ProductRepository implements ProductRepositoryInterface {

  private $entityStorage;

  const ENTITY_NAME = "node";

  public function __construct($couponRepository) {
    $this->couponRepository = $couponRepository;
  }

  public function get($id) {
    $coupon = $this->couponRepository->load($id);
    $object = new \stdClass();
    $object->id = $coupon->id();
    $object->price = $coupon->field_price->value;
    return ProductFactory::create($object);
  }

}