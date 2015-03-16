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

    $ecommerceMannager = \Drupal::service('ecommerce.manager');
    $shoppingCartLines = $ecommerceMannager->getCartItems();
    $shoppingCartTotal = $ecommerceMannager->getCartTotalAmunt();

    $printer = new EcommercePrinter();
    return $printer->printShortShoppingCart($shoppingCartLines, $shoppingCartTotal);

  }

}