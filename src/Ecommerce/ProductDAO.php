<?php

namespace Drupal\ecommerce\Ecommerce;

class ProductDAO {

  public static function get($nid) {

    $product = \Drupal::entityManager()->getStorage("product")->load($nid);

    return $product;
  }

  public static function save($product) {

    $entityProduct = \Drupal::entityManager()->getStorage("product");

    $entityProduct->save($product);

    return $product;
  }


}