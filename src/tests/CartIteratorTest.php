<?php

namespace Drupal\ecommerce\Tests;


use Drupal\Tests\UnitTestCase;
use Drupal\ecommerce\Ecommerce\CartIterator;
use Drupal\ecommerce\Ecommerce\Cart;

/**
 * @ingroup Ecommerce
 * @group Ecommerce
 */
class CartIteratorTest extends UnitTestCase {

  protected $cartIterator;
  protected $cart;

  public function setUp() {

    $cartLine[0] = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\CartItem')
      ->disableOriginalConstructor()
      ->getMock();
    $cartLine[0]->method('getProductReference')
      ->willReturn('PR1');
    $cartLine[0]->method('lineCartAmount')
      ->willReturn(20.3);

    $cartLine[1] = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\CartItem')
      ->disableOriginalConstructor()
      ->getMock();
    $cartLine[1]->method('getProductReference')
      ->willReturn('PR2');
    $cartLine[1]->method('lineCartAmount')
      ->willReturn(10.3);


    $this->cart = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\CartInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $this->cart->method('getCartItem')
      ->will($this->onConsecutiveCalls($cartLine[0], $cartLine[1]));

    $this->cart->method('countItems')
      ->willReturn(2);

    $this->cartIterator = new CartIterator($this->cart);
  }


  public function testCreateACartIterator() {
    $this->assertTrue($this->cartIterator instanceof CartIterator);
  }


  public function testGetCurrentFromEmptyCart() {

    $cart = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\CartInterface')
      ->disableOriginalConstructor()
      ->getMock();
    $cart->method('getCartItem')
      ->willReturn(null);

    $cartIterator = new CartIterator($cart);

    $cartLine = $cartIterator->current();
    $this->assertEquals(null, $cartLine);

  }


  public function testGetCurrent() {

    $cartLine = $this->cartIterator->current();
    $this->assertEquals("PR1", $cartLine->getProductReference());

  }
  public function testNextElement() {
    $cartLine = $this->cartIterator->current();
    $this->cartIterator->next();
    $cartLine = $this->cartIterator->current();
    $this->assertEquals("PR2", $cartLine->getProductReference());
  }




  public function testForeachInEmptyCart() {

    $keys[0] = "PR1";
    $keys[1] = "PR2";

    $cartIterator = new CartIterator(new Cart);

    foreach($cartIterator as $key => $cartLine) {
      var_dump($key);
      var_dump($cartLine);
      $this->fail("New Carts must be empty");
      //$this->assertEquals($keys[$key], $cartLine->getProductReference());
    }


  }

  public function testForeach() {

    $keys[0] = "PR1";
    $keys[1] = "PR2";

    foreach($this->cartIterator as $key => $cartLine) {
      var_dump($key);
      var_dump($cartLine->getProductReference());
      $this->assertEquals($keys[$key], $cartLine->getProductReference());
    }

  }


}