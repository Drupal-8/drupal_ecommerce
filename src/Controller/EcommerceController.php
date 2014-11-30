<?php
/**
 * @file
 * Contains \Drupal\ecommerce\Controller\EcommerceController.
 */
namespace Drupal\ecommerce\Controller;

use Drupal\Core\Controller\ControllerBase;

use Drupal\ecommerce\Entity\Product;
use Drupal\ecommerce\Ecommerce\ProductDAO;
use Drupal\ecommerce\Ecommerce\CartItem;
use Drupal\ecommerce\Ecommerce\CartDAO;

class EcommerceController extends ControllerBase {
  /*
   * @Todo
   * Remove only for testing purpose
   */
  public function testDAO() {

    $myProduct =  Product::create();
    $myProduct->setName("Mi producto")
      ->setDescription("Mi producto")
      ->setReference("Ref")
      ->setPrice(29.2);

    //$myProduct = ProductDAO::get(1);
    ProductDAO::save($myProduct);
    var_dump($myProduct);

  }

  public function addToCart($productId) {
    try {
      //@todo test that id is not null
      $product = ProductDAO::get($productId);

      $shoppingCart = CartDAO::get();

      $shoppingCart->addItem(new CartItem($product,1));

      CartDAO::save($shoppingCart);
    } catch (\Exception $e) {
      drupal_set_message ($e->getMessage (), 'error');
    }
  }
}