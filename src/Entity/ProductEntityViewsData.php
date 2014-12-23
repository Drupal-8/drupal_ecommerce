<?php

/**
 * @file
 * Contains Drupal\ecommerce\Entity\ProductEntity.
 */

namespace Drupal\ecommerce\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides the views data for the ProductEntity entity type.
 */
class ProductEntityViewsData extends EntityViewsData implements EntityViewsDataInterface
{

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    $data['product_entity']['table']['base'] = array(
      'field' => 'id',
      'title' => t('ProductEntity'),
      'help' => t('The product_entity entity ID.'),
    );

    return $data;
  }


}
