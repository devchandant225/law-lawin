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
        'schema_json_ld',
        'page_type',
        'is_active'
    ];
    
    protected $casts = [
        'schema_json_ld' => 'array',
        'is_active' => 'boolean'
    ];
    
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
