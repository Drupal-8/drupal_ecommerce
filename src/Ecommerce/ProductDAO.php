<?php

namespace Drupal\ecommerce\Ecommerce;

class ProductDAO {

  public static function get($nid) {

    $productEntity = \Drupal::entityManager()->getStorage("product")->load($nid);

    $product = new Product() ;
    $product->setName($productEntity->getName())
      ->setDescription($productEntity->getDescription())
      ->setReference($productEntity->getReference())
      ->setPrice($productEntity->getPrice());
    return $product;
  }

  public static function save($product) {

    $entityProduct = \Drupal::entityManager()->getStorage("product");

    $entityProduct->save($product);

    return $product;
  }


}