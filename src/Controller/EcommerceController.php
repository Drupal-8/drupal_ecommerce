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


class EcommerceController extends ControllerBase {

  protected $database;

  public function __construct($database) {
    $this->database = $database;
  }

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
  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    // Instantiates this form class.
    return new static(
    // Load the service required to construct this class.
      $container->get('database')
    );
  }
}