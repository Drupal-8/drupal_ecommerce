<?php

namespace Drupal\ecommerce\Tests;

use Drupal\Tests\UnitTestCase;

use Drupal\ecommerce\Ecommerce\Cart;
use Drupal\ecommerce\Ecommerce\CartLine;


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

    $this->product1 = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\CartLineItemInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $this->product1->method('getReference')
      ->willReturn('PR1');
    $this->product1->method('getPrice')
      ->willReturn(20.3);

    $this->product2 = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\CartLineItemInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $this->product2->method('getReference')
      ->willReturn('PR2');
    $this->product2->method('getPrice')
      ->willReturn(11);

    $this->myCart = new Cart();
  }

  //New card has 0 products
  //User can add products to their chart
  //Whem a product is added the number os products in cart increased
  public function testaddItemToCart() {

    
    $this->assertEquals(0 , $this->myCart->countProducts());

    $this->myCart->addItem(CartLine::create($this->product1));

    $this->assertEquals(1 , $this->myCart->countProducts());

    $this->myCart->addItem(CartLine::create($this->product2));

    $this->assertEquals(2 , $this->myCart->countProducts());
  }



  public function testAddMoreThenOneItemFromAProduct() {

    $cartLine = CartLine::create($this->product1, 2);

    $this->myCart->addItem($cartLine);

    $this->assertEquals(1 , $this->myCart->countProducts());

  }

  public function testRemoveAProductsByItsReference() {

    $this->myCart->addItem(CartLine::create($this->product1));

    $this->myCart->removeProduct('PR1');

    $this->assertEquals(0 , $this->myCart->countProducts());

  }


  public function testTotalCostFromCartLines() {

    $this->myCart->addItem(CartLine::create($this->product1));

    $this->assertEquals(20.3 , $this->myCart->totalAmount());

    $this->myCart->addItem(CartLine::create($this->product2));

    $this->assertEquals(31.3 , $this->myCart->totalAmount());

  }


  public function testTotalCostFromProductsWithMultipleAmount() {

    $this->myCart->addItem(CartLine::create($this->product1, 2));

    $this->assertEquals(40.6 , $this->myCart->totalAmount());

  }

  public function testAddSeveralTimesTheSameProduct() {

    $this->myCart->addItem(CartLine::create($this->product1, 2));
    $this->myCart->addItem(CartLine::create($this->product1, 1));

    $this->assertEquals(1 , $this->myCart->countProducts());

    $this->assertEquals(60.9 , $this->myCart->totalAmount());

  }

  public function testGetCartItem() {


    $product = $this->myCart->getCartItem(0);

    $this->assertEquals(null , $product);

  }


}