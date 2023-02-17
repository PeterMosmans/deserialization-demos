#!/usr/bin/env php
<?php
/* Serializes object to STDOUT or file.
   The class definition is read from serializeobject.php.

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
 */

class SerializeObject
{
    /* Note that this object has only one property */
    public $admin = false;
}

$object = new SerializeObject();
$serialized = serialize($object);

include "serialize_function.php";


?>
