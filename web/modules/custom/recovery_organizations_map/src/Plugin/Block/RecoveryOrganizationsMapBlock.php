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

    return [
      '#theme' => 'recovery_organizations_map',
      '#attached' => array(
        'library' =>  array(      
          'recovery_organizations_map/libraries',
        ),
      ),
    ];
  }
}
