<?php

namespace App\Services;

use App\Models\Donation;
use App\Models\Donor;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Project;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    /**
     * Get real-time KPI metrics for the NGO dashboard.
     */
    public function getKpiMetrics(): array
    {
        $totalDonations = (float) Donation::where('payment_status', 'completed')->sum('amount');
        $totalExpenses = (float) Expense::sum('amount');
        $totalSalaries = (float) Salary::where('payment_status', 'paid')->sum('net_payable');
        $totalExpenditure = $totalExpenses + $totalSalaries;
        $netFundBalance = $totalDonations - $totalExpenditure;

        $totalDonors = Donor::count();
        $activeProjects = Project::where('status', 'active')->count();
        $totalProjects = Project::count();
        $totalEmployees = Employee::where('status', 'active')->count();

        return [
            'total_donations' => $totalDonations,
            'total_expenses' => $totalExpenditure,
            'net_fund_balance' => $netFundBalance,
            'total_donors' => $totalDonors,
            'active_projects' => $activeProjects,
            'total_projects' => $totalProjects,
            'total_employees' => $totalEmployees,
            'donations_count' => Donation::where('payment_status', 'completed')->count(),
        ];
    }

    /**
     * Get recent completed donations.
     */
    public function getRecentDonations(int $limit = 5)
    {
        return Donation::with(['donor', 'project'])
            ->where('payment_status', 'completed')
            ->latest('donated_at')
            ->take($limit)
            ->get();
    }

    /**
     * Get recent NGO projects.
     */
    public function getRecentProjects(int $limit = 5)
    {
        return Project::latest()->take($limit)->get();
    }

    /**
     * Get recent expenses & vouchers.
     */
    public function getRecentExpenses(int $limit = 5)
    {
        return Expense::with('project')->latest('expense_date')->take($limit)->get();
    }
}
