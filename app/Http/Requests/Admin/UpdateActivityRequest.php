<?php

namespace App\Http\Requests\Admin;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateActivityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'title_bn' => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
            'event_time' => 'nullable|string|max:100',
            'location' => 'nullable|string|max:255',
            'location_bn' => 'nullable|string|max:255',
            'short_description' => 'nullable|string|max:1000',
            'short_description_bn' => 'nullable|string|max:1000',
            'description' => 'nullable|string',
            'description_bn' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,webp,svg|max:5120',
            'remove_featured_image' => 'nullable|string|in:0,1',
            'status' => 'required|string|in:upcoming,ongoing,completed,cancelled',
            'is_featured' => 'nullable|boolean',
            'is_published' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ];
    }
}
