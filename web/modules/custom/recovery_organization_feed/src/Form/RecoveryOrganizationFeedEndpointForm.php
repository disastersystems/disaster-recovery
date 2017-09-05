<?php

namespace Drupal\recovery_organization_feed\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class RecoveryOrganizationFeedEndpoint.
 *
 * @package Drupal\recovery_organization_feed\Form
 */
class RecoveryOrganizationFeedEndpointForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'recovery_organization_feed.endpoint',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'recovery_organization_feed_endpoint_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('recovery_organization_feed.endpoint');
    $form['recovery_organization_endpoint'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Recovery Organization Endpoint'),
      '#description' => $this->t('Endpoint to get Recovery Organization Info.'),
      '#default_value' => $config->get('organization'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);

    $this->config('recovery_organization_feed.endpoint')
      ->set('organization', $form_state->getValue('recovery_organization_endpoint'))
      ->save();
  }

}
