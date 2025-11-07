<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsContentSection extends Model
{
    use HasFactory;

    protected $table = 'about_us_content_sections';

    protected $fillable = [
        'title',
        'desc_1',
        'desc_2',
        'image1',
        'image2',
        'page_type',
        'status',
        'order_list'
    ];

    protected $casts = [
        'order_list' => 'integer',
    ];

    // Page type constants
    const PAGE_TYPE_ABOUT = 'about-page';
    const PAGE_TYPE_HOME = 'home-page';

    // Status constants
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';

    /**
     * Get page type options
     */
    public static function getPageTypeOptions()
    {
        return [
            self::PAGE_TYPE_ABOUT => 'About Page',
            self::PAGE_TYPE_HOME => 'Home Page'
        ];
    }

    /**
     * Get status options
     */
    public static function getStatusOptions()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_INACTIVE => 'Inactive'
        ];
    }

    /**
     * Scope a query to only include active content sections.
     */
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /**
     * Scope a query to filter by page type.
     */
    public function scopeForPageType($query, $pageType)
    {
        return $query->where('page_type', $pageType);
    }

    /**
     * Scope a query to order by order_list.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_list', 'asc');
    }

    /**
     * Scope a query to search content sections.
     */
    public function scopeSearch($query, $search)
    {
        return $query->where(function($q) use ($search) {
            $q->where('title', 'like', '%' . $search . '%')
              ->orWhere('desc_1', 'like', '%' . $search . '%')
              ->orWhere('desc_2', 'like', '%' . $search . '%');
        });
    }

    /**
     * Get the page type label
     */
    public function getPageTypeLabelAttribute()
    {
        $options = self::getPageTypeOptions();
        return $options[$this->page_type] ?? $this->page_type;
    }

    /**
     * Get the status label
     */
    public function getStatusLabelAttribute()
    {
        $options = self::getStatusOptions();
        return $options[$this->status] ?? $this->status;
    }

    /**
     * Get about page content sections
     */
    public static function getAboutPageContent()
    {
        return self::active()
            ->forPageType(self::PAGE_TYPE_ABOUT)
            ->ordered()
            ->get();
    }
}
