<?php

namespace Drupal\knowledge_base_integration\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class KnowledgeBaseEndpointForm.
 *
 * @package Drupal\knowledge_base_integration\Form
 */
class KnowledgeBaseEndpointForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'knowledge_base_integration.endpoint',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'knowledge_base_endpoint_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('knowledge_base_integration.endpoint');
    $form['knowledge_base_endpoint'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Knowledge Base Endpoint'),
      '#description' => $this->t('Endpoint to get Knowledge Base Info.'),
      '#default_value' => $config->get('knowledge_base'),
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

    $this->config('knowledge_base_integration.endpoint')
      ->set('knowledge_base', $form_state->getValue('knowledge_base_endpoint'))
      ->save();
  }

}
