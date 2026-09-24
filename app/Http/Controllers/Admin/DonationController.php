<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDonationRequest;
use App\Http\Requests\Admin\UpdateDonationRequest;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\Project;
use App\Services\DonationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class DonationController extends Controller
{
    public function __construct(protected DonationService $donationService) {}

    /**
     * Display a listing of donations with server-side DataTable.
     */
    public function index(Request $request): JsonResponse|View
    {
        if ($request->ajax() || $request->wantsJson()) {
            $query = Donation::query()->with(['donor', 'project'])->select('donations.*');

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('payment_method')) {
                $query->where('payment_method', $request->payment_method);
            }

            if ($request->filled('project_id')) {
                $query->where('project_id', $request->project_id);
            }

            if ($request->has('draw')) {
                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('receipt_info', function ($row) {
                        $showUrl = route('admin.donations.show', $row->id);
                        $dateStr = $row->donation_date ? $row->donation_date->format('M d, Y') : '-';

                        return '<div class="d-flex flex-column">
                            <a href="'.e($showUrl).'" class="fw-bold text-dark text-decoration-none table-title-link font-monospace" style="font-size: 13.5px;">'.e($row->receipt_number).'</a>
                            <span class="text-muted mt-1" style="font-size: 11px;"><i class="ri-calendar-line me-1"></i>'.$dateStr.'</span>
                        </div>';
                    })
                    ->addColumn('donor_name', function ($row) {
                        if ($row->donor) {
                            $donorUrl = route('admin.donors.show', $row->donor->id);

                            return '<div class="d-flex flex-column">
                                <a href="'.e($donorUrl).'" class="fw-semibold text-dark text-decoration-none" style="font-size: 13px; width: 100%; height:auto;">'.e($row->donor->name).'</a>
                                <span class="text-muted" style="font-size: 11px;">'.e($row->donor->phone ?: 'No phone').'</span>
                            </div>';
                        }

                        return '<span class="text-muted" style="font-size: 12.5px;">Anonymous Well-wisher</span>';
                    })
                    ->addColumn('project_title', function ($row) {
                        if ($row->project) {
                            $projectUrl = route('admin.projects.show', $row->project->id);

                            return '<a href="'.e($projectUrl).'" class="badge" style="background-color: #f1f5f9; color: #334155; font-size: 11.5px; padding: 4px 8px; border-radius: 4px; text-decoration: none; width: 100%; height:auto; justify-content: flex-start;">'.e($row->project->name).'</a>';
                        }

                        return '<span class="badge" style="background-color: #ecfdf5; color: #065f46; font-size: 11px; padding: 4px 8px; border-radius: 4px;">General Relief Fund</span>';
                    })
                    ->addColumn('formatted_amount', function ($row) {
                        $methodBadge = '<span class="badge bg-light text-dark border ms-1" style="font-size: 10px;">'.e(strtoupper($row->payment_method)).'</span>';

                        return '<div class="d-flex flex-column">
                            <span class="fw-bold text-success" style="font-size: 13.5px;">৳ '.number_format((float) $row->amount, 2).'</span>
                            <div class="mt-1">'.$methodBadge.'</div>
                        </div>';
                    })
                    ->addColumn('status_badge', function ($row) {
                        $badgeStyle = match ($row->status) {
                            'completed' => 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;',
                            'pending' => 'background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a;',
                            'cancelled' => 'background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca;',
                            default => 'background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;',
                        };

                        return '<span class="badge" style="'.$badgeStyle.' font-size: 11px; padding: 4px 8px; border-radius: 4px; font-weight: 600;">'.e(ucfirst((string) $row->status)).'</span>';
                    })
                    ->addColumn('action-btn', function ($row) {
                        return [
                            'id' => $row->id,
                            'name' => $row->receipt_number,
                        ];
                    })
                    ->rawColumns(['receipt_info', 'donor_name', 'project_title', 'formatted_amount', 'status_badge', 'action-btn'])
                    ->make(true);
            }

            return response()->json([
                'success' => true,
                'data' => $query->latest('donation_date')->paginate(20),
            ]);
        }

        $paymentMethods = $this->donationService->getPaymentMethods();
        $statuses = $this->donationService->getStatuses();
        $projects = Project::orderBy('name')->get();

        return view('admin.donations.index', compact('paymentMethods', 'statuses', 'projects'));
    }

    /**
     * Show the form for creating a new donation.
     */
    public function create(): View
    {
        $donors = Donor::orderBy('name')->get();
        $projects = Project::orderBy('name')->get();
        $paymentMethods = $this->donationService->getPaymentMethods();
        $statuses = $this->donationService->getStatuses();
        $suggestedReceiptNumber = $this->donationService->generateReceiptNumber();

        return view('admin.donations.create', compact('donors', 'projects', 'paymentMethods', 'statuses', 'suggestedReceiptNumber'));
    }

    /**
     * Store a newly created donation.
     */
    public function store(StoreDonationRequest $request): RedirectResponse
    {
        $donation = $this->donationService->store($request->validated());

        return redirect()->route('admin.donations.show', $donation->id)
            ->with('success', 'Donation recorded successfully! Receipt generated.');
    }

    /**
     * Display the specified donation and official printable receipt.
     */
    public function show(Donation $donation): View
    {
        $donation->load(['donor', 'project']);

        return view('admin.donations.show', compact('donation'));
    }

    /**
     * Show form for editing donation.
     */
    public function edit(Donation $donation): View
    {
        $donors = Donor::orderBy('name')->get();
        $projects = Project::orderBy('name')->get();
        $paymentMethods = $this->donationService->getPaymentMethods();
        $statuses = $this->donationService->getStatuses();

        return view('admin.donations.edit', compact('donation', 'donors', 'projects', 'paymentMethods', 'statuses'));
    }

    /**
     * Update donation.
     */
    public function update(UpdateDonationRequest $request, Donation $donation): RedirectResponse
    {
        $this->donationService->update($donation, $request->validated());

        return redirect()->route('admin.donations.index')
            ->with('success', 'Donation record updated successfully!');
    }

    /**
     * Delete donation.
     */
    public function destroy(Donation $donation): RedirectResponse
    {
        $this->donationService->delete($donation);

        return redirect()->route('admin.donations.index')
            ->with('success', 'Donation deleted successfully!');
    }
}
