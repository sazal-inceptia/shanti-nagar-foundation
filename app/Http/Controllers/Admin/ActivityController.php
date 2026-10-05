<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreActivityRequest;
use App\Http\Requests\Admin\UpdateActivityRequest;
use App\Models\Activity;
use App\Services\ActivityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function __construct(
        protected ActivityService $activityService
    ) {}

    /**
     * Display a listing of activities.
     */
    public function index(Request $request): View|JsonResponse
    {
        if ($request->ajax()) {
            return $this->activityService->getDataTable($request);
        }

        $stats = $this->activityService->getStats();
        $totalActivities = $stats['total'];
        $upcomingActivities = $stats['upcoming'];
        $completedActivities = $stats['completed'];

        $statuses = [
            'upcoming' => 'Upcoming',
            'ongoing' => 'Ongoing',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ];

        return view('admin.activities.index', compact(
            'totalActivities',
            'upcomingActivities',
            'completedActivities',
            'statuses'
        ));
    }

    /**
     * Show the form for creating a new activity.
     */
    public function create(): View
    {
        $statuses = [
            'upcoming' => 'Upcoming (Scheduled)',
            'ongoing' => 'Ongoing (Happening Now)',
            'completed' => 'Completed (Past Activity)',
            'cancelled' => 'Cancelled',
        ];

        return view('admin.activities.create', compact('statuses'));
    }

    /**
     * Store a newly created activity in storage.
     */
    public function store(StoreActivityRequest $request): RedirectResponse
    {
        $activity = $this->activityService->createActivity(
            $request->validated(),
            $request->file('featured_image')
        );

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity initiative "'.e($activity->title).'" created successfully.');
    }

    /**
     * Display the specified activity.
     */
    public function show(Activity $activity): View
    {
        return view('admin.activities.show', compact('activity'));
    }

    /**
     * Show the form for editing the specified activity.
     */
    public function edit(Activity $activity): View
    {
        $statuses = [
            'upcoming' => 'Upcoming (Scheduled)',
            'ongoing' => 'Ongoing (Happening Now)',
            'completed' => 'Completed (Past Activity)',
            'cancelled' => 'Cancelled',
        ];

        return view('admin.activities.edit', compact('activity', 'statuses'));
    }

    /**
     * Update the specified activity in storage.
     */
    public function update(UpdateActivityRequest $request, Activity $activity): RedirectResponse
    {
        $removeImage = $request->input('remove_featured_image') === '1';

        $this->activityService->updateActivity(
            $activity,
            $request->validated(),
            $request->file('featured_image'),
            $removeImage
        );

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity initiative "'.e($activity->title).'" updated successfully.');
    }

    /**
     * Remove the specified activity from storage.
     */
    public function destroy(Activity $activity): RedirectResponse|JsonResponse
    {
        $this->activityService->deleteActivity($activity);

        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Activity deleted successfully.',
            ]);
        }

        return redirect()->route('admin.activities.index')
            ->with('success', 'Activity removed successfully.');
    }

    /**
     * Toggle active/featured/published status via AJAX.
     */
    public function toggleStatus(Request $request, Activity $activity): JsonResponse
    {
        $field = $request->input('field', 'is_published');
        $value = $request->has('value') ? (bool) $request->input('value') : null;

        $updated = $this->activityService->toggleStatus($activity, $field, $value);

        return response()->json([
            'success' => true,
            'message' => 'Activity '.str_replace('_', ' ', $field).' updated.',
            'status' => $updated->{$field},
        ]);
    }
}
