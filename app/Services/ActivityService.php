<?php

namespace App\Services;

use App\Models\Activity;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;

class ActivityService
{
    /**
     * Build and return the Yajra DataTables response for activities.
     */
    public function getDataTable(Request $request): JsonResponse
    {
        $query = Activity::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('featured')) {
            $query->where('is_featured', $request->boolean('featured'));
        }

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('thumbnail', function ($row) {
                $imgUrl = $row->featured_image && file_exists(public_path($row->featured_image))
                    ? asset($row->featured_image)
                    : asset('assets/images/logo.png');

                return '<div style="width: 50px; height: 38px; border-radius: 6px; overflow: hidden; background: #e2e8f0; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; justify-content: center;">
                    <img src="'.$imgUrl.'" alt="'.e($row->title).'" style="width: 100%; height: 100%; object-fit: cover;">
                </div>';
            })
            ->addColumn('title_details', function ($row) {
                $showUrl = route('admin.activities.show', $row->id);
                $locationHtml = $row->location ? '<span class="text-muted ms-2" style="font-size: 11px;"><i class="ri-map-pin-line text-danger me-1"></i>'.e($row->location).'</span>' : '';

                return '<div class="d-flex flex-column">
                    <a href="'.e($showUrl).'" class="fw-bold text-dark text-decoration-none table-title-link" style="font-size: 13.5px;">'.e($row->title).'</a>
                    <div class="d-flex align-items-center mt-1 flex-wrap gap-1">
                        '.$locationHtml.'
                    </div>
                </div>';
            })
            ->addColumn('event_date_time', function ($row) {
                $dateStr = $row->event_date ? $row->event_date->format('d M, Y') : '<span class="text-muted">Not specified</span>';
                $timeStr = $row->event_time ? '<span class="text-muted" style="font-size: 11px;"><i class="ri-time-line me-1"></i>'.e($row->event_time).'</span>' : '';

                return '<div class="d-flex flex-column">
                    <span class="fw-semibold text-dark" style="font-size: 12.5px;">'.$dateStr.'</span>
                    '.$timeStr.'
                </div>';
            })
            ->addColumn('status_badge', function ($row) {
                $badgeStyle = match ($row->status) {
                    'upcoming' => 'background-color: #eff6ff; color: #005daa; border: 1px solid #bfdbfe;',
                    'ongoing' => 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;',
                    'completed' => 'background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;',
                    'cancelled' => 'background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca;',
                    default => 'background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;',
                };

                return '<span class="badge" style="'.$badgeStyle.' font-size: 11px; padding: 4px 8px; border-radius: 4px; font-weight: 600;">'.e(ucwords(str_replace('_', ' ', (string) $row->status))).'</span>';
            })
            ->addColumn('published_toggle', function ($row) {
                $checked = $row->is_published ? 'checked' : '';

                return '<div class="form-check form-switch m-0 d-flex justify-content-center">
                    <input class="form-check-input status-toggle toggle-activity-publish" type="checkbox" role="switch" data-id="'.$row->id.'" '.$checked.' style="cursor: pointer;">
                </div>';
            })
            ->addColumn('action-btn', function ($row) {
                return [
                    'id' => $row->id,
                    'name' => $row->title,
                ];
            })
            ->rawColumns(['thumbnail', 'title_details', 'event_date_time', 'status_badge', 'published_toggle', 'action-btn'])
            ->make(true);
    }

    /**
     * Create a new activity initiative.
     */
    public function createActivity(array $data, ?UploadedFile $featuredImage = null): Activity
    {
        $data['is_featured'] = ! empty($data['is_featured']);
        $data['is_published'] = ! empty($data['is_published']);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        if ($featuredImage) {
            $data['featured_image'] = $this->uploadImage($featuredImage);
        }

        return Activity::create($data);
    }

    /**
     * Update an existing activity.
     */
    public function updateActivity(Activity $activity, array $data, ?UploadedFile $featuredImage = null, bool $removeImage = false): Activity
    {
        $data['is_featured'] = ! empty($data['is_featured']);
        $data['is_published'] = ! empty($data['is_published']);
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        if ($removeImage && $activity->featured_image) {
            $this->deleteImageFile($activity->featured_image);
            $data['featured_image'] = null;
        }

        if ($featuredImage) {
            if ($activity->featured_image) {
                $this->deleteImageFile($activity->featured_image);
            }
            $data['featured_image'] = $this->uploadImage($featuredImage);
        }

        $activity->update($data);

        return $activity;
    }

    /**
     * Delete an activity record.
     */
    public function deleteActivity(Activity $activity): bool
    {
        if ($activity->featured_image) {
            $this->deleteImageFile($activity->featured_image);
        }

        return (bool) $activity->delete();
    }

    /**
     * Toggle status or featured flag.
     */
    public function toggleStatus(Activity $activity, string $field, ?bool $value = null): Activity
    {
        if (in_array($field, ['is_published', 'is_featured'])) {
            $activity->{$field} = $value !== null ? $value : ! $activity->{$field};
            $activity->save();
        }

        return $activity;
    }

    /**
     * Get summary KPI stats for activities.
     */
    public function getStats(): array
    {
        return [
            'total' => Activity::count(),
            'upcoming' => Activity::upcoming()->count(),
            'completed' => Activity::completed()->count(),
        ];
    }

    /**
     * Helper: upload and save an image file.
     */
    protected function uploadImage(UploadedFile $file): string
    {
        $imageName = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
        $destinationPath = public_path('uploads/activities');

        if (! File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }

        $file->move($destinationPath, $imageName);

        return 'uploads/activities/'.$imageName;
    }

    /**
     * Helper: safely delete an image file.
     */
    protected function deleteImageFile(string $filePath): void
    {
        $fullPath = public_path($filePath);
        if (File::exists($fullPath)) {
            @unlink($fullPath);
        }
    }
}
