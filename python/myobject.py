"""Class definition for serialization.

   SPDX-License-Identifier: GPL-3.0-or-later

   This file is part of the deserialization demos:
   https://github.com/PeterMosmans/deserialization-demos
"""
import subprocess


class MyObject:
    """Example object."""

    def __init__(self):
        """Magic function - executes when instantiated."""
        # subprocess.run(["touch", "INIT"])

    def __reduce__(self):
        """Magic function - executes when deserialized."""
        return (
            subprocess.run,
            (["touch", "REDUCE"],),
        )
