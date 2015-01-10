<?php

namespace Drupal\ecommerce\Ecommerce\Adapters;

use malotor\ecommerce\Adapters\ProductRepositoryInterface;
use malotor\ecommerce\ProductFactory;

class ProductRepository implements ProductRepositoryInterface {

  private $entityStorage;

  public function __construct() {
    $this->entityStorage = \Drupal::entityManager()->getStorage("product_entity");
  }

  public function getProductByReference($reference) {
    $productEntity = $this->entityStorage->loadByProperties(['reference' => $reference]);
    $productEntity = array_shift(array_values($productEntity));
    $product = ProductFactory::createProduct($productEntity->getName(), $productEntity->getReference(), $productEntity->getDescription(), $productEntity->getPrice());
    return $product;
  }

  public function get($id) {
    $productEntity = $this->entityStorage->load($id);
    $product = ProductFactory::createProduct($productEntity->getName(), $productEntity->getReference(), $productEntity->getDescription(), $productEntity->getPrice());
    return $product;
  }

  public function save($product) {
    return new Product();
  }

}