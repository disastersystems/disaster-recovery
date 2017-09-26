<?php

namespace Drupal\recovery_updates_feed;

use Symfony\Component\HttpFoundation\Response;

/**
* Class Helper
*/
class Helper {

  public static function createHttpRequest($endpoint) {
    $client = \Drupal::httpClient();
    
    try {
      $request = $client->request('GET', $endpoint, [
        'headers' => [
          'Accept'     => 'application/xml',
        ]
      ]);

      $status = $request->getStatusCode();

      if($status == 200) {
        $response = new Response(($request->getBody()));
        $content = json_decode($response->getContent());

        return $content;
      }
    } catch (RequestException $e) {
      \Drupal::logger('recovery_updates_feed')->notice($e);
    }
  }
}
