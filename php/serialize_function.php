#!/usr/bin/env php
<?php
/* Serializes object to STDOUT or file.
   Expects that the variable $serialized is set

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
 */

  if (!isset($serialized)){
    exit(0);
  }

  if ($argc < 2) {
    /* Write to STDOUT */
    print $serialized;
  } else {
    /* Write to file */
    $filename = $argv[1];
    file_put_contents($filename, $serialized);
    print "Object serialized and saved to " . $filename . "\n";
  }


?>
