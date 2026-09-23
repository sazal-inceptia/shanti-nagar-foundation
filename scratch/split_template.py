import os

with open("public/purehearts.html", "r") as f:
    html = f.read()

# Make links absolute
html = html.replace('href="assets/', 'href="https://st.ourhtmldemo.com/new/PureHearts/assets/')
html = html.replace('src="assets/', 'src="https://st.ourhtmldemo.com/new/PureHearts/assets/')
html = html.replace('url(assets/', 'url(https://st.ourhtmldemo.com/new/PureHearts/assets/')
html = html.replace('url(\'assets/', 'url(\'https://st.ourhtmldemo.com/new/PureHearts/assets/')

header_start_idx = html.find('<header class="main-header')
header_end_idx = html.find('</header>', header_start_idx) + 9

if header_start_idx != -1 and header_end_idx != -1:
    header_html = html[header_start_idx:header_end_idx]
else:
    header_html = "<!-- Header not found -->"

footer_start_idx = html.find('<section class="main-footer"')
footer_end_idx = html.find('</section>', footer_start_idx) + 10

if footer_start_idx != -1 and footer_end_idx != -1:
    footer_html = html[footer_start_idx:footer_end_idx]
else:
    footer_html = "<!-- Footer not found -->"

# Main content
# Usually after </header> and before <section class="main-footer"
if header_end_idx != -1 and footer_start_idx != -1:
    content_html = html[header_end_idx:footer_start_idx]
else:
    content_html = "<!-- Content bounds not found -->"

# For app.blade.php, we take the HTML skeleton and replace the body with yields
app_html_top = html[:header_start_idx]
app_html_bottom = html[footer_end_idx:]

app_html = app_html_top + "\n@include('frontend.partials.header')\n@yield('content')\n@include('frontend.partials.footer')\n" + app_html_bottom

# Save to blade files
with open('resources/views/frontend/layouts/app.blade.php', 'w') as f:
    f.write(app_html)

with open('resources/views/frontend/partials/header.blade.php', 'w') as f:
    f.write(header_html)

with open('resources/views/frontend/partials/footer.blade.php', 'w') as f:
    f.write(footer_html)

index_blade = f"@extends('frontend.layouts.app')\n\n@section('content')\n{content_html}\n@endsection"
with open('resources/views/frontend/home/index.blade.php', 'w') as f:
    f.write(index_blade)

print("Successfully split the template!")
