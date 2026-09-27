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
                        e(mb_strimwidth($msg->message, 0, 90, '...'))
                    );
                })
                ->editColumn('status', function (ContactMessage $msg) {
                    if ($msg->status === 'read') {
                        return '<span class="badge" style="background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; font-size: 11px; padding: 4px 8px; font-weight: 600;"><i class="ri-check-double-line me-1"></i>Read</span>';
                    }

                    return '<span class="badge" style="background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca; font-size: 11px; padding: 4px 8px; font-weight: 600;"><i class="ri-mail-unread-line me-1"></i>Unread</span>';
                })
                ->editColumn('created_at', function (ContactMessage $msg) {
                    return $msg->created_at ? $msg->created_at->format('M d, Y h:i A') : '-';
                })
                ->addColumn('action', function (ContactMessage $msg) {
                    $showUrl = route('admin.contacts.show', $msg->id);
                    $deleteUrl = route('admin.contacts.destroy', $msg->id);

                    $viewBtn = sprintf(
                        '<button type="button" class="btn btn-view btn-view-contact" data-id="%d" data-url="%s" data-bs-toggle="tooltip" title="View Full Message"><i class="ri-eye-line"></i></button>',
                        $msg->id,
                        $showUrl
                    );

                    $deleteBtn = sprintf(
                        '<button type="button" class="btn btn-delete btn-delete-contact" data-id="%d" data-title="%s" data-url="%s" data-bs-toggle="tooltip" title="Delete"><i class="ri-delete-bin-line"></i></button>',
                        $msg->id,
                        e($msg->name),
                        $deleteUrl
                    );

                    return sprintf('<div class="action-btn justify-content-center">%s %s</div>', $viewBtn, $deleteBtn);
                })
                ->rawColumns(['name', 'message', 'status', 'action'])
                ->make(true);
        }

        return view('admin.contacts.index');
    }

    /**
     * Display the specified message and automatically mark it as read.
     */
    public function show(ContactMessage $contact): JsonResponse
    {
        if ($contact->status !== 'read') {
            $contact->update([
                'status' => 'read',
                'replied_at' => now(),
            ]);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'id' => $contact->id,
                'name' => $contact->name,
                'email' => $contact->email,
                'phone' => $contact->phone ?: 'Not provided',
                'subject' => $contact->subject ?: 'General Inquiry',
                'message' => $contact->message,
                'status' => $contact->status,
                'received_at' => $contact->created_at ? $contact->created_at->format('M d, Y h:i A') : '-',
            ],
        ]);
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
