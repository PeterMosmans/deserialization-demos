#####################
Deserialization Demos
#####################

Accompanying repository for the Specialized Testing: Deserialization course on
Pluralsight.
Please note that these instructions can slightly differ from the ones being
shown during the course - this repository is leading.

**************
What is this ?
**************

The files in this repository allow you to quickly try out serialization and
deserialization using several languages and formats. You can either use the
scripts directly, or build ready-to-use Docker images containing the scripts.

Furthermore the Docker images contain several other handy (de)serialization
tools, like `ysoserial <https://github.com/frohoff/ysoserial>`_, `detect_type
<https://github.com/PeterMosmans/deserialization-demos/blob/main/python/detect_type.py>`_,
and `SerializationDumper <https://github.com/NickstaDB/SerializationDumper>`_.

If you don't have access to Make or don't want to build the images yourself: No
problem. The images can be found on Docker hub. Pull the images using:

.. code-block:: console

   git pull gofwd/deserialization:java
   git pull gofwd/deserialization:php
   git pull gofwd/deserialization:python

***********************
Build the Docker images
***********************

In order to build the Docker images, it's easiest to have ``GNU Make`` installed.
Open a terminal, clone this repository, and go to the directory containing these
files:

.. code-block:: console

   git clone https://github.com/PeterMosmans/deserialization-demos
   cd deserialization-demos
   make all

This builds (and test) all 3 Docker images:

+ ``gofwd/deserialization:java``
+ ``gofwd/deserialization:php``
+ ``gofwd/deserialization:python``

*****
Usage
*****

On each image, the serialization and deserialization scripts can be executed by
referencing their name directly. The scripts either expect a filename, or, when
not supplied, they can take input from STDIN and output directly to STDOUT.


Using a Docker image, serialize ``MyObject`` and save it to a local file
``serialized``:

.. code-block:: console

   docker run --rm gofwd/deserialization:java serialize > serialized.java
   docker run --rm gofwd/deserialization:php serialize > serialized.php
   docker run --rm gofwd/deserialization:python serialize > serialized.python

Detect which (serialized) type the file ``serialized`` has:

.. code-block:: console

   docker run --rm -v $PWD:/workdir:ro gofwd/deserialization:python detect_type serialized

Deserialize a PHP object from stdin:

.. code-block:: console

   echo 'O:6:"object":1:{s:8:"property";b:1;}' | docker run --rm -i gofwd/deserialization:php deserialize

Deserialize the file ``serialized``:

.. code-block:: console

   # As a file...
   docker run --rm -v $PWD:/workdir:ro gofwd/deserialization:java deserialize serialized
   # ...or by using STDIN
   cat serialized | docker run --rm -i gofwd/deserialization:php deserialize

*********
ysoserial
*********

The image ``gofwd/deserialization:java`` contains the tool `ysoserial
<https://github.com/frohoff/ysoserial>`_. This tool creates gadget
chains to exploit insecure deserialization vulnerabilities.

Create a gadget chain for Clojure, executing the command is, and save it to
``exploit``:

.. code-block:: console

   docker run --rm gofwd/deserialization:java ysoserial Clojure 'id' > exploit

***********
detect_type
***********

The image ``gofwd/deserialization:python`` contains the script
``detect_type.py``. This script tries to fingerprint the serialization format of
a file.

Detect the type of the file ``exploit``:

.. code-block:: console

   docker run --rm -v $(PWD):/workdir:ro gofwd/deserialization:python detect_type exploit

*******************
SerializationDumper
*******************

The image ``gofwd/deserialization:java`` contains the tool `SerializationDumper
<https://github.com/NickstaDB/SerializationDumper>`_. This tool can dump
serialized Java objects into a more human-readable form.

Dump the object that is stored in ``exploit`` in binary format:

.. code-block:: console

   docker run --rm gofwd/deserialization:java SerializationDumper $(xxd -plain exploit|tr -d \\n)

Note that the command ``xxd -plain`` converts the binary format to hexadecimal
format, and ``tr -d \\n`` removes all new line characters.
