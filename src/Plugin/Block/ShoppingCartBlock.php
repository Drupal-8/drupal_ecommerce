<?php
/**
 * @file
 * Contains \Drupal\example\Plugin\Block\ExampleBlock.
 */
namespace Drupal\ecommerce\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\ecommerce\Ecommerce\CartDAO;
use Drupal\ecommerce\Ecommerce\Printer;

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
    $shoppingCart = CartDAO::get();
    return Printer::printShortShoppingCart($shoppingCart);
  }

}