<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'image_path',
        'caption',
        'caption_bn',
        'sort_order',
    ];

    /**
     * Get localized image caption based on active locale.
     */
    public function getLocalizedCaptionAttribute(): ?string
    {
        return (app()->getLocale() === 'bn' && ! empty($this->caption_bn)) ? $this->caption_bn : $this->caption;
    }

    /**
     * Get the project that owns this image.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
