<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_bn',
        'slug',
        'description',
        'description_bn',
        'badge_color',
        'order_index',
        'is_active',
    ];

    protected $casts = [
        'order_index' => 'integer',
        'is_active' => 'boolean',
    ];

    /**
     * Get localized project type name based on active locale.
     */
    public function getLocalizedNameAttribute(): string
    {
        return (app()->getLocale() === 'bn' && ! empty($this->name_bn)) ? $this->name_bn : (string) $this->name;
    }

    /**
     * Get localized project type description based on active locale.
     */
    public function getLocalizedDescriptionAttribute(): ?string
    {
        return (app()->getLocale() === 'bn' && ! empty($this->description_bn)) ? $this->description_bn : $this->description;
    }

    /**
     * Get all projects belonging to this project type.
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }

    /**
     * Get UI Badge style based on slug or badge_color.
     */
    public function getBadgeStyleAttribute(): string
    {
        return match ($this->slug) {
            'signature-project' => 'background-color: #fef3c7; color: #92400e; border: 1px solid #fde68a;',
            'continuous-project' => 'background-color: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0;',
            'monthly-project' => 'background-color: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd;',
            default => 'background-color: #f1f5f9; color: #334155; border: 1px solid #cbd5e1;',
        };
    }
}
