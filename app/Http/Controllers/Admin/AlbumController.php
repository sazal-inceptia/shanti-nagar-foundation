<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\GalleryImage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class AlbumController extends Controller
{
    public function index(Request $request): JsonResponse|View
    {
        if ($request->ajax() || $request->wantsJson()) {
            $query = Album::query()->withCount('images')->latest();

            if ($request->filled('status')) {
                $query->where('is_active', $request->status == '1');
            }

            return DataTables::of($query)
                ->addIndexColumn()
                ->addColumn('cover', function ($row) {
                    $coverUrl = $row->cover_image_url;

                    return '<div style="width: 55px; height: 42px; border-radius: 6px; overflow: hidden; background: #f1f5f9; border: 1px solid #e2e8f0; display: inline-flex; align-items: center; justify-content: center;">
                        <img src="'.e($coverUrl).'" alt="'.e($row->title).'" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>';
                })
                ->addColumn('title_details', function ($row) {
                    $showUrl = route('admin.albums.show', $row->id);
                    $bnTitle = $row->title_bn ? '<span class="text-muted d-block" style="font-size: 11.5px;">'.e($row->title_bn).'</span>' : '';

                    return '<div class="d-flex flex-column">
                        <a href="'.e($showUrl).'" class="fw-bold text-dark text-decoration-none table-title-link" style="font-size: 13.5px;">'.e($row->title).'</a>
                        '.$bnTitle.'
                    </div>';
                })
                ->addColumn('photos_count', function ($row) {
                    return '<span class="badge bg-primary" style="font-size: 11px; padding: 4px 8px; border-radius: 6px;"><i class="ri-image-line me-1"></i>'.$row->images_count.' '.__('Photos').'</span>';
                })
                ->addColumn('date_display', function ($row) {
                    return $row->event_date ? $row->event_date->format('d M, Y') : '<span class="text-muted">-</span>';
                })
                ->addColumn('status_toggle', function ($row) {
                    $checked = $row->is_active ? 'checked' : '';

                    return '<div class="form-check form-switch form-switch-md d-flex justify-content-center">
                        <input class="form-check-input status-toggle" type="checkbox" role="switch" data-url="'.route('admin.albums.toggle-status', $row->id).'" '.$checked.'>
                    </div>';
                })
                ->addColumn('action-btn', function ($row) {
                    return [
                        'id' => $row->id,
                        'title' => $row->title,
                    ];
                })
                ->rawColumns(['cover', 'title_details', 'photos_count', 'date_display', 'status_toggle'])
                ->make(true);
        }

        $totalAlbums = Album::count();
        $activeAlbums = Album::where('is_active', true)->count();
        $totalPhotos = GalleryImage::count();

        return view('admin.albums.index', compact('totalAlbums', 'activeAlbums', 'totalPhotos'));
    }

    public function create(): View
    {
        return view('admin.albums.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_bn' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_bn' => 'nullable|string',
            'event_date' => 'nullable|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $slug = Str::slug($validated['title']);
        $count = Album::where('slug', 'LIKE', "{$slug}%")->count();
        $validated['slug'] = $count ? "{$slug}-{$count}" : $slug;
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('albums', 'public');
            $validated['cover_image'] = $path;
        }

        $album = Album::create($validated);

        return redirect()->route('admin.albums.show', $album->id)->with('success', __('Album created successfully! You can now add photos.'));
    }

    public function show(Album $album): View
    {
        $album->load(['images' => function ($q) {
            $q->orderBy('sort_order')->latest();
        }]);

        return view('admin.albums.show', compact('album'));
    }

    public function edit(Album $album): View
    {
        return view('admin.albums.edit', compact('album'));
    }

    public function update(Request $request, Album $album): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'title_bn' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'description_bn' => 'nullable|string',
            'event_date' => 'nullable|date',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        if ($album->title !== $validated['title']) {
            $slug = Str::slug($validated['title']);
            $count = Album::where('slug', 'LIKE', "{$slug}%")->where('id', '!=', $album->id)->count();
            $validated['slug'] = $count ? "{$slug}-{$count}" : $slug;
        }

        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        if ($request->hasFile('cover_image')) {
            if ($album->cover_image && ! str_starts_with($album->cover_image, 'assets/') && Storage::disk('public')->exists($album->cover_image)) {
                Storage::disk('public')->delete($album->cover_image);
            }
            $validated['cover_image'] = $request->file('cover_image')->store('albums', 'public');
        }

        $album->update($validated);

        return redirect()->route('admin.albums.index')->with('success', __('Album updated successfully!'));
    }

    public function destroy(Album $album): JsonResponse|RedirectResponse
    {
        if ($album->cover_image && ! str_starts_with($album->cover_image, 'assets/') && Storage::disk('public')->exists($album->cover_image)) {
            Storage::disk('public')->delete($album->cover_image);
        }

        // Delete all associated gallery images
        foreach ($album->images as $img) {
            if ($img->image_path && ! str_starts_with($img->image_path, 'assets/') && Storage::disk('public')->exists($img->image_path)) {
                Storage::disk('public')->delete($img->image_path);
            }
            $img->delete();
        }

        $album->delete();

        if (request()->ajax() || request()->wantsJson()) {
            return response()->json(['success' => true, 'message' => __('Album deleted successfully.')]);
        }

        return redirect()->route('admin.albums.index')->with('success', __('Album deleted successfully!'));
    }

    public function toggleStatus(Album $album): JsonResponse
    {
        $album->is_active = ! $album->is_active;
        $album->save();

        return response()->json([
            'success' => true,
            'is_active' => $album->is_active,
            'message' => __('Album status updated successfully.'),
        ]);
    }
}
