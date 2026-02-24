<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetaTag extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'desc',
        'keyword',
        'image',
        'schema_head',
        'schema_body',
        'page_type',
        'is_active'
    ];
    
    protected $casts = [
        'schema_head' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Get formatted Schema Head as JSON-LD.
     */
    public function getSchemaHeadJsonAttribute()
    {
        if (empty($this->schema_head)) {
            return null;
        }
        return is_array($this->schema_head) 
            ? json_encode($this->schema_head, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
            : $this->schema_head;
    }

    /**
     * Get formatted Schema Body as JSON-LD.
     */
    public function getSchemaBodyJsonAttribute()
    {
        if (empty($this->schema_body)) {
            return null;
        }
        return is_array($this->schema_body)
            ? json_encode($this->schema_body, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)
            : $this->schema_body;
    }
    
    /**
     * Scope to get active meta tags
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
    /**
     * Get page types for admin form
     */
    public static function getPageTypes()
    {
        return [
            'home' => 'Home Page',
            'about' => 'About Page', 
            'service' => 'Service Page',
            'services' => 'Services Listing',
            'publication' => 'Publication Page',
            'more-publication' => 'More Publications',
            'practice' => 'Practice Page',
            'practices' => 'Practices Listing', 
            'language' => 'Language Page',
            'languages' => 'Languages Listing',
            'service-location' => 'Service Location',
            'service-locations' => 'Service Locations Listing',
            'calculator' => 'Calculator Page',
            'privacy' => 'Privacy Policy',
            'terms-condition' => 'Terms & Conditions',
            'team' => 'Team Page',
            'contact' => 'Contact Page',
            'portfolios' => 'Portfolios Page',
            'help-desk' => 'Help Desk Page'
        ];
    }
    
    /**
     * Get meta tag by page type
     */
    public static function getByPageType($pageType)
    {
        return static::active()->where('page_type', $pageType)->first();
    }
}
