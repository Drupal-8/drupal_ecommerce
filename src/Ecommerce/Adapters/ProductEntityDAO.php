<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 12/01/15
 * Time: 20:34
 */

namespace Drupal\ecommerce\Ecommerce\Adapters;


class ProductEntityDAO {
  private $entityStorage;

  const ENTITY_NAME = "node";

  public function __construct($entityManager) {
    $this->entityStorage = $entityManager->getStorage(self::ENTITY_NAME);
  }

  public function getByProperty($propertyName, $propertyValue) {
    $productEntities = $this->entityStorage->loadByProperties([$propertyName => $propertyValue]);
    return $productEntities;
  }

  public function get($id) {
    $productEntity = $this->entityStorage->load($id);
    return $productEntity;
  }

} 