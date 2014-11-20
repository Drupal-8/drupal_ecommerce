<?php
/**
 * @file
 * Contains \Drupal\ecommerce\ProductInterface.
 */
namespace Drupal\ecommerce;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a Product entity.
 */
interface ProductInterface extends  ContentEntityInterface  {
  /**
   * Returns the identifier.
   *
   * @return int
   *   The entity identifier.
   */
  public function id();
  /**
   * Returns the entity UUID (Universally Unique Identifier).
   *
   * The UUID is guaranteed to be unique and can be used to identify an entity
   * across multiple systems.
   *
   * @return string
   *   The UUID of the entity.
   */
  public function uuid();
  /**
   * Return the Value of Foo Bar Field.
   *
   * @return string
   *   The content of the field.
   */
  public function getName();
  /**
   * Return the Value of Foo Bar Field.
   *
   * @return string
   *   The content of the field.
   */

  /**
   * {@inheritdoc}
   */
  public function getDescription();
  /**
   * {@inheritdoc}
   */
  public function getReference();
  /**
   * {@inheritdoc}
   */
  public function getPrice();
  /**
   * {@inheritdoc}
   */
  public function getImage();

}