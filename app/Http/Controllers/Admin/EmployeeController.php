<?php

namespace App\Http\Controllers\Admin;

use App\Enums\EmploymentStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEmployeeRequest;
use App\Http\Requests\Admin\UpdateEmployeeRequest;
use App\Models\Employee;
use App\Services\EmployeeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    public function __construct(protected EmployeeService $employeeService) {}

    /**
     * Display a listing of employees with server-side DataTable.
     */
    public function index(Request $request): JsonResponse|View
    {
        if ($request->ajax() || $request->wantsJson()) {
            $query = Employee::query()->select('employees.*');

            if ($request->filled('employment_status')) {
                $query->where('employment_status', $request->employment_status);
            }

            if ($request->filled('department')) {
                $query->where('department', $request->department);
            }

            if ($request->has('draw')) {
                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('photo_display', function ($row) {
                        $photoUrl = $row->photo && file_exists(public_path($row->photo))
                            ? asset($row->photo)
                            : null;

                        if ($photoUrl) {
                            return '<img src="'.e($photoUrl).'" alt="'.e($row->name).'" class="rounded-circle border" style="width: 40px; height: 40px; object-fit: cover;">';
                        }

                        $initial = strtoupper(substr($row->name, 0, 1));

                        return '<div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 40px; height: 40px; background-color: #f65024; font-size: 14px;">'.$initial.'</div>';
                    })
                    ->addColumn('employee_info', function ($row) {
                        $showUrl = route('admin.employees.show', $row->id);

                        return '<div class="d-flex flex-column">
                            <a href="'.e($showUrl).'" class="fw-bold text-dark text-decoration-none table-title-link" style="font-size: 13.5px;">'.e($row->name).'</a>
                            <span class="text-muted font-monospace" style="font-size: 11px;">'.e($row->employee_id).'</span>
                        </div>';
                    })
                    ->addColumn('role_department', function ($row) {
                        return '<div class="d-flex flex-column">
                            <span class="fw-semibold text-dark" style="font-size: 12.5px;">'.e($row->designation).'</span>
                            <span class="text-muted" style="font-size: 11px;">'.e($row->department).'</span>
                        </div>';
                    })
                    ->addColumn('contact_info', function ($row) {
                        $phone = $row->phone ? '<span><i class="ri-phone-line me-1"></i>'.e($row->phone).'</span>' : '';
                        $email = $row->email ? '<span class="text-muted" style="font-size: 11px;"><i class="ri-mail-line me-1"></i>'.e($row->email).'</span>' : '';

                        return '<div class="d-flex flex-column" style="font-size: 12px;">'.$phone.$email.'</div>';
                    })
                    ->addColumn('formatted_salary', function ($row) {
                        return '<span class="fw-bold text-dark" style="font-size: 13.5px;">৳ '.number_format((float) $row->base_salary, 2).'</span>';
                    })
                    ->addColumn('status_badge', function ($row) {
                        $statusEnum = EmploymentStatus::tryFrom($row->employment_status);
                        $badgeStyle = $statusEnum ? $statusEnum->badgeStyle() : 'background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1;';
                        $label = $statusEnum ? $statusEnum->label() : ucfirst($row->employment_status);

                        return '<span class="badge" style="'.$badgeStyle.' font-size: 11px; padding: 4px 8px; border-radius: 4px; font-weight: 600;">'.e($label).'</span>';
                    })
                    ->addColumn('action-btn', function ($row) {
                        return [
                            'id' => $row->id,
                            'name' => $row->name.' ('.$row->employee_id.')',
                        ];
                    })
                    ->rawColumns(['photo_display', 'employee_info', 'role_department', 'contact_info', 'formatted_salary', 'status_badge', 'action-btn'])
                    ->make(true);
            }

            return response()->json([
                'success' => true,
                'data' => $query->latest('id')->paginate(20),
            ]);
        }

        $statuses = $this->employeeService->getStatuses();
        $departments = $this->employeeService->getDepartments();

        return view('admin.employees.index', compact('statuses', 'departments'));
    }

    /**
     * Show form for creating a new employee profile.
     */
    public function create(): View
    {
        $suggestedEmployeeId = $this->employeeService->generateEmployeeId();
        $departments = $this->employeeService->getDepartments();
        $statuses = $this->employeeService->getStatuses();

        return view('admin.employees.create', compact('suggestedEmployeeId', 'departments', 'statuses'));
    }

    /**
     * Store a newly created employee.
     */
    public function store(StoreEmployeeRequest $request): RedirectResponse
    {
        $employee = $this->employeeService->store($request->validated());

        return redirect()->route('admin.employees.show', $employee->id)
            ->with('success', 'Staff profile registered successfully!');
    }

    /**
     * Display the specified employee profile with salary ledger.
     */
    public function show(Employee $employee): View
    {
        $employee->load(['salaries' => function ($q) {
            $q->latest('payment_date');
        }]);

        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show form for editing employee profile.
     */
    public function edit(Employee $employee): View
    {
        $departments = $this->employeeService->getDepartments();
        $statuses = $this->employeeService->getStatuses();

        return view('admin.employees.edit', compact('employee', 'departments', 'statuses'));
    }

    /**
     * Update employee profile.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee): RedirectResponse
    {
        $this->employeeService->update($employee, $request->validated());

        return redirect()->route('admin.employees.index')
            ->with('success', 'Staff profile updated successfully!');
    }

    /**
     * Soft delete employee.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $this->employeeService->delete($employee);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Staff profile archived successfully!');
    }
}
