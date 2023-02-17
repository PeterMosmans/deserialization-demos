/* Serializes object to STDOUT or file.
   The class definition is read from MyObject.

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
 */

package net.gofwd;

import java.io.*;

public class Serialize {

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
