<?php

namespace Drupal\recovery_organization_feed;

use Drupal\node\Entity\Node;
use Drupal\recovery_organization_feed\Helper;

/**
* Class RecoveryOrganizationFeed
*/
class RecoveryOrganizationFeed {

  /**
   *  Trigger Recovery Organization Feed
   *
   *  @param action
   */
  public function run($action) {
    switch ($action) {
      case 'create':
        $organizations = $this->createNewOrganizations();
        return $organizations;
        break;
      case 'delete':
        $organizations = $this->deleteOrganizations();
        return $organizations;
        break;
      default:
        break;
    }
  }

  /**
   *  Delete Recovery Organizations
   */
  public function deleteOrganizations() {
    $organizations = Helper::getExistingOrganizations();
    if(!empty($organizations)) {
      $nodes = Node::loadMultiple($organizations);
      foreach($nodes as $node) {
        $node->delete();
      }
    }
  }

  /**
   *  Create new Recovery Organizations from Feed
   *
   *  @return 
   *  Count of new organizations created
   */
  private function createNewOrganizations() {
    $organizations = Helper::getOrganizationsFromFeed();
    $count = 0;
    foreach($organizations as $organization) {
      if($this->createNewOrganization($organization)) {
        $count++;
      }
    }
    return $count;
  }

  /**
   *  Create new Recovery Organization from Feed
   *
   *  @param array of $organization data from createNewHomes
   *
   *  @return 
   *  nid
   */
  private function createNewOrganization($organization) {
    $title = $organization->shelter;
    $latitude = $organization->latitude;
    $longitude = $organization->longitude;
    // $address = $organization->address;
    // $city = $organization->city;
    // $address = Helper::processAddress($shelter_address, $city);
    $written_address = $organization->address;
    $cleanPhone = $organization->cleanPhone;
    $phone = '('.substr($cleanPhone, 0, 3).') '.substr($cleanPhone, 3, 3).'-'.substr($cleanPhone,6);
    $description = $organization->notes;

    $data = [
      'type' => 'recovery_organization',
      'title' => $title,
      'status' => 1,
      'field_phone' => $phone,
      'field_provides' => [
        'target_id' => Helper::getSheltersTermID(),
      ],
      'field_written_address' => $written_address,
      'field_description' => [
        'format' => 'basic_html',
        'value' => $notes
      ],
    ];

    if(!empty($latitude) && !empty($longitude)) {
      $data['field_geofield'] = [
        'lat' => $latitude,
        'lon' => $longitude,
        'geo_type' => 'Point',
        'value' => "POINT($longitude $latitude)",
      ];
    }

    $node = Node::create($data);
    $node->save();
    $nid = $node->id();

    drush_print("Create $title");

    return $nid;
  }
}