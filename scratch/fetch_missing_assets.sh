#!/bin/bash
BASE_URL="https://st.ourhtmldemo.com/new/PureHearts"
grep -o "asset('assets/[^']*')" resources/views/frontend/home/index.blade.php resources/views/frontend/partials/header.blade.php | sed -E "s/.*asset\('([^']+)'\)/\1/" | sort | uniq > scratch/assets.txt

while read -r asset; do
    dir=$(dirname "public/$asset")
    mkdir -p "$dir"
    echo "Downloading $asset"
    curl -s -L -A "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36" -e "https://st.ourhtmldemo.com/new/PureHearts/index.html" -o "public/$asset" "$BASE_URL/$asset"
done < scratch/assets.txt
