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
     * Get real-time KPI metrics for the NGO dashboard (optionally scoped to a Rotary Year).
     */
    public function getKpiMetrics(?int $year = null): array
    {
        $donationsQuery = Donation::where('status', 'completed');
        $expensesQuery = Expense::query();
        $salariesQuery = Salary::where('status', 'paid');
        $projectsQuery = Project::query();
        $employeesQuery = Employee::where('is_active', true);

        if ($year !== null) {
            $donationsQuery->rotaryYear($year);
            $expensesQuery->rotaryYear($year);
            $salariesQuery->rotaryYear($year);
            $projectsQuery->rotaryYear($year);
            $employeesQuery->rotaryYear((string) $year);
        }

        $totalDonations = (float) $donationsQuery->sum('amount');
        $totalDirectExpenses = (float) $expensesQuery->sum('amount');
        $totalSalaries = (float) $salariesQuery->sum('net_paid_amount');
        $totalExpenditure = $totalDirectExpenses + $totalSalaries;
        $netFundBalance = $totalDonations - $totalExpenditure;

        $totalDonors = Donor::count();
        $activeProjects = (clone $projectsQuery)->where('status', 'in_progress')->count();
        $totalProjects = $projectsQuery->count();
        $totalEmployees = $employeesQuery->count();

        return [
            'total_donations' => $totalDonations,
            'total_direct_expenses' => $totalDirectExpenses,
            'total_salaries' => $totalSalaries,
            'total_expenses' => $totalExpenditure,
            'net_fund_balance' => $netFundBalance,
            'total_donors' => $totalDonors,
            'active_projects' => $activeProjects,
            'total_projects' => $totalProjects,
            'total_employees' => $totalEmployees,
            'donations_count' => (clone $donationsQuery)->count(),
            'expenses_count' => (clone $expensesQuery)->count(),
            'salaries_count' => (clone $salariesQuery)->count(),
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
