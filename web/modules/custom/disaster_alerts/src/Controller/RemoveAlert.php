<?php

namespace Drupal\disaster_alerts\Controller;

use Drupal\Core\Controller\ControllerBase;

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
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: remove_alert_init')
    ];
  }

}
