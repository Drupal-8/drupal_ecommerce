<?php

namespace Drupal\ecommerce\Services;

use Symfony\Component\HttpFoundation\RedirectResponse;

class RouterService {

  //use UrlGeneratorTrait;

  const HOME_URL = '/';


  public function redirectToPreviosPage($message = '') {
    $request = \Drupal::request();
    $referer = $request->headers->get('referer');

    if (!$referer) $referer = self::HOME_URL;

    return RedirectResponse::create($referer);
  }
} 