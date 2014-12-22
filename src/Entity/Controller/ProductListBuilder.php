<?php
/**
 * @file
 * Contains \Drupal\ecommerce\Entity\Controller\ProductListBuilder.
 */
namespace Drupal\ecommerce\Entity\Controller;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;

use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Routing\UrlGeneratorTrait;

use Drupal\Core\Url;

/**
 * Provides a list controller for Product entity.
 */
class ProductListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;
  use UrlGeneratorTrait;


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('ProductID');
    $header['label'] = $this->t('Label');
    $header['ref'] = $this->t('Reference');
    $header['name'] = $this->t('Name');
    $header['price'] = $this->t('Price');
    $header['add_cart'] = $this->t('Add cart');
    return $header + parent::buildHeader ();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {

    /* @var $entity \Drupal\ecommerce\Entity\Product */
    $row['id'] = $entity->id();
    $row['label'] = $this->getLabel($entity);
    $row['ref'] = $entity->getReference();
    $row['name'] = $entity->getName();
    $row['price'] = $entity->getPrice();
    $row['add_cart'] = $this->l(t('Add to cart') , Url::fromRoute('product.addtocart', array('productId' => $entity->id() )));
    return $row + parent::buildRow ($entity);
  }
}