<?php

namespace Drupal\ecommerce\Ecommerce;

class Product implements CartLineItemInterface {

  protected $name;
  protected $description;
  protected $reference;
  protected $price;
  protected $image;

  /**
   * @param mixed $description
   */
  public function setDescription($description) {
    $this->description = $description;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * @param mixed $image
   */
  public function setImage($image) {
    $this->image = $image;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getImage() {
    return $this->image;
  }

  /**
   * @param mixed $price
   */
  public function setPrice($price) {
    if (!is_numeric($price)) throw new ProductPriceException();
    $this->price = $price;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getPrice() {
    return $this->price;
  }

  /**
   * @param mixed $name
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getName() {
    return $this->name;
  }

  /**
   * @param mixed $reference
   */
  public function setReference($reference) {
    $this->reference = $reference;
    return $this;
  }

  /**
   * @return mixed
   */
  public function getReference() {
    return $this->reference;
  }

}


class ProductPriceException extends \Exception {
  public function __construct($message = null, $code = 0, Exception $previous = null)
  {
    $message = 'Product price must be numeric';
    parent::__construct($message, $code, $previous);
  }
}