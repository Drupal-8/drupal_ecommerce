<?php
/**
 * @file
 * Contains \Drupal\ecommerce\Controller\EcommerceController.
 */
namespace Drupal\ecommerce\Controller;

use Drupal\Core\Controller\ControllerBase;

use Drupal\ecommerce\Entity\Product;
use Drupal\ecommerce\Ecommerce\ProductDAO;
use Drupal\ecommerce\Ecommerce\CartLine;
use Drupal\ecommerce\Ecommerce\CartDAO;
use Drupal\ecommerce\Ecommerce\Printer;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EcommerceController extends ControllerBase {


  public function addToCart($productId) {
    try {

      $productDAO = \Drupal::service('ecommerce.product_dao');

      //@todo test that id is not null
      $product = $productDAO::get($productId);

      $shoppingCart = CartDAO::get();

      $shoppingCart->addItem(CartLine::create($product,1));

      CartDAO::save($shoppingCart);

      //Redirect to previous page
      $request = \Drupal::request();
      $referer = $request->headers->get('referer');
      return RedirectResponse::create($referer);


    } catch (\Exception $e) {
      drupal_set_message ($e->getMessage (), 'error');
    }
  }

  public function showCart() {
    try {
      $shoppingCart = CartDAO::get();
      return Printer::printShoppingCart($shoppingCart);
    } catch (\Exception $e) {
      drupal_set_message ($e->getMessage (), 'error');
    }
  }


}