<?php

namespace Drupal\ecommerce\Adapters;

use malotor\shoppingcart\Application\ItemRepositoryInterface;
use malotor\shoppingcart\Application\ItemFactory;

class ProductRepository implements ItemRepositoryInterface {

  private $entityStorage;

  const ENTITY_NAME = "node";

  public function __construct($entityManager) {
    $this->entityStorage = $entityManager->getStorage(self::ENTITY_NAME);
  }

  public function get($id) {

    $nodeProduct = $this->entityStorage->load($id);

    $product = $this->createItem($nodeProduct);

    return $product;
  }

  protected function createItem($nodeProduct) {
    return ItemFactory::create(
      $nodeProduct->id(),
      $nodeProduct->title->value,
      $nodeProduct->field_reference->value,
      $nodeProduct->body->value,
      $nodeProduct->field_price->value
    );
  }

  /*
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
  */
}