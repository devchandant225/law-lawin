<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'type',
        'excerpt',
        'description',
        'feature_image',
        'status',
        'metatitle',
        'metadescription',
        'metakeywords',
        'json_ld_schema',
    ];

    protected $casts = [
        'json_ld_schema' => 'array',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($page) {
            if (empty($page->slug)) {
                $page->slug = Str::slug($page->title);
            }
        });

        static::updating(function ($page) {
            if ($page->isDirty('title') && empty($page->slug)) {
                $page->slug = Str::slug($page->title);
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
     * Scope a query to only include active pages.
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
     * Get the feature image URL.
     */
    public function getFeatureImageUrlAttribute()
    {
        return $this->feature_image ? asset('storage/' . $this->feature_image) : null;
    }

    /**
     * Get array of Schema Head JSON-LD strings.
     */
    public function getSchemaHeadJsonAttribute()
    {
        if (empty($this->json_ld_schema)) {
            return [$this->generateDefaultSchema()];
        }
        return is_array($this->json_ld_schema) ? $this->json_ld_schema : [$this->json_ld_schema];
    }

    /**
     * Get array of Schema Body JSON-LD strings.
     */
    public function getSchemaBodyJsonAttribute()
    {
        return [];
    }

    /**
     * Get formatted JSON-LD Schema.
     */
    public function getJsonLdSchemaFormattedAttribute()
    {
        if (empty($this->json_ld_schema)) {
            return $this->generateDefaultSchema();
        }
        return json_encode($this->json_ld_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Get available page types.
     */
    public static function getTypes()
    {
        return [
            'more-publication' => 'More Publications',
            'privacy-policy' => 'Privacy Policy',
            'terms-condition' => 'Terms & Conditions',
            'language' => 'Language',
        ];
    }

    /**
     * Get formatted type name.
     */
    public function getTypeNameAttribute()
    {
        $types = self::getTypes();
        return $types[$this->type] ?? ucfirst(str_replace('-', ' ', $this->type));
    }

    /**
     * Get available statuses.
     */
    public static function getStatuses()
    {
        return [
            'active' => 'Active',
            'inactive' => 'Inactive',
            'draft' => 'Draft',
        ];
    }

    /**
     * Get formatted status name.
     */
    public function getStatusNameAttribute()
    {
        $statuses = self::getStatuses();
        return $statuses[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Get status badge color class.
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            'active' => 'bg-green-100 text-green-800',
            'inactive' => 'bg-red-100 text-red-800',
            'draft' => 'bg-yellow-100 text-yellow-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    /**
     * Generate default JSON-LD Schema for page.
     */
    private function generateDefaultSchema()
    {
        $baseSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebPage',
            'name' => $this->title,
            'description' => $this->excerpt ?: substr(strip_tags($this->description), 0, 160),
            'url' => url('/page/' . $this->slug),
            'datePublished' => $this->created_at->toISOString(),
            'dateModified' => $this->updated_at->toISOString(),
        ];

        if ($this->feature_image) {
            $baseSchema['image'] = $this->feature_image_url;
        }

        return json_encode($baseSchema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
