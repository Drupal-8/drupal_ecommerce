<?php

namespace Drupal\ecommerce\Adapters;

class ProductEntityDAO {
  private $entityStorage;

  const ENTITY_NAME = "node";

  public function __construct($entityManager) {
    $this->entityStorage = $entityManager->getStorage(self::ENTITY_NAME);
  }

  public function findBy($propertyName, $propertyValue) {
    $productEntities = $this->entityStorage->loadByProperties([$propertyName => $propertyValue]);
    return $productEntities;
  }

  public function get($id) {
    $productEntity = $this->entityStorage->load($id);
    return $productEntity;
  }

} 
