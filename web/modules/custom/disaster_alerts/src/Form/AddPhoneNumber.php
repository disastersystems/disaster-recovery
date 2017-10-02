<?php

namespace Drupal\disaster_alerts\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AddPhoneNumber.
 */
class AddPhoneNumber extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'add_phone_number_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['phone_number'] = [
      '#type' => 'tel',
      '#default_value' => '',
      '#attributes' => array(
        'placeholder' => $this->t('Enter your mobile number'),
      ),
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Get Alerts'),
      '#attributes' => array(
        'class' => ['alerts-submit'],
      ),
    ];
    return $form;
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
    //  Display result.
    foreach ($form_state->getValues() as $key => $value) {
      drupal_set_message($key . ': ' . strtotime($value));
    }
  }

}
