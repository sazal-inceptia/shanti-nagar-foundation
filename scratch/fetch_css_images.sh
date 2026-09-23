#!/bin/bash
BASE_URL="https://st.ourhtmldemo.com/new/PureHearts"
grep -o 'url([^)]*)' public/assets/css/style.css | sed -E "s/url\('?([^')]+)'?\)/\1/" > scratch/css_images.txt

while read -r asset; do
    if [[ $asset == ../* ]]; then
        clean_path="assets/${asset#../}"
        if [ ! -f "public/$clean_path" ]; then
            dir=$(dirname "public/$clean_path")
            mkdir -p "$dir"
            echo "Downloading $clean_path"
            curl -s -L -A "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36" -e "https://st.ourhtmldemo.com/new/PureHearts/index.html" -o "public/$clean_path" "$BASE_URL/$clean_path"
        fi
    fi
done < scratch/css_images.txt
