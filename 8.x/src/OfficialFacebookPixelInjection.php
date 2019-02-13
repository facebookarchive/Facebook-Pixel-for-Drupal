<?php

/*
 * Copyright (C) 2017-present, Facebook, Inc.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; version 2 of the License.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 */

/**
 * @file
 * Contains \Drupal\official_facebook_pixel
 * \OfficialFacebookPixelInjection.
 */

namespace Drupal\official_facebook_pixel;

use Drupal\official_facebook_pixel\OfficialFacebookPixelConfig;
use Drupal\official_facebook_pixel\OfficialFacebookPixelOptions;

/**
 * Class OfficialFacebookPixelInjection.
 *
 * @package Drupal\official_facebook_pixel
 */
class OfficialFacebookPixelInjection {
  public static function injectPixelCode(array &$page) {
    $options = OfficialFacebookPixelOptions::getInstance();
    PixelScriptBuilder::initialize($options->getPixelId());

    self::injectScriptCode($page, $options);
    self::injectNoScriptCode($page);

    foreach (OfficialFacebookPixelConfig::integrationConfigFor8() as $key => $value) {
      $class_name = 'Drupal\\official_facebook_pixel\\integration\\'.$value;
      $class_name::injectPixelCode($page);
    }
  }

  public static function injectScriptCode(array &$page, $options) {
    // Inject inline script code to head
    $pixel_script_code = PixelScriptBuilder::getPixelBaseCode();
    $pixel_script_code .= PixelScriptBuilder::getPixelInitCode(
      $options->getAgentString(),
      $options->getUserInfo());
    $pixel_script_code .= PixelScriptBuilder::getPixelPageViewCode();
    $page['#attached']['html_head'][] = [
      [
        '#tag' => 'script',
        '#value' => $pixel_script_code
      ],
      'facebook_pixel_script_code'
    ];
  }

  public static function injectNoScriptCode(array &$page) {
    // Inject inline noscript code to head
    $pixel_noscript_code = PixelScriptBuilder::getPixelNoscriptCode();
    $page['#attached']['html_head'][] = [
      [
        '#tag' => 'noscript',
        '#value' => $pixel_noscript_code
      ],
      'facebook_pixel_noscript_code'
    ];
  }
}
