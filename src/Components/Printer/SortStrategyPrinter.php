<?php

namespace Drupal\ecommerce\Components\Printer;

use Drupal\ecommerce\Components\EcommerceTools;

class SortStrategyPrinter extends  StrategyPrinter {

  public function render($products,$shoppingCartTotal) {

    $productDao = \Drupal::service('ecommerce.product_entity_repository');

    $templatePath = EcommerceTools::getBasePath() . '/templates/shoppingCart.html.twig';

    $twig = \Drupal::service('twig');

    $items = [];
    foreach ($products as $product) {
      $productEntity = $productDao->get($product->getId());
      $items[] = $product->getQuantity() . ' x ' . $productEntity->title->value;
    }

    $params = array(
      'items' => $items,
      'total' => EcommerceTools::formatPrice($shoppingCartTotal),
    );

    $template = $twig->loadTemplate($templatePath);

    return array (
      '#markup' => $template->render($params),
    );
  }

} 