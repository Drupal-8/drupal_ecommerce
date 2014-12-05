<?php

namespace Drupal\ecommerce\Tests;

//use Drupal\ecommerce\Entity\Product;

use Drupal\Tests\UnitTestCase;

use Symfony\Component\DependencyInjection\ContainerBuilder;

use Drupal\ecommerce\Ecommerce\Product;

/**
 * @ingroup EcommerceProduct
 * @group EcommerceProduct
 */
class ProductTest extends UnitTestCase {
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
    $container = new ContainerBuilder();

    \Drupal::setContainer($container);
    */
    $this->myProduct = Product::create();
    //$this->myProduct = Product::createInstance();

    $this->productName = "Mi producto";
    $this->productDesc = "Mi descripción";
    $this->productRef = "R2D2";
    $this->productPrice = 12.5;
    $this->productImage = "product_image.png";

    $this->myProduct->setName($this->productName)
      ->setDescription($this->productDesc)
      ->setReference($this->productRef)
      ->setPrice($this->productPrice);
      //->setImage($this->productImage);

  }

  //Product have fields name, description , ref , price, image
  public function testProduct()
  {

    $this->assertEquals($this->productName , $this->myProduct->getName());
    $this->assertEquals($this->productDesc, $this->myProduct->getDescription());
    $this->assertEquals($this->productRef , $this->myProduct->getReference());
    $this->assertEquals($this->productPrice , $this->myProduct->getPrice());
    //$this->assertEquals($this->productImage , $this->myProduct->getImage());

  }

}