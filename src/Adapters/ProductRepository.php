<?php

namespace Drupal\ecommerce\Adapters;

use malotor\shoppingcart\Application\ItemRepositoryInterface;
use malotor\shoppingcart\Application\ItemFactory;

class ProductRepository implements ItemRepositoryInterface {

  private $productEntityDAO;

  public function __construct($productEntityDAO) {
    $this->productEntityDAO = $productEntityDAO;
  }

  public function get($id) {

    $productEntity = $this->productEntityDAO->get($id);

    $product = ItemFactory::create(
      $productEntity->id(),
      $productEntity->title->value,
      $productEntity->field_reference->value,
      $productEntity->body->value,
      $productEntity->field_price->value
    );

    return $product;
  }

  protected function getProductByProperty($propertyName, $propertyValue) {
    $productEntity = $this->productEntityDAO->getByProperty($propertyName, $propertyValue);
    $productEntity = array_shift(array_values($productEntity));
    $product = ItemFactory::create(
      $productEntity->id(),
      $productEntity->title->value,
      $productEntity->field_reference->value,
      $productEntity->body->value,
      $productEntity->field_price->value
    );
    return $product;
  }

  public function getProductByReference($reference) {
    return $this->getProductByProperty('reference', $reference);
  }

  public function save($product) {
  }

}