<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 15/04/15
 * Time: 23:21
 */

namespace Drupal\ecommerce\Ecommerce\Components\Printer;

use Drupal\ecommerce\Ecommerce\EcommerceTools;

class FullStrategyPrinter {

  public function render($cartLines,$shoppingCartTotal) {

    $templatePath = EcommerceTools::getBasePath() . '/templates/shoppingCart.html.twig';

    //TODO
    //$shoppingCartTotal = 0;

    $this->twig = \Drupal::service('twig');

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