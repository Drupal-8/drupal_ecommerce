<?php

/**
 * @file
 * Contains Drupal\account\ProductEntityAccessController.
 */

namespace Drupal\ecommerce;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the ProductEntity entity.
 *
 * @see \Drupal\ecommerce\Entity\ProductEntity.
 */
class ProductEntityAccessControlHandler extends EntityAccessControlHandler
{

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, $langcode, AccountInterface $account) {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'view ProductEntity entity');
        break;

      case 'edit':
        return AccessResult::allowedIfHasPermission($account, 'edit ProductEntity entity');
        break;

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete ProductEntity entity');
        break;

    }

    return AccessResult::allowed();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add Bar entity');
  }
}
