/* Class definition for deserialization.

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
 */

package net.gofwd;

public class MyObject implements java.io.Serializable {

  // This object has two properties
  public boolean admin;
  public String name;

  // Default constructor
  public MyObject() {
    this.admin = false;
  }
}
