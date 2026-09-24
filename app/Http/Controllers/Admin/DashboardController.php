<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the Admin Dashboard with static NGO KPI cards and overview data.
     */
    public function index(): View
    {
        return view('admin.home.index');
    }
}
