<?php

/**
 * @file
 * Contains Drupal\ecommerce\Entity\Form\ProductEntitySettingsForm.
 */

namespace Drupal\ecommerce\Entity\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class ProductEntitySettingsForm.
 * @package Drupal\ecommerce\Form
 * @ingroup ecommerce
 */
class ProductEntitySettingsForm extends FormBase
{

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'ProductEntity_settings';
  }

  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param array $form_state
   *   An associative array containing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }


  /**
   * Define the form used for ProductEntity  settings.
   * @return array
   *   Form definition array.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param array $form_state
   *   An associative array containing the current state of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['ProductEntity_settings']['#markup'] = 'Settings form for ProductEntity. Manage field settings here.';
    return $form;
  }
}
