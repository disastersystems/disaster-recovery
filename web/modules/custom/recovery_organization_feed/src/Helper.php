<?php

namespace Drupal\recovery_organization_feed;

use Symfony\Component\HttpFoundation\Response;

/**
* Class HomeFeed
*/
class Helper {

  private function createHttpRequest($endpoint) {
    $client = \Drupal::httpClient();
    
    try {
      $request = $client->request('GET', $endpoint, [
        'headers' => [
          'Accept'     => 'application/json',
        ]
      ]);

      $status = $request->getStatusCode();

      if($status == 200) {
        $response = new Response(($request->getBody()));
        $content = json_decode($response->getContent());

        return $content;
      }
    } catch (RequestException $e) {
      \Drupal::logger('recovery_organization_feed')->notice($e);
    }
  }
  /**
   *  Get New/Updated Homes from Feed
   *
   *  @return
   *  An array new/updated Homes from Feed
   */
  public static function getOrganizationsFromFeed() {
    $endpoint = \Drupal::config('recovery_organization_feed.endpoint')->get('organization');
    $data = self::createHttpRequest($endpoint);
    return $data->shelters;
  }

  /**
   *  Get existing Organizations on Site
   *
   *  @return
   *  And array of nid
   */
  public static function getExistingOrganizations() {
    $organizations = \Drupal::database()
                  ->query("SELECT nid
                    FROM node_field_data
                    WHERE type='recovery_organization'")->fetchCol();
    return $organizations;
  }


  /**
   *
   *  Get Shelters Term ID
   *
   *  @return
   *  tid
   */
  public static function getSheltersTermID() {
    $tid = \Drupal::database()
                  ->query("SELECT tid
                    FROM taxonomy_term_field_data
                    WHERE name='shelters' and vid='resources'")->fetchField();
    return $tid;
  }
}
