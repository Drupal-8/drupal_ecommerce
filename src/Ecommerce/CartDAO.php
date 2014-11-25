<?php

namespace Drupal\ecommerce\Ecommerce;

use Drupal;

use SebastianBergmann\Exporter\Exception;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;


class CartDAO {

  static public function get() {
    $session_manager = \Drupal::service("session_manager");
    $session_manager->start();
    try {
      $userAttributeBag = $session_manager->getBag('my_storage_key');

      $shoppingCart = $userAttributeBag->get('shoopingcart', new Cart());

    } catch (Exception $e) {
      $shoppingCart = new Cart();
    }


    return $shoppingCart;
  }

  static public function save($shoppingCart) {
    $session_manager = \Drupal::service("session_manager");
    $session_manager->start();

    var_dump($session_manager->getId());

    $myAttributeBag = new AttributeBag('my_storage_key');
    $myAttributeBag->setName('some_descriptive_name');
    $myAttributeBag->set('shoopingcart',serialize($shoppingCart));
    $session_manager->registerBag($myAttributeBag);

    $session_manager->save();


    //$cookie = new Cookie("shoopingcart", serialize($shoppingCart));
  }

}