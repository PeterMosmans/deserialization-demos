/* Serializes object to STDOUT or file.
   Note that the class definition can be found within this file.

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
 */
package net.gofwd;

import java.io.*;


public class SerializeAnother {

  // Serialize an object to a file
  public static void main(String[] args) {
    MyObject object = new MyObject();
    try {
      if (args.length == 0) {
        ObjectOutputStream out = new ObjectOutputStream(System.out);
        out.writeObject(object);
        out.close();
      } else {
        String filename = args[0];
        FileOutputStream file = new FileOutputStream(filename);
        ObjectOutputStream out = new ObjectOutputStream(file);
        out.writeObject(object);
        out.close();
        file.close();
        System.out.println("Object serialized and saved to " + filename);
      }
    } catch (IOException i) {
      System.out.println("Could not write: " + i);
    }
  }
}

class MyObject implements java.io.Serializable {

  // This object has one property
  public boolean admin;
  public String name;

  // private static final long serialVersionUID = 5113763556545582140L;
  // Default constructor
  public MyObject() {
    this.admin = true;
  }
}
