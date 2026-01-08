<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'excerpt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'feature_image',
        'type',
        'google_schema'
    ];

    protected $casts = [
        'google_schema' => 'array',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        static::updating(function ($post) {
            if ($post->isDirty('title') && empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * Scope a query to only include active posts.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to filter by type.
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope a query to order by created_at.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Get the feature image URL.
     */
    public function getFeatureImageUrlAttribute()
    {
        return $this->feature_image ? asset('storage/' . $this->feature_image) : null;
    }

    /**
     * Get formatted Google Schema as JSON-LD.
     */
    public function getGoogleSchemaJsonAttribute()
    {
        if (empty($this->google_schema)) {
            return $this->generateDefaultSchema();
        }
        return json_encode($this->google_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Generate default Google Schema based on post type.
     */
    private function generateDefaultSchema()
    {
        $baseSchema = [
            '@context' => 'https://schema.org',
            '@type' => $this->getSchemaType(),
            'name' => $this->title,
            'description' => $this->excerpt ?: substr(strip_tags($this->description), 0, 160),
            'url' => url('/posts/' . $this->slug),
            'datePublished' => $this->created_at->toISOString(),
            'dateModified' => $this->updated_at->toISOString()
        ];

        if ($this->feature_image) {
            $baseSchema['image'] = $this->feature_image_url;
        }

        return json_encode($baseSchema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Get the appropriate schema type based on post type.
     */
    private function getSchemaType()
    {
        return match($this->type) {
            'service' => 'Service',
            'practice' => 'Article',
            'news' => 'NewsArticle',
            'blog' => 'BlogPosting',
            default => 'Article'
        };
    }

    /**
     * Get the left-right contents associated with this post.
     */
    public function leftRightContents()
    {
        return $this->hasMany(LeftRightContent::class);
    }
}
