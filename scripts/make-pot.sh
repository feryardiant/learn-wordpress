#!/bin/bash

for pkg in `ls packages/`; do
    if [ ! -d "packages/$pkg" ]; then
        continue
    fi

    pkg_dir="packages/$pkg"

    ./vendor/bin/wp i18n make-pot "$pkg_dir" "$pkg_dir/languages/$pkg.pot"
done
