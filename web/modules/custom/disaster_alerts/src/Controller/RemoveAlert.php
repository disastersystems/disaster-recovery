<?php

namespace Drupal\disaster_alerts\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

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
  public function remove_alert_init() {
      $number = '+12108430634';
      $body = 'STOP';

      if($body == 'STOP'){
        $xml = '<Response>';
        $xml .= '<Message>';
        $xml .= 'you been removed';
        $xml .= '</Message>';
        $xml .= '</Response>';
        $this->_setPhoneStatus($number);
      }else{
        $xml = '<Response>';
        $xml .= '<Message>';
        $xml .= 'Hello '.$number.'.';
        $xml .= 'You said '.$body.'';
        $xml .= '</Message>';
        $xml .= '</Response>';
      }

      $response = new Response($xml);
      $response->headers->set('Content-Type', 'xml');

      return $response;
  }

  private function _setPhoneStatus($phone_number){
    $db = \Drupal::database();
    $rows = $db->query('UPDATE disaster_alerts SET status = 0 WHERE phone_number = '.$phone_number.' ');
    $rows->execute();

  }

}
