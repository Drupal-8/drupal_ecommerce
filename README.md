Drupal 8 Ecommerce Module
====

This module is an example how to decouple the logic business from the framework. Businness Logic is provided by this repository.

[https://github.com/malotor/ecommerce
](https://github.com/malotor/ecommerce)

Add it to the main composer.json file

  {
    "require": {
      "malotor/ecommerce": "dev-master"
    },
    "repositories": [
      {
        "type": "vcs",
        "url":  "https://github.com/malotor/ecommerce.git"
      }
    ],
  }

Update the ecommerce package

	$ php composer.phar update malotor/ecommerce
	

	
We must implement 2 DAO

ProductDAO

	<?php
	
	namespace Drupal\ecommerce\Ecommerce;
	
	use malotor\ecommerce\ProductDAOInterface;
	use malotor\ecommerce\Product;
	
	class ProductDAO implements ProductDAOInterface {
	
	  public function get($nid) {
	
	    $productEntity = \Drupal::entityManager()->getStorage("product_entity")->load($nid);
	
	    $product = new Product() ;
	    $product->setName($productEntity->getName())
	      ->setDescription($productEntity->getDescription())
	      ->setReference($productEntity->getReference())
	      ->setPrice($productEntity->getPrice());
	
	    return $product;
	  }
	
	  public function save($product) {
	
	    $entityProduct = \Drupal::entityManager()->getStorage("product_entity");
	
	    $entityProduct->save($product);
	
	    return $product;
	  }
	
	
	}

CartDAO

	<?php
	
	namespace Drupal\ecommerce\Ecommerce;
	
	use Symfony\Component\HttpFoundation\Session\Session;
	
	use malotor\ecommerce\CartDAOInterface;
	use malotor\ecommerce\Cart;
	
	class CartDAO implements CartDAOInterface {
	
	   public function get() {
	
	    $session = new Session();
	    $shoppingCart = $session->get ('shoppingCart');
	
	    if ($shoppingCart)
	      return unserialize ($shoppingCart);
	    else return new Cart();
	
	  }
	
	  public function save($shoppingCart) {
	
	    $session = new Session();
	    $session->set (
	      'shoppingCart',
	      serialize ($shoppingCart)
	    );
	
	    $session->save ();
	
	  }

	
We can create a service
	
	#File: ecommerce.services.yml
	services:
	  ecommerce.product_dao:
	    class: Drupal\ecommerce\Ecommerce\ProductDAO
	  ecommerce.cart_dao:
	    class: Drupal\ecommerce\Ecommerce\CartDAO
	  ecommerce.manager:
	    class: malotor\ecommerce\EcommerceManager
	    arguments: ['@ecommerce.product_dao','@ecommerce.cart_dao']