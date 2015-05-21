<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 15/04/15
 * Time: 23:21
 */

namespace Drupal\ecommerce\Components\Printer;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Routing\UrlGeneratorTrait;
use Drupal\Core\Url;

use Drupal\ecommerce\Components\EcommerceTools;

class FullStrategyPrinter {
  use StringTranslationTrait;
  use LinkGeneratorTrait;
  use UrlGeneratorTrait;

  public function render($products, $shoppingCartTotal) {

    $this->header = array(
      $this->t('Quantity'),
      $this->t('Product'),
      $this->t('Price'),
      $this->t('Total'),
      $this->t('Options'),
    );

    $couponRepository = \Drupal::service('ecommerce.coupon_repository');
    $rows = [];

    foreach ($products as $key => $product) {
      $coupon = $couponRepository->load($product->getId());
      $rows[] = array(
        $product->getQuantity(),
        $coupon->title->value,
        $coupon->field_price->value,
        EcommerceTools::formatPrice($product->getAmount()),
        $this->l($this->t('Remove from cart') , Url::fromRoute('ecommerce.removefromcart', array('productId' => $coupon->id()))),
      );
    }
    $this->rows = $rows;

    return array(
      '#theme' => 'table',
      '#header' => $this->header,
      '#rows' => $this->rows,
      '#attributes' => array('class' => array('table-class'))
    );
  }
}