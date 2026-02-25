<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'file_path',
        'file_type',
        'file_size',
        'original_name',
    ];

    /**
     * Get the full URL for the media file.
     */
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    /**
     * Check if the media is an image.
     */
    public function isImage()
    {
        return str_starts_with($this->file_type, 'image/');
    }

    /**
     * Check if the media is a PDF.
     */
    public function isPdf()
    {
        return $this->file_type === 'application/pdf';
    }

    /**
     * Get formatted file size.
     */
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Delete the file from storage when the model is deleted.
     */
    protected static function booted()
    {
        static::deleted(function ($media) {
            Storage::disk('public')->delete($media->file_path);
        });
    }
}
