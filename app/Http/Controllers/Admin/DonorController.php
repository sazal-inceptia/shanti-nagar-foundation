<?php

namespace App\Http\Controllers\Admin;

use App\Enums\DonorType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDonorRequest;
use App\Http\Requests\Admin\UpdateDonorRequest;
use App\Models\Donor;
use App\Services\DonorService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class DonorController extends Controller
{
    public function __construct(protected DonorService $donorService) {}

    /**
     * Display a listing of donors with server-side DataTable.
     */
    public function index(Request $request): JsonResponse|View
    {
        if ($request->ajax() || $request->wantsJson()) {
            $query = Donor::query()->with('donations')->select('donors.*');

            if ($request->filled('donor_type')) {
                $query->where('donor_type', $request->donor_type);
            }

            if ($request->has('draw')) {
                return DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('donor_info', function ($row) {
                        $showUrl = route('admin.donors.show', $row->id);
                        $phoneHtml = $row->phone ? '<span class="text-muted" style="font-size: 11.5px;"><i class="ri-phone-line text-success me-1"></i>'.e($row->phone).'</span>' : '';
                        $emailHtml = $row->email ? '<span class="text-muted ms-2" style="font-size: 11.5px;"><i class="ri-mail-line text-primary me-1"></i>'.e($row->email).'</span>' : '';
                        $anonymousBadge = $row->is_anonymous ? '<span class="badge bg-secondary ms-1" style="font-size: 10px;">Anonymous</span>' : '';

                        return '<div class="d-flex flex-column">
                            <div class="d-flex align-items-center">
                                <a href="'.e($showUrl).'" class="fw-bold text-dark text-decoration-none table-title-link" style="font-size: 13.5px;">'.e($row->name).'</a>
                                '.$anonymousBadge.'
                            </div>
                            <div class="d-flex align-items-center mt-1 flex-wrap">
                                '.$phoneHtml.'
                                '.$emailHtml.'
                            </div>
                        </div>';
                    })
                    ->addColumn('type_badge', function ($row) {
                        $donorType = $row->donor_type instanceof DonorType
                            ? $row->donor_type
                            : DonorType::tryFrom((string) $row->donor_type) ?? DonorType::Individual;

                        return '<span class="badge" style="'.$donorType->badgeStyle().' font-size: 11px; padding: 4px 8px; border-radius: 4px; font-weight: 600;">'.e($donorType->label()).'</span>';
                    })
                    ->addColumn('total_contributions', function ($row) {
                        $count = $row->donations->where('status', 'completed')->count();
                        $sum = $row->donations->where('status', 'completed')->sum('amount');

                        return '<div class="d-flex flex-column">
                            <span class="fw-bold text-success" style="font-size: 13px;">৳ '.number_format((float) $sum, 2).'</span>
                            <span class="text-muted" style="font-size: 11px;">'.$count.' donation(s)</span>
                        </div>';
                    })
                    ->addColumn('location', function ($row) {
                        return '<span class="text-dark" style="font-size: 12.5px;">'.e($row->city ?: 'Dhaka, Bangladesh').'</span>';
                    })
                    ->addColumn('action-btn', function ($row) {
                        return [
                            'id' => $row->id,
                            'name' => $row->name,
                        ];
                    })
                    ->rawColumns(['donor_info', 'type_badge', 'total_contributions', 'location', 'action-btn'])
                    ->make(true);
            }

            return response()->json([
                'success' => true,
                'data' => $query->latest()->paginate(20),
            ]);
        }

        $donorTypes = $this->donorService->getDonorTypes();

        return view('admin.donors.index', compact('donorTypes'));
    }

    /**
     * Show form for creating a new donor.
     */
    public function create(): View
    {
        $donorTypes = $this->donorService->getDonorTypes();

        return view('admin.donors.create', compact('donorTypes'));
    }

    /**
     * Store newly created donor.
     */
    public function store(StoreDonorRequest $request): RedirectResponse
    {
        $this->donorService->store($request->validated());

        return redirect()->route('admin.donors.index')
            ->with('success', 'Donor registered successfully!');
    }

    /**
     * Display donor profile & donation history.
     */
    public function show(Donor $donor): View
    {
        $donor->load(['donations' => fn ($q) => $q->with('project')->latest('donation_date')]);

        return view('admin.donors.show', compact('donor'));
    }

    /**
     * Show form for editing donor.
     */
    public function edit(Donor $donor): View
    {
        $donorTypes = $this->donorService->getDonorTypes();

        return view('admin.donors.edit', compact('donor', 'donorTypes'));
    }

    /**
     * Update donor.
     */
    public function update(UpdateDonorRequest $request, Donor $donor): RedirectResponse
    {
        $this->donorService->update($donor, $request->validated());

        return redirect()->route('admin.donors.index')
            ->with('success', 'Donor profile updated successfully!');
    }

    /**
     * Remove donor.
     */
    public function destroy(Donor $donor): RedirectResponse
    {
        $this->donorService->delete($donor);

        return redirect()->route('admin.donors.index')
            ->with('success', 'Donor removed successfully!');
    }
}
