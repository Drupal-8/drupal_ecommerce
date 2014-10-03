<?php

use malotor\ecommerce\Product;


class ProductTest extends PHPUnit_Framework_TestCase {

  public function setUp() {
    $this->myProduct = new Product();

    $this->productName = "Mi producto";
    $this->productDesc = "Mi descripción";
    $this->productRef = "R2D2";
    $this->productPrice = 12.5;
    $this->productImage = "product_image.png";

    $this->myProduct->setName($this->productName)
      ->setDescription($this->productDesc)
      ->setReference($this->productRef)
      ->setPrice($this->productPrice)
      ->setImage($this->productImage);

  }

  //Product have fields name, description , ref , price, image
  public function testProduct()
  {

    $this->assertEquals($this->productName , $this->myProduct->getName());
    $this->assertEquals($this->productDesc, $this->myProduct->getDescription());
    $this->assertEquals($this->productRef , $this->myProduct->getReference());
    $this->assertEquals($this->productPrice , $this->myProduct->getPrice());
    $this->assertEquals($this->productImage , $this->myProduct->getImage());

  }

  /**
   * @expectedException malotor\ecommerce\ProductPriceException
   */

  public function testProductPriceMustBeNumeric() {

    $oneProduct = new Product();
    $oneProduct->setPrice("ten");

  }

}