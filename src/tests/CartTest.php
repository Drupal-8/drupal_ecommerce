<?php

namespace Drupal\ecommerce\Tests;

use Drupal\Tests\UnitTestCase;

use Drupal\ecommerce\Ecommerce\Cart;
use Drupal\ecommerce\Ecommerce\CartItem;


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

    $this->product1 = $this->getMockBuilder('Drupal\ecommerce\Entity\Product')
      ->disableOriginalConstructor()
      ->getMock();
    $this->product1->method('getReference')
      ->willReturn('PR1');
    $this->product1->method('getPrice')
      ->willReturn(20.3);

    $this->product2 = $this->getMockBuilder('Drupal\ecommerce\Entity\Product')
      ->disableOriginalConstructor()
      ->getMock();
    $this->product2->method('getReference')
      ->willReturn('PR2');
    $this->product2->method('getPrice')
      ->willReturn(11);

  }

  //New card has 0 products
  //User can add products to their chart
  //Whem a product is added the number os products in cart increased
  public function testaddItemToCart() {

    $myCart = new Cart();
    $this->assertEquals(0 , $myCart->countProducts());

    $myCart->addItem(new CartItem($this->product1));

    $this->assertEquals(1 , $myCart->countProducts());

    $myCart->addItem(new CartItem($this->product2));

    $this->assertEquals(2 , $myCart->countProducts());
  }



  public function testAddMoreThenOneItemFromAProduct() {

    $myCart = new Cart();

    $cartLine = new CartItem($this->product1, 2);

    $myCart->addItem($cartLine);

    $this->assertEquals(1 , $myCart->countProducts());

  }

  public function testRemoveAProductsByItsReference() {
    $myCart = new Cart();

    $myCart->addItem(new CartItem($this->product1));

    $myCart->removeProduct('PR1');

    $this->assertEquals(0 , $myCart->countProducts());

  }

  public function testTotalCostFromCartLines() {


    $myCart = new Cart();

    $myCart->addItem(new CartItem($this->product1));

    $this->assertEquals(20.3 , $myCart->totalAmount());

    $myCart->addItem(new CartItem($this->product2));

    $this->assertEquals(30.3 , $myCart->totalAmount());

  }


  public function testTotalCostFromProductsWithMultipleAmount() {


    $myCart = new Cart();

    $myCart->addItem(new CartItem($this->product1, 2));

    $this->assertEquals(40.6 , $myCart->totalAmount());

  }

  public function testAddSeveralTimesTheSameProduct() {


    $myCart = new Cart();

    $myCart->addItem(new CartItem($this->product1, 2));
    $myCart->addItem(new CartItem($this->product1, 1));

    $this->assertEquals(1 , $myCart->countProducts());

    $this->assertEquals(60.9 , $myCart->totalAmount());

  }

}