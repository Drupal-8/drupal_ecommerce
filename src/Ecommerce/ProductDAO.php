<?php

namespace Drupal\ecommerce\Ecommerce;

class ProductDAO {

  public static function get($nid) {

    $entityProdut = \Drupal::entityManager()->getStorage("product")->load($nid);

    $product = new Product();
    $product->setName($entityProdut->getName())
      ->setDescription($entityProdut->getProductField());

    return $product;
  }

}