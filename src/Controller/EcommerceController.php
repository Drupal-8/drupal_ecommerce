<?php
/**
 * @file
 * Contains \Drupal\ecommerce\Controller\EcommerceController.
 */
namespace Drupal\ecommerce\Controller;

use Drupal\Core\Controller\ControllerBase;

use Drupal\ecommerce\Ecommerce\EcommerceManager;

use Drupal\ecommerce\Ecommerce\CartDAO;
use Drupal\ecommerce\Ecommerce\Printer;

use Drupal\ecommerce\Ecommerce\CartDAOInterface;
use Drupal\ecommerce\Ecommerce\ProductDAOInterface;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;

class EcommerceController extends ControllerBase {

  public function __construct(ProductDAOInterface $productDAO, CartDAOInterface $cartDAO) {
    $this->productDAO = $productDAO;
    $this->cartDAO = $cartDAO;
  }

  public function addToCart($productId) {
    try {

      $ecommerceManager = new EcommerceManager($this->productDAO, $this->cartDAO);
      $ecommerceManager->addProductToCart($productId);

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

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('ecommerce.product_dao'),
      $container->get('ecommerce.cart_dao')
    );
  }

}