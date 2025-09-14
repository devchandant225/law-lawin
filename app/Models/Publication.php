<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'feature_image', 'description', 'excerpt', 'status', 'post_type', 'orderlist', 'metatitle', 'metadescription', 'metakeywords', 'google_schema'];

    protected $casts = [
        'google_schema' => 'array',
        'orderlist' => 'integer',
        'post_type' => 'string',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($publication) {
            if (empty($publication->slug)) {
                $publication->slug = Str::slug($publication->title);
            }
        });

        static::updating(function ($publication) {
            if ($publication->isDirty('title') && empty($publication->slug)) {
                $publication->slug = Str::slug($publication->title);
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
     * Scope a query to only include active publications.
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Scope a query to order by orderlist.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('orderlist', 'asc')->orderBy('created_at', 'desc');
    }

    /**
     * Scope a query to only include publications of type 'publication'.
     */
    public function scopePublication($query)
    {
        return $query->where('post_type', 'publication');
    }

    /**
     * Scope a query to only include publications of type 'more-publication'.
     */
    public function scopeMorePublication($query)
    {
        return $query->where('post_type', 'more-publication');
    }

    /**
     * Scope a query to only include publications of type 'service-location'.
     */
    public function scopeServiceLocation($query)
    {
        return $query->where('post_type', 'service-location');
    }

    /**
     * Scope a query to only include publications of type 'language'.
     */
    public function scopeLanguage($query)
    {
        return $query->where('post_type', 'language');
    }

    /**
     * Scope a query to filter by post type.
     */
    public function scopeByPostType($query, $postType)
    {
        return $query->where('post_type', $postType);
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
     * Get the FAQs for the publication.
     */
    public function faqs()
    {
        return $this->hasMany(FAQ::class);
    }

    /**
     * Get the count of active FAQs for the publication.
     */
    public function activeFaqsCount()
    {
        return $this->faqs()->where('status', 'active')->count();
    }

    /**
     * Get the count of all FAQs for the publication.
     */
    public function faqsCount()
    {
        return $this->faqs()->count();
    }

    /**
     * Get the table of contents for the publication.
     */
    public function tableOfContents()
    {
        return $this->hasMany(TableOfContent::class);
    }

    /**
     * Get the ordered table of contents for the publication.
     */
    public function orderedTableOfContents()
    {
        return $this->tableOfContents()->ordered();
    }

    /**
     * Get the count of table of contents items for the publication.
     */
    public function tableOfContentsCount()
    {
        return $this->tableOfContents()->count();
    }

    /**
     * Get the count of active table of contents items for the publication.
     */
    public function activeTableOfContentsCount()
    {
        return $this->tableOfContents()->active()->count();
    }

    /**
     * Get the team members associated with the publication.
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class, 'publication_team')->withPivot('role')->withTimestamps();
    }

    /**
     * Get the count of team members for the publication.
     */
    public function teamsCount()
    {
        return $this->teams()->count();
    }

    /**
     * Check if a team member is associated with this publication.
     */
    public function hasTeamMember($teamId)
    {
        return $this->teams()->where('team_id', $teamId)->exists();
    }

    /**
     * Get team members with their roles for display.
     */
    public function getTeamMembersWithRoles()
    {
        return $this->teams()
            ->get()
            ->map(function ($team) {
                return [
                    'id' => $team->id,
                    'name' => $team->name,
                    'designation' => $team->designation,
                    'slug' => $team->slug,
                    'phone' => $team->phone,
                    'email' => $team->email,
                    'facebooklink' => $team->facebooklink,
                    'linkedinlink' => $team->linkedinlink,
                    'image_url' => $team->image_url,
                    'role' => $team->pivot->role ?? 'Team Member',
                    'assigned_at' => $team->pivot->created_at,
                ];
            });
    }

    /**
     * Generate default Google Schema for publication.
     */
    private function generateDefaultSchema()
    {
        $baseSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'name' => $this->title,
            'description' => $this->excerpt ?: substr(strip_tags($this->title), 0, 160),
            'url' => url('/publications/' . $this->slug),
            'datePublished' => $this->created_at->toISOString(),
            'dateModified' => $this->updated_at->toISOString(),
        ];

        if ($this->feature_image) {
            $baseSchema['image'] = $this->feature_image_url;
        }

        return json_encode($baseSchema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
}
