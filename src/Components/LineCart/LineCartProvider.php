<?php

namespace Drupal\ecommerce\Components\LineCart;

interface LineCartProvider
{
	public function getAll();
	public function save($lineCarts);
}