import re
import os

def update_file(path, fn):
    with open(path, 'r', encoding='utf-8') as f:
        content = f.read()
    new_content = fn(content)
    with open(path, 'w', encoding='utf-8') as f:
        f.write(new_content)
    print(f"Updated {path}")

# 2. events.blade.php
def transform_events(c):
    c = c.replace("<h1>Upcoming Events & Activities</h1>", "<h1>{{ __('Upcoming Activities & Events') }}</h1>")
    c = c.replace("<li><a href=\"{{ route('home') }}\">Home</a></li>", "<li><a href=\"{{ route('home') }}\">{{ __('Home') }}</a></li>")
    c = c.replace("<li>Events</li>", "<li>{{ __('Activities') }}</li>")
    c = c.replace("<li>Community Outreach & Relief Drives</li>", "<li>{{ __('Field Activities & Drives') }}</li>")
    c = c.replace("$typeName = $activity->projectType?->name;", "$typeName = $activity->projectType?->localized_name;")
    c = c.replace("alt=\"{{ $activity->name }}\"", "alt=\"{{ $activity->localized_name }}\"")
    c = c.replace("{{ Str::limit($activity->location, 16) }}", "{{ Str::limit($activity->localized_location ?: __('Dhaka, Bangladesh'), 16) }}")
    c = c.replace("{{ $activity->name }}", "{{ $activity->localized_name }}")
    c = c.replace("View Details</a>", "{{ __('View Details') }}</a>")
    c = c.replace("No active activities or events found at the moment.", "{{ __('No projects found in this category.') }}")
    return c

# 3. event-details.blade.php
def transform_event_details(c):
    c = c.replace("@section('title', $activity->name . ' — Rotary Club of Shantinagar Dhaka')", "@section('title', $activity->localized_name . ' — ' . site_setting('org_name', 'Rotary Club of Shantinagar Dhaka'))")
    c = c.replace("@section('meta_description', Str::limit($activity->short_description ?: $activity->description, 160))", "@section('meta_description', Str::limit($activity->localized_short_description ?: $activity->localized_description, 160))")
    c = c.replace("$typeName = $activity->projectType?->name;", "$typeName = $activity->projectType?->localized_name;")
    c = c.replace("<h1>{{ $activity->name }}</h1>", "<h1>{{ $activity->localized_name }}</h1>")
    c = c.replace("<h2>{{ $activity->name }}</h2>", "<h2>{{ $activity->localized_name }}</h2>")
    c = c.replace("<li><a href=\"{{ route('home') }}\">Home</a></li>", "<li><a href=\"{{ route('home') }}\">{{ __('Home') }}</a></li>")
    c = c.replace("<li><a href=\"{{ route('events') }}\">Activities & Events</a></li>", "<li><a href=\"{{ route('events') }}\">{{ __('Activities') }}</a></li>")
    c = c.replace("<li>{{ Str::limit($activity->name, 28) }}</li>", "<li>{{ Str::limit($activity->localized_name, 28) }}</li>")
    c = c.replace("<li><i class=\"far fa-map\"></i>{{ $activity->location }}</li>", "<li><i class=\"far fa-map\"></i>{{ $activity->localized_location ?: __('Dhaka, Bangladesh') }}</li>")
    c = c.replace("alt=\"{{ $activity->name }}\"", "alt=\"{{ $activity->localized_name }}\"")
    c = c.replace("<li class=\"tab-btn active-btn\" data-tab=\"#tab-1\"><i class=\"icon-right-arrow\"></i>Activity Overview</li>", "<li class=\"tab-btn active-btn\" data-tab=\"#tab-1\"><i class=\"icon-right-arrow\"></i>{{ __('Campaign Overview') }}</li>")
    c = c.replace("<li class=\"tab-btn\" data-tab=\"#tab-2\"><i class=\"icon-right-arrow\"></i>Field Coordination Team</li>", "<li class=\"tab-btn\" data-tab=\"#tab-2\"><i class=\"icon-right-arrow\"></i>{{ __('Leadership & Members') }}</li>")
    c = c.replace("<li class=\"tab-btn\" data-tab=\"#tab-3\"><i class=\"icon-right-arrow\"></i>Join as Volunteer</li>", "<li class=\"tab-btn\" data-tab=\"#tab-3\"><i class=\"icon-right-arrow\"></i>{{ __('Become a Volunteer') }}</li>")
    c = c.replace("<h3>Activity Description</h3>", "<h3>{{ __('Campaign Overview') }}</h3>")
    c = c.replace("{{ $activity->short_description }}", "{{ $activity->localized_short_description }}")
    c = c.replace("{!! nl2br(e($activity->description ?: 'Rotary Club of Shantinagar Dhaka conducts regular field visits, health camps, winter relief distributions, and community welfare initiatives across Bangladesh.')) !!}", "{!! nl2br(e($activity->localized_description ?: __('Rotary Club of Shantinagar Dhaka is dedicated to delivering transparent humanitarian relief, healthcare support, and social empowerment across Bangladesh. Every contribution directly funds verified on-the-ground initiatives without intermediaries.'))) !!}")
    c = c.replace("<h3>Event Documentation & Photos</h3>", "<h3>{{ __('Field Documentation') }}</h3>")
    c = c.replace("alt=\"{{ $img->caption ?: $activity->name }}\"", "alt=\"{{ $img->localized_caption ?: $activity->localized_name }}\"")
    c = c.replace("{{ $img->caption }}", "{{ $img->localized_caption }}")
    c = c.replace("<h3>Field Organizing Committee</h3>", "<h3>{{ __('Executive Leadership') }}</h3>")
    c = c.replace("{{ $teamLead->name }}", "{{ $teamLead->localized_name }}")
    c = c.replace("{{ $teamLead->designation?->name }}", "{{ $teamLead->designation?->localized_name }}")
    c = c.replace("<h3>Join This Relief Drive as a Volunteer</h3>", "<h3>{{ __('Join Us As A Volunteer') }}</h3>")
    c = c.replace("<label>Full Name <span>*</span></label>", "<label>{{ __('Full Name') }} <span>*</span></label>")
    c = c.replace("<label>Email Address <span>*</span></label>", "<label>{{ __('Email Address') }} <span>*</span></label>")
    c = c.replace("<label>Phone / WhatsApp <span>*</span></label>", "<label>{{ __('Phone Number') }} <span>*</span></label>")
    c = c.replace("<label>Your Availability / Skills / Notes</label>", "<label>{{ __('Your Message / Question') }}</label>")
    c = c.replace("Submit Volunteer Registration</button>", "{{ __('Join As Volunteer') }}</button>")
    return c

# 4. gallery.blade.php
def transform_gallery(c):
    c = c.replace("<h1>Photo & Field Documentation</h1>", "<h1>{{ __('Photo & Field Documentation') }}</h1>")
    c = c.replace("<li><a href=\"{{ route('home') }}\">Home</a></li>", "<li><a href=\"{{ route('home') }}\">{{ __('Home') }}</a></li>")
    c = c.replace("<li>Gallery</li>", "<li>{{ __('Gallery') }}</li>")
    c = c.replace("<li>Field Documentation</li>", "<li>{{ __('Field Documentation') }}</li>")
    c = c.replace("<li class=\"active filter\" data-role=\"button\" data-filter=\".all\">All</li>", "<li class=\"active filter\" data-role=\"button\" data-filter=\".all\">{{ __('All Categories') }}</li>")
    c = c.replace("alt=\"{{ $img->caption ?: $img->project?->name ?: 'Relief Field Gallery' }}\"", "alt=\"{{ $img->localized_caption ?: $img->project?->localized_name ?: __('Photo & Field Documentation') }}\"")
    c = c.replace("{{ $img->project?->name }}", "{{ $img->project?->localized_name }}")
    c = c.replace("{{ $img->caption }}", "{{ $img->localized_caption }}")
    return c

# 5. volunteer.blade.php
def transform_volunteer(c):
    c = c.replace("<h1>Volunteer Registration</h1>", "<h1>{{ __('Become a Volunteer') }}</h1>")
    c = c.replace("<li><a href=\"{{ route('home') }}\">Home</a></li>", "<li><a href=\"{{ route('home') }}\">{{ __('Home') }}</a></li>")
    c = c.replace("<li>Volunteer</li>", "<li>{{ __('Join As Volunteer') }}</li>")
    c = c.replace("<li>Join As A Volunteer</li>", "<li>{{ __('Join Us As A Volunteer') }}</li>")
    c = c.replace("<span class=\"top-text\">Join Our Mission</span>", "<span class=\"top-text\">{{ __('Service Above Self') }}</span>")
    c = c.replace("<h2>Become a Community Volunteer</h2>", "<h2>{{ __('Join Us As A Volunteer') }}</h2>")
    c = c.replace("<label>Full Name <span>*</span></label>", "<label>{{ __('Full Name') }} <span>*</span></label>")
    c = c.replace("<label>Email Address <span>*</span></label>", "<label>{{ __('Email Address') }} <span>*</span></label>")
    c = c.replace("<label>Phone / WhatsApp Number <span>*</span></label>", "<label>{{ __('Phone Number') }} <span>*</span></label>")
    c = c.replace("<label>Area of Interest / Skills</label>", "<label>{{ __('Subject') }}</label>")
    c = c.replace("<label>Availability & Motivation</label>", "<label>{{ __('Your Message / Question') }}</label>")
    c = c.replace("Submit Volunteer Application</button>", "{{ __('Join As Volunteer') }}</button>")
    return c

# 6. contact.blade.php
def transform_contact(c):
    c = c.replace("<h1>Get In Touch With Us</h1>", "<h1>{{ __('Contact Us') }}</h1>")
    c = c.replace("<li><a href=\"{{ route('home') }}\">Home</a></li>", "<li><a href=\"{{ route('home') }}\">{{ __('Home') }}</a></li>")
    c = c.replace("<li>Contact</li>", "<li>{{ __('Contact') }}</li>")
    c = c.replace("<li>Central Secretariat</li>", "<li>{{ __('Central Coordination') }}</li>")
    c = c.replace("<h3>Head Office</h3>", "<h3>{{ __('Head Office') }}</h3>")
    c = c.replace("<h3>Hotline / Phone</h3>", "<h3>{{ __('Call Hotline') }}</h3>")
    c = c.replace("<h3>Official Email</h3>", "<h3>{{ __('Email Us') }}</h3>")
    c = c.replace("<span class=\"top-text\">Send Us A Message</span>", "<span class=\"top-text\">{{ __('Contact Us') }}</span>")
    c = c.replace("<h2>How Can We Assist You?</h2>", "<h2>{{ __('Send Us A Message') }}</h2>")
    c = c.replace("<label>Your Name <span>*</span></label>", "<label>{{ __('Your Name') }} <span>*</span></label>")
    c = c.replace("<label>Your Email <span>*</span></label>", "<label>{{ __('Email Address') }} <span>*</span></label>")
    c = c.replace("<label>Phone Number <span>*</span></label>", "<label>{{ __('Phone Number') }} <span>*</span></label>")
    c = c.replace("<label>Subject</label>", "<label>{{ __('Subject') }}</label>")
    c = c.replace("<label>Your Message <span>*</span></label>", "<label>{{ __('Write Your Message') }} <span>*</span></label>")
    c = c.replace("Send Message</button>", "{{ __('Send Message') }}</button>")
    c = c.replace("{{ $siteSettings['address'] ?? 'House 12, Road 5, Shanti Nagar, Dhaka-1217, Bangladesh.' }}", "{{ site_setting('address', 'House 12, Road 5, Shanti Nagar, Dhaka-1217, Bangladesh.') }}")
    c = c.replace("{{ $siteSettings['hotline'] ?? '+880 1711-000000' }}", "{{ site_setting('hotline', '+880 1711-000000') }}")
    c = c.replace("{{ $siteSettings['email'] ?? 'contact@rotaryshantinagardhaka.org' }}", "{{ site_setting('email', 'contact@rotaryshantinagardhaka.org') }}")
    return c

# 7. faq.blade.php
def transform_faq(c):
    c = c.replace("<h1>Frequently Asked Questions</h1>", "<h1>{{ __('Frequently Asked Questions') }}</h1>")
    c = c.replace("<li><a href=\"{{ route('home') }}\">Home</a></li>", "<li><a href=\"{{ route('home') }}\">{{ __('Home') }}</a></li>")
    c = c.replace("<li>FAQ</li>", "<li>{{ __('Frequently Asked Questions') }}</li>")
    c = c.replace("<li>Transparency & Operations</li>", "<li>{{ __('Transparency & Governance') }}</li>")
    return c

update_file('/Users/zesan/Desktop/My-Work/shanti-nagar-foundation/resources/views/frontend/events.blade.php', transform_events)
update_file('/Users/zesan/Desktop/My-Work/shanti-nagar-foundation/resources/views/frontend/event-details.blade.php', transform_event_details)
update_file('/Users/zesan/Desktop/My-Work/shanti-nagar-foundation/resources/views/frontend/gallery.blade.php', transform_gallery)
update_file('/Users/zesan/Desktop/My-Work/shanti-nagar-foundation/resources/views/frontend/volunteer.blade.php', transform_volunteer)
update_file('/Users/zesan/Desktop/My-Work/shanti-nagar-foundation/resources/views/frontend/contact.blade.php', transform_contact)
update_file('/Users/zesan/Desktop/My-Work/shanti-nagar-foundation/resources/views/frontend/faq.blade.php', transform_faq)
