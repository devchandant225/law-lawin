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
        'status',
        'orderlist'
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

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
