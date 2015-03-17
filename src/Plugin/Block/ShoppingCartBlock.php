<?php
/**
 * @file
 * Contains \Drupal\example\Plugin\Block\ExampleBlock.
 */
namespace Drupal\ecommerce\Plugin\Block;

use Drupal\Core\Block\BlockBase;

use Drupal\ecommerce\Ecommerce\EcommerceManager;
use Drupal\ecommerce\Ecommerce\EcommercePrinter;


/**
 * Provides a shooping cart block.
 *
 *
 * @Block(
 *   id = "shoppingcartblock",
 *    subject = @Translation("Shopping Cart block"),
 *   admin_label = @Translation("Shopping Cart block")
 * )
 */
class ShoppingCartBlock extends BlockBase {

  public function build() {
    $printer = \Drupal::service('ecommerce.printer');
    return $printer->render('short');
  }
}