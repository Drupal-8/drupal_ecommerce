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


  public function __construct($ecommerceManager, $router, $printer) {
    $this->ecommerceManager = $ecommerceManager;
    $this->router = $router;
    $this->printer = $printer;
  }

  public function addToCart($productId) {
    try {
      $this->ecommerceManager->addProductToBasket($productId, null);
      drupal_set_message ("Product added to cart", 'status');
      return $this->router->redirectToPreviosPage();
    } catch (\Exception $e) {
      drupal_set_message ($e->getMessage (), 'error');
    }
  }

  public function showCart() {
    try {
      $this->printer->setDisplay('full');
      return $this->printer->render();
    } catch (\Exception $e) {
      drupal_set_message ($e->getMessage (), 'error');
    }
  }

  public function removeFromCart($productId) {
    try {
      $this->ecommerceManager->removeProductFromBasket($productId, null);
      drupal_set_message ("Product removed from cart", 'status');
      return $this->router->redirectToPreviosPage();
    } catch (\Exception $e) {
      drupal_set_message($e->getMessage (), 'error');
    }
  }


  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('ecommerce.manager'),
      $container->get('ecommerce.router'),
      $container->get('ecommerce.printer')
    );
  }

}