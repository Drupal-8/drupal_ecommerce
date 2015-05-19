<?php

namespace Drupal\ecommerce\Components\LineCart;

use Symfony\Component\HttpFoundation\Session\Session;


class LineCartSessionProvider implements LineCartProvider {
	
	public function __construct($currentUser)
	{
		$this->userId = $currentUser->id();
		$this->session = new Session();
	}

	function getAll() 
	{
		return unserialize( $this->session->get('cartLines', array()) );
	}

	function save($lineCarts)
	{
		
		$cartLines = array();
	    foreach ($lineCarts as $product) {
	    	$cartLine = new \stdClass();
	    	$cartLine->user_id = (int) $this->userId;
		    $cartLine->item_id = (int) $product->getId();
		    $cartLine->quantity = (int) $product->getQuantity();
		    $cartLines[] = $cartLine;
	   	}

	    $this->session->set('cartLines', serialize($cartLines) );
	}

}