<?php

namespace Drupal\ecommerce\Services;

use Symfony\Component\HttpFoundation\RedirectResponse;

class RouterService {

  //use UrlGeneratorTrait;

  const HOME_URL = '/';


  public function redirectToPreviosPage($message = '') {
    $request = \Drupal::request();
    $referer = $request->headers->get('referer');

    drupal_set_message($message, 'status');

    if (!$referer) $referer = self::HOME_URL;

    return RedirectResponse::create($referer);
  }


  public function redirectWithError($error) {

  	drupal_set_message($error, 'error');

  	return RedirectResponse::create(self::HOME_URL);
  }
} 