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
 * Contains \Drupal\official_facebook_pixel\Form
 * \OfficialFacebookPixelSettingsForm.
 */

namespace Drupal\official_facebook_pixel\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class OfficialFacebookPixelSettingsForm.
 *
 * @package Drupal\official_facebook_pixel\Form
 */
class OfficialFacebookPixelSettingsForm extends ConfigFormBase {

  const CONFIG_NAME = 'official_facebook_pixel.settings';
  const FORM_ID = 'official_facebook_pixel_settings';
  const FORM_KEY = 'pixel_id';
  const FORM_TITLE = 'Pixel ID';
  const FORM_DESCRIPTION = 'Enter the Facebook Pixel ID';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return self::FORM_ID;
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      self::CONFIG_NAME,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(self::CONFIG_NAME);

    $form[self::FORM_KEY] = [
      '#type' => 'textfield',
      '#title' => $this->t(self::FORM_TITLE),
      '#description' => $this->t(self::FORM_DESCRIPTION),
      '#default_value' => $config->get(self::FORM_KEY),
      '#maxlength' => 64,
      '#size' => 64
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration
    $this->config(self::CONFIG_NAME)
      // Set the submitted pixel_id setting
      ->set(self::FORM_KEY, $form_state->getValue(self::FORM_KEY))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
