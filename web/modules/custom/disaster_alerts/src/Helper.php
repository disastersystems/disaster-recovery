<?php

namespace Drupal\disaster_alerts;

use Symfony\Component\HttpFoundation\JsonResponse;

class Helper {
  /**
   * @param $message
   * @return JsonResponse
   */
  public static function responseHelper($message) {
    $response = new JsonResponse();

    $response->setData([
      'data' => $message
    ]);

    return $response;
  }

}
