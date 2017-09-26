<?php

namespace Drupal\disaster_alerts\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class SendAlert.
 */
class SendAlert extends ControllerBase {

  /**
   * Send_alert_init.
   *
   * @return string
   *   Return Hello string.
   */
  public function send_alert_init() {
    return [
      '#type' => 'markup',
      '#markup' => $this->t('Implement method: send_alert_init')
    ];
  }

}
