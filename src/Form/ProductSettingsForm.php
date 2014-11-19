<?php
/**
 * @file
 * Defines Drupal\ecommerce\Entity\Form\FooBarSettingsForm.
 */
namespace Drupal\ecommerce\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
class ProductSettingsForm extends FormBase {
  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'product_settings';
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
   * Define the form used for FooBar settings.
   * @return array
   *   Form definition array.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param array $form_state
   *   An associative array containing the current state of the form.
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['product_settings']['#markup'] = 'Settings form for FooBar. Manage field settings here.';
    return $form;
  }
}
