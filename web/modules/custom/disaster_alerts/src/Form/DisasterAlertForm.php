<?php

namespace Drupal\disaster_alerts\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class DisasterAlertForm.
 */
class DisasterAlertForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'disaster_alerts.disasteralert',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'disaster_alert_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('disaster_alerts.disasteralert');
    $form['accountsid'] = [
      '#type' => 'textfield',
      '#title' => $this->t('AccountSid'),
      '#description' => $this->t('Get your AccountSid from https://twilio.com/console'),
      '#maxlength' => 120,
      '#size' => 64,
      '#default_value' => $config->get('accountsid'),
    ];
    $form['authtoken'] = [
      '#type' => 'textfield',
      '#title' => $this->t('AuthToken'),
      '#description' => $this->t('Get your AuthToken from https://twilio.com/console'),
      '#maxlength' => 120,
      '#size' => 64,
      '#default_value' => $config->get('authtoken'),
    ];
    $form['twillio_phone'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Twillio Phone'),
      '#description' => $this->t('Get your phone number from https://twilio.com/console (+12223334455 use this format)'),
      '#maxlength' => 120,
      '#size' => 64,
      '#default_value' => $config->get('authtoken'),
    ];
    $form['phone_number_endpoint'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Phone Number Endpoint'),
      '#description' => $this->t('Provide Phone number endpoint URL (if any)'),
      '#default_value' => $config->get('phone_number_endpoint'),
      '#format' => 'restricted_html',
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

    $this->config('disaster_alerts.disasteralert')
      ->set('accountsid', $form_state->getValue('accountsid'))
      ->set('authtoken', $form_state->getValue('authtoken'))
      ->set('twillio_phone', $form_state->getValue('twillio_phone'))
      ->set('phone_number_endpoint', $form_state->getValue('phone_number_endpoint'))
      ->save();
  }

}
