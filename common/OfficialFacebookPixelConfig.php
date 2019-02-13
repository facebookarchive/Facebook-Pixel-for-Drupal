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
 * \OfficialFacebookPixelConfig.
 */

namespace Drupal\official_facebook_pixel;

/**
 * Class OfficialFacebookPixelConfig.
 *
 * @package Drupal\official_facebook_pixel
 */
class OfficialFacebookPixelConfig {
  const CONFIG_NAME = 'official_facebook_pixel.settings';
  const FORM_ID = 'official_facebook_pixel_settings';
  const FORM_PII_KEY = 'pii_id';
  const FORM_PII_TITLE = 'Use Advanced Matching on pixel?';
  const FORM_PII_DESCRIPTION = 'Enabling Advanced Matching improves audience building.<br />For businesses that operate in the European Union, you may need to take additional action. Read the <a href="%s" target="_blank">Cookie Consent Guide for Sites and Apps</a> for suggestions on complying with EU privacy requirements. the Facebook Pixel ID';
  const FORM_PII_DESCRIPTION_LINK = 'https://developers.facebook.com/docs/privacy/';
  const FORM_PIXEL_KEY = 'pixel_id';
  const FORM_PIXEL_TITLE = 'Pixel ID';
  const FORM_PIXEL_DESCRIPTION = 'Enter the Facebook Pixel ID';
  const SOURCE_7 = 'pldrupal-7';
  const SOURCE_8 = 'pldrupal-8';

  // integration config for Drupal7: INTEGRATION_KEY => PLUGIN_CLASS
  public static function integrationConfigFor7() {
    return array(
    );
  }

  // integration config for Drupal8: INTEGRATION_KEY => PLUGIN_CLASS
  public static function integrationConfigFor8() {
    return array(
    );
  }
}
