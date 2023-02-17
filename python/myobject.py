"""Example object definition."""
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
