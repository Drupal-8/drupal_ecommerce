<?php

namespace Drupal\ecommerce\Ecommerce\Components\Printer;

use Drupal\ecommerce\Ecommerce\Components\EcommerceTools;

class SortStrategyPrinter extends  StrategyPrinter {

  public function render($cartLines,$shoppingCartTotal) {

    $templatePath = EcommerceTools::getBasePath() . '/templates/shoppingCart.html.twig';

    $twig = \Drupal::service('twig');

    $items = [];
    //$chartIterator = $this->shoppingCart->getIterator();
    foreach ($cartLines as $key => $cartline) {
      $items[] = $cartline->getQuantity() . ' x ' . $cartline->getItem()->getName();
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