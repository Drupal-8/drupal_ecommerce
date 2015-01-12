<?php

namespace Drupal\ecommerce\Ecommerce;

use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Routing\UrlGeneratorTrait;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Url;

class EcommercePrinter {

  use LinkGeneratorTrait;
  use UrlGeneratorTrait;
  use StringTranslationTrait;

  public function __construct() {

  }

  static public function printShortShoppingCart($shoppingCart) {

    $twig = \Drupal::service('twig');

    $items = [];
    $chartIterator = $shoppingCart->getIterator();
    foreach ($chartIterator as $key => $cartline) {
      $items[] = $cartline->getQuantity() . ' x ' . $cartline->getItem()->getName();
    }

    $path = drupal_get_path('module', 'ecommerce') ;
    $params = array(
      'items' => $items,
      'total' => self::formatPrice($shoppingCart->totalAmount()),
    );
    $template = $twig->loadTemplate($path . '/templates/shoppingCart.html.twig');

    $markup = array (
      '#markup' => $template->render($params),

    );

    return $markup;

  }

  public function printShoppingCart($shoppingCart) {

    $productDao = \Drupal::service('ecommerce.product_entity_dao');

    $rows = [];
    $chartIterator = $shoppingCart->getIterator();
    foreach ($chartIterator as $key => $cartline) {
      $productEntitys = $productDao->getByProperty('reference', $cartline->getItemReference());
      $productEntity = array_shift(array_values($productEntitys));
      $rows[] = array(
        $cartline->getQuantity(),
        $cartline->getItem()->getName(),
        $cartline->getItem()->getPrice(),
        self::formatPrice($cartline->lineCartAmount()),
        $this->l($this->t('Remove from cart') , Url::fromRoute('ecommerce.removefromcart', array('productId' => $productEntity->id()))),
      );
    }

    $header = array(
      $this->t('Amount'),
      $this->t('Product'),
      $this->t('Price'),
      $this->t('Total'),
      $this->t('Options'),
    );


    return array(
      '#theme' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#attributes' => array('class' => array('table-class'))
    );
  }


  static public function formatPrice($price) {
    return number_format($price,2) . "€";
  }

}