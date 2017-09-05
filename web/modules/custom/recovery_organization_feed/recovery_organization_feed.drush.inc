<?php

use Drupal\recovery_organization_feed\RecoveryOrganizationFeed;

/**
* @file Contains the code to generate the custom drush commands.
*/
/**
* Implements hook_drush_command().
*/
function recovery_organization_feed_drush_command() {
 $items = array();
 $items['import-organization'] = [
   'description' => 'Run the organization import',
   'drupal dependencies' => ['recovery_organization_feed'],
 ];

 $items['delete-organization'] = [
   'description' => 'Run the organization delete',
   'drupal dependencies' => ['recovery_organization_feed'],
 ];
 return $items;
}

/**
* Call back function drush_custom_drush_command_say_hello()
* The call back function name in the  following format
*   drush_{module_name}_{item_id_for_command}()
*/
function drush_recovery_organization_feed_import_organization() {
  drush_print('Start Creating Recovery Organization Feed process.');
  $importer = new RecoveryOrganizationFeed();
  $results = $importer->run('create');
  drush_print("Finish Creating Recovery Organization Feed process. Create $results.");
}

function drush_recovery_organization_feed_delete_organization() {
  drush_print('Start Deleting Recovery Organization Feed process.');
  $importer = new RecoveryOrganizationFeed();
  $results = $importer->run('delete');
  drush_print("Finish Deleting Recovery Organization Feed process.");
}
