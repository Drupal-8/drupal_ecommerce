<?php

namespace Drupal\ecommerce\Ecommerce;

abstract class TemplatePrinter {

  protected $path;
  protected $params;

  public function __construct($shoppingCart) {
    $this->shoppingCart = $shoppingCart;
  }

  abstract protected function setTemplate();
  abstract protected function prepareParams();

  public function render($params = []) {

    $this->setTemplate();
    $this->prepareParams();

    $twig = \Drupal::service('twig');

    $template = $twig->loadTemplate($this->path);

    return array (
      '#markup' => $template->render($this->params),
    );
  }

} 