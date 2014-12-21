<?php


namespace Drupal\ecommerce\Ecommerce;

interface CartLineItemInterface {

  function getReference();
  function getPrice();
}