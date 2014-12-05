<?php

namespace Drupal\ecommerce\Tests;

use Drupal\Tests\UnitTestCase;

use Drupal\ecommerce\Ecommerce\Cart;
use Drupal\ecommerce\Ecommerce\CartItem;
use Drupal\ecommerce\Ecommerce\Product;

/**
 * @ingroup Ecommerce
 * @group Ecommerce
 */

class CartTest extends UnitTestCase {

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

    $this->product1 = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\Product')
      ->disableOriginalConstructor()
      ->getMock();
    $this->product1->method('getReference')
      ->willReturn('PR1');
    $this->product1->method('getPrice')
      ->willReturn(20.3);

    $this->product2 = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\Product')
      ->disableOriginalConstructor()
      ->getMock();
    $this->product2->method('getReference')
      ->willReturn('PR2');
    $this->product2->method('getPrice')
      ->willReturn(11.0);

    $this->myCart = new Cart();
  }

  public function testCreateANewCart() {
    
    $this->assertTrue($this->myCart instanceof Cart);
  }

  public function testANewCartHaveNotProducts() {
    
    $this->assertEquals(0 , $this->myCart->countProducts());
  }

  public function testaddItemToCart() {

    $this->myCart->addItem(CartItem::create($this->product1));

    $this->assertEquals(1 , $this->myCart->countProducts());

    $this->myCart->addItem(CartItem::create($this->product2));

    $this->assertEquals(2 , $this->myCart->countProducts());
  }

  public function testAddMoreThenOneItemFromAProduct() {

    $cartLine = CartItem::create($this->product1, 2);

    $this->myCart->addItem($cartLine);

    $this->assertEquals(1 , $this->myCart->countProducts());

  }

  public function testRemoveAProductsByItsReference() {

    $this->myCart->addItem(CartItem::create($this->product1));

    $this->myCart->removeProduct('PR1');

    $this->assertEquals(0 , $this->myCart->countProducts());

  }

  public function testTotalCostFromCartLines() {

    $this->myCart->addItem(CartItem::create($this->product1));

    $this->assertEquals(20.3 , $this->myCart->totalAmount());

    $this->myCart->addItem(CartItem::create($this->product2));

    $this->assertEquals(31.3 , $this->myCart->totalAmount());

  }


  public function testTotalCostFromProductsWithMultipleAmount() {

    $this->myCart->addItem(CartItem::create($this->product1, 2));

    $this->assertEquals(40.6 , $this->myCart->totalAmount());

  }

  public function testAddSeveralTimesTheSameProduct() {

    $this->myCart->addItem (CartItem::create ($this->product1, 2));
    $this->myCart->addItem (CartItem::create ($this->product1, 1));

    $this->assertEquals (1, $this->myCart->countProducts ());

    $this->assertEquals (60.9, $this->myCart->totalAmount ());

  }

}