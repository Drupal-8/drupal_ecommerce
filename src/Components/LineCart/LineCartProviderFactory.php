<?php

namespace Drupal\ecommerce\Components\LineCart;

Class LineCartProviderFactory {
	static public function create($currentUser) 
	{	
		if ($currentUser->id()>0)
			return \Drupal::service("ecommerce.linecart_database_provider");
		else
			return \Drupal::service("ecommerce.linecart_session_provider");
	}
}