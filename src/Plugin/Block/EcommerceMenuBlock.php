<?php
/**
 * @file
 * Contains \Drupal\example\Plugin\Block\ExampleBlock.
 */
namespace Drupal\ecommerce\Plugin\Block;

use Drupal\Core\Block\BlockBase;

use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Routing\UrlGeneratorTrait;
use Drupal\Core\StringTranslation\StringTranslationTrait;


use Drupal\Core\Url;

/**
 * Provides a Ecommerce Menu.
 *
 * @Block(
 *   id = "ecommercemenublock",
 *   subject = @Translation("Ecommerce Menu block"),
 *   admin_label = @Translation("Ecommerce Menu block")
 * )
 */
class EcommerceMenuBlock extends BlockBase {

  use StringTranslationTrait;
  use LinkGeneratorTrait;
  use UrlGeneratorTrait;

  public function build() {

    $items = array(
        $this->l($this->t('Shopping Cart') , Url::fromRoute('ecommerce.showcart')),
    );

    return array(
      'menu_links' => array(
        '#theme' => 'item_list',
        '#items' => $items,
      ),
    );

  }

}