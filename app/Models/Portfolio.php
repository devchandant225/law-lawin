<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'order',
        'status'
    ];

    protected $casts = [
        'order' => 'integer'
    ];

    // Scope for active portfolios
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    // Scope for ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('order', 'asc');
    }

    // Get the full image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }

    // Check if portfolio is active
    public function isActive()
    {
        return $this->status === 'active';
    }
}
