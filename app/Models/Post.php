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
        'bottom_description',
        'excerpt',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'feature_image',
        'feature_image_alt',
        'icon',
        'type',
        'layout',
        'schema_head',
        'schema_body',
        'orderposition'
    ];

    protected $casts = [
        'schema_head' => 'array',
        'schema_body' => 'array',
        'orderposition' => 'integer',
    ];

    // Layout constants
    const LAYOUT_WITH_SIDEBAR = 'with_sidebar';
    const LAYOUT_FULLSCREEN = 'fullscreen';

    /**
     * Get layout options
     */
    public static function getLayoutOptions()
    {
        return [
            self::LAYOUT_WITH_SIDEBAR => 'With Sidebar',
            self::LAYOUT_FULLSCREEN => 'Fullscreen'
        ];
    }

    /**
     * Get the layout label
     */
    public function getLayoutLabelAttribute()
    {
        $options = self::getLayoutOptions();
        return $options[$this->layout] ?? $this->layout;
    }

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
     * Scope a query to order by orderposition ascending.
     */
    public function scopeByOrderPosition($query)
    {
        return $query->orderBy('orderposition', 'asc');
    }

    /**
     * Get the feature image URL.
     */
    public function getFeatureImageUrlAttribute()
    {
        return $this->feature_image ? asset('storage/' . $this->feature_image) : null;
    }

    /**
     * Get the icon URL.
     */
    public function getIconUrlAttribute()
    {
        return $this->icon ? asset('storage/' . $this->icon) : null;
    }

    /**
     * Get array of Schema Head JSON-LD strings.
     */
    public function getSchemaHeadJsonAttribute()
    {
        if (empty($this->schema_head)) {
            return [$this->generateDefaultSchema()];
        }
        return is_array($this->schema_head) ? $this->schema_head : [$this->schema_head];
    }

    /**
     * Get array of Schema Body JSON-LD strings.
     */
    public function getSchemaBodyJsonAttribute()
    {
        if (empty($this->schema_body)) {
            return [];
        }
        return is_array($this->schema_body) ? $this->schema_body : [$this->schema_body];
    }

    /**
     * Backward compatibility for google_schema_json
     */
    public function getGoogleSchemaJsonAttribute()
    {
        return $this->schema_head_json;
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
            'help_desk' => 'Article',
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

    /**
     * Get the FAQs associated with this post.
     */
    public function postFaqs()
    {
        return $this->hasMany(PostFAQ::class);
    }
}
