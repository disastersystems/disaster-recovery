<?php

namespace Drupal\disaster_alerts\Controller;

use Drupal\Core\Controller\ControllerBase;
require DRUPAL_ROOT.'/../vendor/autoload.php';
use Twilio\Rest\Client;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CreateAlert.
 */
class CreateAlert extends ControllerBase {

  /**
   * Alert_init.
   *
   * @return string
   *   Return Hello string.
   */
  public function alert_init(Request $request) {

    $config = \Drupal::config('disaster_alerts.disasteralert');
    $sid = $config->get('accountsid');
    $token = $config->get('authtoken');
    // Make a call to the Lookup API
    $client = new Client($sid, $token);

    $phone = $request->query->get('phone');

    $encoded = rawurlencode($phone);
    try {
      $number = $client->lookups
            ->phoneNumbers($encoded)
            ->fetch(
                array("type" => "caller-name")
            );

      $this->_isPhoneInDB($number->phoneNumber);

      return [
        '#type' => 'markup',
        '#markup' => $this->t('hello there '.$number->phoneNumber)
      ];
    } catch (\Exception $e) {
        return [
          '#type' => 'markup',
          '#markup' => $this->t(':panda_face: Something went wrong :panda_face:"')
        ];
    }
  }

  private function _addNewPhone($phone_number){
    $database = \Drupal\Core\Database\Database::getConnection();

        $database->insert('disaster_alerts')->fields(
            array(
            'created' => REQUEST_TIME,
            'phone_number' => $phone_number,
            'status' => 1,
            )
        )->execute();

  }

  private function _isPhoneInDB($phone_number){
    $db = \Drupal::database();
    $rows = $db->query('SELECT * from disaster_alerts WHERE phone_number = '.$phone_number.' ');
    if(!$rows->fetchAssoc()){
      $this->_addNewPhone($phone_number);
    } else {
      echo 'sorrry number already on the DB';
    }

  }

}
