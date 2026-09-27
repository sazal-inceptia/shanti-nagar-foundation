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
                        e($vol->age_group ? 'Age: '.$vol->age_group : 'Age: N/A')
                    );
                })
                ->editColumn('contact', function (Volunteer $vol) {
                    return sprintf(
                        '<div><a href="mailto:%s" class="text-decoration-none text-dark">%s</a><div class="text-muted" style="font-size: 11px;">%s</div></div>',
                        e($vol->email),
                        e($vol->email),
                        e($vol->phone)
                    );
                })
                ->editColumn('address', function (Volunteer $vol) {
                    return sprintf('<span class="text-muted" style="font-size: 12px;">%s</span>', e(mb_strimwidth($vol->address ?? 'N/A', 0, 80, '...')));
                })
                ->editColumn('status', function (Volunteer $vol) {
                    $badges = [
                        'pending' => 'bg-warning text-dark',
                        'approved' => 'bg-success text-white',
                        'rejected' => 'bg-danger text-white',
                    ];
                    $badgeClass = $badges[$vol->status] ?? 'bg-secondary text-white';

                    return sprintf('<span class="badge %s" style="font-size: 11px; padding: 4px 8px;">%s</span>', $badgeClass, ucfirst($vol->status));
                })
                ->editColumn('created_at', function (Volunteer $vol) {
                    return $vol->created_at ? $vol->created_at->format('M d, Y') : '-';
                })
                ->addColumn('action', function (Volunteer $vol) {
                    $approveUrl = route('admin.volunteers.toggle-status', ['volunteer' => $vol->id, 'status' => 'approved']);
                    $rejectUrl = route('admin.volunteers.toggle-status', ['volunteer' => $vol->id, 'status' => 'rejected']);
                    $deleteUrl = route('admin.volunteers.destroy', $vol->id);
                    $csrf = csrf_field();
                    $deleteMethod = method_field('DELETE');

                    $approveBtn = sprintf(
                        '<form action="%s" method="POST" class="d-inline">%s<button type="submit" class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip" title="Approve" style="padding: 2px 7px; font-size: 12px;"><i class="ri-check-line"></i></button></form>',
                        $approveUrl,
                        $csrf
                    );

                    $rejectBtn = sprintf(
                        '<form action="%s" method="POST" class="d-inline">%s<button type="submit" class="btn btn-sm btn-outline-warning" data-bs-toggle="tooltip" title="Reject" style="padding: 2px 7px; font-size: 12px;"><i class="ri-close-line"></i></button></form>',
                        $rejectUrl,
                        $csrf
                    );

                    $deleteBtn = sprintf(
                        '<form action="%s" method="POST" class="d-inline" onsubmit="return confirm(\'Are you sure you want to delete this volunteer record?\');">%s%s<button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Delete" style="padding: 2px 7px; font-size: 12px;"><i class="ri-delete-bin-line"></i></button></form>',
                        $deleteUrl,
                        $csrf,
                        $deleteMethod
                    );

                    return sprintf('<div class="d-flex align-items-center gap-1">%s %s %s</div>', $approveBtn, $rejectBtn, $deleteBtn);
                })
                ->rawColumns(['name', 'contact', 'address', 'status', 'action'])
                ->make(true);
        }

        return view('admin.volunteers.index');
    }

    /**
     * Toggle approval status of volunteer.
     */
    public function toggleStatus(Request $request, Volunteer $volunteer): RedirectResponse
    {
        $status = $request->get('status', 'approved');
        $volunteer->update(['status' => $status]);

        return redirect()->back()->with('success', 'Volunteer status updated to '.ucfirst($status).'.');
    }

    /**
     * Remove the specified volunteer record.
     */
    public function destroy(Volunteer $volunteer): RedirectResponse
    {
        $volunteer->delete();

        return redirect()->back()->with('success', 'Volunteer registration deleted successfully.');
    }
}
