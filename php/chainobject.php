<?php
/* Class definition for serialization.

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

?>
