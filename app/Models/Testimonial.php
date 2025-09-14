<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'img',
        'profession',
        'desc',
        'status',
        'rating',
        'sort_order'
    ];

    protected $casts = [
        'status' => 'boolean',
        'rating' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Get the image URL attribute.
     */
    public function getImageUrlAttribute()
    {
        if ($this->img && Storage::disk('public')->exists($this->img)) {
            return Storage::disk('public')->url($this->img);
        }
        
        // Return default avatar if no image
        return asset('images/default-avatar.jpg');
    }

    /**
     * Scope to get only active testimonials
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope to order by sort order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Get star rating as array for display
     */
    public function getStarsAttribute()
    {
        return [
            'filled' => $this->rating,
            'empty' => 5 - $this->rating
        ];
    }
}
