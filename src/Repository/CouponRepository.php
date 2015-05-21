<?php

namespace Drupal\ecommerce\Repository;

class CouponRepository {
  private $entityStorage;

  const ENTITY_NAME = "node";

  public function __construct($entityManager) {
    $this->entityStorage = $entityManager->getStorage(self::ENTITY_NAME);
  }

  public function findBy($propertyName, $propertyValue) {
    $productEntities = $this->entityStorage->loadByProperties([$propertyName => $propertyValue]);
    return $productEntities;
  }

  public function load($id) {
    $productEntity = $this->entityStorage->load($id);
    return $productEntity;
  }

} 
