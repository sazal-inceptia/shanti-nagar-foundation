import re

def update_file(path, fn):
    with open(path, 'r', encoding='utf-8') as f:
        content = f.read()
    new_content = fn(content)
    with open(path, 'w', encoding='utf-8') as f:
        f.write(new_content)
    print(f"Updated {path}")

# 1. index.blade.php
def transform_index(c):
    c = c.replace("@section('title', 'Rotary Club of Shantinagar Dhaka — Grassroots Humanitarian Aid & Relief in Bangladesh')", "@section('title', site_setting('org_name', 'Rotary Club of Shantinagar Dhaka') . ' — ' . __('Building Hope, Saving Lives'))")
    c = c.replace("<h2>Direct Relief</h2>", "<h2>{{ __('Direct Relief') }}</h2>")
    c = c.replace("<span>For Deserving Families</span>", "<span>{{ __('For Deserving Families') }}</span>")
    c = c.replace("<h2>Across Bangladesh</h2>", "<h2>{{ __('Across Bangladesh') }}</h2>")
    c = c.replace("<p>Delivering medical equipment, orphan kits, safe water & emergency food relief<br />with 100% transparency and zero intermediaries.</p>", "<p>{{ __('Delivering medical equipment, orphan kits, safe water & emergency food relief with 100% transparency and zero intermediaries.') }}</p>")
    c = c.replace("<a href=\"{{ route('donations') }}\" class=\"banner-btn\">Explore Causes</a>", "<a href=\"{{ route('donations') }}\" class=\"banner-btn\">{{ __('Explore Causes') }}</a>")

    c = c.replace("<h2>Healthcare Aid</h2>", "<h2>{{ __('Healthcare Aid') }}</h2>")
    c = c.replace("<span>Supporting Public Wards</span>", "<span>{{ __('Supporting Public Wards') }}</span>")
    c = c.replace("<h2>Hospital Equipment</h2>", "<h2>{{ __('Hospital Equipment') }}</h2>")
    c = c.replace("<p>Providing hospital fans, wheelchairs, emergency oxygen & medical aid<br />for underprivileged patients at government and community clinics.</p>", "<p>{{ __('Providing hospital fans, wheelchairs, emergency oxygen & medical aid for underprivileged patients at government and community clinics.') }}</p>")
    c = c.replace("<a href=\"{{ route('donations') }}\" class=\"banner-btn\">Support Healthcare</a>", "<a href=\"{{ route('donations') }}\" class=\"banner-btn\">{{ __('Support Healthcare') }}</a>")

    c = c.replace("<h2>Safe Water</h2>", "<h2>{{ __('Safe Water') }}</h2>")
    c = c.replace("<span>Deep Tube-Wells in Rural Areas</span>", "<span>{{ __('Deep Tube-Wells in Rural Areas') }}</span>")
    c = c.replace("<h2>Pure Water for All</h2>", "<h2>{{ __('Pure Water for All') }}</h2>")
    c = c.replace("<p>Installing arsenic-free deep tube-wells and water filtration plants<br />for coastal and remote rural communities in Bangladesh.</p>", "<p>{{ __('Installing arsenic-free deep tube-wells and water filtration plants for coastal and remote rural communities in Bangladesh.') }}</p>")
    c = c.replace("<a href=\"{{ route('donations') }}\" class=\"banner-btn\">View Projects</a>", "<a href=\"{{ route('donations') }}\" class=\"banner-btn\">{{ __('View Projects') }}</a>")

    c = c.replace("<span class=\"top-text\">About Rotary Club of Shantinagar Dhaka</span>", "<span class=\"top-text\">{{ __('About Rotary Club of Shantinagar Dhaka') }}</span>")
    c = c.replace("<h2>Dedicated to Social Welfare & Humanitarian Support</h2>", "<h2>{{ __('Dedicated to Social Welfare & Humanitarian Support') }}</h2>")
    c = c.replace("<span>Governing Secretariat</span>", "<span>{{ __('Governing Secretariat') }}</span>")
    c = c.replace("<h3>Shantinagar Association</h3>", "<h3>{{ __('Shanti Nagar Association') }}</h3>")

    # Urgent project section
    c = c.replace("<span class=\"top-text\">Priority Relief Mission</span>", "<span class=\"top-text\">{{ __('Active Relief Causes') }}</span>")
    c = c.replace("<h2>{{ $urgentProject->name }}</h2>", "<h2>{{ $urgentProject->localized_name }}</h2>")
    c = c.replace("{{ Str::limit($urgentProject->short_description ?: $urgentProject->description, 130) }}", "{{ Str::limit($urgentProject->localized_short_description ?: $urgentProject->localized_description, 130) }}")
    c = c.replace("<h5>Charity Raised</h5>", "<h5>{{ __('Fund Raised') }}</h5>")
    c = c.replace("৳{{ number_format($uRaised) }} <span>/ ৳{{ number_format($uTarget) }}</span>", "৳{{ localized_number($uRaised) }} <span>/ ৳{{ localized_number($uTarget) }}</span>")
    c = c.replace("<h5>{{ $uPercent }}%</h5>", "<h5>{{ localized_number($uPercent) }}%</h5>")
    c = c.replace("<a href=\"{{ route('donation.details', $urgentProject->slug) }}\" class=\"donate-box-btn\">Donate Now</a>", "<a href=\"{{ route('donation.details', $urgentProject->slug) }}\" class=\"donate-box-btn\">{{ __('Donate Now') }}</a>")
    c = c.replace("<p>{{ Str::limit($urgentProject->location, 40) }}</p>", "<p>{{ Str::limit($urgentProject->localized_location ?: __('Dhaka, Bangladesh'), 40) }}</p>")
    c = c.replace("<h5>{{ $uSupporters }}+</h5>", "<h5>{{ localized_number($uSupporters) }}+</h5>")
    c = c.replace("<p>Supporters</p>", "<p>{{ __('Supporters') }}</p>")

    # Project loops in index
    c = c.replace("{{ $project->name }}", "{{ $project->localized_name }}")
    c = c.replace("{{ $project->projectType?->name", "{{ $project->projectType?->localized_name")
    c = c.replace("{{ Str::limit($project->short_description ?: $project->description, 120) }}", "{{ Str::limit($project->localized_short_description ?: $project->localized_description, 120) }}")
    c = c.replace("{{ Str::limit($project->location", "{{ Str::limit($project->localized_location")
    c = c.replace("alt=\"{{ $project->name }}\"", "alt=\"{{ $project->localized_name }}\"")
    c = c.replace("alt=\"{{ $item->name }}\"", "alt=\"{{ $item->localized_name }}\"")
    c = c.replace("{{ $item->name }}", "{{ $item->localized_name }}")
    c = c.replace("{{ $item->projectType?->name", "{{ $item->projectType?->localized_name")
    c = c.replace("{{ $item->location }}", "{{ $item->localized_location }}")
    c = c.replace("{{ $type->name }}", "{{ $type->localized_name }}")
    c = c.replace("{{ $leader->name }}", "{{ $leader->localized_name }}")
    c = c.replace("{{ $leader->designation?->name }}", "{{ $leader->designation?->localized_name }}")
    c = c.replace("{{ $leader->bio }}", "{{ $leader->localized_bio }}")

    return c

# 2. about.blade.php
def transform_about(c):
    c = c.replace("<h1>About Us</h1>", "<h1>{{ __('About Us') }}</h1>")
    c = c.replace("<li><a href=\"{{ route('home') }}\">Home</a></li>", "<li><a href=\"{{ route('home') }}\">{{ __('Home') }}</a></li>")
    c = c.replace("<li>About Us</li>", "<li>{{ __('About Us') }}</li>")
    
    # Best president
    c = c.replace("<h2>{{ $bestPresident?->name ?? 'Alhaj Mohammad Nurul Islam' }}</h2>", "<h2>{{ $bestPresident?->localized_name ?? 'Alhaj Mohammad Nurul Islam' }}</h2>")
    c = c.replace("{{ $bestPresident?->designation?->name ?? (is_string($bestPresident?->designation) ? $bestPresident->designation : 'Best President Ever & Lifetime Patron') }}", "{{ $bestPresident?->designation?->localized_name ?? 'Best President Ever & Lifetime Patron' }}")
    c = c.replace("{{ $bestPresident?->bio ?: 'Recognized as the foundational cornerstone and most beloved leader of Rotary Club of Shantinagar Dhaka. Under his visionary stewardship, our grassroots relief initiatives reached over 50,000 underprivileged families with 100% itemized audit transparency and direct field procurement.' }}", "{{ $bestPresident?->localized_bio ?: 'Recognized as the foundational cornerstone and most beloved leader of Rotary Club of Shantinagar Dhaka. Under his visionary stewardship, our grassroots relief initiatives reached over 50,000 underprivileged families with 100% itemized audit transparency and direct field procurement.' }}")
    c = c.replace("{{ $bestPresident?->signature_text ?: ($bestPresident?->name ?? 'Alhaj Mohammad Nurul Islam') }}", "{{ $bestPresident?->localized_name ?? 'Alhaj Mohammad Nurul Islam' }}")
    
    # Executive leadership
    c = c.replace("<h3>{{ $president?->name ?? 'Advocate Mahfuzur Rahman' }}</h3>", "<h3>{{ $president?->localized_name ?? 'Advocate Mahfuzur Rahman' }}</h3>")
    c = c.replace("{{ $president?->designation?->name ?? (is_string($president?->designation) ? $president->designation : 'President, Governing Body') }}", "{{ $president?->designation?->localized_name ?? 'President' }}")
    
    c = c.replace("<h3>{{ $secretary?->name ?? 'Dr. Tariqul Islam' }}</h3>", "<h3>{{ $secretary?->localized_name ?? 'Dr. Tariqul Islam' }}</h3>")
    c = c.replace("{{ $secretary?->designation?->name ?? (is_string($secretary?->designation) ? $secretary->designation : 'General Secretary') }}", "{{ $secretary?->designation?->localized_name ?? 'General Secretary' }}")

    c = c.replace("<h3>{{ $treasurer?->name ?? 'Engr. Shahabuddin Ahmed' }}</h3>", "<h3>{{ $treasurer?->localized_name ?? 'Engr. Shahabuddin Ahmed' }}</h3>")
    c = c.replace("{{ $treasurer?->designation?->name ?? (is_string($treasurer?->designation) ? $treasurer->designation : 'Treasurer & Finance Secretary') }}", "{{ $treasurer?->designation?->localized_name ?? 'Treasurer' }}")

    # Directors, members, past presidents
    c = c.replace("{{ $director->name }}", "{{ $director->localized_name }}")
    c = c.replace("{{ $director->designation?->name ?? 'Director' }}", "{{ $director->designation?->localized_name ?? 'Director' }}")
    
    c = c.replace("{{ $member->name }}", "{{ $member->localized_name }}")
    c = c.replace("{{ $member->designation?->name ?? 'General Member' }}", "{{ $member->designation?->localized_name ?? 'Member' }}")

    c = c.replace("{{ $pp->name }}", "{{ $pp->localized_name }}")
    c = c.replace("{{ $pp->designation?->name ?? 'Past President' }}", "{{ $pp->designation?->localized_name ?? 'Past President' }}")

    # Titles
    c = c.replace("<span class=\"top-text\">Executive Leadership</span>", "<span class=\"top-text\">{{ __('Executive Leadership') }}</span>")
    c = c.replace("<h2>Governing Secretariat & Leadership Messages</h2>", "<h2>{{ __('Club Leadership') }}</h2>")
    c = c.replace("<h2>Board of Directors</h2>", "<h2>{{ __('Board of Directors') }}</h2>")
    c = c.replace("<h2>General Members & Volunteers</h2>", "<h2>{{ __('General Members') }}</h2>")
    c = c.replace("<h2>Past Presidents & Honored Pillars</h2>", "<h2>{{ __('Past Presidents') }}</h2>")
    
    return c

update_file('/Users/zesan/Desktop/My-Work/shanti-nagar-foundation/resources/views/frontend/index.blade.php', transform_index)
update_file('/Users/zesan/Desktop/My-Work/shanti-nagar-foundation/resources/views/frontend/about.blade.php', transform_about)
