<?php

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProjectService
{
    /**
     * Get list of active dynamic project types.
     *
     * @return Collection<int, ProjectType>
     */
    public function getProjectTypes(): Collection
    {
        return ProjectType::where('is_active', true)
            ->orderBy('order_index', 'asc')
            ->orderBy('name', 'asc')
            ->get();
    }

    /**
     * Get paginated or filtered projects.
     */
    public function getProjects(array $filters = [], int $perPage = 15)
    {
        $query = Project::with(['projectType', 'images', 'donations', 'expenses'])->latest();

        if (! empty($filters['project_type_id'])) {
            $query->where('project_type_id', $filters['project_type_id']);
        }

        if (! empty($filters['project_type_slug'])) {
            $query->whereHas('projectType', function ($q) use ($filters) {
                $q->where('slug', $filters['project_type_slug']);
            });
        }

        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['is_published']) && $filters['is_published'] !== '') {
            $query->where('is_published', (bool) $filters['is_published']);
        }

        if (! empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%");
            });
        }

        return $query->paginate($perPage);
    }

    /**
     * Store a new Project with cover image and gallery images.
     */
    public function store(array $data, ?UploadedFile $featuredImage = null, array $galleryFiles = []): Project
    {
        return DB::transaction(function () use ($data, $featuredImage, $galleryFiles) {
            $slug = ! empty($data['slug']) ? Str::slug($data['slug']) : Str::slug($data['name']);

            // Ensure unique slug
            $originalSlug = $slug;
            $count = 1;
            while (Project::where('slug', $slug)->exists()) {
                $slug = "{$originalSlug}-{$count}";
                $count++;
            }
            $data['slug'] = $slug;

            // Handle featured image upload
            if ($featuredImage) {
                $data['featured_image'] = $this->uploadFile($featuredImage, 'assets/images/projects');
            }

            $data['is_published'] = isset($data['is_published']) ? (bool) $data['is_published'] : true;

            $project = Project::create($data);

            // Handle multi-image gallery upload
            if (! empty($galleryFiles)) {
                $this->uploadGallery($project, $galleryFiles);
            }

            return $project;
        });
    }

    /**
     * Update an existing project.
     */
    public function update(Project $project, array $data, ?UploadedFile $featuredImage = null, array $galleryFiles = []): Project
    {
        return DB::transaction(function () use ($project, $data, $featuredImage, $galleryFiles) {
            if (! empty($data['name']) && empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name']);
            } elseif (! empty($data['slug'])) {
                $data['slug'] = Str::slug($data['slug']);
            }

            // If new featured image is uploaded
            if ($featuredImage) {
                if ($project->featured_image && File::exists(public_path($project->featured_image))) {
                    File::delete(public_path($project->featured_image));
                }
                $data['featured_image'] = $this->uploadFile($featuredImage, 'assets/images/projects');
            }

            $data['is_published'] = isset($data['is_published']) ? (bool) $data['is_published'] : false;

            $project->update($data);

            // Upload additional gallery images if present
            if (! empty($galleryFiles)) {
                $this->uploadGallery($project, $galleryFiles);
            }

            return $project;
        });
    }

    /**
     * Delete project and its associated image files.
     */
    public function delete(Project $project): bool
    {
        return DB::transaction(function () use ($project) {
            // Soft delete or remove files if force delete
            return (bool) $project->delete();
        });
    }

    /**
     * Toggle a boolean field (is_published).
     */
    public function toggleStatus(Project $project, string $field): bool
    {
        if (in_array($field, ['is_published'])) {
            $project->$field = ! $project->$field;

            return $project->save();
        }

        return false;
    }

    /**
     * Helper to upload single file.
     */
    protected function uploadFile(UploadedFile $file, string $directory): string
    {
        $destinationPath = public_path($directory);
        if (! File::isDirectory($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true, true);
        }

        $filename = time().'_'.Str::random(8).'.'.$file->getClientOriginalExtension();
        $file->move($destinationPath, $filename);

        return $directory.'/'.$filename;
    }

    /**
     * Helper to upload multiple gallery images.
     */
    protected function uploadGallery(Project $project, array $files): void
    {
        $highestSort = (int) $project->images()->max('sort_order');

        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                $path = $this->uploadFile($file, 'assets/images/projects/gallery');
                $highestSort++;
                $project->images()->create([
                    'image_path' => $path,
                    'caption' => $project->name,
                    'sort_order' => $highestSort,
                ]);
            }
        }
    }
}
