import os
import re
import urllib.request
import urllib.error

base_url = 'https://st.ourhtmldemo.com/new/PureHearts/assets/'
local_base_dir = 'public/assets/'
blade_files = [
    'resources/views/frontend/layouts/app.blade.php',
    'resources/views/frontend/partials/header.blade.php',
    'resources/views/frontend/partials/footer.blade.php',
    'resources/views/frontend/home/index.blade.php',
]

def download_file(url, local_path):
    if os.path.exists(local_path):
        return True
    
    os.makedirs(os.path.dirname(local_path), exist_ok=True)
    try:
        urllib.request.urlretrieve(url, local_path)
        print(f"Downloaded: {url}")
        return True
    except Exception as e:
        print(f"Failed to download {url}: {e}")
        return False

def parse_and_download_css(css_path, relative_to_url):
    try:
        with open(css_path, 'r', encoding='utf-8') as f:
            content = f.read()
    except Exception:
        return
        
    # Find url(...) in CSS
    urls = re.findall(r'url\([\'"]?(.*?)[\'"]?\)', content)
    for u in urls:
        if u.startswith('data:') or u.startswith('http'):
            continue
            
        # Remove query params/hash from filename for saving
        clean_u = u.split('?')[0].split('#')[0]
        
        # Calculate absolute URL
        # CSS is usually at assets/css/style.css, and url is ../fonts/font.woff
        if u.startswith('../'):
            parts = relative_to_url.split('/')
            up_count = u.count('../')
            base = '/'.join(parts[:-up_count-1])
            asset_url = base + '/' + u.replace('../', '')
            
            local_rel = relative_to_url.replace(base_url, '')
            local_parts = local_rel.split('/')
            local_base = '/'.join(local_parts[:-up_count-1])
            local_path = os.path.join(local_base_dir, local_base, clean_u.replace('../', ''))
        else:
            asset_url = relative_to_url.rsplit('/', 1)[0] + '/' + u
            local_rel = relative_to_url.replace(base_url, '').rsplit('/', 1)[0]
            local_path = os.path.join(local_base_dir, local_rel, clean_u)
            
        download_file(asset_url, local_path)

def process_blade_file(file_path):
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()
        
    # Find all asset urls
    pattern = r'https://st\.ourhtmldemo\.com/new/PureHearts/assets/([^"\']+)'
    matches = set(re.findall(pattern, content))
    
    for match in matches:
        url = base_url + match
        local_path = os.path.join(local_base_dir, match.split('?')[0].split('#')[0])
        
        if download_file(url, local_path):
            if local_path.endswith('.css'):
                parse_and_download_css(local_path, url)
                
            # Replace in blade content
            original_string = f'https://st.ourhtmldemo.com/new/PureHearts/assets/{match}'
            replacement_string = f"{{{{ asset('assets/{match}') }}}}"
            content = content.replace(original_string, replacement_string)
            
    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(content)

for bf in blade_files:
    process_blade_file(bf)
    
print("Asset localization complete!")
