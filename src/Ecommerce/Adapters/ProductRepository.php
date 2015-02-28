<?php

namespace Drupal\ecommerce\Ecommerce\Adapters;

use malotor\shoppingcart\Ports\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface {

  private $productEntityDAO;

  public function __construct($productEntityDAO) {
    $this->productEntityDAO = $productEntityDAO;
  }

  public function get($id) {
    $productEntity = $this->productEntityDAO->get($id);
    //$product = ProductFactory::createProduct($productEntity->getName(), $productEntity->getReference(), $productEntity->getDescription(), $productEntity->getPrice());
    return $productEntity;
  }

  protected function getProductByProperty($propertyName, $propertyValue) {
    $productEntity = $this->productEntityDAO->getByProperty($propertyName, $propertyValue);
    $productEntity = array_shift(array_values($productEntity));
    //$product = ProductFactory::createProduct($productEntity->getName(), $productEntity->getReference(), $productEntity->getDescription(), $productEntity->getPrice());
    return $productEntity;
  }

  public function getProductByReference($reference) {
    return $this->getProductByProperty('reference', $reference);
  }

  public function save($product) {
  }

}