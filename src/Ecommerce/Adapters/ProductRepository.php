<?php

namespace Drupal\ecommerce\Ecommerce\Adapters;

use malotor\ecommerce\Adapters\ProductRepositoryInterface;
use malotor\ecommerce\ProductFactory;

class ProductRepository implements ProductRepositoryInterface {

  public function get($nid) {

    $productEntity = \Drupal::entityManager()->getStorage("product_entity")->load($nid);

    $product = ProductFactory::createProduct($productEntity->getName(), $productEntity->getReference(), $productEntity->getDescription(), $productEntity->getPrice());

    return $product;
  }

  public function save($product) {

    $entityProduct = \Drupal::entityManager()->getStorage("product_entity");

    $entityProduct->save($product);

    return $product;
  }


}