<?php

namespace Drupal\ecommerce\Ecommerce\Components\Printer;

use Drupal\ecommerce\Ecommerce\EcommerceTools;

class SortStrategyPrinter extends  StrategyPrinter {

  public function render($cartLines, $shoppingCartTotal) {

    $this->header = array(
      $this->t('Amount'),
      $this->t('Product'),
      $this->t('Price'),
      $this->t('Total'),
      $this->t('Options'),
    );

    $productDao = \Drupal::service('ecommerce.product_entity_dao');
    $rows = [];

    foreach ($cartLines as $key => $cartline) {
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

    return array(
      '#theme' => 'table',
      '#header' => $this->header,
      '#rows' => $this->rows,
      '#attributes' => array('class' => array('table-class'))
    );
  }
} 