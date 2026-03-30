<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeftRightContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'image_alt',
        'order',
        'status',
        'post_id'
    ];

    /**
     * Get the image alt text, defaulting to title if not set
     */
    public function getImageAltAttribute()
    {
        return $this->image_alt ?: $this->title;
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
