<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 13/01/15
 * Time: 20:54
 */

namespace Drupal\ecommerce\Ecommerce;


class EcommerceTools {
  static public function getBasePath() {
    return drupal_get_path('module', 'ecommerce') ;
  }
  static public function formatPrice($price) {
    return number_format($price,2) . "€";
  }
}