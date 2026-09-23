import os
import re
import urllib.request
from pathlib import Path

# Paths
BASE_URL = 'https://st.ourhtmldemo.com/new/PureHearts/'
LOCAL_DIR = Path('public')

# Read index blade
with open('resources/views/frontend/home/index.blade.php', 'r') as f:
    content = f.read()
with open('resources/views/frontend/partials/header.blade.php', 'r') as f:
    content += f.read()

# Find all asset paths
assets = re.findall(r"asset\('([^']+)'\)", content)

# Unique assets
assets = set(assets)

opener = urllib.request.build_opener()
opener.addheaders = [('User-agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36')]
urllib.request.install_opener(opener)

for asset_path in assets:
    local_path = LOCAL_DIR / asset_path
    if not local_path.exists():
        # print(f"Missing: {asset_path}")
        remote_url = BASE_URL + asset_path
        try:
            local_path.parent.mkdir(parents=True, exist_ok=True)
            print(f"Downloading {remote_url} to {local_path}")
            urllib.request.urlretrieve(remote_url, local_path)
        except Exception as e:
            print(f"Failed to download {remote_url}: {e}")

