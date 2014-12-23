<?php

/**
 * @file
 * Contains Drupal\ecommerce\Entity\Controller\ProductEntityListController.
 */

namespace Drupal\ecommerce\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Url;

/**
 * Provides a list controller for ProductEntity entity.
 *
 * @ingroup ecommerce
 */
class ProductEntityListController extends EntityListBuilder
{

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = t('ProductEntityID');
    $header['name'] = t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\ecommerce\Entity\ProductEntity */
    $row['id'] = $entity->id();
    $row['name'] = \Drupal::l(
        $this->getLabel($entity),
        new Url(
          'product_entity.edit', array(
            'product_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }
}
