<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 13/01/15
 * Time: 21:04
 */

namespace Drupal\ecommerce\Ecommerce;

use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Routing\UrlGeneratorTrait;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Url;

class CartTablePrinter extends TablePrinter {

  use LinkGeneratorTrait;
  use UrlGeneratorTrait;
  use StringTranslationTrait;

  public function __construct($shoppingCart) {
    $this->shoppingCart = $shoppingCart;
  }

  public function prepareHeader() {
    $this->header = array(
      $this->t('Amount'),
      $this->t('Product'),
      $this->t('Price'),
      $this->t('Total'),
      $this->t('Options'),
    );
  }

  public function prepareRows() {
    $productDao = \Drupal::service('ecommerce.product_entity_dao');
    $rows = [];

    foreach ($this->shoppingCart as $key => $cartline) {
      $productEntity = $productDao->get($cartline->getItem()->getId());

      $rows[] = array(
        $cartline->getQuantity(),
        $cartline->getItem()->getName(),
        $cartline->getItem()->getPrice(),
        EcommerceTools::formatPrice($cartline->getAmount()),
        $this->l($this->t('Remove from cart') , Url::fromRoute('ecommerce.removefromcart', array('productId' => $productEntity->id()))),
      );
    }
    $this->rows = $rows;
  }


} 