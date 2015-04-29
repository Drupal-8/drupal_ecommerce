<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 15/04/15
 * Time: 23:23
 */

namespace Drupal\ecommerce\Components\Printer;


class FactoryPrinter {

  static public function create($display) {

    switch($display) {
      case 'short':
        $printer = new SortStrategyPrinter();
        break;
      case 'full':
        $printer = new FullStrategyPrinter();
        break;
      default:
        throw new \Exception("This display doesn't exists!");
        break;

    }

    return $printer;
  }
} 