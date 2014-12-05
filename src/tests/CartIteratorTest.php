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

    $cartLines[0] = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\CartItem')
      ->disableOriginalConstructor()
      ->getMock();
    $cartLines[0]->method('getProductReference')
      ->willReturn('PR1');
    $cartLines[0]->method('lineCartAmount')
      ->willReturn(20.3);

    $cartLines[1] = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\CartItem')
      ->disableOriginalConstructor()
      ->getMock();
    $cartLines[1]->method('getProductReference')
      ->willReturn('PR2');
    $cartLines[1]->method('lineCartAmount')
      ->willReturn(10.3);

    $this->cart = $this->getMockBuilder('Drupal\ecommerce\Ecommerce\Cart')
      ->disableOriginalConstructor()
      ->getMock();
    $this->cart->method('getCartLines')
      ->willReturn($cartLines);

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
    $this->assertEquals(null, $cartLine->getProductReference());

  }

  public function testGetCurrent() {
    $cartLine = $this->cartIterator->current();
    $this->assertEquals("PR1", $cartLine->getProductReference());

  }
} 