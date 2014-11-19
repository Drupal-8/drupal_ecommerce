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
    $header['id'] = $this->t('ProductID');
    $header['label'] = $this->t('Label');
    $header['product_field'] = $this->t('ProductField');
    $header['add_cart'] = $this->t('Add cart');
    return $header + parent::buildHeader ();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\ecommerce\Entity\FooBar */
    $row['id'] = $entity->id();
    $row['label'] = $this->getLabel($entity);
    $row['product_field'] = $entity->getProductField();
    $row['add_cart'] = "Add cart";
    return $row + parent::buildRow ($entity);
  }
}