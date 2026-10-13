<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Expense;
use App\Models\Project;
use App\Models\Salary;
use App\Services\ReportService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReportController extends Controller
{
    public function __construct(protected ReportService $reportService) {}

    /**
     * Display the financial reports and audit dashboard.
     */
    public function index(Request $request): View
    {
        $rotaryYear = $request->get('rotary_year', $request->get('year', '2026'));
        $filters = [
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'project_id' => $request->get('project_id'),
            'rotary_year' => $rotaryYear,
        ];

        $year = (int) ($rotaryYear !== 'all' ? $rotaryYear : 2026);

        $summary = $this->reportService->getFinancialSummary($filters);
        $projectBalances = $this->reportService->getProjectBalances($filters);
        $monthlyBreakdown = $this->reportService->getMonthlyBreakdown($year, $filters);
        $categoryBreakdown = $this->reportService->getExpenseCategoryBreakdown($filters);
        $transactions = $this->reportService->getTransactions($filters);
        $projects = Project::orderBy('name')->get();

        return view('admin.reports.index', compact(
            'summary',
            'projectBalances',
            'monthlyBreakdown',
            'categoryBreakdown',
            'transactions',
            'projects',
            'filters',
            'year'
        ));
    }

    /**
     * Display printable official financial statement & audit certificate.
     */
    public function statement(Request $request): View
    {
        $rotaryYear = $request->get('rotary_year', $request->get('year', '2026'));
        $filters = [
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'project_id' => $request->get('project_id'),
            'rotary_year' => $rotaryYear,
        ];

        $year = (int) ($rotaryYear !== 'all' ? $rotaryYear : 2026);

        $summary = $this->reportService->getFinancialSummary($filters);
        $projectBalances = $this->reportService->getProjectBalances($filters);
        $monthlyBreakdown = $this->reportService->getMonthlyBreakdown($year, $filters);
        $categoryBreakdown = $this->reportService->getExpenseCategoryBreakdown($filters);
        $auditedVouchers = $this->reportService->getAuditedVouchers($filters);

        return view('admin.reports.statement', compact(
            'summary',
            'projectBalances',
            'monthlyBreakdown',
            'categoryBreakdown',
            'auditedVouchers',
            'filters',
            'year'
        ));
    }

    /**
     * Export transaction audit ledger to CSV format.
     */
    public function export(Request $request): StreamedResponse
    {
        $rotaryYear = $request->get('rotary_year', $request->get('year', '2026'));
        $filters = [
            'start_date' => $request->get('start_date'),
            'end_date' => $request->get('end_date'),
            'project_id' => $request->get('project_id'),
            'rotary_year' => $rotaryYear,
        ];

        [$startDate, $endDate] = $this->reportService->resolveDateRange($filters);
        $projectId = ! empty($filters['project_id']) ? $filters['project_id'] : null;

        $filename = 'shanti-nagar-financial-statement-'.date('Y-m-d').'.csv';

        return response()->streamDownload(function () use ($startDate, $endDate, $projectId, $rotaryYear) {
            $handle = fopen('php://output', 'w');

            // BOM for UTF-8 Excel support
            fwrite($handle, "\xEF\xBB\xBF");

            // Header Section
            fputcsv($handle, ['ROTARY CLUB OF SHANTINAGAR DHAKA']);
            fputcsv($handle, ['FINANCIAL AUDIT STATEMENT & LEDGER EXPORT']);
            fputcsv($handle, ['Generated Date', date('Y-m-d H:i:s')]);
            fputcsv($handle, ['Rotary Year / Period', (! empty($rotaryYear) && $rotaryYear !== 'all' ? "RY {$rotaryYear}–".((int) $rotaryYear + 1) : ($startDate?->format('Y-m-d') ?: 'All Time').' to '.($endDate?->format('Y-m-d') ?: 'Present'))]);
            fputcsv($handle, []);

            // Inflow (Donations) Table
            fputcsv($handle, ['--- INFLOW / DONATIONS RECEIVED ---']);
            fputcsv($handle, ['SL', 'Receipt #', 'Date', 'Donor Name', 'Project Allocation', 'Payment Method', 'Amount (BDT)']);

            $donations = Donation::with(['donor', 'project'])
                ->where('status', 'completed')
                ->when($startDate, fn ($q) => $q->where('donation_date', '>=', $startDate))
                ->when($endDate, fn ($q) => $q->where('donation_date', '<=', $endDate))
                ->when($projectId, fn ($q) => $q->where('project_id', $projectId))
                ->orderBy('donation_date')
                ->get();

            $sl = 1;
            $totalDonations = 0;
            foreach ($donations as $don) {
                $totalDonations += (float) $don->amount;
                fputcsv($handle, [
                    $sl++,
                    $don->receipt_number,
                    $don->donation_date?->format('Y-m-d'),
                    $don->donor?->name ?? 'Anonymous Supporter',
                    $don->project?->name ?? 'General Fund',
                    strtoupper($don->payment_method),
                    number_format((float) $don->amount, 2, '.', ''),
                ]);
            }
            fputcsv($handle, ['', '', '', '', '', 'TOTAL INFLOW (BDT):', number_format($totalDonations, 2, '.', '')]);
            fputcsv($handle, []);

            // Outflow (Expenses) Table
            fputcsv($handle, ['--- OUTFLOW / EXPENDITURES ---']);
            fputcsv($handle, ['SL', 'Voucher #', 'Date', 'Expense Title', 'Category', 'Project Allocation', 'Payment Method', 'Voucher Status', 'Amount (BDT)']);

            $expenses = Expense::with('project')
                ->when($startDate, fn ($q) => $q->where('expense_date', '>=', $startDate))
                ->when($endDate, fn ($q) => $q->where('expense_date', '<=', $endDate))
                ->when($projectId, fn ($q) => $q->where('project_id', $projectId))
                ->orderBy('expense_date')
                ->get();

            $sl = 1;
            $totalExpenses = 0;
            foreach ($expenses as $exp) {
                $totalExpenses += (float) $exp->amount;
                fputcsv($handle, [
                    $sl++,
                    $exp->voucher_number,
                    $exp->expense_date?->format('Y-m-d'),
                    $exp->title,
                    $exp->expense_category,
                    $exp->project?->name ?? 'Central Admin',
                    strtoupper($exp->payment_method),
                    $exp->receipt_voucher_file ? 'Verified Receipt Attached' : 'Disbursement Ledger Record',
                    number_format((float) $exp->amount, 2, '.', ''),
                ]);
            }
            fputcsv($handle, ['', '', '', '', '', '', '', 'TOTAL DIRECT EXPENSES (BDT):', number_format($totalExpenses, 2, '.', '')]);
            fputcsv($handle, []);

            // Staff Salaries (if all projects selected)
            $totalSalaries = 0;
            if (! $projectId) {
                fputcsv($handle, ['--- STAFF PAYROLL & HR DISBURSEMENTS ---']);
                fputcsv($handle, ['SL', 'Payslip #', 'Date', 'Staff Employee', 'Period', 'Payment Method', 'Amount (BDT)']);

                $salaries = Salary::with('employee')
                    ->where('status', 'paid')
                    ->when($startDate, fn ($q) => $q->where('payment_date', '>=', $startDate))
                    ->when($endDate, fn ($q) => $q->where('payment_date', '<=', $endDate))
                    ->orderBy('payment_date')
                    ->get();

                $sl = 1;
                foreach ($salaries as $sal) {
                    $totalSalaries += (float) $sal->net_paid_amount;
                    fputcsv($handle, [
                        $sl++,
                        $sal->salary_slip_number,
                        $sal->payment_date?->format('Y-m-d'),
                        $sal->employee?->name ?? 'Staff Employee',
                        $sal->month_year,
                        strtoupper($sal->payment_method),
                        number_format((float) $sal->net_paid_amount, 2, '.', ''),
                    ]);
                }
                fputcsv($handle, ['', '', '', '', '', 'TOTAL PAYROLL DISBURSEMENTS (BDT):', number_format($totalSalaries, 2, '.', '')]);
                fputcsv($handle, []);
            }

            // Total Outflow & Net Balance
            $totalOutflow = $totalExpenses + $totalSalaries;
            $net = $totalDonations - $totalOutflow;
            fputcsv($handle, ['TOTAL COMBINED OUTFLOW (BDT):', number_format($totalOutflow, 2, '.', '')]);
            fputcsv($handle, ['NET SURPLUS / BALANCE (BDT):', number_format($net, 2, '.', '')]);

            fclose($handle);
        }, $filename, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ]);
    }
}
