<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Http\Requests\StorePublicDonationRequest;
use App\Http\Requests\StoreVolunteerRequest;
use App\Models\ContactMessage;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectType;
use App\Models\Salary;
use App\Models\Volunteer;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Get real-time dynamic impact and transparency statistics directly from database.
     *
     * @return array<string, mixed>
     */
    private function getImpactStats(): array
    {
        $totalDonationsRaised = (float) Donation::where('status', 'completed')->sum('amount');
        if ($totalDonationsRaised === 0.0) {
            $totalDonationsRaised = (float) Donation::sum('amount');
        }

        $totalExpenses = (float) Expense::sum('amount');
        $totalSalaries = (float) Salary::where('status', 'paid')->sum('net_paid_amount');
        if ($totalSalaries === 0.0) {
            $totalSalaries = (float) Salary::sum('net_paid_amount');
        }
        $totalFundsUtilized = $totalExpenses + $totalSalaries;

        $totalProjects = Project::where('is_published', true)->count();
        $projectsCompleted = Project::where('is_published', true)->where('status', 'completed')->count();
        if ($projectsCompleted === 0 && $totalProjects > 0) {
            $projectsCompleted = $totalProjects;
        }

        $activeVolunteers = Volunteer::where('status', 'approved')->count();
        if ($activeVolunteers === 0) {
            $activeVolunteers = Volunteer::count();
        }

        $totalDonors = Donor::count();
        if ($totalDonors === 0) {
            $totalDonors = Donation::distinct('donor_id')->count();
        }

        $completedDonationsCount = Donation::where('status', 'completed')->count();
        if ($completedDonationsCount === 0) {
            $completedDonationsCount = Donation::count();
        }

        return [
            'totalDonationsRaised' => $totalDonationsRaised,
            'totalFundsUtilized' => $totalFundsUtilized,
            'totalExpenses' => $totalExpenses,
            'totalProjects' => $totalProjects,
            'projectsCompleted' => $projectsCompleted,
            'activeVolunteers' => $activeVolunteers,
            'totalDonors' => $totalDonors,
            'completedDonationsCount' => $completedDonationsCount,
        ];
    }

    public function index(): View
    {
        $featuredProjects = Project::where('is_published', true)
            ->with(['projectType', 'donations', 'expenses'])
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        $urgentProject = Project::where('is_published', true)
            ->where('status', 'in_progress')
            ->with(['projectType', 'donations', 'expenses'])
            ->orderBy('estimated_cost', 'desc')
            ->first() ?? $featuredProjects->first();

        $upcomingActivities = Project::where('is_published', true)
            ->whereIn('status', ['planned', 'in_progress'])
            ->with('projectType')
            ->orderBy('start_date', 'asc')
            ->take(3)
            ->get();

        $recentDonations = Donation::where('status', 'completed')
            ->with(['donor', 'project.projectType'])
            ->latest('donation_date')
            ->take(10)
            ->get();

        if ($recentDonations->isEmpty()) {
            $recentDonations = Donation::with(['donor', 'project.projectType'])
                ->latest()
                ->take(10)
                ->get();
        }

        $recentVolunteers = Volunteer::where('status', 'approved')->latest()->take(4)->get();
        if ($recentVolunteers->isEmpty()) {
            $recentVolunteers = Volunteer::latest()->take(4)->get();
        }

        $projectTypes = ProjectType::where('is_active', true)->orderBy('order_index')->get();

        $stats = $this->getImpactStats();

        return view('frontend.index', compact('featuredProjects', 'urgentProject', 'upcomingActivities', 'recentDonations', 'recentVolunteers', 'projectTypes', 'stats'));
    }

    public function about(): View
    {
        $stats = $this->getImpactStats();

        $bestPresident = Employee::with('designation')
            ->where('is_active', true)
            ->where('is_highlight', true)
            ->orderBy('order_index', 'asc')
            ->first();

        $president = Employee::with('designation')
            ->where('is_active', true)
            ->where(function ($q) {
                $q->where('is_highlight', false)
                    ->orWhereNull('is_highlight');
            })
            ->whereHas('designation', function ($q) {
                $q->where('category', 'Executive Leadership')
                    ->where(function ($sq) {
                        $sq->where('slug', 'president')
                            ->orWhere('name', 'like', '%President%');
                    });
            })
            ->where('id', '!=', $bestPresident?->id)
            ->orderBy('order_index', 'asc')
            ->first();

        $secretary = Employee::with('designation')
            ->where('is_active', true)
            ->whereHas('designation', function ($q) {
                $q->where('category', 'Executive Leadership')
                    ->where(function ($sq) {
                        $sq->where('slug', 'general-secretary')
                            ->orWhere('name', 'like', '%General Secretary%')
                            ->orWhere('name', 'like', '%Secretary%');
                    });
            })
            ->where('id', '!=', $bestPresident?->id)
            ->orderBy('order_index', 'asc')
            ->first();

        $treasurer = Employee::with('designation')
            ->where('is_active', true)
            ->whereHas('designation', function ($q) {
                $q->where('category', 'Executive Leadership')
                    ->where(function ($sq) {
                        $sq->where('slug', 'like', '%treasurer%')
                            ->orWhere('name', 'like', '%Treasurer%');
                    });
            })
            ->where('id', '!=', $bestPresident?->id)
            ->orderBy('order_index', 'asc')
            ->first();

        $bodMembers = Employee::with('designation')
            ->where('is_active', true)
            ->whereHas('designation', function ($dq) {
                $dq->where('category', 'Board of Directors');
            })
            ->whereNotIn('id', array_filter([
                $bestPresident?->id,
                $president?->id,
                $secretary?->id,
                $treasurer?->id,
            ]))
            ->orderBy('order_index', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $excludedIds = array_filter([
            $bestPresident?->id,
            $president?->id,
            $secretary?->id,
            $treasurer?->id,
            ...$bodMembers->pluck('id')->toArray(),
        ]);

        $otherMembers = Employee::with('designation')
            ->where('is_active', true)
            ->whereNotIn('id', $excludedIds)
            ->orderBy('order_index', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        $teamMembers = Employee::with('designation')
            ->where('is_active', true)
            ->orderBy('order_index', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        return view('frontend.about', compact(
            'stats',
            'bestPresident',
            'president',
            'secretary',
            'treasurer',
            'bodMembers',
            'otherMembers',
            'teamMembers'
        ));
    }

    public function donations(): View
    {
        $selectedType = request('type');
        $query = Project::where('is_published', true)
            ->with(['projectType', 'donations', 'expenses']);

        if ($selectedType && $selectedType !== 'all') {
            $query->whereHas('projectType', function ($q) use ($selectedType) {
                $q->where('slug', $selectedType);
            });
        }

        $projects = $query->orderBy('created_at', 'desc')->paginate(6)->withQueryString();
        $projectTypes = ProjectType::where('is_active', true)->orderBy('order_index')->get();

        return view('frontend.donations', compact('projects', 'projectTypes', 'selectedType'));
    }

    public function donationDetails(?string $slug = null): View
    {
        $project = null;
        if ($slug) {
            $project = Project::where('slug', $slug)
                ->with(['projectType', 'images', 'donations.donor'])
                ->first();
        }
        if (! $project) {
            $project = Project::with(['projectType', 'images', 'donations.donor'])
                ->where('is_published', true)
                ->first();
        }

        if (! $project) {
            abort(404);
        }

        $recentProjects = Project::where('id', '!=', $project->id)
            ->where('is_published', true)
            ->with('projectType')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        $recentDonors = $project->donations()
            ->where('status', 'completed')
            ->with('donor')
            ->latest('donation_date')
            ->take(6)
            ->get();

        $projectTypes = ProjectType::where('is_active', true)
            ->withCount(['projects' => function ($q) {
                $q->where('is_published', true);
            }])
            ->orderBy('order_index')
            ->get();

        $galleryImages = ProjectImage::latest()->take(6)->get();

        return view('frontend.donation-details', compact('project', 'recentProjects', 'recentDonors', 'projectTypes', 'galleryImages'));
    }

    public function events(): View
    {
        $activities = Project::where('is_published', true)
            ->with('projectType')
            ->orderBy('start_date', 'desc')
            ->paginate(6);

        return view('frontend.events', compact('activities'));
    }

    public function eventDetails(?string $slug = null): View
    {
        $activity = null;
        if ($slug) {
            $activity = Project::where('slug', $slug)
                ->with(['projectType', 'images', 'donations.donor'])
                ->first();
        }
        if (! $activity) {
            $activity = Project::with(['projectType', 'images', 'donations.donor'])
                ->where('is_published', true)
                ->first();
        }

        if (! $activity) {
            abort(404);
        }

        $upcomingActivities = Project::where('id', '!=', $activity->id)
            ->where('is_published', true)
            ->with('projectType')
            ->orderBy('start_date', 'desc')
            ->take(3)
            ->get();

        $recentVolunteers = Volunteer::where('status', 'approved')
            ->latest()
            ->take(3)
            ->get();

        return view('frontend.event-details', compact('activity', 'upcomingActivities', 'recentVolunteers'));
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
        $selectedType = request('type');

        $query = ProjectImage::with(['project.projectType'])
            ->whereHas('project', function ($q) use ($selectedType) {
                $q->where('is_published', true);
                if ($selectedType && $selectedType !== 'all') {
                    $q->whereHas('projectType', function ($typeQuery) use ($selectedType) {
                        $typeQuery->where('slug', $selectedType);
                    });
                }
            })
            ->orderBy('created_at', 'desc');

        $galleryImages = $query->paginate(12)->withQueryString();

        $projectTypes = ProjectType::where('is_active', true)
            ->whereHas('projects', function ($q) {
                $q->where('is_published', true)->whereHas('images');
            })
            ->orderBy('order_index')
            ->get();

        if ($projectTypes->isEmpty()) {
            $projectTypes = ProjectType::where('is_active', true)->orderBy('order_index')->get();
        }

        return view('frontend.gallery', compact('galleryImages', 'projectTypes', 'selectedType'));
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
        $validated = $request->validated();

        $noteParts = [];
        if (! empty($validated['event_name'])) {
            $noteParts[] = 'Event/Initiative: '.$validated['event_name'];
        }
        if (! empty($validated['experience'])) {
            $noteParts[] = 'Experience: '.$validated['experience'];
        }
        if (! empty($validated['notes'])) {
            $noteParts[] = $validated['notes'];
        }

        $notes = ! empty($noteParts) ? implode(' | ', $noteParts) : null;

        Volunteer::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'gender' => $validated['gender'] ?? null,
            'age_group' => $validated['age_group'] ?? null,
            'address' => $validated['address'] ?? null,
            'notes' => $notes,
            'status' => 'pending',
        ]);

        $successMsg = ! empty($validated['event_name'])
            ? "Thank you for registering to volunteer for {$validated['event_name']}! Our team will contact you shortly."
            : 'Thank you for registering as a volunteer with Shanti Nagar Foundation! We will review your application soon.';

        return redirect()->back()->with('success', $successMsg);
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
