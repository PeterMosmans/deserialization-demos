#!/usr/bin/env python3
"""Serializes object to STDOUT or file.
   The class definition is read from myobject.py

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
 """

import pickle
import sys
from typing import Optional

import typer
import yaml

import myobject


def write_file(filename: str, data, mode="w"):
    """Write to file."""
    try:
        with open(filename, mode) as file:
            file.write(data)
    except IOError as exception:
        print(f"Could not write to {filename}: {exception}")
        sys.exit(-1)
    print(f"Object saved to {filename}")


def main(filename: Optional[str] = typer.Argument(None), format: str = "native"):
    """Serialize an object to a file."""
    serialize = myobject.MyObject()
    if format in "yaml":
        serialized = yaml.dump(serialize)
        if filename:
            write_file(filename, serialized, mode="w")
        else:
            sys.stdout.write(serialized)
    else:
        serialized = pickle.dumps(serialize)
        if filename:
            write_file(filename, serialized, mode="wb")
        else:
            sys.stdout.buffer.write(serialized)


if __name__ == "__main__":
    typer.run(main)
