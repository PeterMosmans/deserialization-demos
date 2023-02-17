#!/usr/bin/env php
<?php
/* Deserializes object from STDIN or file.
   The class definition is read from chainobject.php.

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
 */

include "chainobject.php";

if ($argc < 2) {
    /* Read from STDIN */
    $serialized = "";
    while ($stdin = fgets(STDIN)) {
        /* Only read one (the last) line */
        $serialized = $stdin;
    }
} else {
    /* Read from file */
    $filename = $argv[1];
    $serialized = file_get_contents($filename);
    print "Object read from " . $filename . "\n";
}
try {
    $object = unserialize($serialized);
    if (is_object($object)) {
        print "Deserialized object has class name " . get_class($object) . "\n";
        var_dump($object);
        print "\n";
    }
} catch (Exception $e) {
    print "Failed to deserialize object: " . $e . "\n";
}


?>
