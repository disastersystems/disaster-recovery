<?php

namespace Drupal\disaster_alerts\Controller;

use Drupal\Core\Controller\ControllerBase;
require DRUPAL_ROOT.'/../vendor/autoload.php';
use Twilio\Rest\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

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

      $rows  = $this->_isPhoneInDB($number->phoneNumber);
      if(!$rows->fetchAssoc()){
        $this->_addNewPhone($number->phoneNumber);
        $response = new JsonResponse();
        $response->setData([
          'data' => 'phone created'
        ]);

        return $response;
      } else {
        $response = new JsonResponse();
        $response->setData([
          'data' => 'already in db'
        ]);

        return $response;
      }

    } catch (\Exception $e) {
      $response = new JsonResponse();
      $response->setData([
        'data' => 'not a valid phone number'
      ]);

      return $response;
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
    return $rows;
  }

}
