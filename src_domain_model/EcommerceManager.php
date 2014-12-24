<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 21/12/14
 * Time: 21:02
 */

namespace Drupal\ecommerce\Ecommerce;


class EcommerceManager  {

  protected $productDAO;
  protected $cartDAO;

  public function __construct(ProductDAOInterface $productDAO, CartDAOInterface $cartDAO) {
    $this->productDAO = $productDAO;
    $this->cartDAO = $cartDAO;
  }

  public function addProductToCart($productId) {
    $product = $this->productDAO->get($productId);
    $shoppingCart = $this->cartDAO->get();
    $shoppingCart->addItem(CartLine::create($product,1));
    $this->cartDAO->save($shoppingCart);
  }

  public function getCart() {
    return $this->cartDAO->get();
  }
}