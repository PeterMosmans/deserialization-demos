#!/usr/bin/env python3
"""Detect serialization file format."""

# SPDX-License-Identifier: GPL-3.0-or-later
__author__ = "Peter Mosmans"

import sys
import magic
import typer


def php_format(filename: str, detected: str):
    """Detect whether a file is the PHP serialization format."""
    contents, length = read_file(filename)
    # Convert to text
    contents = contents.decode("utf-8")
    if contents[0] in "abdisNO":
        if length > 1 and contents[1] in ":":
            return "PHP serialization format (uncertain)"
    return detected


def pickle_format(filename: str, detected: str):
    """Detect whether a file is the Pickle file format."""
    contents, length = read_file(filename)
    if (
        length > 2
        and contents[0] == 128
        and contents[1] < 6
        and contents[length - 1] == 46
    ):
        return f"Pickle serialization format {contents[1]} (uncertain)"
    return detected


def read_file(filename: str):
    """Return contents of a file."""
    try:
        with open(filename, "rb") as file:
            contents = file.read()
        return contents, len(contents)
    except Exception as exception:
        print(f"Could not read {filename}: {exception}")
        sys.exit(-1)


def main(filename: str):
    """Detect file type."""
    try:
        detected = magic.from_file(filename)
    except Exception as exception:
        print(f"Could not read {filename}: {exception}")
        sys.exit(-1)
    if "data" in detected:
        detected = pickle_format(filename, detected)
    if "Solitaire Image Recorder format" in detected:
        detected = php_format(filename, detected)
    print(detected)


if __name__ == "__main__":
    typer.run(main)
