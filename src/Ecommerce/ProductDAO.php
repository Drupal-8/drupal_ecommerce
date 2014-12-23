<?php

namespace Drupal\ecommerce\Ecommerce;

class ProductDAO implements ProductDAOInterface {

  public function get($nid) {

    $productEntity = \Drupal::entityManager()->getStorage("product_entity")->load($nid);

    $product = new Product() ;
    $product->setName($productEntity->getName())
      ->setDescription($productEntity->getDescription())
      ->setReference($productEntity->getReference())
      ->setPrice($productEntity->getPrice());

    return $product;
  }

  public function save($product) {

    $entityProduct = \Drupal::entityManager()->getStorage("product_entity");

    $entityProduct->save($product);

    return $product;
  }


}