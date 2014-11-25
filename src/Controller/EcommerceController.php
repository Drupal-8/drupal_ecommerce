<?php
/**
 * @file
 * Contains \Drupal\ecommerce\Controller\EcommerceController.
 */
namespace Drupal\ecommerce\Controller;

use Drupal\Core\Controller\ControllerBase;

use Drupal\ecommerce\Entity\Product;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Drupal\ecommerce\Ecommerce\ProductDAO;

use Drupal\ecommerce\Ecommerce\Cart;
use Drupal\ecommerce\Ecommerce\CartItem;

use Symfony\Component\HttpFoundation\Cookie;

use Drupal\ecommerce\Ecommerce\CartDAO;

class EcommerceController extends ControllerBase {

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

    //@todo test that id is not null
    $product = ProductDAO::get($productId);

    $shoppingCart = CartDAO::get();


    //$shoppingCart = new Cart();

    $shoppingCart->addItem(new CartItem($product,1));


    CartDAO::save($shoppingCart);


  }

}