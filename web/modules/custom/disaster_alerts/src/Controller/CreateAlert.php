<?php

namespace Drupal\disaster_alerts\Controller;

use Drupal\Core\Controller\ControllerBase;
require DRUPAL_ROOT.'/../vendor/autoload.php';
use Twilio\Rest\Client;
use Symfony\Component\HttpFoundation\Request;
use Drupal\disaster_alerts\Helper;

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
    $content = $request->getContent();
    parse_str($content, $params);

    $config = \Drupal::config('disaster_alerts.disasteralert');
    $sid = $config->get('accountsid');
    $token = $config->get('authtoken');
    // Make a call to the Lookup API
    $client = new Client($sid, $token);

    $phone = $params['phone_number'];
    try {
      $number = $client->lookups
        ->phoneNumbers($phone)
        ->fetch(
          array("type" => "caller-name")
        );

      $add_phone_db  = $this->_isPhoneInDB($number->phoneNumber);
      if($add_phone_db){
        $this->_addNewPhone($number->phoneNumber);
        return Helper::responseHelper('You are now signed up!');

      } else {
        return Helper::responseHelper('Oopps, Your phone is already in our system');
      }

    } catch (\Exception $e) {
      return Helper::responseHelper('Make sure you use a valid phone number');
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
    $create_phone = !$rows->fetchAssoc();

    return $create_phone;
  }

}
