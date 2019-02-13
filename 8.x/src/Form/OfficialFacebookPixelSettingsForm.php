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

use Drupal\official_facebook_pixel\OfficialFacebookPixelConfig;
use Drupal\official_facebook_pixel\OfficialFacebookPixelOptions;

/**
 * Class OfficialFacebookPixelSettingsForm.
 *
 * @package Drupal\official_facebook_pixel\Form
 */
class OfficialFacebookPixelSettingsForm extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return OfficialFacebookPixelConfig::FORM_ID;
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      OfficialFacebookPixelConfig::CONFIG_NAME,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $options = OfficialFacebookPixelOptions::getInstance();

    $form[OfficialFacebookPixelConfig::FORM_PIXEL_KEY] = [
      '#type' => 'textfield',
      '#title' => $this->t(OfficialFacebookPixelConfig::FORM_PIXEL_TITLE),
      '#description' => $this->t(OfficialFacebookPixelConfig::FORM_PIXEL_DESCRIPTION),
      '#default_value' => $options->getPixelId(),
      '#maxlength' => 64,
      '#size' => 64
    ];

    $form[OfficialFacebookPixelConfig::FORM_PII_KEY] = [
      '#type' => 'checkbox',
      '#title' => $this->t(OfficialFacebookPixelConfig::FORM_PII_TITLE),
      '#description' => $this->t(sprintf(
        OfficialFacebookPixelConfig::FORM_PII_DESCRIPTION,
        OfficialFacebookPixelConfig::FORM_PII_DESCRIPTION_LINK)),
      '#default_value' => $options->getUsePii(),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Retrieve the configuration
    $this->config(OfficialFacebookPixelConfig::CONFIG_NAME)
      // Set the submitted pixel_id setting
      ->set(OfficialFacebookPixelConfig::FORM_PIXEL_KEY, $form_state->getValue(OfficialFacebookPixelConfig::FORM_PIXEL_KEY))
      ->set(OfficialFacebookPixelConfig::FORM_PII_KEY, $form_state->getValue(OfficialFacebookPixelConfig::FORM_PII_KEY))
      ->save();

    parent::submitForm($form, $form_state);
  }
}
