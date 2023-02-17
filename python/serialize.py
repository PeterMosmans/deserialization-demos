#!/usr/bin/env python3
"""Serialization demo. Currently supports pickle (native) and YAML format."""

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
    if format == "yaml":
        mode = "w"
        serialized = yaml.dump(serialize)
    else:
        mode = "wb"
        serialized = pickle.dumps(serialize)
    if filename:
        write_file(filename, serialized, mode=mode)
    else:
        sys.stdout.buffer.write(serialized)


if __name__ == "__main__":
    typer.run(main)
