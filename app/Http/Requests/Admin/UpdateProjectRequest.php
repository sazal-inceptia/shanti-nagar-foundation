<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $projectId = $this->route('project')?->id ?? $this->route('project');

        return [
            'name'              => ['required', 'string', 'max:255'],
            'slug'              => ['nullable', 'string', 'max:255', Rule::unique('projects', 'slug')->ignore($projectId)],
            'category'          => ['required', 'string', 'max:100'],
            'estimated_cost'    => ['nullable', 'numeric', 'min:0'],
            'start_date'        => ['nullable', 'date'],
            'completion_date'   => ['nullable', 'date', 'after_or_equal:start_date'],
            'status'            => ['required', 'in:planned,in_progress,completed,cancelled'],
            'location'          => ['nullable', 'string', 'max:255'],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description'       => ['nullable', 'string'],
            'featured_image'    => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:5120'],
            'gallery'           => ['nullable', 'array'],
            'gallery.*'         => ['image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'is_featured'       => ['nullable', 'boolean'],
            'is_published'      => ['nullable', 'boolean'],
        ];
    }
}
