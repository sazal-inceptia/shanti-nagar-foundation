<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProjectRequest;
use App\Http\Requests\Admin\UpdateProjectRequest;
use App\Models\Project;
use App\Services\ProjectService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    protected ProjectService $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    /**
     * Display a listing of projects with filter support and Yajra DataTable.
     */
    public function index(Request $request): JsonResponse|View
    {
        if ($request->ajax() || $request->wantsJson()) {
            $query = Project::query()->with(['images', 'donations', 'expenses'])->select('projects.*');

            if ($request->filled('category')) {
                $query->where('category', $request->category);
            }

            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }

            if ($request->filled('is_featured')) {
                $query->where('is_featured', (bool) $request->is_featured);
            }

            if ($request->filled('featured')) {
                $query->where('is_featured', (bool) $request->featured);
            }

            if ($request->has('draw')) {
                return \Yajra\DataTables\Facades\DataTables::of($query)
                    ->addIndexColumn()
                    ->addColumn('thumbnail', function ($row) {
                        $imageUrl = $row->featured_image ? asset($row->featured_image) : asset('assets/images/logo.png');
                        $defaultLogo = asset('assets/images/logo.png');
                        return '<div class="project-thumb-box" style="width: 52px; height: 38px; border-radius: 6px; overflow: hidden; background: #e2e8f0; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; justify-content: center;">
                            <img src="' . e($imageUrl) . '" alt="' . e($row->name) . '" onerror="this.onerror=null;this.src=\'' . e($defaultLogo) . '\';" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>';
                    })
                    ->addColumn('title_details', function ($row) {
                        $showUrl = route('admin.projects.show', $row->id);
                        $locationHtml = $row->location ? '<span class="text-muted ms-2" style="font-size: 11px;"><i class="ri-map-pin-line text-danger me-1"></i>' . e($row->location) . '</span>' : '';
                        $categoryHtml = '<span class="badge" style="background-color: #f1f5f9; color: #334155; font-size: 10.5px; padding: 2px 6px; border-radius: 4px;">' . e($row->category ?? 'General') . '</span>';
                        return '<div class="d-flex flex-column">
                            <a href="' . e($showUrl) . '" class="fw-bold text-dark text-decoration-none table-title-link" style="font-size: 13.5px;">' . e($row->name) . '</a>
                            <div class="d-flex align-items-center mt-1">
                                ' . $categoryHtml . '
                                ' . $locationHtml . '
                            </div>
                        </div>';
                    })
                    ->addColumn('target_budget', function ($row) {
                        return '<div class="d-flex flex-column">
                            <span class="fw-bold text-dark" style="font-size: 13px;">৳ ' . number_format((float) $row->estimated_cost, 2) . '</span>
                            <span class="text-muted" style="font-size: 11px;">Spent: ৳ ' . number_format((float) $row->total_expense, 2) . '</span>
                        </div>';
                    })
                    ->addColumn('status_badge', function ($row) {
                        $badgeStyle = match ($row->status) {
                            'completed' => 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;',
                            'in_progress' => 'background-color: #fff3ee; color: #f65024; border: 1px solid rgba(246, 80, 36, 0.3);',
                            'planned' => 'background-color: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe;',
                            'cancelled' => 'background-color: #fef2f2; color: #991b1b; border: 1px solid #fecaca;',
                            default => 'background-color: #f1f5f9; color: #475569; border: 1px solid #cbd5e1;',
                        };
                        return '<span class="badge" style="' . $badgeStyle . ' font-size: 11px; padding: 4px 8px; border-radius: 4px; font-weight: 600;">' . e(ucwords(str_replace('_', ' ', (string) $row->status))) . '</span>';
                    })
                    ->addColumn('featured_toggle', function ($row) {
                        $checked = $row->is_featured ? 'checked' : '';
                        return '<div class="form-check form-switch m-0 d-flex justify-content-center">
                            <input class="form-check-input featured-toggle toggle-project-feature" type="checkbox" role="switch" data-id="' . $row->id . '" ' . $checked . ' style="cursor: pointer;">
                        </div>';
                    })
                    ->addColumn('published_toggle', function ($row) {
                        $checked = $row->is_published ? 'checked' : '';
                        return '<div class="form-check form-switch m-0 d-flex justify-content-center">
                            <input class="form-check-input status-toggle toggle-project-publish" type="checkbox" role="switch" data-id="' . $row->id . '" ' . $checked . ' style="cursor: pointer;">
                        </div>';
                    })
                    ->addColumn('action-btn', function ($row) {
                        return [
                            'id' => $row->id,
                            'name' => $row->name,
                        ];
                    })
                    ->rawColumns(['thumbnail', 'title_details', 'target_budget', 'status_badge', 'featured_toggle', 'published_toggle', 'action-btn'])
                    ->make(true);
            }

            return response()->json([
                'success' => true,
                'data' => $query->latest()->paginate(20),
            ]);
        }

        $categories = $this->projectService->getCategories();
        $statuses = [
            'planned' => 'Planned',
            'in_progress' => 'In Progress',
            'completed' => 'Completed',
            'cancelled' => 'Cancelled',
        ];

        return view('admin.projects.index', compact('categories', 'statuses'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create(): View
    {
        $categories = $this->projectService->getCategories();
        return view('admin.projects.create', compact('categories'));
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(StoreProjectRequest $request): RedirectResponse
    {
        $featuredImage = $request->file('featured_image');
        $galleryFiles = $request->file('gallery', []);

        $this->projectService->store(
            $request->validated(),
            $featuredImage,
            $galleryFiles
        );

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    /**
     * Display the specified project details.
     */
    public function show(Project $project): View
    {
        $project->load(['images', 'donations', 'expenses']);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit(Project $project): View
    {
        $categories = $this->projectService->getCategories();
        $project->load('images');
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project): RedirectResponse
    {
        $featuredImage = $request->file('featured_image');
        $galleryFiles = $request->file('gallery', []);

        $this->projectService->update(
            $project,
            $request->validated(),
            $featuredImage,
            $galleryFiles
        );

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy(Project $project): RedirectResponse
    {
        $this->projectService->delete($project);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }

    /**
     * Toggle status or featured status via AJAX.
     */
    public function toggleStatus(Request $request, Project $project): JsonResponse
    {
        $field = $request->input('field');
        $value = $request->input('value');

        if (!in_array($field, ['is_featured', 'is_published', 'status', 'featured'])) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid toggle field requested',
            ], 422);
        }

        // Map alias
        if ($field === 'featured') {
            $field = 'is_featured';
        }

        if ($request->has('value')) {
            $project->$field = $value;
            $success = $project->save();
        } else {
            $success = $this->projectService->toggleStatus($project, $field);
        }

        return response()->json([
            'success' => $success,
            'message' => ucfirst(str_replace('_', ' ', $field)) . ' status updated successfully.',
            'value'   => $project->$field,
        ]);
    }
}
