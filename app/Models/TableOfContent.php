<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableOfContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'publication_id',
        'title',
        'description',
        'order_index',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean',
        'order_index' => 'integer'
    ];

    /**
     * Get the publication that owns the table of content.
     */
    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }

    /**
     * Scope a query to only include active table of contents.
     */
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    /**
     * Scope a query to only include inactive table of contents.
     */
    public function scopeInactive($query)
    {
        return $query->where('status', false);
    }

    /**
     * Scope a query to order by order_index.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index', 'asc');
    }

    /**
     * Scope a query to order by latest.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Get the next order index for a publication.
     */
    public static function getNextOrderIndex($publicationId)
    {
        return static::where('publication_id', $publicationId)->max('order_index') + 1;
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        // Auto-assign order_index if not provided
        static::creating(function ($tableOfContent) {
            if (is_null($tableOfContent->order_index)) {
                $tableOfContent->order_index = static::getNextOrderIndex($tableOfContent->publication_id);
            }
        });
    }

    /**
     * Get the status label.
     */
    public function getStatusLabelAttribute()
    {
        return $this->status ? 'Active' : 'Inactive';
    }

    /**
     * Get the status badge class.
     */
    public function getStatusBadgeClassAttribute()
    {
        return $this->status ? 'badge-success' : 'badge-secondary';
    }
}
