<?php

namespace Drupal\ecommerce\Ecommerce;

abstract class TemplatePrinter {

  protected $path;
  protected $params = [];

  public function __construct($shoppingCart) {
    $this->shoppingCart = $shoppingCart;
    $this->twig = \Drupal::service('twig');
  }

  abstract protected function setTemplate();
  abstract protected function prepareParams();

  public function render() {
    $templatePath = $this->setTemplate();
    $params = $this->prepareParams();
    $template = $this->twig->loadTemplate($templatePath);
    return array (
      '#markup' => $template->render($params),
    );
  }

} 