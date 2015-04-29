<?php

namespace Drupal\ecommerce\Ecommerce\Components\Printer;

abstract class StrategyPrinter {

  abstract public function render($cartLines,$shoppingCartTotal);

} 