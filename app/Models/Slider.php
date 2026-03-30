<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'image_alt',
        'status',
        'orderlist'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Get the image alt text, defaulting to title if not set
     */
    public function getImageAltAttribute()
    {
        return $this->image_alt ?: $this->title;
    }

    /**
     * Scope to get active sliders
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope to get sliders ordered by orderlist
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('orderlist', 'asc');
    }

    /**
     * Get the image URL
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
