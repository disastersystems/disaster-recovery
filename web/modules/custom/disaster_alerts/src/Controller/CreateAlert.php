<?php

namespace Drupal\disaster_alerts\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class CreateAlert.
 */
class CreateAlert extends ControllerBase {

  /**
   * Alert_init.
   *
   * @return string
   *   Return Hello string.
   */
  public function alert_init() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: alert_init')
    ];
  }

}
