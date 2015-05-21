<?php
/**
 * @file
 * Contains \Drupal\ecommerce\Controller\EcommerceController.
 */
namespace Drupal\ecommerce\Controller;

use Drupal\Core\Controller\ControllerBase;

use Drupal\ecommerce\Ecommerce\EcommercePrinter;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Routing\UrlGeneratorTrait;

class EcommerceController extends ControllerBase {


  public function __construct($shoppingCart, $router, $printer) {
    $this->shoppingCart = $shoppingCart;
    $this->router = $router;
    $this->printer = $printer;
  }

  public function addToCart($productId) {
    try {
      $this->shoppingCart->addProductToBasket($productId, null);
      return $this->router->redirectToPreviosPage("Product added to cart");
    } catch (\Exception $e) {
      return $this->router->redirectWithError($e->getMessage());
      
    }
  }

  public function showCart() {
    try {
      $this->printer->setDisplay('full');
      return $this->printer->render();
    } catch (\Exception $e) {
      return $this->router->redirectWithError($e->getMessage());
    }
  }

  public function removeFromCart($productId) {
    try {
      $this->shoppingCart->removeProductFromBasket($productId, null);
      return $this->router->redirectToPreviosPage("Product removed from cart");
    } catch (\Exception $e) {
      return $this->router->redirectWithError($e->getMessage());
    }
  }


  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('ecommerce.shoppingcart'),
      $container->get('ecommerce.router'),
      $container->get('ecommerce.printer')
    );
  }

}