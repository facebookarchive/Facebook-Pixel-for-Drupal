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

/**
 * Implements hook_admin_settings().
 */
function official_facebook_pixel_settings_form($form, &$form_state) {
  $form = array();

  $form['pixel_id'] = array(
    '#type' => 'textfield',
    '#title' => 'Pixel ID',
    '#required' => TRUE,
    '#default_value' => variable_get('pixel_id', '{pixel_id}'),
  );

  return system_settings_form($form);
}
