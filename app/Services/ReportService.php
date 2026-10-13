<?php

namespace App\Services;

use App\Models\Donation;
use App\Models\Expense;
use App\Models\Project;
use App\Models\Salary;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReportService
{
    /**
     * Resolve effective start and end dates from given filters.
     * Custom start_date and end_date take precedence over rotary_year.
     *
     * @param  array<string, mixed>  $filters
     * @return array{0: ?Carbon, 1: ?Carbon}
     */
    public function resolveDateRange(array $filters): array
    {
        $hasCustomStart = ! empty($filters['start_date']);
        $hasCustomEnd = ! empty($filters['end_date']);

        $rotaryYear = $filters['rotary_year'] ?? null;
        $hasRotaryYear = ! empty($rotaryYear) && $rotaryYear !== 'all';

        $startDate = null;
        $endDate = null;

        if ($hasCustomStart) {
            $startDate = Carbon::parse($filters['start_date'])->startOfDay();
        } elseif ($hasRotaryYear) {
            $startDate = Carbon::create((int) $rotaryYear, 7, 1)->startOfDay();
        }

        if ($hasCustomEnd) {
            $endDate = Carbon::parse($filters['end_date'])->endOfDay();
        } elseif ($hasRotaryYear) {
            $endDate = Carbon::create((int) $rotaryYear + 1, 6, 30)->endOfDay();
        }

        return [$startDate, $endDate];
    }

    /**
     * Get summary statistics (Inflow, Outflow, Net Balance, Projects) for given date range and project.
     *
     * @param  array<string, mixed>  $filters
     * @return array<string, mixed>
     */
    public function getFinancialSummary(array $filters = []): array
    {
        [$startDate, $endDate] = $this->resolveDateRange($filters);
        $projectId = ! empty($filters['project_id']) ? $filters['project_id'] : null;

        // 1. Total Inflow (Donations)
        $donationQuery = Donation::query()->where('status', 'completed');
        if ($startDate) {
            $donationQuery->where('donation_date', '>=', $startDate);
        }
        if ($endDate) {
            $donationQuery->where('donation_date', '<=', $endDate);
        }
        if ($projectId) {
            $donationQuery->where('project_id', $projectId);
        }
        $totalInflow = (float) $donationQuery->sum('amount');
        $donationCount = $donationQuery->count();

        // 2. Direct Expenses
        $expenseQuery = Expense::query();
        if ($startDate) {
            $expenseQuery->where('expense_date', '>=', $startDate);
        }
        if ($endDate) {
            $expenseQuery->where('expense_date', '<=', $endDate);
        }
        if ($projectId) {
            $expenseQuery->where('project_id', $projectId);
        }
        $totalExpenses = (float) $expenseQuery->sum('amount');
        $expenseCount = $expenseQuery->count();
        $voucherCount = (clone $expenseQuery)->whereNotNull('receipt_voucher_file')->where('receipt_voucher_file', '!=', '')->count();

        // 3. Employee Salaries (Counted towards overall organization outflow when no specific project is filtered)
        $salaryQuery = Salary::query()->where('status', 'paid');
        if ($startDate) {
            $salaryQuery->where('payment_date', '>=', $startDate);
        }
        if ($endDate) {
            $salaryQuery->where('payment_date', '<=', $endDate);
        }
        // Salaries are general administrative outflow unless filtered to a specific project (which has no salaries attached)
        $totalSalaries = $projectId ? 0.0 : (float) $salaryQuery->sum('net_paid_amount');
        $salaryCount = $projectId ? 0 : $salaryQuery->count();

        $totalOutflow = $totalExpenses + $totalSalaries;
        $netBalance = $totalInflow - $totalOutflow;

        return [
            'total_inflow' => $totalInflow,
            'donation_count' => $donationCount,
            'total_expenses' => $totalExpenses,
            'expense_count' => $expenseCount,
            'voucher_count' => $voucherCount,
            'total_salaries' => $totalSalaries,
            'salary_count' => $salaryCount,
            'total_outflow' => $totalOutflow,
            'net_balance' => $netBalance,
            'start_date' => $startDate?->format('Y-m-d'),
            'end_date' => $endDate?->format('Y-m-d'),
            'selected_project' => $projectId ? Project::find($projectId) : null,
        ];
    }

    /**
     * Get project-wise financial performance and budget allocations.
     *
     * @param  array<string, mixed>  $filters
     * @return Collection<int, array<string, mixed>>
     */
    public function getProjectBalances(array $filters = []): Collection
    {
        [$startDate, $endDate] = $this->resolveDateRange($filters);
        $projectId = ! empty($filters['project_id']) ? $filters['project_id'] : null;

        $projectsQuery = Project::with('projectType')
            ->when($projectId, fn ($q) => $q->where('id', $projectId))
            ->withSum(['donations as total_donated' => function ($q) use ($startDate, $endDate) {
                $q->where('status', 'completed')
                    ->when($startDate, fn ($sub) => $sub->where('donation_date', '>=', $startDate))
                    ->when($endDate, fn ($sub) => $sub->where('donation_date', '<=', $endDate));
            }], 'amount')
            ->withSum(['expenses as total_expensed' => function ($q) use ($startDate, $endDate) {
                $q->when($startDate, fn ($sub) => $sub->where('expense_date', '>=', $startDate))
                    ->when($endDate, fn ($sub) => $sub->where('expense_date', '<=', $endDate));
            }], 'amount')
            ->orderByDesc('id');

        $projects = $projectsQuery->get();

        return $projects->map(function (Project $prj) {
            $raised = (float) ($prj->total_donated ?? 0);
            $spent = (float) ($prj->total_expensed ?? 0);
            $target = (float) $prj->estimated_cost;
            $balance = $raised - $spent;
            $percent = $target > 0 ? min(100, round(($raised / $target) * 100, 1)) : 0;

            return [
                'id' => $prj->id,
                'name' => $prj->name,
                'project_type' => $prj->projectType?->name ?? 'General Campaign',
                'target_amount' => $target,
                'total_raised' => $raised,
                'total_spent' => $spent,
                'net_balance' => $balance,
                'raised_percent' => $percent,
                'status' => $prj->status,
            ];
        });
    }

    /**
     * Get monthly breakdown of Income vs Outflow for Rotary Year (July of $year to June of $year + 1).
     *
     * @param  array<string, mixed>  $filters
     * @return array<int, array<string, mixed>>
     */
    public function getMonthlyBreakdown(int $year, array $filters = []): array
    {
        $projectId = ! empty($filters['project_id']) ? $filters['project_id'] : null;
        $months = [];

        // Rotary year runs from July (month 7) of $year to June (month 6) of $year + 1
        for ($i = 0; $i < 12; $i++) {
            $monthNum = (($i + 6) % 12) + 1; // 7, 8, 9, 10, 11, 12, 1, 2, 3, 4, 5, 6
            $monthYear = $i < 6 ? $year : $year + 1;

            $start = Carbon::create($monthYear, $monthNum, 1)->startOfMonth();
            $end = Carbon::create($monthYear, $monthNum, 1)->endOfMonth();

            $inflowQuery = Donation::where('status', 'completed')
                ->whereBetween('donation_date', [$start, $end]);
            if ($projectId) {
                $inflowQuery->where('project_id', $projectId);
            }
            $inflow = (float) $inflowQuery->sum('amount');

            $expenseQuery = Expense::whereBetween('expense_date', [$start, $end]);
            if ($projectId) {
                $expenseQuery->where('project_id', $projectId);
            }
            $expense = (float) $expenseQuery->sum('amount');

            $salary = 0.0;
            if (! $projectId) {
                $salary = (float) Salary::where('status', 'paid')
                    ->whereBetween('payment_date', [$start, $end])
                    ->sum('net_paid_amount');
            }

            $outflow = $expense + $salary;
            $surplus = $inflow - $outflow;

            $months[] = [
                'month_number' => $i + 1,
                'calendar_month' => $monthNum,
                'year' => $monthYear,
                'month_name' => $start->format('F Y'),
                'short_name' => $start->format('M Y'),
                'inflow' => $inflow,
                'expenses' => $expense,
                'salaries' => $salary,
                'outflow' => $outflow,
                'surplus' => $surplus,
            ];
        }

        return $months;
    }

    /**
     * Get category-wise expense distribution.
     *
     * @param  array<string, mixed>  $filters
     * @return Collection<int, object>
     */
    public function getExpenseCategoryBreakdown(array $filters = []): Collection
    {
        [$startDate, $endDate] = $this->resolveDateRange($filters);
        $projectId = ! empty($filters['project_id']) ? $filters['project_id'] : null;

        $query = Expense::query()
            ->select('expense_category', DB::raw('SUM(amount) as total_amount'), DB::raw('COUNT(*) as total_count'))
            ->groupBy('expense_category');

        if ($startDate) {
            $query->where('expense_date', '>=', $startDate);
        }
        if ($endDate) {
            $query->where('expense_date', '<=', $endDate);
        }
        if ($projectId) {
            $query->where('project_id', $projectId);
        }

        return $query->orderByDesc('total_amount')->get();
    }

    /**
     * Get unified chronological transactions (Donations, Expenses, Salaries) for list view.
     *
     * @param  array<string, mixed>  $filters
     * @return Collection<int, array<string, mixed>>
     */
    public function getTransactions(array $filters = []): Collection
    {
        [$startDate, $endDate] = $this->resolveDateRange($filters);
        $projectId = ! empty($filters['project_id']) ? $filters['project_id'] : null;

        $transactions = collect();

        // 1. Inflows: Completed Donations
        $donations = Donation::with(['donor', 'project'])
            ->where('status', 'completed')
            ->when($startDate, fn ($q) => $q->where('donation_date', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->where('donation_date', '<=', $endDate))
            ->when($projectId, fn ($q) => $q->where('project_id', $projectId))
            ->get();

        foreach ($donations as $don) {
            $transactions->push([
                'type' => 'Donation',
                'type_badge' => 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;',
                'date' => $don->donation_date,
                'reference' => $don->receipt_number,
                'view_url' => route('admin.donations.show', $don->id),
                'title' => ($don->donor?->name ?? 'Anonymous Supporter').($don->purpose ? ' ('.$don->purpose.')' : ''),
                'project_name' => $don->project?->name ?? 'General Welfare Fund',
                'payment_method' => $don->payment_method,
                'inflow' => (float) $don->amount,
                'outflow' => 0.0,
            ]);
        }

        // 2. Outflows: Expenses
        $expenses = Expense::with('project')
            ->when($startDate, fn ($q) => $q->where('expense_date', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->where('expense_date', '<=', $endDate))
            ->when($projectId, fn ($q) => $q->where('project_id', $projectId))
            ->get();

        foreach ($expenses as $exp) {
            $transactions->push([
                'type' => 'Expense',
                'type_badge' => 'background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca;',
                'date' => $exp->expense_date,
                'reference' => $exp->voucher_number,
                'view_url' => route('admin.expenses.show', $exp->id),
                'title' => $exp->title.($exp->recipient_or_vendor ? ' — '.$exp->recipient_or_vendor : ''),
                'project_name' => $exp->project?->name ?? 'Central Administration',
                'payment_method' => $exp->payment_method,
                'inflow' => 0.0,
                'outflow' => (float) $exp->amount,
                'voucher_file' => $exp->receipt_voucher_file,
                'has_voucher' => ! empty($exp->receipt_voucher_file),
                'voucher_url' => $exp->receipt_voucher_url,
            ]);
        }

        // 3. Outflows: Staff Salaries (only when all projects are selected)
        if (! $projectId) {
            $salaries = Salary::with('employee')
                ->where('status', 'paid')
                ->when($startDate, fn ($q) => $q->where('payment_date', '>=', $startDate))
                ->when($endDate, fn ($q) => $q->where('payment_date', '<=', $endDate))
                ->get();

            foreach ($salaries as $sal) {
                $transactions->push([
                    'type' => 'Salary',
                    'type_badge' => 'background-color: #fff7ed; color: #9a3412; border: 1px solid #fed7aa;',
                    'date' => $sal->payment_date,
                    'reference' => $sal->salary_slip_number,
                    'view_url' => route('admin.salaries.show', $sal->id),
                    'title' => ($sal->employee?->name ?? 'Staff Employee').' ('.$sal->month_year.')',
                    'project_name' => 'Staff Payroll & HR',
                    'payment_method' => $sal->payment_method,
                    'inflow' => 0.0,
                    'outflow' => (float) $sal->net_paid_amount,
                    'voucher_file' => null,
                    'has_voucher' => false,
                    'voucher_url' => null,
                ]);
            }
        }

        return $transactions->sortByDesc('date')->values();
    }

    /**
     * Get verified vouchers with attachment proofs for official audit reporting.
     *
     * @param  array<string, mixed>  $filters
     * @return Collection<int, Expense>
     */
    public function getAuditedVouchers(array $filters = []): Collection
    {
        [$startDate, $endDate] = $this->resolveDateRange($filters);
        $projectId = ! empty($filters['project_id']) ? $filters['project_id'] : null;

        return Expense::with('project')
            ->whereNotNull('receipt_voucher_file')
            ->where('receipt_voucher_file', '!=', '')
            ->when($startDate, fn ($q) => $q->where('expense_date', '>=', $startDate))
            ->when($endDate, fn ($q) => $q->where('expense_date', '<=', $endDate))
            ->when($projectId, fn ($q) => $q->where('project_id', $projectId))
            ->orderBy('expense_date')
            ->get();
    }
}
