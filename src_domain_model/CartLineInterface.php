<?php


namespace Drupal\ecommerce\Ecommerce;

interface CartLineInterface {

  function getProductReference();
  function getQuantity();
  function lineCartAmount();
}