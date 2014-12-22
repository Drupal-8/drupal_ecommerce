<?php

namespace Drupal\ecommerce\Tests;

use Drupal\Tests\UnitTestCase;

use Drupal\ecommerce\Ecommerce\ProductDAO;


/**
 * @ingroup EcommerceTest
 * @group EcommerceTest
 */

class ProductDAOTest extends UnitTestCase {

  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => 'Product DAO Unit Test',
      'description' => 'Product DAO Unit Test',
      'group' => 'Product DAO Unit Test',
    );
  }

  protected function setMockContainerService($service_name, $return = NULL) {
    $expects = $this->container->expects($this->once())
      ->method('get')
      ->with($service_name);

    if (isset($return)) {
      $expects->will($this->returnValue($return));
    }
    else {
      $expects->will($this->returnValue(TRUE));
    }
  }

  public function setUpServiceContainerMockUp() {
    $this->container = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerBuilder')
      ->setMethods(array('get'))
      ->getMock();

  }

  public function setUp() {

    $this->setUpServiceContainerMockUp();

    //Product Mockup
    $this->productMockup = $this->getMockBuilder('Drupal\ecommerce\ProductInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $this->productMockup->method('getReference')
      ->willReturn('PR1');
    $this->productMockup->method('getPrice')
      ->willReturn(20.3);

    //EntityStorage Mockup
    $this->entityStorage = $this->getMock('\Drupal\Core\Entity\EntityStorageInterface');
    $this->entityStorage->method('load')
      ->willReturn($this->productMockup);

    $this->entityStorage->method('save')
      ->willReturn(true);

    //EntityManager
    $this->entityManager = $this->getMock('\Drupal\Core\Entity\EntityManagerInterface');
    $this->entityManager->method('getStorage')
      ->willReturn($this->entityStorage);


    $this->setMockContainerService('entity.manager', $this->entityManager);

    \Drupal::setContainer($this->container);
  }

  public function testGetProduct() {
    $product = ProductDAO::get(1);

    $this->assertInstanceOf('Drupal\ecommerce\Ecommerce\Product', $product);

    $this->assertEquals('PR1' , $product->getReference());
    $this->assertEquals(20.3, $product->getPrice());
  }

}