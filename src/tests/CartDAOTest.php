<?php

namespace Drupal\ecommerce\Tests;

use Drupal\Tests\UnitTestCase;

use Drupal\ecommerce\Ecommerce\Cart;
use Drupal\ecommerce\Ecommerce\CartLine;


/**
 * @ingroup EcommerceTest
 * @group EcommerceTest
 */

class CartDAOTest extends UnitTestCase {

  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return array(
      'name' => 'Ecommerce Unit Test',
      'description' => 'Ecommerce Unit Test',
      'group' => 'Ecommerce',
    );
  }

  public function setUp() {

    /*
    $serviceA = $this->getMockBuilder('ServiceA')
      ->disableOriginalConstructor()
      ->getMock();

    $client->getContainer()->set('my_bundle.service.a', $serviceA);
    */

    /*
    $this->shoopingCart = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\Cart')
      ->disableOriginalConstructor()
      ->getMock();
    $this->shoopingCart->method('countProducts')
      ->willReturn('2');
    $this->shoopingCart->method('totalAmount')
      ->willReturn(20.3);

    */
  }

  public function testSaveCart() {

  }

  public function testGetCart() {

  }

}