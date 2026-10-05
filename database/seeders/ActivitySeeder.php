<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $activities = [
            [
                'title' => 'Winter Warmth & Blanket Distribution Campaign',
                'title_bn' => 'শীতবস্ত্র ও কম্বল বিতরণ মানবিক কর্মসূচি',
                'slug' => 'winter-warmth-blanket-distribution-campaign',
                'event_date' => now()->addDays(12)->toDateString(),
                'event_time' => '09:00 AM - 03:00 PM',
                'location' => 'Kurigram & Sirajganj Flood-Affected Char Areas',
                'location_bn' => 'কুড়িগ্রাম ও সিরাজগঞ্জের বন্যা দুর্গত চরাঞ্চল',
                'short_description' => 'Direct field distribution of heavy winter blankets and thermal jackets to vulnerable elderly and children.',
                'short_description_bn' => 'শীতকবলিত অসহায় শিশু ও বয়োবৃদ্ধদের মাঝে সরাসরি কম্বল ও শীতবস্ত্র বিতরণ কর্মসূচি।',
                'description' => '<p class="lead">Every winter, severe cold waves severely impact marginalized char communities in northern Bangladesh. Rotary Club of Shantinagar Dhaka is organizing a direct field drive providing <strong>1,500 heavy-duty thermal blankets</strong>, baby sweaters, and warm shawls to destitute families.</p>
<h3>Campaign Core Objectives</h3>
<p>Our dedicated volunteer wing will deliver relief packages door-to-door to ensure authentic beneficiary reach:</p>
<ul>
    <li>Procurement of high-density warm thermal blankets with certified fabric quality.</li>
    <li>Direct door-to-door distribution in remote, unbanked river islands (chars).</li>
    <li>Special nutritional packages and thermal innerwear for infants and nursing mothers.</li>
    <li>Coordination with local union parishads and community elders to prevent duplicate claims.</li>
</ul>
<blockquote>
    <p>"Service Above Self is our guiding motto. Bringing warmth to an underprivileged family during biting cold is one of our greatest privileges as Rotarians."</p>
</blockquote>
<h3>Relief Distribution Matrix</h3>
<figure class="table">
    <table>
        <thead>
            <tr>
                <th>Target District</th>
                <th>Target Families</th>
                <th>Package Items</th>
                <th>Coordination Team</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Kurigram (Chilmari Char)</strong></td>
                <td>800 Families</td>
                <td>Blanket + Child Sweater + Vaseline</td>
                <td>Rotary Youth Volunteer Unit</td>
            </tr>
            <tr>
                <td><strong>Sirajganj (Kazipur Char)</strong></td>
                <td>700 Families</td>
                <td>Thermal Blanket + Woolen Shawl</td>
                <td>Shantinagar Field Wing</td>
            </tr>
        </tbody>
    </table>
</figure>
<figure class="image image-style-side">
    <img src="/assets/images/gallery/portfolio-9.jpg" alt="Winter Relief Distribution">
    <figcaption>Rotary Club volunteers packaging warm winter relief supplies at central hub.</figcaption>
</figure>
<p>All logistical and transportation expenses are borne by the Club. Every single contribution from our donors directly purchases verified relief materials without administrative deductions.</p>',
                'description_bn' => '<p class="lead">প্রতি বছর শীত মৌসুমে উত্তরবঙ্গের প্রত্যন্ত চরাঞ্চলের দরিদ্র ও ছিন্নমূল পরিবারগুলো চরম দুর্ভোগের মুখে পড়ে। রোটারি ক্লাব অব শান্তিনগর ঢাকার উদ্যোগে <strong>১৫০০টি ভারী ও টেকসই উষ্ণ কম্বল</strong>, শিশুতোষ সোয়েটার এবং শীতের চাদর সরাসরি বিতরণ করা হচ্ছে।</p>
<h3>কর্মসূচির মূল লক্ষ্য ও কর্মপরিকল্পনা</h3>
<p>আমাদের মাঠপর্যায়ের ভলান্টিয়ার টিম বাড়ি বাড়ি গিয়ে প্রকৃত সুবিধাবঞ্চিতদের হাতে শীতবস্ত্র পৌঁছে দিচ্ছে:</p>
<ul>
    <li>উচ্চমানের ও টেকসই ভারী কম্বল সরাসরি পাইকারি উৎস থেকে সাশ্রয়ী মূল্যে সংগ্রহ।</li>
    <li>নদীমাতৃক প্রত্যন্ত চরাঞ্চলে নৌকায় করে সরাসরি ঘরে ঘরে গিয়ে কম্বল উপহার।</li>
    <li>নবজাতক ও শিশুদের সুরক্ষায় বিশেষ শীতের পোশাক ও শিশু খাদ্য কিট প্রদান।</li>
    <li>স্থানীয় জনপ্রতিনিধি ও শিক্ষকদের সহায়তায় স্বচ্ছতার সাথে তালিকা যাচাই।</li>
</ul>
<blockquote>
    <p>"মানুষের সেবায় নিবেদিত থাকাই রোটারির মূল আদর্শ। কনকনে শীতে অসহায় মানুষের পাশে এক টুকরো উষ্ণতা নিয়ে দাঁড়ানোই আমাদের লক্ষ্য।"</p>
</blockquote>
<h3>ত্রাণ বণ্টন ও লক্ষ্যমাত্রা</h3>
<figure class="table">
    <table>
        <thead>
            <tr>
                <th>নির্দিষ্ট এলাকা</th>
                <th>উপকারভোগী পরিবার</th>
                <th>বিতরণকৃত সামগ্রী</th>
                <th>মাঠপর্যায়ের দায়িত্ব</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>কুড়িগ্রাম (চিলমারী চর)</strong></td>
                <td>৮০০ পরিবার</td>
                <td>উষ্ণ কম্বল + শিশু সোয়েটার + ভেসলিন</td>
                <td>রোটারি যুব ভলান্টিয়ার উইং</td>
            </tr>
            <tr>
                <td><strong>সিরাজগঞ্জ (কাজীপুর চর)</strong></td>
                <td>৭০০ পরিবার</td>
                <td>ভারী কম্বল + শীতের চাদর</td>
                <td>শান্তিনগর ফিল্ড কো-অর্ডিনেশন</td>
            </tr>
        </tbody>
    </table>
</figure>
<figure class="image image-style-side">
    <img src="/assets/images/gallery/portfolio-9.jpg" alt="শীতবস্ত্র বিতরণ প্রস্তুতি">
    <figcaption>রোটারি ক্লাব সেন্টারে শীতবস্ত্র প্যাকেজিং ও তালিকা চূড়ান্তকরণ মুহূর্ত।</figcaption>
</figure>
<p>এই কর্মসূচির শতভাগ অনুদান সরাসরি শীতবস্ত্র ক্রয়ে ব্যয় করা হয়। কোনো প্রকার মধ্যস্বত্বভোগী ছাড়াই স্বচ্ছতার সাথে এই মানবিক সহায়তা নিশ্চিত করা হচ্ছে।</p>',
                'featured_image' => 'assets/images/events/events-5.jpg',
                'status' => 'upcoming',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Free Eye Screening & Cataract Surgery Camp',
                'title_bn' => 'বিনামূল্যে চক্ষু পরীক্ষা ও ছানি অপারেশন ক্যাম্প',
                'slug' => 'free-eye-screening-cataract-surgery-camp',
                'event_date' => now()->addDays(24)->toDateString(),
                'event_time' => '08:30 AM - 04:30 PM',
                'location' => 'Rotary Community Clinic, Shantinagar, Dhaka',
                'location_bn' => 'রোটারি কমিউনিটি ক্লিনিক, শান্তিনগর, ঢাকা',
                'short_description' => 'Comprehensive eye checkup, free prescription glasses, and fully sponsored IOL cataract surgeries for underprivileged patients.',
                'short_description_bn' => 'বিনামূল্যে চক্ষু পরীক্ষা, চশমা বিতরণ এবং দরিদ্র রোগীদের সম্পূর্ণ বিনামূল্যে লেন্স প্রতিস্থাপন সার্জারি।',
                'description' => '<p class="lead">Preventable blindness remains a critical barrier to livelihoods among low-income community members. Experienced ophthalmologists and optometrists will provide free consultations, distribute vision glasses, and shortlist <strong>60 patients for sponsored cataract surgery</strong>.</p>
<h3>Medical Services Provided</h3>
<ul>
    <li>Comprehensive visual acuity testing and auto-refraction by certified doctors.</li>
    <li>Distribution of 350+ free custom prescription reading and distance spectacles.</li>
    <li>Glaucoma screening, diabetic retinopathy detection, and specialized eye drops.</li>
    <li>Fully sponsored Intraocular Lens (IOL) micro-surgery with hospital accommodation.</li>
</ul>
<blockquote>
    <p>"Restoring a person’s vision restores their dignity, livelihood, and independence. Our eye camps have transformed hundreds of lives across Dhaka."</p>
</blockquote>
<h3>Camp Schedule & Diagnostics</h3>
<figure class="table">
    <table>
        <thead>
            <tr>
                <th>Time Slot</th>
                <th>Clinical Activity</th>
                <th>Capacity</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>08:30 AM - 12:30 PM</td>
                <td>Registration, Vision Testing & Prescription Glasses</td>
                <td>300 Patients</td>
            </tr>
            <tr>
                <td>01:30 PM - 04:30 PM</td>
                <td>Specialist Eye Surgery Shortlisting & Pre-Op Counseling</td>
                <td>60 Surgeries</td>
            </tr>
        </tbody>
    </table>
</figure>
<figure class="image image-style-side">
    <img src="/assets/images/gallery/portfolio-10.jpg" alt="Eye Examination Camp">
    <figcaption>Specialist ophthalmologist examining low-income elderly patients at Shantinagar clinic.</figcaption>
</figure>
<p>Post-surgery medications, transportation, and follow-up reviews are 100% sponsored by Rotary Club of Shantinagar Dhaka.</p>',
                'description_bn' => '<p class="lead">দৃষ্টিহীনতা দূর করে অসচ্ছল মানুষের কর্মক্ষমতা ফিরিয়ে আনতে রোটারি ক্লাব অব শান্তিনগর ঢাকা দিনব্যাপী ফ্রি চক্ষু চিকিৎসা ক্যাম্প আয়োজন করেছে। অভিজ্ঞ চক্ষু বিশেষজ্ঞদের দ্বারা <strong>বিনামূল্যে চক্ষু পরীক্ষা, পাওয়ার চশমা বিতরণ এবং ৬০ জন রোগীর ছানি অপারেশন</strong> নিশ্চিত করা হবে।</p>
<h3>ক্যাম্পে প্রদত্ত স্বাস্থ্যসেবাসমূহ</h3>
<ul>
    <li>কম্পিউটারাইজড পদ্ধতিতে নিখুঁত দৃষ্টিশক্তি পরীক্ষা ও বিশেষজ্ঞ ডাক্তারদের পরামর্শ।</li>
    <li>৩৫০+ রোগীকে তাৎক্ষণিকভাবে বিনামূল্যে প্রেসক্রিপশন চশমা ও আইড্রপ প্রদান।</li>
    <li>গ্লুকোমা ও ডায়াবেটিক রেটিনোপ্যাথি রোগীদের বিশেষ স্ক্রিনিং ও পথ্য নির্দেশনা।</li>
    <li>ছানি রোগীদের সম্পূর্ণ বিনামূল্যে বিশ্বমানের মাইক্রোসার্জারি ও লেন্স সংযোজন।</li>
</ul>
<blockquote>
    <p>"একজন মানুষের চোখের দৃষ্টি ফিরিয়ে দেওয়া মানে তাকে স্বাবলম্বী করে তোলা। আমাদের এই সেবামূলক কার্যক্রম প্রতি বছর শত শত মানুষকে নতুন জীবন উপহার দিচ্ছে।"</p>
</blockquote>
<h3>ক্যাম্প সময়সূচি ও সেবা</h3>
<figure class="table">
    <table>
        <thead>
            <tr>
                <th>সময়</th>
                <th>কার্যক্রম</th>
                <th>লক্ষ্যমাত্রা</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>সকাল ০৮:৩০ - দুপুর ১২:৩০</td>
                <td>রেজিস্ট্রেশন, প্রাথমিক চক্ষু পরীক্ষা ও চশমা বিতরণ</td>
                <td>৩০০ জন রোগী</td>
            </tr>
            <tr>
                <td>দুপুর ০১:৩০ - বিকাল ০৪:৩০</td>
                <td>ছানি রোগী বাছাই ও অপারেশনের চূড়ান্ত প্রস্তুতি</td>
                <td>৬০ জন সার্জারি</td>
            </tr>
        </tbody>
    </table>
</figure>
<figure class="image image-style-side">
    <img src="/assets/images/gallery/portfolio-10.jpg" alt="চক্ষু পরীক্ষা ক্যাম্প">
    <figcaption>শান্তিনগর ক্লিনিকে বিশেষজ্ঞ ডাক্তার দ্বারা সুবিধাবঞ্চিত রোগীর দৃষ্টি পরীক্ষা।</figcaption>
</figure>
<p>অপারেশন পরবর্তী ওষুধ, ফলোআপ চেকআপ এবং রোগীবান্ধব সার্বিক পরিচর্যা সম্পূর্ণ বিনামূল্যে ক্লাবের অর্থায়নে পরিচালিত হবে।</p>',
                'featured_image' => 'assets/images/events/events-2.jpg',
                'status' => 'upcoming',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Tree Plantation & Environmental Green Drive',
                'title_bn' => 'বৃক্ষরোপণ ও সবুজ পরিবেশ সচেতনতা অভিযান',
                'slug' => 'tree-plantation-environmental-awareness-drive',
                'event_date' => now()->addDays(40)->toDateString(),
                'event_time' => '07:00 AM - 11:30 AM',
                'location' => 'Ramna, Segunbagicha & Public School Grounds, Dhaka',
                'location_bn' => 'রমনা, সেগুনবাগিচা ও বিভিন্ন সরকারি বিদ্যালয় প্রাঙ্গণ, ঢাকা',
                'short_description' => 'Planting 2,000 indigenous fruit, timber, and medicinal saplings to combat urban heat islands in Dhaka.',
                'short_description_bn' => 'ঢাকার নগর পরিবেশের ভারসাম্য রক্ষায় ২০০০ ফলজ, বনজ ও ওষধি গাছের চারা রোপণ ও বিতরণ।',
                'description' => '<p class="lead">To mitigate rising urban heat and cultivate environmental awareness among youth, Rotary Club of Shantinagar Dhaka is launching a city-wide green campaign planting <strong>2,000 indigenous saplings</strong> across educational institutions and public parks.</p>
<h3>Drive Highlights & Sustainability</h3>
<ul>
    <li>Planting native fruit-bearing (Mango, Guava, Jackfruit) and herbal saplings (Neem, Amla).</li>
    <li>Appointing student "Green Ambassadors" in each partner school for year-long plant care.</li>
    <li>Distributing eco-friendly gardening toolkits and awareness booklets to local youth.</li>
    <li>Creating micro green-zones in concrete urban spaces to support biodiversity.</li>
</ul>
<blockquote>
    <p>"Protecting our environment is an investment for generations to come. Every sapling planted today is oxygen and shelter for tomorrow."</p>
</blockquote>
<figure class="image image-style-side">
    <img src="/assets/images/gallery/portfolio-8.jpg" alt="Tree Plantation Drive">
    <figcaption>Rotaract youth volunteers actively planting saplings at local school boundary.</figcaption>
</figure>
<p>Join hands with our youth volunteers to build a greener, cleaner, and healthier Dhaka city.</p>',
                'description_bn' => '<p class="lead">তীব্র দাবদাহ প্রতিরোধ এবং ভবিষ্যৎ প্রজন্মের জন্য একটি বাসযোগ্য সবুজ নগরী গড়ে তোলার প্রত্যয়ে রোটারি ক্লাব অব শান্তিনগর ঢাকা <strong>২,০০০ ফলজ, বনজ ও ওষধি গাছের চারা রোপণ</strong> অভিযান শুরু করেছে।</p>
<h3>কর্মসূচির বিশেষত্ব ও রক্ষণাবেক্ষণ</h3>
<ul>
    <li>দেশীয় ফলজ (আম, পেয়ারা, আমলকী) এবং পরিবেশবান্ধব ওষধি (নিম, বকুল, কদম) চারা রোপণ।</li>
    <li>প্রতিটি বিদ্যালয়ে শিক্ষার্থীদের মাঝে পরিবেশবান্ধব "গ্রিন অ্যাম্বাসেডর" দল গঠন।</li>
    <li>গাছের নিয়মিত পরিচর্যার জন্য শিক্ষাপ্রতিষ্ঠানে গার্ডেনিং টুলকিট ও নির্দেশিকা প্রদান।</li>
    <li>নাগরিকদের মাঝে ব্যালকনি ও ছাদকৃষির প্রয়োজনীয় সচেতনতা বৃদ্ধি।</li>
</ul>
<blockquote>
    <p>"পরিবেশের ভারসাম্য রক্ষায় একটি গাছ রোপণ করা মানে পৃথিবীর ভবিষ্যৎকে এক ধাপ এগিয়ে দেওয়া। আসুন আমরা সবাই অন্তত একটি করে গাছ লাগাই।"</p>
</blockquote>
<figure class="image image-style-side">
    <img src="/assets/images/gallery/portfolio-8.jpg" alt="বৃক্ষরোপণ কার্যক্রম">
    <figcaption>স্থানীয় শিক্ষা প্রাঙ্গণে রোটার‌্যাক্ট তরুণদের অংশগ্রহণে বৃক্ষরোপণ উৎসব।</figcaption>
</figure>
<p>সবুজ ঢাকা গড়ার এই মহৎ উদ্যোগে যেকোনো নাগরিক ও শিক্ষার্থী স্বেচ্ছাসেবক হিসেবে সরাসরি যুক্ত হতে পারেন।</p>',
                'featured_image' => 'assets/images/events/events-3.jpg',
                'status' => 'upcoming',
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Voluntary Blood Donation & Thalassemia Screening Drive',
                'title_bn' => 'স্বেচ্ছায় রক্তদান ও থ্যালাসেমিয়া স্ক্রিনিং কর্মসূচি',
                'slug' => 'voluntary-blood-donation-thalassemia-screening-drive',
                'event_date' => now()->subDays(15)->toDateString(),
                'event_time' => '10:00 AM - 05:00 PM',
                'location' => 'Central Blood Bank & Rotary Center, Dhaka',
                'location_bn' => 'সেন্ট্রাল ব্লাড ব্যাংক ও রোটারি সেন্টার, ঢাকা',
                'short_description' => 'Collected 120+ safe blood units for child thalassemia patients and registered 200 regular emergency donors.',
                'short_description_bn' => 'থ্যালাসেমিয়া আক্রান্ত শিশুদের জরুরি চিকিৎসায় ১২০ ব্যাগ নিরাপদ রক্ত সংগ্রহ এবং ২০০ জন ডোনারের ডাটাবেজ তৈরি।',
                'description' => '<p class="lead">In partnership with specialized transfusion centers, our club successfully hosted a voluntary blood donation camp collecting <strong>124 bags of screened safe blood</strong> dedicated specifically for underprivileged thalassemia patients.</p>
<h3>Key Accomplishments</h3>
<ul>
    <li>124 healthy volunteer donors successfully donated blood after rigorous health checks.</li>
    <li>Conducted free hemoglobin and blood grouping tests for over 300 walk-in visitors.</li>
    <li>Created a dedicated Emergency Donors Registry for urgent platelet and rare group requests.</li>
    <li>Distributed donor appreciation certificates, health snacks, and Rotary donor cards.</li>
</ul>
<blockquote>
    <p>"Your single bag of donated blood is a priceless lifeline for a child fighting thalassemia. We salute our selfless voluntary donors."</p>
</blockquote>
<figure class="table">
    <table>
        <thead>
            <tr>
                <th>Blood Group</th>
                <th>Units Collected</th>
                <th>Beneficiary Center</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>O+ / A+ / B+</td>
                <td>88 Units</td>
                <td>Dhaka Shishu Hospital Thalassemia Wing</td>
            </tr>
            <tr>
                <td>AB+ / Negative Groups</td>
                <td>36 Units</td>
                <td>Emergency Patient Transfusion Bank</td>
            </tr>
        </tbody>
    </table>
</figure>
<figure class="image image-style-side">
    <img src="/assets/images/gallery/portfolio-11.jpg" alt="Blood Donation Activity">
    <figcaption>Volunteer donating safe blood during the Rotary Shantinagar blood drive.</figcaption>
</figure>',
                'description_bn' => '<p class="lead">থ্যালাসেমিয়া আক্রান্ত নিষ্পাপ শিশুদের নিয়মিত রক্তের সংকট নিরসনে রোটারি ক্লাব অব শান্তিনগর ঢাকার উদ্যোগে সফলভাবে দিনব্যাপী রক্তদান কর্মসূচি সম্পন্ন হয়েছে, যেখানে <strong>১২৪ ব্যাগ নিরাপদ রক্ত</strong> সংগৃহীত হয়েছে।</p>
<h3>অর্জিত সাফল্য ও পরিসংখ্যান</h3>
<ul>
    <li>১২৪ জন উদ্যমী রক্তদাতা সম্পূর্ণ স্বাস্থ্য পরীক্ষার পর নিরাপদ রক্ত দান করেছেন।</li>
    <li>৩০০+ দর্শনার্থীর বিনামূল্যে রক্তের গ্রুপ ও হিমোগ্লোবিন টেস্ট সম্পন্ন।</li>
    <li>জরুরি রক্তের প্রয়োজনে ক্লাবের তত্ত্বাবধানে একটি "জরুরি রক্তদাতা ডেটাবেজ" গঠন।</li>
    <li>সকল রক্তদাতাকে ক্লাবের পক্ষ থেকে সম্মাননা সনদ ও হেলথ কার্ড প্রদান।</li>
</ul>
<blockquote>
    <p>"এক ব্যাগ রক্ত একটি পরিবারের মুখে হাসি ফোটাতে পারে। থ্যালাসেমিয়া রোগীদের পাশে দাঁড়ানো প্রতিটি রক্তদাতাকে আমাদের আন্তরিক অভিবাদন।"</p>
</blockquote>
<figure class="table">
    <table>
        <thead>
            <tr>
                <th>রক্তের গ্রুপ</th>
                <th>সংগৃহীত ব্যাগ</th>
                <th>সংযুক্ত হাসপাতাল</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>ও+, এ+, বি+</td>
                <td>৮৮ ব্যাগ</td>
                <td>ঢাকা শিশু হাসপাতাল থ্যালাসেমিয়া ইউনিট</td>
            </tr>
            <tr>
                <td>এবি+ ও নেগেটিভ গ্রুপ</td>
                <td>৩৬ ব্যাগ</td>
                <td>জরুরি ব্লাড ট্রান্সফিউশন সেন্টার</td>
            </tr>
        </tbody>
    </table>
</figure>
<figure class="image image-style-side">
    <img src="/assets/images/gallery/portfolio-11.jpg" alt="রক্তদান কর্মসূচি">
    <figcaption>স্বেচ্ছাসেবী রক্তদাতা কর্তৃক আনন্দচিত্তে রক্তদান ও সহমর্মিতা প্রকাশ।</figcaption>
</figure>',
                'featured_image' => 'assets/images/events/events-7.jpg',
                'status' => 'completed',
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Hospital Ceiling Fan & Patient Aid Installation Drive',
                'title_bn' => 'হাসপাতাল সিলিং ফ্যান ও রোগী সহায়তা সামগ্রী স্থাপন কর্মসূচি',
                'slug' => 'hospital-fan-patient-aid-installation-drive',
                'event_date' => now()->addDays(5)->toDateString(),
                'event_time' => '10:00 AM - 02:30 PM',
                'location' => 'Dhaka Medical College General Ward & Outpatient Complex',
                'location_bn' => 'ঢাকা মেডিকেল কলেজ জেনারেল ওয়ার্ড ও বহির্বিভাগ',
                'short_description' => 'Supplying and installing 50 heavy-duty ceiling fans and basic patient mobility equipment in public hospital wards.',
                'short_description_bn' => 'সরকারি হাসপাতালের সাধারণ ওয়ার্ডে ৫০টি উন্নত সিলিং ফ্যান ও হুইলচেয়ার স্থাপন কর্মসূচি।',
                'description' => '<p class="lead">Underprivileged patients admitted to government public wards often suffer from extreme heat and lack of basic mobility aids. Rotary Club of Shantinagar Dhaka is directly procuring and installing <strong>50 energy-efficient high-speed ceiling fans</strong> and donating 10 heavy-duty wheelchairs.</p>
<h3>Project Scope & Installation</h3>
<ul>
    <li>Installation of 50 heavy-duty 56-inch ceiling fans with complete copper wiring.</li>
    <li>Donation of 10 foldable stainless steel wheelchairs for emergency patient movement.</li>
    <li>Provision of digital blood pressure monitors and pulse oximeters to duty stations.</li>
    <li>Official handover to the hospital administration under transparent memorandum.</li>
</ul>
<blockquote>
    <p>"Making hospital wards humane and comfortable for low-income patients is an immediate, impactful service."</p>
</blockquote>
<figure class="image image-style-side">
    <img src="/assets/images/gallery/portfolio-7.jpg" alt="Hospital Aid Handover">
    <figcaption>Rotary club leadership inspecting installed electrical facilities in general ward.</figcaption>
</figure>',
                'description_bn' => '<p class="lead">সরকারি হাসপাতালের সাধারণ ওয়ার্ডে চিকিৎসাধীন অসহায় রোগীদের তীব্র গরমের কষ্ট লাঘব এবং নির্বিঘ্ন সেবা নিশ্চিত করতে রোটারি ক্লাব অব শান্তিনগর ঢাকা <strong>৫০টি শক্তিশালী সিলিং ফ্যান ও ১০টি হুইলচেয়ার</strong> সরাসরি স্থাপন করছে।</p>
<h3>প্রকল্পের আওতা ও সামগ্রী</h3>
<ul>
    <li>হাসপাতালের সাধারণ ওয়ার্ডে উন্নতমানের ৫৬ ইঞ্চি কপার ওয়্যারিং সিলিং ফ্যান স্থাপন।</li>
    <li>অসহায় রোগীদের ওয়ার্ড পরিবর্তনের সুবিধার্থে ১০টি ফোল্ডিং হুইলচেয়ার প্রদান।</li>
    <li>ডিউটি ডাক্তার ও নার্সদের জরুরি ব্যবহারের জন্য ডিজিটাল বিপি মেশিন ও অক্সিমিটার প্রদান।</li>
    <li>হাসপাতাল কর্তৃপক্ষের নিকট আনুষ্ঠানিক হস্তান্তর ও রক্ষণাবেক্ষণ চুক্তি সম্পাদন।</li>
</ul>
<blockquote>
    <p>"হাসপাতালে সেবা নিতে আসা দরিদ্র মানুষের কষ্ট সামান্য লাঘব করাও আমাদের ক্লাবের অন্যতম পরম দায়িত্ব।"</p>
</blockquote>
<figure class="image image-style-side">
    <img src="/assets/images/gallery/portfolio-7.jpg" alt="হাসপাতাল সহায়তা হস্তান্তর">
    <figcaption>হাসপাতাল ওয়ার্ডে ফ্যান স্থাপন ও উপকরণ হস্তান্তর পরিদর্শনকালে রোটারিয়ানবৃন্দ।</figcaption>
</figure>',
                'featured_image' => 'assets/images/events/events-4.jpg',
                'status' => 'upcoming',
                'is_featured' => true,
                'is_published' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Emergency Disaster Food Relief & Rehabilitation',
                'title_bn' => 'জরুরি দুর্যোগ খাদ্য সহায়তা ও পুনর্বাসন কার্যক্রম',
                'slug' => 'emergency-disaster-food-relief-rehabilitation',
                'event_date' => now()->subMonths(2)->toDateString(),
                'event_time' => '09:00 AM - 04:00 PM',
                'location' => 'Sunamganj & Feni Flood-Affected Remote Villages',
                'location_bn' => 'সুনামগঞ্জ ও ফেনীর বন্যা কবলিত প্রত্যন্ত গ্রাম',
                'short_description' => 'Delivered 1,200 emergency dry ration packs and water purification kits directly to submerged riverbank villages.',
                'short_description_bn' => 'বন্যাদুর্গত পানিবন্দী ১,২০০ পরিবারের মাঝে জরুরি শুকনো খাদ্য ও পানি বিশুদ্ধকরণ ট্যাবলেট বিতরণ।',
                'description' => '<p class="lead">During devastating flash floods, our volunteers deployed motorized boats to reach marooned families, providing <strong>1,200 comprehensive emergency dry food packs</strong>, saline, water purification tablets, and baby food.</p>
<h3>Aid Package Breakdown</h3>
<ul>
    <li>Rice (10kg), Lentils (2kg), Oil (1L), Potatoes (3kg), Salt, and Matches per family.</li>
    <li>High-energy flattened rice (Chira), Gur, biscuits, and oral rehydration saline (ORS).</li>
    <li>Water purification tablets (Halazone) providing 10,000+ liters of drinkable water.</li>
    <li>Essential sanitary kits and water-resistant solar lanterns for dark flood nights.</li>
</ul>
<blockquote>
    <p>"When floods wash away homes, immediate food and clean water are matters of life and death. Our volunteers stood on the front lines."</p>
</blockquote>
<figure class="table">
    <table>
        <thead>
            <tr>
                <th>Area / Upazila</th>
                <th>Packs Distributed</th>
                <th>Water Purification Tablets</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Sunamganj (Dowarabazar)</td>
                <td>650 Families</td>
                <td>6,500 Tablets</td>
            </tr>
            <tr>
                <td>Feni (Parshuram)</td>
                <td>550 Families</td>
                <td>5,500 Tablets</td>
            </tr>
        </tbody>
    </table>
</figure>
<figure class="image image-style-side">
    <img src="/assets/images/gallery/portfolio-12.jpg" alt="Flood Food Relief">
    <figcaption>Volunteers loading emergency relief boats for marooned char households.</figcaption>
</figure>',
                'description_bn' => '<p class="lead">স্মরণকালের ভয়াবহ বন্যায় পানিবন্দী মানুষের চরম মানবিক বিপর্যয়ে রোটারি ক্লাব অব শান্তিনগর ঢাকার ভলান্টিয়ার টিম ইঞ্জিন বোটে করে <strong>১,২০০ পরিবারের মাঝে জরুরি শুকনো খাদ্য, স্যালাইন ও পানি বিশুদ্ধকরণ সামগ্রী</strong> পৌঁছে দিয়েছে।</p>
<h3>বিতরণকৃত খাদ্য প্যাকেজের বিবরণ</h3>
<ul>
    <li>চাল (১০ কেজি), ডাল (২ কেজি), তেল (১ লিটার), আলু (৩ কেজি), লবণ ও দিয়াশলাই।</li>
    <li>জরুরি শুকনো খাবার (চিড়া, গুড়, বিস্কুট) এবং খাওয়ার স্যালাইন (ওরস্যালাইন)।</li>
    <li>১০,০০০+ লিটার সুপেয় পানি তৈরির জন্য পানি বিশুদ্ধকরণ হ্যালোজেন ট্যাবলেট।</li>
    <li>রাতে আলোর সুবিধার্থে ওয়াটারপ্রুফ সোলার লণ্ঠন ও জরুরি স্যানিটেশন সামগ্রী।</li>
</ul>
<blockquote>
    <p>"বন্যার পানিতে সবকিছু হারিয়ে নিঃস্ব হওয়া মানুষের পাশে আমরা প্রথম দিন থেকেই উপস্থিত ছিলাম। প্রতিটি অনুদান সরাসরি তাদের মুখে খাবার হয়ে পৌঁছেছে।"</p>
</blockquote>
<figure class="table">
    <table>
        <thead>
            <tr>
                <th>উপজেলা / এলাকা</th>
                <th>বিতরণকৃত প্যাকেট</th>
                <th>পানি বিশুদ্ধকরণ ট্যাবলেট</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>সুনামগঞ্জ (দোয়ারাবাজার)</td>
                <td>৬৫০ পরিবার</td>
                <td>৬,৫০০ ট্যাবলেট</td>
            </tr>
            <tr>
                <td>ফেনী (পরশুরাম)</td>
                <td>৫৫০ পরিবার</td>
                <td>৫,৫০০ ট্যাবলেট</td>
            </tr>
        </tbody>
    </table>
</figure>
<figure class="image image-style-side">
    <img src="/assets/images/gallery/portfolio-12.jpg" alt="বন্যা ত্রাণ বিতরণ">
    <figcaption>বন্যাদুর্গতদের মাঝে সরাসরি খাদ্য প্যাকেট হস্তান্তরের মুহূর্ত।</figcaption>
</figure>',
                'featured_image' => 'assets/images/events/events-8.jpg',
                'status' => 'completed',
                'is_featured' => false,
                'is_published' => true,
                'sort_order' => 6,
            ],
        ];

        foreach ($activities as $data) {
            Activity::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
