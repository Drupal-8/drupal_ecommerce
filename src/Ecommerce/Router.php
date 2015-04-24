<?php
/**
 * Created by PhpStorm.
 * User: manel
 * Date: 24/04/15
 * Time: 19:51
 */

namespace Drupal\ecommerce\Ecommerce;

use Symfony\Component\HttpFoundation\RedirectResponse;

class Router {

  //use UrlGeneratorTrait;

  const HOME_URL = '/';


  public function redirectToPreviosPage($message = '') {
    $request = \Drupal::request();
    $referer = $request->headers->get('referer');

    if (!$referer) $referer = self::HOME_URL;

    return RedirectResponse::create($referer);
  }
} 