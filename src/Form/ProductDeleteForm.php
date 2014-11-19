<?php
/**
 * @file
 * Contains \Drupal\foo_bar\Entity\Form\FooBarDeleteForm
 */
namespace Drupal\ecommerce\Form;
use Drupal\Core\Entity\ContentEntityConfirmFormBase;
use Drupal\Core\Url;
use Drupal\Core\Form\FormStateInterface;
/**
 * Provides a form for deleting a foo_bar entity.
 */
class ProductDeleteForm extends ContentEntityConfirmFormBase {
  /**
   * {@inheritdoc}
   */
  public function getQuestion() {
    return t('Are you sure you want to delete entity %name?', array('%name' => $this->entity->label()));
  }
  /**
   * {@inheritdoc}
   */
  public function getCancelUrl() {
    return new Url('product.list');
  }
  /**
   * {@inheritdoc}
   */
  public function getConfirmText() {
    return t('Delete');
  }
  /**
   * {@inheritdoc}
   */
  public function submit(array $form, FormStateInterface $form_state) {
    $this->entity->delete();
    watchdog('content', '@type: deleted %title.', array('@type' => $this->entity->bundle(), '%title' => $this->entity->label()));
    $form_state->setRedirect('product.list');
  }
}