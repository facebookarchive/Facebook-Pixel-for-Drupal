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

use PHPUnit\Framework\TestCase;
define('_JEXEC', 1);

final class PixelScriptBuilderTest extends TestCase {
  public function testCanGetPixelCode() {
    $pixel = new \Drupal\facebook_pixel\PixelScriptBuilder('12345');
    $this->assertInstanceOf(
      \Drupal\facebook_pixel\PixelScriptBuilder::class,
      $pixel);
  }
}
