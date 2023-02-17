#!/usr/bin/env php
<?php
/* Serializes object to STDOUT or file.
   The class definition is read from serializeobject.php.

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
 */

include "serializeobject.php";

$object = new SerializeObject();
$serialized = serialize($object);

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
