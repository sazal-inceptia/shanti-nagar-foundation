import urllib.request

url = "https://st.ourhtmldemo.com/new/PureHearts/about.html"
headers = {
    "User-Agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/119.0.0.0 Safari/537.36",
    "Accept": "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8",
    "Accept-Language": "en-US,en;q=0.9",
    "Referer": "https://st.ourhtmldemo.com/",
}
req = urllib.request.Request(url, headers=headers)
try:
    with urllib.request.urlopen(req) as response:
        html = response.read().decode('utf-8')
        with open('scratch/about.html', 'w', encoding='utf-8') as f:
            f.write(html)
        print("Fetched successfully.")
except Exception as e:
    print(f"Failed: {e}")
