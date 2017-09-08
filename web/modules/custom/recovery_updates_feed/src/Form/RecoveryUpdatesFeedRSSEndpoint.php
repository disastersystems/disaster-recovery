<?php

namespace Drupal\recovery_updates_feed\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class RecoveryUpdatesRSSEndpoint.
 *
 * @package Drupal\recovery_updates_feed\Form
 */
class RecoveryUpdatesFeedRSSEndpoint extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'recovery_updates_feed.endpoint',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'recovery_updates_feed_rss_endpoint';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('recovery_updates_feed.endpoint');
    $form['recovery_updates_feed_rss_endpoint'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Recovery Updates RSS Endpoint'),
      '#description' => $this->t('Endpoint to get Recovery Updates Info.'),
      '#default_value' => $config->get('rss'),
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

    $this->config('recovery_updates_feed.endpoint')
      ->set('rss', $form_state->getValue('recovery_updates_feed_rss_endpoint'))
      ->save();
  }

}
