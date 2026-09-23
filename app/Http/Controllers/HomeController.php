<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.index');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function donations()
    {
        return view('frontend.donations');
    }

    public function donationDetails()
    {
        return view('frontend.donation-details');
    }

    public function events()
    {
        return view('frontend.events');
    }

    public function eventDetails()
    {
        return view('frontend.event-details');
    }

    public function blog()
    {
        return view('frontend.blog');
    }

    public function blogDetails()
    {
        return view('frontend.blog-details');
    }
}
