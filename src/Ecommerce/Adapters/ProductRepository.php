<?php

namespace Drupal\ecommerce\Ecommerce\Adapters;

use malotor\ecommerce\Adapters\ProductRepositoryInterface;
use malotor\ecommerce\ProductFactory;

class ProductRepository implements ProductRepositoryInterface {

  private $entityStorage;

  public function __construct($entityManager) {
    $this->entityStorage = $entityManager->getStorage("product_entity");
  }

  protected function getProductByProperty($propertyName, $propertyValue) {
    $productEntity = $this->entityStorage->loadByProperties([$propertyName => $propertyValue]);
    $productEntity = array_shift(array_values($productEntity));
    $product = ProductFactory::createProduct($productEntity->getName(), $productEntity->getReference(), $productEntity->getDescription(), $productEntity->getPrice());
    return $product;
  }

  public function getProductByReference($reference) {
    return $this->getProductByProperty('reference', $reference);
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