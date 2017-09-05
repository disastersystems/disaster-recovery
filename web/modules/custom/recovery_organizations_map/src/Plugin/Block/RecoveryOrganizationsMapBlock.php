<?php

namespace Drupal\recovery_organizations_map\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\node\Entity\Node;
use Drupal\Core\Url;

/**
 * Provides a 'RecoveryOrganizationsMapBlock' block.
 *
 * @Block(
 *  id = "recovery_organizations_map_block",
 *  admin_label = @Translation("Recovery Organizations Map"),
 * )
 */
class RecoveryOrganizationsMapBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    $current_term = \Drupal::request()->attributes->get('taxonomy_term');
    
    if(!empty($current_term)) {
      $current_term_tid = $current_term->id();

      return [
        '#theme' => 'recovery_organizations_map',
        '#attached' => array(
          'library' =>  array(      
            'recovery_organizations_map/libraries',
          ),
          'drupalSettings' => [
            'tid' => $current_term_tid,
          ],
        ),
      ];
    }

    return NULL;
  }
}
