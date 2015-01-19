<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 12/01/15
 * Time: 23:08
 */

namespace Drupal\ecommerce\Tests;

use Drupal\Tests\UnitTestCase;

use Drupal\ecommerce\Ecommerce\Adapters\ProductEntityDAO;


/**
 * @ingroup EcommerceTest
 * @group EcommerceTest
 */

class RepositoryTest extends UnitTestCase {

  protected $container;
  protected $productMockup;
  protected $entityStorage;

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
    $expects = $this->container->expects($this->any())
      ->method('get')
      ->with($service_name);

    if (isset($return)) {
      $expects->will($this->returnValue($return));
    }
    else {
      $expects->will($this->returnValue(TRUE));
    }
  }


  public function setUp() {

    $this->container = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerBuilder')
      ->setMethods(array('get'))
      ->getMock();

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

    //$productDAO = \Drupal::service('ecommerce.product_entity_dao');
    //$productDAO = \Drupal::service('ecommerce.product_entity_dao');
    //entity.manager

    $this->assertNotNull(\Drupal::service('entity.manager'));

    $productDAO = \Drupal::service('ecommerce.product_entity_dao');

    /*
    $product = $productDAO->get(1);

    $this->assertInstanceOf('Drupal\ecommerce\Ecommerce\Product', $product);

    $this->assertEquals('PR1' , $product->getReference());
    $this->assertEquals(20.3, $product->getPrice());
    */
  }

}
