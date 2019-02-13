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
 * Contains facebook_pixel_settings_form.
 */

use Drupal\official_facebook_pixel\OfficialFacebookPixelConfig;
use Drupal\official_facebook_pixel\OfficialFacebookPixelOptions;

/**
 * Implements hook_admin_settings().
 */
function official_facebook_pixel_settings_form($form, &$form_state) {
  $options = OfficialFacebookPixelOptions::getInstance();

  $form = array();

  $form[OfficialFacebookPixelConfig::FORM_PIXEL_KEY] = array(
    '#type' => 'textfield',
    '#title' => t(OfficialFacebookPixelConfig::FORM_PIXEL_TITLE),
    '#description' => t(OfficialFacebookPixelConfig::FORM_PIXEL_DESCRIPTION),
    '#required' => TRUE,
    '#default_value' => $options->getPixelId(),
  );

  $form[OfficialFacebookPixelConfig::FORM_PII_KEY] = array(
    '#type' => 'checkbox',
    '#title' => t(OfficialFacebookPixelConfig::FORM_PII_TITLE),
    '#description' => t(sprintf(
      OfficialFacebookPixelConfig::FORM_PII_DESCRIPTION,
      OfficialFacebookPixelConfig::FORM_PII_DESCRIPTION_LINK)),
    '#default_value' => $options->getUsePii(),
  );

  return system_settings_form($form);
}
