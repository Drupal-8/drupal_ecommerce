<?php

namespace Drupal\ecommerce\Ecommerce;

interface ProductDAOInterface {
  function get($nid);
  function save($product);
} 