import re
import os
import urllib.request

# Read the full HTML
with open('scratch/about.html', 'r', encoding='utf-8') as f:
    html = f.read()

# Extract content between <!-- main-header end --> and <!-- main-footer -->
start_marker = "<!-- Mobile Menu  -->"
end_marker = "<!-- main-footer -->"
start_idx = html.find(start_marker)
end_idx = html.find(end_marker)

if start_idx == -1:
    # Try finding page-title
    start_marker = "<!-- Page Title -->"
    start_idx = html.find(start_marker)

if start_idx != -1 and end_idx != -1:
    content = html[start_idx:end_idx]
else:
    print("Could not find markers")
    exit(1)

# Replace Pure Hearts / Pureheart with Shanti Nagar Foundation
content = re.sub(r'(?i)Pure\s*Hearts?', 'Shanti Nagar Foundation', content)
content = content.replace('Pureheart', 'Shanti Nagar Foundation')
content = content.replace('PureHearts', 'Shanti Nagar Foundation')
content = content.replace('pureheart', 'shanti nagar foundation')

# Find all assets links (images)
# format is mostly assets/images/...
asset_pattern = r'assets/(?:images|css|js)/[^"\'\s)]+'
assets_found = re.findall(asset_pattern, content)
assets_found = list(set(assets_found)) # unique

base_url = "https://st.ourhtmldemo.com/new/PureHearts/"
headers = {
    "User-Agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36",
    "Referer": base_url
}

print(f"Found {len(assets_found)} assets.")
downloaded = 0
for asset in assets_found:
    local_path = f"public/{asset}"
    # ensure dir exists
    os.makedirs(os.path.dirname(local_path), exist_ok=True)
    if not os.path.exists(local_path):
        remote_url = base_url + asset
        req = urllib.request.Request(remote_url, headers=headers)
        try:
            with urllib.request.urlopen(req) as response, open(local_path, 'wb') as out_file:
                out_file.write(response.read())
            downloaded += 1
        except Exception as e:
            print(f"Failed to download {remote_url}: {e}")

print(f"Downloaded {downloaded} new assets.")

# Convert asset paths to Laravel {{ asset(...) }} syntax
def replace_asset(match):
    path = match.group(0)
    return f"{{{{ asset('{path}') }}}}"

content = re.sub(asset_pattern, replace_asset, content)

# Wrap in Blade layout structure
blade_content = f"""@extends('frontend.layouts.app')

@section('content')

{content}

@endsection
"""

# Save to resources/views/frontend/about/index.blade.php
os.makedirs('resources/views/frontend/about', exist_ok=True)
with open('resources/views/frontend/about/index.blade.php', 'w', encoding='utf-8') as f:
    f.write(blade_content)
print("Saved blade file.")
