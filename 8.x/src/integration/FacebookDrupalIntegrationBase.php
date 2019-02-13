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
 * \integration\FacebookDrupalIntegrationBase.
 */

namespace Drupal\official_facebook_pixel\integration;

/**
 * Class FacebookDrupalIntegrationBase.
 *
 * @package Drupal\official_facebook_pixel\integration
 */

abstract class FacebookDrupalIntegrationBase {
  const TRACKING_NAME = '';

  /**
   * inject the pixel code for the plugin
   */
  public static function injectPixelCode(array &$page) {
  }
}
