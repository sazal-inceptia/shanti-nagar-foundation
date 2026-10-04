<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\GalleryImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class GalleryImageController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        if ($request->ajax() || $request->wantsJson()) {
            $query = GalleryImage::query()->with('album')->latest();

            if ($request->filled('album_id')) {
                if ($request->album_id === 'standalone') {
                    $query->whereNull('album_id');
                } else {
                    $query->where('album_id', $request->album_id);
                }
            }

            if ($request->filled('status')) {
                $query->where('is_active', $request->status == '1');
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('preview', function ($row) {
                    $imageUrl = $row->image_url;

                    return '<div style="width: 60px; height: 45px; border-radius: 6px; overflow: hidden; background: #f1f5f9; border: 1px solid #e2e8f0; display: inline-flex; align-items: center; justify-content: center;">
                        <a href="'.e($imageUrl).'" target="_blank" data-fancybox="admin-gallery">
                            <img src="'.e($imageUrl).'" alt="'.e($row->title ?? 'Gallery Photo').'" style="width: 100%; height: 100%; object-fit: cover;">
                        </a>
                    </div>';
                })
                ->addColumn('title_caption', function ($row) {
                    $title = $row->title ? '<div class="fw-bold text-dark" style="font-size: 13.5px;">'.e($row->title).'</div>' : '<span class="text-muted" style="font-size: 12px;">('.__('No Title').')</span>';
                    $caption = $row->caption ? '<div class="text-muted text-truncate" style="max-width: 260px; font-size: 12px;">'.e($row->caption).'</div>' : '';

                    return $title.$caption;
                })
                ->addColumn('album_badge', function ($row) {
                    if ($row->album) {
                        return '<a href="'.route('admin.albums.show', $row->album->id).'" class="badge bg-soft-primary text-primary" style="font-size: 11px; padding: 4px 8px; border-radius: 6px;"><i class="ri-folder-image-line me-1"></i>'.e($row->album->title).'</a>';
                    }

                    return '<span class="badge bg-secondary" style="font-size: 11px; padding: 4px 8px; border-radius: 6px;"><i class="ri-image-line me-1"></i>'.__('Standalone / No Album').'</span>';
                })
                ->addColumn('status_toggle', function ($row) {
                    $checked = $row->is_active ? 'checked' : '';

                    return '<div class="form-check form-switch form-switch-md d-flex justify-content-center">
                        <input class="form-check-input status-toggle" type="checkbox" role="switch" data-url="'.route('admin.gallery-images.toggle-status', $row->id).'" '.$checked.'>
                    </div>';
                })
                ->addColumn('action-btn', function ($row) {
                    return [
                        'id' => $row->id,
                        'title' => $row->title ?? 'Gallery Photo',
                    ];
                })
                ->rawColumns(['preview', 'title_caption', 'album_badge', 'status_toggle'])
                ->make(true);
        }

        $albums = Album::orderBy('title')->get();
        $totalPhotos = GalleryImage::count();
        $standalonePhotos = GalleryImage::whereNull('album_id')->count();

        return view('admin.gallery-images.index', compact('albums', 'totalPhotos', 'standalonePhotos'));
    }

    public function create(Request $request): View
    {
        $albums = Album::orderBy('title')->get();
        $selectedAlbumId = $request->query('album_id');

        return view('admin.gallery-images.create', compact('albums', 'selectedAlbumId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'album_id' => 'nullable|exists:albums,id',
            'title' => 'nullable|string|max:255',
            'title_bn' => 'nullable|string|max:255',
            'caption' => 'nullable|string',
            'caption_bn' => 'nullable|string',
            'images' => 'required|array|min:1',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:10240',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
        ]);

        $albumId = $request->filled('album_id') ? $request->album_id : null;
        $isActive = $request->has('is_active');
        $isFeatured = $request->has('is_featured');
        $uploadedCount = 0;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $path = $file->store('gallery', 'public');

                GalleryImage::create([
                    'album_id' => $albumId,
                    'title' => $request->title,
                    'title_bn' => $request->title_bn,
                    'caption' => $request->caption,
                    'caption_bn' => $request->caption_bn,
                    'image_path' => $path,
                    'is_active' => $isActive,
                    'is_featured' => $isFeatured,
                    'sort_order' => $index,
                ]);
                $uploadedCount++;
            }
        }

        if ($albumId) {
            return redirect()->route('admin.albums.show', $albumId)->with('success', __(':count photos uploaded successfully to album!', ['count' => $uploadedCount]));
        }

        return redirect()->route('admin.gallery-images.index')->with('success', __(':count photos uploaded successfully!', ['count' => $uploadedCount]));
    }

    public function edit(GalleryImage $galleryImage): View
    {
        $albums = Album::orderBy('title')->get();

        return view('admin.gallery-images.edit', compact('galleryImage', 'albums'));
    }

    public function update(Request $request, GalleryImage $galleryImage): RedirectResponse
    {
        $validated = $request->validate([
            'album_id' => 'nullable|exists:albums,id',
            'title' => 'nullable|string|max:255',
            'title_bn' => 'nullable|string|max:255',
            'caption' => 'nullable|string',
            'caption_bn' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:10240',
            'is_active' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $validated['album_id'] = $request->filled('album_id') ? $request->album_id : null;
        $validated['is_active'] = $request->has('is_active');
        $validated['is_featured'] = $request->has('is_featured');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('image')) {
            if ($galleryImage->image_path && ! str_starts_with($galleryImage->image_path, 'assets/') && Storage::disk('public')->exists($galleryImage->image_path)) {
                Storage::disk('public')->delete($galleryImage->image_path);
            }
            $validated['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $galleryImage->update($validated);

        if ($galleryImage->album_id) {
            return redirect()->route('admin.albums.show', $galleryImage->album_id)->with('success', __('Photo updated successfully!'));
        }

        return redirect()->route('admin.gallery-images.index')->with('success', __('Photo updated successfully!'));
    }

    public function destroy(GalleryImage $galleryImage): JsonResponse|RedirectResponse
    {
        if ($galleryImage->image_path && ! str_starts_with($galleryImage->image_path, 'assets/') && Storage::disk('public')->exists($galleryImage->image_path)) {
            Storage::disk('public')->delete($galleryImage->image_path);
        }

        $galleryImage->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => __('Photo deleted successfully.')]);
        }

        return redirect()->back()->with('success', __('Photo deleted successfully!'));
    }

    public function toggleStatus(GalleryImage $galleryImage): JsonResponse
    {
        $galleryImage->is_active = ! $galleryImage->is_active;
        $galleryImage->save();

        return response()->json([
            'success' => true,
            'is_active' => $galleryImage->is_active,
            'message' => __('Photo status updated successfully.'),
        ]);
    }
}
