<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Http\Requests\StorePublicDonationRequest;
use App\Http\Requests\StoreVolunteerRequest;
use App\Models\ContactMessage;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\Volunteer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredProjects = Project::where('is_published', true)->orderBy('created_at', 'desc')->take(4)->get();
        $upcomingActivities = Project::where('is_published', true)
            ->whereIn('status', ['planned', 'in_progress'])
            ->orderBy('start_date', 'asc')
            ->take(3)
            ->get();

        return view('frontend.index', compact('featuredProjects', 'upcomingActivities'));
    }

    public function about(): View
    {
        return view('frontend.about');
    }

    public function donations(): View
    {
        $projects = Project::where('is_published', true)->orderBy('created_at', 'desc')->paginate(6);

        return view('frontend.donations', compact('projects'));
    }

    public function donationDetails(?string $slug = null): View
    {
        $project = null;
        if ($slug) {
            $project = Project::where('slug', $slug)->with('images')->first();
        }
        if (! $project) {
            $project = Project::with('images')->first();
        }

        $recentProjects = Project::where('id', '!=', $project ? $project->id : 0)
            ->where('is_published', true)
            ->take(3)
            ->get();

        return view('frontend.donation-details', compact('project', 'recentProjects'));
    }

    public function events(): View
    {
        $activities = Project::where('is_published', true)
            ->orderBy('start_date', 'desc')
            ->paginate(6);

        return view('frontend.events', compact('activities'));
    }

    public function eventDetails(?string $slug = null): View
    {
        $activity = null;
        if ($slug) {
            $activity = Project::where('slug', $slug)->with('images')->first();
        }
        if (! $activity) {
            $activity = Project::with('images')->first();
        }

        return view('frontend.event-details', compact('activity'));
    }

    public function blog(): View
    {
        return view('frontend.blog');
    }

    public function blogDetails(): View
    {
        return view('frontend.blog-details');
    }

    public function contact(): View
    {
        return view('frontend.contact');
    }

    public function volunteer(): View
    {
        return view('frontend.volunteer');
    }

    public function faq(): View
    {
        return view('frontend.faq');
    }

    public function donate(): View
    {
        $projects = Project::where('is_published', true)->orderBy('name')->get();

        return view('frontend.donate', compact('projects'));
    }

    public function gallery(): View
    {
        $galleryImages = ProjectImage::with('project')
            ->whereHas('project', function ($q) {
                $q->where('is_published', true);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.gallery', compact('galleryImages'));
    }

    /**
     * Handle public contact inquiry submission.
     */
    public function submitContact(StoreContactMessageRequest $request): RedirectResponse
    {
        ContactMessage::create($request->validated());

        return redirect()->back()->with('success', 'Thank you! Your message has been received. Our team will contact you shortly.');
    }

    /**
     * Handle public volunteer registration submission.
     */
    public function submitVolunteer(StoreVolunteerRequest $request): RedirectResponse
    {
        Volunteer::create([
            ...$request->validated(),
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Thank you for registering as a volunteer with Shanti Nagar Foundation! We will review your application soon.');
    }

    /**
     * Handle public donation pledge submission.
     */
    public function submitDonate(StorePublicDonationRequest $request): RedirectResponse
    {
        $donor = Donor::firstOrCreate(
            ['email' => $request->email],
            [
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'donor_type' => 'individual',
            ]
        );

        $year = date('Y');
        $lastDonation = Donation::whereYear('created_at', $year)->orderBy('id', 'desc')->first();
        $sequence = $lastDonation ? ((int) substr($lastDonation->receipt_number, -4)) + 1 : 1;
        $receiptNumber = sprintf('REC-%s-%04d', $year, $sequence);

        $donation = Donation::create([
            'receipt_number' => $receiptNumber,
            'donor_id' => $donor->id,
            'project_id' => $request->project_id,
            'amount' => $request->amount,
            'donation_date' => now(),
            'payment_method' => $request->payment_method,
            'transaction_id' => $request->transaction_id,
            'status' => 'pending',
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Thank you for your generous contribution of ৳ '.number_format((float) $donation->amount, 2).'! Your donation pledge (Receipt #'.$receiptNumber.') has been recorded. Our accounts team will verify your transaction.');
    }
}
