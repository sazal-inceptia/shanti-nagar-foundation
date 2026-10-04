<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreEmployeeRequest;
use App\Http\Requests\Admin\UpdateEmployeeRequest;
use App\Models\Designation;
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
            $query = Employee::query()->with('designation')->select('employees.*');

            if ($request->filled('is_active')) {
                $query->where('is_active', (bool) $request->is_active);
            }

            if ($request->filled('designation_id')) {
                $query->where('designation_id', $request->designation_id);
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
                    ->addColumn('designation_role', function ($row) {
                        $desig = $row->designation;
                        $desigName = ($desig instanceof Designation) ? $desig->name : (is_string($desig) ? $desig : '—');
                        $category = ($desig instanceof Designation) ? $desig->category : null;

                        $categoryHtml = $category
                            ? '<span class="badge mt-1" style="background-color: #f8fafc; color: #475569; font-size: 11px; font-weight: 500; border: 1px solid #cbd5e1; width: fit-content;"><i class="ri-folder-user-line me-1 text-primary"></i>'.e($category).'</span>'
                            : '';

                        return '<div class="d-flex flex-column align-items-start">
                            <span class="fw-semibold text-dark" style="font-size: 13px;">'.e($desigName).'</span>
                            '.$categoryHtml.'
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
                    ->addColumn('status_toggle', function ($row) {
                        $checked = $row->is_active ? 'checked' : '';
                        $toggleUrl = route('admin.employees.toggle-status', $row->id);
                        $badgeStyle = $row->is_active
                            ? 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;'
                            : 'background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca;';
                        $badgeText = $row->is_active ? 'Active' : 'Inactive';

                        return '<div class="d-flex align-items-center gap-2">
                            <div class="form-check form-switch m-0" style="min-height: auto;">
                                <input class="form-check-input status-toggle-switch" type="checkbox" role="switch"
                                    data-url="'.e($toggleUrl).'"
                                    data-id="'.$row->id.'"
                                    '.$checked.'
                                    style="cursor: pointer; width: 36px; height: 18px;">
                            </div>
                            <span class="badge" id="status-badge-'.$row->id.'" style="'.$badgeStyle.' font-size: 11px; padding: 4px 8px; border-radius: 4px; font-weight: 600;">
                                '.$badgeText.'
                            </span>
                        </div>';
                    })
                    ->addColumn('action-btn', function ($row) {
                        return [
                            'id' => $row->id,
                            'name' => $row->name.' ('.$row->employee_id.')',
                        ];
                    })
                    ->rawColumns(['photo_display', 'employee_info', 'designation_role', 'contact_info', 'formatted_salary', 'status_toggle', 'action-btn'])
                    ->make(true);
            }

            return response()->json([
                'success' => true,
                'data' => $query->latest('id')->paginate(20),
            ]);
        }

        $designations = $this->employeeService->getDesignations();

        return view('admin.employees.index', compact('designations'));
    }

    /**
     * Show form for creating a new employee profile.
     */
    public function create(): View
    {
        $suggestedEmployeeId = $this->employeeService->generateEmployeeId();
        $designations = $this->employeeService->getDesignations();

        return view('admin.employees.create', compact('suggestedEmployeeId', 'designations'));
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
        $employee->load([
            'designation',
            'salaries' => function ($q) {
                $q->latest('payment_date');
            },
        ]);

        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show form for editing employee profile.
     */
    public function edit(Employee $employee): View
    {
        $designations = $this->employeeService->getDesignations();

        return view('admin.employees.edit', compact('employee', 'designations'));
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
     * Toggle active/inactive status of an employee.
     */
    public function toggleStatus(Employee $employee): JsonResponse
    {
        $employee->update([
            'is_active' => ! $employee->is_active,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Staff status changed to '.($employee->is_active ? 'Active' : 'Inactive').' successfully.',
            'is_active' => $employee->is_active,
        ]);
    }

    /**
     * Soft delete employee.
     */
    public function destroy(Employee $employee): RedirectResponse
    {
        $this->employeeService->delete($employee);

        return redirect()->route('admin.employees.index')
            ->with('success', 'Staff profile archived successfully.');
    }
}
