<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'email',
        'phone1',
        'phone2',
        'whatsapp',
        'viber',
        'facebook_link',
        'instagram_link',
        'twitter_link',
        'linkedin_link',
        'youtube_link',
        'wechat_link',
        'address',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the logo URL
     */
    public function getLogoUrlAttribute()
    {
        if ($this->logo && Storage::disk('public')->exists($this->logo)) {
            return Storage::disk('public')->url($this->logo);
        }
        return null;
    }

    /**
     * Get the first profile (singleton pattern)
     */
    public static function getProfile()
    {
        return static::first() ?: new static();
    }
}
