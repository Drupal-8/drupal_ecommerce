<?php

namespace Drupal\ecommerce\Components\Printer;

abstract class StrategyPrinter {

  abstract public function render($cartLines,$shoppingCartTotal);

} 