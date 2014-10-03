<?php
/**
 * @file
 * Contains \Drupal\ecommerce\Entity\Controller\ProductListBuilder.
 */
namespace Drupal\ecommerce\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

/**
 * Provides a list controller for foo_bar entity.
 */
class ProductListBuilder extends EntityListBuilder {
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = t ('ProductID');
    $header['label'] = t ('Label');
    $header['product_field'] = t ('ProductField');

    return $header + parent::buildHeader ();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\ecommerce\Entity\FooBar */
    $row['id'] = $entity->id ();
    $row['label'] = l ($this->getLabel ($entity), 'product/' . $entity->id ());
    $row['product_field'] = $entity->getProductField ();

    return $row + parent::buildRow ($entity);
  }
}