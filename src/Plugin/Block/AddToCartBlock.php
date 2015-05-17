<?php

namespace Drupal\ecommerce\Plugin\Block;

use Drupal\Core\Block\BlockBase;

use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Routing\UrlGeneratorTrait;
use Drupal\Core\Url;


/**
 * Provides a "Add to cart" button.
 *
 * @Block(
 *   id = "addtocartblock",
 *   subject = @Translation("Add to cart button block"),
 *   admin_label = @Translation("Add to cart button block")
 * )
 */
class AddToCartBlock extends BlockBase {

	use StringTranslationTrait;
	use LinkGeneratorTrait;
	use UrlGeneratorTrait;

	public function build() {
		
		$node = \Drupal::routeMatch()->getParameter('node');
		if ($node) {
			return $this->l($this->t('Add to cart') , Url::fromRoute('ecommerce.addtocart', array('productId' => $node->id())));
		}
	}
}