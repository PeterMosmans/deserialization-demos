#!/usr/bin/env python3
"""Deserializes object from STDIN or file.

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
 """

import pickle
import sys
from typing import Optional


import typer
import yaml


def read_file(filename: str):
    """Return contents of a file."""
    try:
        with open(filename, "rb") as file:
            contents = file.read()
        return contents
    except Exception as exception:
        print(f"Could not read {filename}: {exception}")
        sys.exit(-1)


def read_stdin():
    """Read stdin."""
    return sys.stdin.buffer.read()


def main(filename: Optional[str] = typer.Argument(None), format: str = "native"):
    """Deserialize a file to an object."""
    if filename:
        contents = read_file(filename)
    else:
        contents = read_stdin()
    try:
        if format == "yaml":
            deserialized = yaml.unsafe_load(contents)
        else:
            deserialized = pickle.loads(contents)
    except Exception as exception:
        print(f"Could not properly deserialize file: {exception}")
        sys.exit(-1)
    print(f"Object deserialized: {type(deserialized)}")


if __name__ == "__main__":
    typer.run(main)
