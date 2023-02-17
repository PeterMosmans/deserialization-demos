/* Deserializes object from STDIN or file.
   The class definition is read from MyObject.

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
 */

package net.gofwd;

import java.io.*;

public class Deserialize {

  // Serialize an object to a file
  public static void main(String[] args) {
    MyObject object = null;
    try {
      if (args.length == 0) {
        ObjectInputStream in = new ObjectInputStream(System.in);
        object = (MyObject) in.readObject();
        in.close();
      } else {
        String filename = args[0];
        FileInputStream file = new FileInputStream(filename);
        ObjectInputStream in = new ObjectInputStream(file);
        object = (MyObject) in.readObject();
        in.close();
        file.close();
      }
      System.out.println("Object deserialized: admin is " + object.admin);
    } catch (IOException ex) {
      System.out.println("Could not read: " + ex);
    } catch (ClassNotFoundException ex) {
      System.out.println("Class not found: " + ex);
    } catch (NullPointerException ex) {
      System.out.println("Could not deserialize object: " + ex);
    }
  }
}
