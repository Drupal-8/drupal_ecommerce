<?php
/**
 * @file
 * Contains \Drupal\ecommerce\Entity\Product.
 */
namespace Drupal\ecommerce\Entity;

use Drupal\ecommerce\ProductInterface;

/**
 * Defines the Foo Bar entity.
 *
 * @ContentEntityType(
 *   id = "product",
 *   label = @Translation("Product"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ecommerce\Entity\Controller\ProductListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ecommerce\Entity\Form\ProductForm",
 *       "edit" = "Drupal\ecommerce\Entity\Form\ProductForm",
 *       "delete" = "Drupal\ecommerce\Entity\Form\ProductDeleteForm"
 *     },
 *     "translation" = "Drupal\content_translation\ContentTranslationController"
 *   },
 *   base_table = "product",
 *   admin_permission = "admin_product",
 *   fieldable = TRUE,
 *   translatable = TRUE,
 *   entity_keys = {
 *     "id" = "prid",
 *     "label" = "name",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "edit-form" = "product.edit",
 *     "delete-form" = "product.delete"
 *   },
 *   field_ui_base_route = "product.settings",
 * )
 */
class Product extends ProductBaseEntity implements ProductInterface {

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->name->value;
  }
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }
  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->description->value;
  }
  public function setDescription($description) {
    $this->set('description', $description);
    return $this;
  }
  /**
   * {@inheritdoc}
   */
  public function getReference() {
    return $this->reference->value;
  }
  public function setReference($reference) {
    $this->set('reference', $reference);
    return $this;
  }
  /**
   * {@inheritdoc}
   */
  public function getPrice() {
    return $this->price->value;
  }
  public function setPrice($price) {
    $this->set('price', $price);
    return $this;
  }
  /**
   * {@inheritdoc}
   */
  public function getImage() {
    return $this->image->value;
  }
  public function setImage($image) {
    $this->set('image', $image);
    return $this;
  }
}