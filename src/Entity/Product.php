<?php
/**
 * @file
 * Contains \Drupal\ecommerce\Entity\Product.
 */
namespace Drupal\ecommerce\Entity;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\ecommerce\ProductInterface;
use Drupal\Core\Entity\EntityTypeInterface;
/**
 * Defines the Foo Bar entity.
 *
 * @ContentEntityType(
 *   id = "product",
 *   label = @Translation("Product entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ecommerce\Entity\Controller\ProductListBuilder",
 *     "form" = {
 *       "add" = "Drupal\ecommerce\Form\ProductForm",
 *       "edit" = "Drupal\ecommerce\Form\ProductForm",
 *       "delete" = "Drupal\ecommerce\Form\ProductDeleteForm"
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
class Product extends ContentEntityBase implements ProductInterface {
  /**
   * {@inheritdoc}
   */
  public function id() {
    return $this->get('prid')->value;
  }
  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->name->value;
  }
  /**
   * {@inheritdoc}
   */
  public function getProductField() {
    return $this->product_field->value;
  }
  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
  }
  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['prid'] = BaseFieldDefinition::create('integer')
      ->setLabel(t('ID'))
      ->setDescription(t('The ID of the Product entity.'))
      ->setReadOnly(TRUE);
    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The UUID of the Product entity.'))
      ->setReadOnly(TRUE);
    $fields['langcode'] = BaseFieldDefinition::create('language')
      ->setLabel(t('Language code'))
      ->setDescription(t('The language code of the Product entity.'));
    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Product entity.'))
      ->setTranslatable(TRUE)
      ->setPropertyConstraints('value', array('Length' => array('max' => 32)))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -6,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string',
        'weight' => -6,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    $fields['type'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Type'))
      ->setDescription(t('The bundle of the Product entity.'))
      ->setRequired(TRUE);
    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('User ID'))
      ->setDescription(t('The ID of the associated user.'))
      ->setSettings(array('target_type' => 'user'))
      ->setTranslatable(TRUE);
    $fields['product_field'] = BaseFieldDefinition::create('string')
      ->setLabel(t('First Product Field'))
      ->setDescription(t('One field of the Product entity.'))
      ->setTranslatable(TRUE)
      ->setPropertyConstraints('value', array('Length' => array('max' => 32)))
      ->setSettings(array(
        'default_value' => '',
        'max_length' => 255,
        'text_processing' => 0,
      ))
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string',
        'weight' => -5,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);
    return $fields;
  }
}