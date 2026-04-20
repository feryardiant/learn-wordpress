#!/bin/bash

for pkg in `ls packages/`; do
    if [ ! -d "packages/$pkg" ]; then
        continue
    fi

    pkg_dir="packages/$pkg"

    if [ ! -f "$pkg_dir/.distignore" ]; then
        echo -e "\e[1;33mNotice:\e[0m No .distignore found for $pkg, skipping"
        continue
    fi

    ./vendor/bin/wp dist-archive "$pkg_dir" public/dist --force --create-target-dir
done
