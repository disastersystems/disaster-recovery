<?php

namespace Drupal\disaster_alerts\Controller;

use Drupal\Core\Controller\ControllerBase;
require_once DRUPAL_ROOT.'/../vendor/autoload.php';
use Twilio\Rest\Client;

/**
 * Class SendAlert.
 */
class SendAlert extends ControllerBase {

  /**
   * Send_alert_init.
   *
   * @return string
   *   Return Hello string.
   */
  public function send_alert_init() {

    $config = \Drupal::config('disaster_alerts.disasteralert');

    $account_sid = $config->get('accountsid');
    $auth_token = $config->get('authtoken');
    $twilio_phone_number = $config->get('twillio_phone');

    $client = new Client($account_sid, $auth_token);

    $client->messages->create(
        '_phone_here',
        ["from" => $twilio_phone_number,
        "body" => "just saying hi, see ya soon!"]
    );

    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: send_alert_init')
    ];
  }

}
