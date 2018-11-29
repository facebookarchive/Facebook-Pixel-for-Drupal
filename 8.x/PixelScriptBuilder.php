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
 * Contains \Drupal\official_facebook_pixel\PixelScriptBuilder.
 */

namespace Drupal\official_facebook_pixel;

/**
 * Pixel object
 */
class PixelScriptBuilder {

  const PIXEL_CODE_SCRIPT = "
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '%s', {}, %s);
fbq('track', 'PageView');
";

  const PIXEL_CODE_NOSCRIPT = "
<img height=\"1\" width=\"1\" style=\"display:none\" alt=\"fbpx\"
src=\"https://www.facebook.com/tr?id=%s&ev=PageView&noscript=1\"/>";

  const PARTNER_AGENT_NAME = 'pldrupal-8';

  static $pixelID;

  public function __construct($pixel_id = '0') {
    self::$pixelID = $pixel_id;
  }

  /**
   * Returns FB pixel code script part
   */
  public function getPixelScriptCode() {
    return sprintf(self::PIXEL_CODE_SCRIPT, self::$pixelID, self::getParameters());
  }

  /**
   * Returns FB pixel code noscript part
   */
  public function getPixelNoscriptCode() {
    return sprintf(self::PIXEL_CODE_NOSCRIPT, self::$pixelID);
  }

  /**
   * Returns FB pixel code including both script and noscript part.
   */
  public function getPixelCode() {
    $script = "<script>" . $this->getPixelScriptCode() . "</script>
";
    $noscript = "<noscript>" . $this->getPixelNoscriptCode() . "</noscript>
";
    return $script . $noscript;
  }

  /**
   * Returns FB pixel code script parameters part
   */
  private function getParameters() {
    return "{agent: '" . self::PARTNER_AGENT_NAME . "'}";
  }
}
