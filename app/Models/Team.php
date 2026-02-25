<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'email',
        'phone',
        'designation',
        'orderlist',
        'image',
        'description',
        'tagline',
        'experience',
        'qualification',
        'additional_details',
        'metatitle',
        'metadescription',
        'metakeywords',
        'schema_head',
        'schema_body',
        'facebooklink',
        'linkedinlink',
        'status'
    ];

    protected $casts = [
        'schema_head' => 'array',
        'schema_body' => 'array',
        'orderlist' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($team) {
            if (empty($team->slug)) {
                $team->slug = Str::slug($team->name);
            }
        });

        static::updating(function ($team) {
            if ($team->isDirty('name') && empty($team->slug)) {
                $team->slug = Str::slug($team->name);
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
     * Scope a query to only include active teams.
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
        return $query->orderBy('orderlist', 'asc')->orderBy('name', 'asc');
    }

    /**
     * Get the team image URL.
     */
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
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
     * Generate default Google Schema for team member.
     */
    private function generateDefaultSchema()
    {
        $baseSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => $this->name,
            'jobTitle' => $this->designation,
            'description' => $this->tagline ?: substr(strip_tags($this->description), 0, 160),
            'url' => url('/team/' . $this->slug),
        ];

        if ($this->image) {
            $baseSchema['image'] = $this->image_url;
        }

        if ($this->email) {
            $baseSchema['email'] = $this->email;
        }

        if ($this->phone) {
            $baseSchema['telephone'] = $this->phone;
        }

        if ($this->linkedinlink) {
            $baseSchema['sameAs'] = [$this->linkedinlink];
            if ($this->facebooklink) {
                $baseSchema['sameAs'][] = $this->facebooklink;
            }
        } elseif ($this->facebooklink) {
            $baseSchema['sameAs'] = [$this->facebooklink];
        }

        return json_encode($baseSchema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

    /**
     * Get the publications associated with the team member.
     */
    public function publications()
    {
        return $this->belongsToMany(Publication::class, 'publication_team')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    /**
     * Get the count of publications for the team member.
     */
    public function publicationsCount()
    {
        return $this->publications()->count();
    }

    /**
     * Check if team member is associated with a publication.
     */
    public function hasPublication($publicationId)
    {
        return $this->publications()->where('publication_id', $publicationId)->exists();
    }

    /**
     * Get publications with roles for display.
     */
    public function getPublicationsWithRoles()
    {
        return $this->publications()->get()->map(function($publication) {
            return [
                'id' => $publication->id,
                'title' => $publication->title,
                'slug' => $publication->slug,
                'status' => $publication->status,
                'role' => $publication->pivot->role ?? 'Team Member',
                'assigned_at' => $publication->pivot->created_at
            ];
        });
    }
}
