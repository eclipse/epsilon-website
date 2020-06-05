#!/bin/bash

set -e

# Go to the directory with this script
cd "$(dirname "$(readlink -f "$0")")"

# Create a Python virtualenv if it does not exist yet
if ! test -d env; then
  virtualenv -p python3 env
fi

# Serve the website
source env/bin/activate
pip install -r requirements.txt
mkdocs serve