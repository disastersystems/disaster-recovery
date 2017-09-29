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
  public function send_alert_init($phone_number, $alert) {

    $config = \Drupal::config('disaster_alerts.disasteralert');

    $account_sid = $config->get('accountsid');
    $auth_token = $config->get('authtoken');
    $twilio_phone_number = $config->get('twillio_phone');

    $client = new Client($account_sid, $auth_token);

    $client->messages->create(
        $phone_number,
        ["from" => $twilio_phone_number,
        "body" => $alert]
    );
  }

  public function _getAllPhoneNumbers(){
    $db = \Drupal::database();
    $rows = $db->query('SELECT * from disaster_alerts WHERE status = 1');
    return $rows->fetchAll();

  }

}
