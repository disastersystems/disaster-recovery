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
   *  Processing Address
   *
   *  @return
   *  address
   */
  // public static function processAddress($address, $city) {
    
  // }

  /**
   *  Request Organization address from Google API
   *
   *  @return
   *  address information
   */
  // public static function getOrganizationAddress($address) {
  //   $endpoint = "http://maps.googleapis.com/maps/api/geocode/json?address=$address";
  //   $data = self::createHttpRequest($endpoint);
  //   $address = [];

  //   if($data->status == "OK") {
  //     $results = $data->results;
  //     $address_components = $results[0]->address_components;

  //     foreach($address_components as $component) {
  //       $type = $component->types[0];
  //       $value = $component->short_name;
  //       $address[$type] = $value;
  //     }

  //     return $address;
  //   }

  //   return NULL;
  // }
}
