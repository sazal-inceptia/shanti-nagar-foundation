<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSalaryRequest;
use App\Http\Requests\Admin\UpdateSalaryRequest;
use App\Models\Employee;
use App\Models\Salary;
use App\Services\SalaryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class SalaryController extends Controller
{
    public function __construct(protected SalaryService $salaryService) {}

    /**
     * Display a listing of salary disbursement records.
     */
    public function index(Request $request): JsonResponse|View
    {
        if ($request->ajax() || $request->wantsJson()) {
            $query = Salary::query()->with('employee')->select('salaries.*');

            if ($request->filled('employee_id')) {
                $query->where('employee_id', $request->employee_id);
            }

            if ($request->filled('month_year')) {
                $query->where('month_year', $request->month_year);
            }

            if ($request->filled('payment_method')) {
                $query->where('payment_method', $request->payment_method);
            }

            if ($request->has('draw')) {
                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('slip_info', function ($row) {
                        $showUrl = route('admin.salaries.show', $row->id);
                        $dateStr = $row->payment_date ? $row->payment_date->format('M d, Y') : '-';

                        return '<div class="d-flex flex-column">
                            <a href="'.e($showUrl).'" class="fw-bold text-dark text-decoration-none table-title-link font-monospace" style="font-size: 13px;">'.e($row->salary_slip_number).'</a>
                            <span class="text-muted mt-1" style="font-size: 11px;"><i class="ri-calendar-line me-1"></i>'.$dateStr.'</span>
                        </div>';
                    })
                    ->addColumn('employee_name', function ($row) {
                        if ($row->employee) {
                            $empUrl = route('admin.employees.show', $row->employee->id);

                            return '<div class="d-flex flex-column">
                                <a href="'.e($empUrl).'" class="fw-semibold text-dark text-decoration-none" style="font-size: 13px;">'.e($row->employee->name).'</a>
                                <span class="text-muted" style="font-size: 11px;">'.e($row->employee->designation).' ('.e($row->employee->employee_id).')</span>
                            </div>';
                        }

                        return '<span class="text-muted">Staff Member</span>';
                    })
                    ->addColumn('period', function ($row) {
                        return '<span class="badge" style="background-color: #f1f5f9; color: #334155; font-size: 11.5px; padding: 4px 8px; border-radius: 4px;">'.e($row->month_year).'</span>';
                    })
                    ->addColumn('salary_breakdown', function ($row) {
                        return '<div class="d-flex flex-column" style="font-size: 11.5px;">
                            <span>Basic: ৳ '.number_format((float) $row->basic_amount, 2).'</span>
                            <span class="text-muted">Allow: ৳ '.number_format((float) $row->allowance, 2).' | Ded: ৳ '.number_format((float) $row->deductions, 2).'</span>
                        </div>';
                    })
                    ->addColumn('net_amount', function ($row) {
                        $methodBadge = '<span class="badge bg-light text-dark border ms-1" style="font-size: 10px;">'.e(strtoupper(str_replace('_', ' ', $row->payment_method))).'</span>';

                        return '<div class="d-flex flex-column">
                            <span class="fw-bold text-success" style="font-size: 13.5px;">৳ '.number_format((float) $row->net_paid_amount, 2).'</span>
                            <div class="mt-1">'.$methodBadge.'</div>
                        </div>';
                    })
                    ->addColumn('status_badge', function ($row) {
                        $badgeStyle = $row->status === 'paid'
                            ? 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;'
                            : 'background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a;';

                        return '<span class="badge" style="'.$badgeStyle.' font-size: 11px; padding: 4px 8px; border-radius: 4px; font-weight: 600;">'.e(ucfirst($row->status)).'</span>';
                    })
                    ->addColumn('action-btn', function ($row) {
                        return [
                            'id' => $row->id,
                            'name' => $row->salary_slip_number,
                        ];
                    })
                    ->rawColumns(['slip_info', 'employee_name', 'period', 'salary_breakdown', 'net_amount', 'status_badge', 'action-btn'])
                    ->make(true);
            }

            return response()->json([
                'success' => true,
                'data' => $query->latest('payment_date')->paginate(20),
            ]);
        }

        $employees = Employee::orderBy('name')->get();
        $paymentMethods = $this->salaryService->getPaymentMethods();

        return view('admin.salaries.index', compact('employees', 'paymentMethods'));
    }

    /**
     * Show form for creating a new salary voucher.
     */
    public function create(Request $request): View
    {
        $employees = Employee::where('employment_status', 'active')->orderBy('name')->get();
        $paymentMethods = $this->salaryService->getPaymentMethods();
        $selectedEmployee = $request->filled('employee_id') ? Employee::find($request->employee_id) : null;

        return view('admin.salaries.create', compact('employees', 'paymentMethods', 'selectedEmployee'));
    }

    /**
     * Store newly disbursed salary.
     */
    public function store(StoreSalaryRequest $request): RedirectResponse
    {
        $salary = $this->salaryService->store($request->validated());

        return redirect()->route('admin.salaries.show', $salary->id)
            ->with('success', 'Salary disbursement recorded successfully! Payslip generated.');
    }

    /**
     * Display printable payslip / salary voucher.
     */
    public function show(Salary $salary): View
    {
        $salary->load('employee');

        return view('admin.salaries.show', compact('salary'));
    }

    /**
     * Show form for editing salary disbursement.
     */
    public function edit(Salary $salary): View
    {
        $employees = Employee::orderBy('name')->get();
        $paymentMethods = $this->salaryService->getPaymentMethods();

        return view('admin.salaries.edit', compact('salary', 'employees', 'paymentMethods'));
    }

    /**
     * Update salary voucher.
     */
    public function update(UpdateSalaryRequest $request, Salary $salary): RedirectResponse
    {
        $this->salaryService->update($salary, $request->validated());

        return redirect()->route('admin.salaries.index')
            ->with('success', 'Salary record updated successfully!');
    }

    /**
     * Delete salary record.
     */
    public function destroy(Salary $salary): RedirectResponse
    {
        $this->salaryService->delete($salary);

        return redirect()->route('admin.salaries.index')
            ->with('success', 'Salary record deleted successfully!');
    }
}
