<?php

namespace Drupal\ecommerce\Tests;


use Drupal\Tests\UnitTestCase;
use Drupal\ecommerce\Ecommerce\CartIterator;


/**
 * @ingroup Ecommerce
 * @group Ecommerce
 */
class CartIteratorTest extends UnitTestCase {

  public function setUp() {

    $cartLine0 = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\CartItem')
      ->disableOriginalConstructor()
      ->getMock();
    $cartLine0->method('getProductReference')
      ->willReturn('PR1');
    $cartLine0->method('lineCartAmount')
      ->willReturn(20.3);

    $cartLine1 = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\CartItem')
      ->disableOriginalConstructor()
      ->getMock();
    $cartLine1->method('getProductReference')
      ->willReturn('PR2');
    $cartLine1->method('lineCartAmount')
      ->willReturn(10.3);

    $cartLines[0] = $cartLine0;
    $cartLines[1] = $cartLine1;

    $this->cart = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\Cart')
      ->disableOriginalConstructor()
      ->getMock();
    $this->cart->method('getCartLines')
      ->willReturn($cartLines);
    $this->cart->method('countProducts')
      ->willReturn(2);

    $this->cartIterator = new CartIterator($this->cart);
  }


  public function testCreateACartIterator() {
    $this->assertTrue($this->cartIterator instanceof CartIterator);
  }


  public function testGetCurrentFromEmptyCart() {

    $cart = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\Cart')
      ->disableOriginalConstructor()
      ->getMock();
    $cart->method('getCartLines')
      ->willReturn(array());

    $cartIterator = new CartIterator($cart);

    $cartLine = $cartIterator->current();
    $this->assertEquals(null, $cartLine);

  }

  public function testGetCurrent() {
    $cartLine = $this->cartIterator->current();
    $this->assertEquals("PR1", $cartLine->getProductReference());

  }
  public function testNextElement() {
    $this->cartIterator->next();
    $cartLine = $this->cartIterator->current();
    $this->assertEquals("PR2", $cartLine->getProductReference());
  }

  public function testForeach() {

    $keys[0] = "PR1";
    $keys[1] = "PR2";

    foreach($this->cartIterator as $key => $cartLine) {
      $this->assertEquals($keys[$key], $cartLine->getProductReference());
    }

  }

}