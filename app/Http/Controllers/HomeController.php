<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredProjects = Project::where('is_published', true)->orderBy('created_at', 'desc')->take(4)->get();
        $upcomingActivities = Project::where('is_published', true)
            ->whereIn('status', ['planned', 'in_progress'])
            ->orderBy('start_date', 'asc')
            ->take(3)
            ->get();

        return view('frontend.index', compact('featuredProjects', 'upcomingActivities'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function donations()
    {
        $projects = Project::where('is_published', true)->orderBy('created_at', 'desc')->paginate(6);
        return view('frontend.donations', compact('projects'));
    }

    public function donationDetails($slug = null)
    {
        $project = null;
        if ($slug) {
            $project = Project::where('slug', $slug)->with('images')->first();
        }
        if (!$project) {
            $project = Project::with('images')->first();
        }

        $recentProjects = Project::where('id', '!=', $project ? $project->id : 0)
            ->where('is_published', true)
            ->take(3)
            ->get();

        return view('frontend.donation-details', compact('project', 'recentProjects'));
    }

    public function events()
    {
        $activities = Project::where('is_published', true)
            ->orderBy('start_date', 'desc')
            ->paginate(6);

        return view('frontend.events', compact('activities'));
    }

    public function eventDetails($slug = null)
    {
        $activity = null;
        if ($slug) {
            $activity = Project::where('slug', $slug)->with('images')->first();
        }
        if (!$activity) {
            $activity = Project::with('images')->first();
        }

        return view('frontend.event-details', compact('activity'));
    }

    public function blog()
    {
        return view('frontend.blog');
    }

    public function blogDetails()
    {
        return view('frontend.blog-details');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function volunteer()
    {
        return view('frontend.volunteer');
    }

    public function faq()
    {
        return view('frontend.faq');
    }

    public function donate()
    {
        return view('frontend.donate');
    }

    public function gallery()
    {
        $galleryImages = ProjectImage::with('project')
            ->whereHas('project', function ($q) {
                $q->where('is_published', true);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('frontend.gallery', compact('galleryImages'));
    }
}

