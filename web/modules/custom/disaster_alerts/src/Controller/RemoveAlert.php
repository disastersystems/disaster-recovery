<?php

namespace Drupal\disaster_alerts\Controller;

use Drupal\Core\Controller\ControllerBase;
require DRUPAL_ROOT.'/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Twilio\Twiml;

/**
 * Class RemoveAlert.
 */
class RemoveAlert extends ControllerBase {

  /**
   * Remove_alert_init.
   *
   * @return string
   *   Return Hello string.
   */
  public function remove_alert_init(Request $request) {
      $number = $request->query->get('From');
      $body = $request->query->get('Body');
      $response = new Twiml;

      if($body == 'STOP'){
        $response->message("did you just said stop?");
        return $response;
      }else{
        $response->message("The Robots are coming! Head for the hills!");
        return $response;
      }


  }

  private function _setPhoneStatus($phone_number){
    $db = \Drupal::database();
    $rows = $db->query('UPDATE disaster_alerts SET status = 0 WHERE phone_number = '.$phone_number.' ');
    $rows->execute();

  }

}



