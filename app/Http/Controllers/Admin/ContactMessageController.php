<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class ContactMessageController extends Controller
{
    /**
     * Display a listing of contact inquiries.
     */
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            $query = ContactMessage::query()->latest();

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('name', function (ContactMessage $msg) {
                    return sprintf(
                        '<div><strong class="text-dark">%s</strong><div class="text-muted" style="font-size: 11px;">%s</div></div>',
                        e($msg->name),
                        e($msg->phone ?? 'No phone')
                    );
                })
                ->editColumn('message', function (ContactMessage $msg) {
                    return sprintf(
                        '<div><strong class="text-dark d-block mb-1" style="font-size: 12.5px;">%s</strong><span class="text-muted" style="font-size: 12px;">%s</span></div>',
                        e($msg->subject ?: 'No Subject'),
                        e(mb_strimwidth($msg->message, 0, 100, '...'))
                    );
                })
                ->editColumn('status', function (ContactMessage $msg) {
                    $badges = [
                        'unread' => 'bg-danger text-white',
                        'read' => 'bg-info text-dark',
                        'replied' => 'bg-success text-white',
                    ];
                    $badgeClass = $badges[$msg->status] ?? 'bg-secondary text-white';

                    return sprintf('<span class="badge %s" style="font-size: 11px; padding: 4px 8px;">%s</span>', $badgeClass, ucfirst($msg->status));
                })
                ->editColumn('created_at', function (ContactMessage $msg) {
                    return $msg->created_at ? $msg->created_at->format('M d, Y h:i A') : '-';
                })
                ->addColumn('action', function (ContactMessage $msg) {
                    $toggleUrl = route('admin.contacts.toggle-status', $msg->id);
                    $deleteUrl = route('admin.contacts.destroy', $msg->id);
                    $csrf = csrf_field();
                    $deleteMethod = method_field('DELETE');

                    $toggleBtn = $msg->status === 'unread'
                        ? sprintf('<form action="%s" method="POST" class="d-inline">%s<input type="hidden" name="status" value="read"><button type="submit" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="Mark as Read" style="padding: 2px 8px; font-size: 12px;"><i class="ri-check-line"></i> Read</button></form>', $toggleUrl, $csrf)
                        : sprintf('<form action="%s" method="POST" class="d-inline">%s<input type="hidden" name="status" value="replied"><button type="submit" class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip" title="Mark as Replied" style="padding: 2px 8px; font-size: 12px;"><i class="ri-reply-line"></i> Replied</button></form>', $toggleUrl, $csrf);

                    $deleteBtn = sprintf(
                        '<form action="%s" method="POST" class="d-inline" onsubmit="return confirm(\'Are you sure you want to delete this message?\');">%s%s<button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Delete" style="padding: 2px 8px; font-size: 12px;"><i class="ri-delete-bin-line"></i></button></form>',
                        $deleteUrl,
                        $csrf,
                        $deleteMethod
                    );

                    return sprintf('<div class="d-flex align-items-center gap-1">%s %s</div>', $toggleBtn, $deleteBtn);
                })
                ->rawColumns(['name', 'message', 'status', 'action'])
                ->make(true);
        }

        return view('admin.contacts.index');
    }

    /**
     * Toggle status of the message.
     */
    public function toggleStatus(Request $request, ContactMessage $contact): RedirectResponse
    {
        $status = $request->get('status', 'read');
        $contact->update([
            'status' => $status,
            'replied_at' => $status === 'replied' ? now() : $contact->replied_at,
        ]);

        return redirect()->back()->with('success', 'Message status updated to '.ucfirst($status).'.');
    }

    /**
     * Remove the specified message.
     */
    public function destroy(ContactMessage $contact): RedirectResponse
    {
        $contact->delete();

        return redirect()->back()->with('success', 'Contact inquiry message deleted successfully.');
    }
}
