<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;

    protected $table = 'faqs';

    protected $fillable = [
        'question',
        'answer',
        'publication_id',
        'status'
    ];

    protected $casts = [
        'publication_id' => 'integer',
    ];

    /**
     * Get the publication that owns the FAQ.
     */
    public function publication()
    {
        return $this->belongsTo(Publication::class);
    }

    /**
     * Scope a query to only include active FAQs.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to filter by publication.
     */
    public function scopeForPublication($query, $publicationId)
    {
        return $query->where('publication_id', $publicationId);
    }

    /**
     * Scope a query to search FAQs.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('question', 'like', '%' . $search . '%')
              ->orWhere('answer', 'like', '%' . $search . '%');
        });
    }
}
