<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Volunteer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class VolunteerController extends Controller
{
    /**
     * Display a listing of volunteer registrations.
     */
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $query = Volunteer::query()->latest();

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('gender')) {
                $query->where('gender', $request->gender);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('name', function (Volunteer $vol) {
                    return sprintf(
                        '<div><strong class="text-dark">%s</strong><div class="text-muted" style="font-size: 11px;">%s &bull; %s</div></div>',
                        e($vol->name),
                        e($vol->gender ?? 'N/A'),
                        e($vol->age_group ? 'Age: ' . $vol->age_group : 'Age: N/A')
                    );
                })
                ->editColumn('contact', function (Volunteer $vol) {
                    return sprintf(
                        '<div><span class="text-primary text-decoration-none fw-semibold" style="font-size: 12.5px;">%s</span><div class="text-muted" style="font-size: 11px;"><i class="ri-phone-line me-1"></i>%s</div></div>',
                        e($vol->email),
                        e($vol->email),
                        e($vol->phone)
                    );
                })
                ->editColumn('address', function (Volunteer $vol) {
                    return sprintf('<span class="text-muted" style="font-size: 12px;">%s</span>', e(mb_strimwidth($vol->address ?? 'N/A', 0, 70, '...')));
                })
                ->editColumn('status', function (Volunteer $vol) {
                    if ($vol->status === 'approved') {
                        return '<span class="badge" style="background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; font-size: 11px; padding: 4px 8px; font-weight: 600;"><i class="ri-checkbox-circle-line me-1"></i>Approved</span>';
                    }

                    return '<span class="badge" style="background-color: #fffbeb; color: #b45309; border: 1px solid #fde68a; font-size: 11px; padding: 4px 8px; font-weight: 600;"><i class="ri-time-line me-1"></i>Pending</span>';
                })
                ->editColumn('created_at', function (Volunteer $vol) {
                    return $vol->created_at ? $vol->created_at->format('M d, Y') : '-';
                })
                ->addColumn('action', function (Volunteer $vol) {
                    $showUrl = route('admin.volunteers.show', $vol->id);
                    $deleteUrl = route('admin.volunteers.destroy', $vol->id);

                    $viewBtn = sprintf(
                        '<button type="button" class="btn btn-view btn-view-volunteer" data-id="%d" data-url="%s" data-bs-toggle="tooltip" title="View Application Details"><i class="ri-eye-line"></i></button>',
                        $vol->id,
                        $showUrl
                    );

                    $deleteBtn = sprintf(
                        '<button type="button" class="btn btn-delete btn-delete-volunteer" data-id="%d" data-title="%s" data-url="%s" data-bs-toggle="tooltip" title="Delete"><i class="ri-delete-bin-line"></i></button>',
                        $vol->id,
                        e($vol->name),
                        $deleteUrl
                    );

                    return sprintf('<div class="action-btn justify-content-center">%s %s</div>', $viewBtn, $deleteBtn);
                })
                ->rawColumns(['name', 'contact', 'address', 'status', 'action'])
                ->make(true);
        }

        return view('admin.volunteers.index');
    }

    /**
     * Display the specified volunteer application details.
     */
    public function show(Volunteer $volunteer): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $volunteer->id,
                'name' => $volunteer->name,
                'email' => $volunteer->email,
                'phone' => $volunteer->phone,
                'gender' => $volunteer->gender ?? 'Not specified',
                'age_group' => $volunteer->age_group ? 'Age: ' . $volunteer->age_group : 'Not specified',
                'address' => $volunteer->address ?: 'Not provided',
                'notes' => $volunteer->notes ?: 'No special notes or event specified.',
                'status' => $volunteer->status,
                'applied_at' => $volunteer->created_at ? $volunteer->created_at->format('M d, Y h:i A') : '-',
            ],
        ]);
    }

    /**
     * Toggle approval status of volunteer between approved and pending.
     */
    public function toggleStatus(Request $request, Volunteer $volunteer): JsonResponse|RedirectResponse
    {
        $newStatus = $request->get('status');
        if (!in_array($newStatus, ['approved', 'pending'])) {
            $newStatus = $volunteer->status === 'approved' ? 'pending' : 'approved';
        }

        $volunteer->update(['status' => $newStatus]);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'status' => $newStatus,
                'message' => 'Volunteer status updated to ' . ucfirst($newStatus) . '.',
            ]);
        }

        return redirect()->back()->with('success', 'Volunteer status updated to ' . ucfirst($newStatus) . '.');
    }

    /**
     * Remove the specified volunteer record.
     */
    public function destroy(Volunteer $volunteer): RedirectResponse
    {
        $volunteer->delete();

        return redirect()->back()->with('success', 'Volunteer record deleted successfully.');
    }
}
