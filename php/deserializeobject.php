<?php
/* Class definition for deserialization.

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
 */

class DeserializeObject
{
    /* This object has two properties */
    public $admin = false;
    public $username;

    /* This will be automatically executed on object creation */
    public function __wakeup()
    {
        if ($this->admin and isset($this->username)) {
            print "The username of this admin is " . $this->username . "\n";
        }
    }
}

?>
