<?php

namespace Drupal\ecommerce\Components\DataProvider;

interface LineCartProvider
{
	public function getAll();
	public function save($lineCarts);
}