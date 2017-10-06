<?php

namespace Drupal\disaster_alerts\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


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
      $number = $_POST['From'];
      $body = $_POST['Body'];

      if (strcasecmp($body, 'stop') == 0) {
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<Response>\n";
        $xml .= "<Message>\n";
        $xml .= "you been removed\n";
        $xml .= "</Message>\n";
        $xml .= "</Response>\n";
        $this->_setPhoneStatus($number);
      }else{
        $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        $xml .= "<Response>\n";
        $xml .= "<Message>\n";
        $xml .= "Hello '.$number.'.";
        $xml .= "You said '.$body.'\n";
        $xml .= "</Message>\n";
        $xml .= "</Response>\n";
      }

      $response = new Response($xml);
      $response->headers->set('Content-Type', 'text/xml');

      return $response;
  }

  private function _setPhoneStatus($phone_number){
    $db = \Drupal::database();
    $rows = $db->query('UPDATE disaster_alerts SET status = 0 WHERE phone_number = '.$phone_number.' ');
    $rows->execute();

  }

}

