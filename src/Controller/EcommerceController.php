<?php
/**
 * @file
 * Contains \Drupal\ecommerce\Controller\EcommerceController.
 */
namespace Drupal\ecommerce\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Drupal\ecommerce\Ecommerce\ProductDAO;


class EcommerceController extends ControllerBase {

  protected $database;

  public function __construct($database) {
    $this->database = $database;
  }
  public function createdb() {


    if (!$this->database->schema()->tableExists("product")) {
      drupal_install_schema("ecommerce");
      drupal_set_message(t("Table created"));
    } else {
      drupal_set_message(t("Table already exists"), "error");
    }

    return $this->redirect('<front>');
  }


  public function testDAO() {

    $myProduct = ProductDAO::get(1);

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