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
        'order',
        'status',
        'post_id'
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
