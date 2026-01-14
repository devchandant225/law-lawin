<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostFAQ extends Model
{
    use HasFactory;

    protected $table = 'post_faqs';

    protected $fillable = [
        'question',
        'answer',
        'post_id',
        'status'
    ];

    protected $casts = [
        'post_id' => 'integer',
    ];

    /**
     * Get the post that owns the FAQ.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Scope a query to only include active FAQs.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to filter by post.
     */
    public function scopeForPost($query, $postId)
    {
        return $query->where('post_id', $postId);
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

    /**
     * Scope a query to order by creation date.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'asc');
    }
}