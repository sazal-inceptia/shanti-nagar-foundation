<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService
    ) {}

    /**
     * Display the Admin Dashboard with dynamic NGO KPI cards and overview data.
     */
    public function index(): View
    {
        $kpi = $this->dashboardService->getKpiMetrics();
        $recentDonations = $this->dashboardService->getRecentDonations(6);
        $recentExpenses = $this->dashboardService->getRecentExpenses(6);
        $recentProjects = $this->dashboardService->getRecentProjects(5);

        return view('admin.home.index', compact('kpi', 'recentDonations', 'recentExpenses', 'recentProjects'));
    }
}
