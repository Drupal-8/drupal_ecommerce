<?php

/**
 * @file
 * An example of a SimpleTest-based functional test.
 */

namespace Drupal\ecommerce\Tests;

use Drupal\simpletest\WebTestBase;

use Drupal\ecommerce\Ecommerce\Adapters\ProductRepository;

/**
 * Ecommerce Repository Test.
 * @group Ecommerce
 *
 */
class EcommerceTest extends WebTestBase {

  static public $modules = array('ecommerce');
  protected $profile = 'standard';


  protected function drupalCreateEntity($entityType, array $settings = array()) {
    // Populate defaults array.
    $settings += array(
      'uid' => \Drupal::currentUser()->id(),
    );
    $entity = entity_create($entityType, $settings);
    $entity->save();

    return $entity;
  }


  public function testProductRepository() {

    $settings = [
      'name' => 'My Product',
      'price' => '20',
      'reference' => 'PR1',
      'description' => 'My Description',
    ];
    $entity = $this->drupalCreateEntity('product_entity',$settings);

    $entityManager = \Drupal::service('entity.manager');
    $productRepository = new ProductRepository($entityManager);
    $product = $productRepository->get($entity->id());

    $this->assertEqual('My Product', $product->getName());
    $this->assertEqual('PR1', $product->getReference());
    $this->assertEqual('My Description', $product->getDescription());
    $this->assertEqual(20, $product->getPrice());

    $this->assertTrue($product instanceof \malotor\ecommerce\Product);

  }

}
