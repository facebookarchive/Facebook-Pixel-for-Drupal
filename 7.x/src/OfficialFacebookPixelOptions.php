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
 * \OfficialFacebookPixelOptions.
 */

namespace Drupal\official_facebook_pixel;

use Drupal\official_facebook_pixel\OfficialFacebookPixelConfig;

/**
 * Class OfficialFacebookPixelOptions.
 *
 * @package Drupal\official_facebook_pixel
 */
class OfficialFacebookPixelOptions {
  private static $instance = null;
  private $options = array();
  private $userInfo = array();
  private $versionInfo = array();

  public static function getInstance() {
    if (is_null(self::$instance)) {
      self::$instance = new OfficialFacebookPixelOptions();
    }

    return self::$instance;
  }

  public function __construct() {
    $this->setOptions();
    $this->setUserInfo();
    $this->setVersionInfo();
  }

  public function getOptions() {
    return $this->options;
  }

  private function setOptions() {
    $this->options = array(
      OfficialFacebookPixelConfig::FORM_PIXEL_KEY =>
        variable_get(OfficialFacebookPixelConfig::FORM_PIXEL_KEY, '{pixel_id}'),
      OfficialFacebookPixelConfig::FORM_PII_KEY =>
        variable_get(OfficialFacebookPixelConfig::FORM_PII_KEY, 1),
    );
  }

  public function getPixelId() {
    return $this->options[OfficialFacebookPixelConfig::FORM_PIXEL_KEY];
  }

  public function getUsePii() {
    return $this->options[OfficialFacebookPixelConfig::FORM_PII_KEY];
  }

  public function getUserInfo() {
    return $this->userInfo;
  }

  public function setUserInfo() {
    global $user;
    $use_pii = $this->getUsePii();
    if (0 === $user->uid || $use_pii !== 1) {
      // User not logged in or admin chose not to send PII.
      $this->userInfo = array();
    } else {
      $this->userInfo = array_filter(
        array(
          // Keys documented in
          // https://developers.facebook.com/docs/facebook-pixel/pixel-with-ads/conversion-tracking#advanced_match
          'em' => $user->mail,
        ),
        function ($value) { return $value !== null && $value !== ''; });
    }
  }

  public function getVersionInfo() {
    return $this->versionInfo;
  }

  public function setVersionInfo() {
    $this->versionInfo = array(
      'source' => OfficialFacebookPixelConfig::SOURCE_7,
      'version' => VERSION,
    );
  }

  public function getAgentString() {
    return sprintf(
      '%s-%s',
      $this->versionInfo['source'],
      $this->versionInfo['version']);
  }
}
