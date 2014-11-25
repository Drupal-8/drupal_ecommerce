<?php
/**
 * @file
 * Contains \Drupal\example\Plugin\Block\ExampleBlock.
 */
namespace Drupal\ecommerce\Plugin\Block;


use Drupal\block\Annotation\Block;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Annotation\Translation;
use Drupal\ecommerce\Ecommerce\CartDAO;

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
    $cartLines = $shoppingCart->getCartLines();
    foreach ($cartLines as $key => $cartline) {
      $rows[] = $cartline->getProduct()->getName();
    }

    $header = array(
      $this->t('Product'),
    );


    return array(
      'table' => array(
        '#theme' => 'table',
        '#header' => $header,
        '#rows' => $rows,
        '#attributes' => array('class' => array('table-class')),
      ),
    );
  }


}