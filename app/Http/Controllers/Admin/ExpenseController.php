<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ExpenseCategory;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreExpenseRequest;
use App\Http\Requests\Admin\UpdateExpenseRequest;
use App\Models\Expense;
use App\Models\Project;
use App\Services\ExpenseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ExpenseController extends Controller
{
    public function __construct(protected ExpenseService $expenseService)
    {
    }

    /**
     * Display a listing of expenses with server-side DataTable.
     */
    public function index(Request $request): JsonResponse|View
    {
        if ($request->ajax() || $request->wantsJson()) {
            $query = Expense::query()->with(['project', 'creator'])->select('expenses.*');

            if ($request->filled('expense_category')) {
                $query->where('expense_category', $request->expense_category);
            }

            if ($request->filled('project_id')) {
                $query->where('project_id', $request->project_id);
            }

            if ($request->filled('payment_method')) {
                $query->where('payment_method', $request->payment_method);
            }

            if ($request->has('draw')) {
                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('voucher_info', function ($row) {
                        $showUrl = route('admin.expenses.show', $row->id);
                        $dateStr = $row->expense_date ? $row->expense_date->format('M d, Y') : '-';

                        return '<div class="d-flex flex-column">
                            <a href="' . e($showUrl) . '" class="fw-bold text-dark text-decoration-none table-title-link font-monospace" style="font-size: 13.5px;">' . e($row->voucher_number) . '</a>
                            <span class="text-muted mt-1" style="font-size: 11px;"><i class="ri-calendar-line me-1"></i>' . $dateStr . '</span>
                        </div>';
                    })
                    ->addColumn('expense_title', function ($row) {
                        $vendor = $row->recipient_or_vendor ? '<span class="text-muted" style="font-size: 11px;">To: ' . e($row->recipient_or_vendor) . '</span>' : '';

                        return '<div class="d-flex flex-column">
                            <span class="fw-semibold text-dark" style="font-size: 13px;">' . e($row->title) . '</span>
                            ' . $vendor . '
                        </div>';
                    })
                    ->addColumn('category_badge', function ($row) {
                        $catEnum = ExpenseCategory::tryFrom($row->expense_category);
                        $badgeStyle = $catEnum ? $catEnum->badgeStyle() : 'background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1;';

                        return '<span class="badge" style="' . $badgeStyle . ' font-size: 11px; padding: 4px 8px; border-radius: 4px; font-weight: 600;">' . e($row->expense_category) . '</span>';
                    })
                    ->addColumn('project_title', function ($row) {
                        if ($row->project) {
                            $projectUrl = route('admin.projects.show', $row->project->id);

                            return '<a href="' . e($projectUrl) . '" class="badge text-start d-inline-block" style="color: #334155; font-size: 11.5px; padding: 5px 8px; border-radius: 4px; text-decoration: none; white-space: normal; line-height: 1.35; width: 100%; max-width: 220px;" title="' . e($row->project->name) . '">' . e($row->project->name) . '</a>';
                        }

                        return '<span class="badge text-start d-inline-block" style="background-color: #f8fafc; color: #64748b; border: 1px solid #e2e8f0; font-size: 11.5px; padding: 5px 8px; border-radius: 4px; white-space: normal; line-height: 1.35;">Office &amp; Administrative</span>';
                    })
                    ->addColumn('formatted_amount', function ($row) {
                        $methodBadge = '<span class="badge bg-light text-dark border ms-1" style="font-size: 10px;">' . e(strtoupper($row->payment_method)) . '</span>';

                        return '<div class="d-flex flex-column">
                            <span class="fw-bold text-danger" style="font-size: 13.5px;">৳ ' . number_format((float) $row->amount, 2) . '</span>
                            <div class="mt-1">' . $methodBadge . '</div>
                        </div>';
                    })
                    ->addColumn('action-btn', function ($row) {
                        return [
                            'id' => $row->id,
                            'name' => $row->voucher_number,
                        ];
                    })
                    ->rawColumns(['voucher_info', 'expense_title', 'category_badge', 'project_title', 'formatted_amount', 'action-btn'])
                    ->make(true);
            }

            return response()->json([
                'success' => true,
                'data' => $query->latest('expense_date')->paginate(20),
            ]);
        }

        $categories = $this->expenseService->getCategories();
        $paymentMethods = $this->expenseService->getPaymentMethods();
        $projects = Project::orderBy('name')->get();

        return view('admin.expenses.index', compact('categories', 'paymentMethods', 'projects'));
    }

    /**
     * Show the form for creating a new expense.
     */
    public function create(): View
    {
        $projects = Project::orderBy('name')->get();
        $categories = $this->expenseService->getCategories();
        $paymentMethods = $this->expenseService->getPaymentMethods();
        $suggestedVoucherNumber = $this->expenseService->generateVoucherNumber();

        return view('admin.expenses.create', compact('projects', 'categories', 'paymentMethods', 'suggestedVoucherNumber'));
    }

    /**
     * Store a newly created expense voucher.
     */
    public function store(StoreExpenseRequest $request): RedirectResponse
    {
        $expense = $this->expenseService->store($request->validated());

        return redirect()->route('admin.expenses.show', $expense->id)
            ->with('success', 'Expense voucher recorded successfully!');
    }

    /**
     * Display the specified expense and printable voucher.
     */
    public function show(Expense $expense): View
    {
        $expense->load(['project', 'creator']);

        return view('admin.expenses.show', compact('expense'));
    }

    /**
     * Show form for editing expense.
     */
    public function edit(Expense $expense): View
    {
        $projects = Project::orderBy('name')->get();
        $categories = $this->expenseService->getCategories();
        $paymentMethods = $this->expenseService->getPaymentMethods();

        return view('admin.expenses.edit', compact('expense', 'projects', 'categories', 'paymentMethods'));
    }

    /**
     * Update the specified expense record.
     */
    public function update(UpdateExpenseRequest $request, Expense $expense): RedirectResponse
    {
        $this->expenseService->update($expense, $request->validated());

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Expense voucher updated successfully!');
    }

    /**
     * Delete the specified expense.
     */
    public function destroy(Expense $expense): RedirectResponse
    {
        $this->expenseService->delete($expense);

        return redirect()->route('admin.expenses.index')
            ->with('success', 'Expense voucher deleted successfully!');
    }
}
