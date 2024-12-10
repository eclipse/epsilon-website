#!/bin/bash

set -e

# Go to the directory with this script
cd "$(dirname "$(readlink -f "$0")")"

# Create a Python virtualenv if we have the tool installed
# and it does not exist yet.
if which virtualenv; then
  if ! test -d env; then
    virtualenv -p python3 env
  fi
  source env/bin/activate
fi

# Serve the website without live reloading (useful for tests)
pip install -r requirements.txt
mkdocs serve --no-livereload