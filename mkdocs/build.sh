#!/bin/bash

set -e

# Go to the directory with this script
cd "$(dirname "$(readlink -f "$0")")"

# Create a Python virtualenv if it does not exist yet
if ! test -d env; then
  virtualenv -p python3 env
fi

# Generate the website
source env/bin/activate
pip install -r requirements.txt
mkdocs build
cp docs/assets/images/* site/assets/images/

# Synchronise with repository root
rsync -ravz --delete \
  --exclude mkdocs --exclude .git --exclude README.md \
  site/ ../
