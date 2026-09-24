<?php

namespace App\Services;

use App\Models\Donation;
use App\Models\Donor;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Project;
use App\Models\Salary;

class DashboardService
{
    /**
     * Get real-time KPI metrics for the NGO dashboard.
     */
    public function getKpiMetrics(): array
    {
        $totalDonations = (float) Donation::where('status', 'completed')->sum('amount');
        $totalExpenses = (float) Expense::sum('amount');
        $totalSalaries = (float) Salary::where('status', 'paid')->sum('net_paid_amount');
        $totalExpenditure = $totalExpenses + $totalSalaries;
        $netFundBalance = $totalDonations - $totalExpenditure;

        $totalDonors = Donor::count();
        $activeProjects = Project::where('status', 'in_progress')->count();
        $totalProjects = Project::count();
        $totalEmployees = Employee::where('employment_status', 'active')->count();

        return [
            'total_donations' => $totalDonations,
            'total_expenses' => $totalExpenditure,
            'net_fund_balance' => $netFundBalance,
            'total_donors' => $totalDonors,
            'active_projects' => $activeProjects,
            'total_projects' => $totalProjects,
            'total_employees' => $totalEmployees,
            'donations_count' => Donation::where('status', 'completed')->count(),
        ];
    }

    /**
     * Get recent completed donations.
     */
    public function getRecentDonations(int $limit = 5)
    {
        return Donation::with(['donor', 'project'])
            ->where('status', 'completed')
            ->latest('donation_date')
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
