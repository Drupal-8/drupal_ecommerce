<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 15/04/15
 * Time: 23:23
 */

namespace Drupal\ecommerce\Ecommerce\Components\Printer;


class FactoryPrinter {

  static function create($display) {
    switch($display) {
      /*
      case 'sort':
        $strategyPrinter = new SortStrategyPrinter();
        return new Printer($strategyPrinter);
        break;

      case 'full':
        $strategyPrinter = new FullStrategyPrinter();
        return new Printer($strategyPrinter);
        break;
      */

      case 'sort':
        return new SortStrategyPrinter();
        break;

      case 'full':
        return new FullStrategyPrinter();
        break;

    }

  }
} 