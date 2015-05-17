<?php

namespace Drupal\ecommerce\Components\DataProvider;

class LineCartDatabaseProvider implements LineCartProvider {
	
	public function __construct($currentUser, $database)
	{
		$this->userId = $currentUser->id();
		$this->dbConnection = $database;
	}

	function getAll() 
	{
		$result = $this->dbConnection->select('linecart', 'ln')
	      ->fields('ln')
	      ->condition('user_id', $this->userId,'=')
	      ->execute();

	    return $result;
	}

	function save($lineCarts)
	{
		$this->dbConnection->delete('linecart')
	      ->condition('user_id', (int) $this->userId)
	      ->execute();

	    foreach ($lineCarts as $product) {
	    	$fields = array(
		      'user_id' => (int) $this->userId,
		      'item_id' => (int) $product->getId(),
		      'quantity' => (int) $product->getQuantity(),
		    );

		    $this->dbConnection->insert('linecart')
		      ->fields($fields)
		      ->execute();
		    
	  	}
	}

}