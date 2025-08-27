# Service Section Component - Dynamic Implementation Guide

## Overview

The `ServiceSection` component has been successfully updated to dynamically render service cards from the database instead of using hardcoded HTML. This makes the component flexible and maintainable.

## Features Implemented

✅ **Dynamic Service Rendering**: Services are now fetched from the database and rendered dynamically
✅ **Customizable Titles**: Section title and subtitle can be customized
✅ **Intelligent Icon Mapping**: Icons are automatically assigned based on service titles
✅ **Image Fallbacks**: Default images are used when services don't have feature images
✅ **Proper URL Routing**: Service links now use proper Laravel routing
✅ **Conditional Brand Section**: Brands section can be shown/hidden based on parameter
✅ **Animation Delays**: Dynamic animation delays based on service position
✅ **Empty State Handling**: Graceful handling when no services are available

## Usage Examples

### Basic Usage
```php
<x-service-section />
```

### Customized Usage (Homepage Example)
```php
<x-service-section 
    :limit="4"
    :showBrands="true"
    sectionTitle="We're Providing Best <br> <span>Service To Clients</span>"
    sectionSubtitle="Our Services"
/>
```

### Advanced Usage with Custom Parameters
```php
<x-service-section 
    :limit="8"
    :showBrands="false"
    sectionTitle="<span class='text-primary'>Legal Services</span> We Offer"
    sectionSubtitle="Professional Legal Solutions"
/>
```

### Services Page Usage
```php
<x-service-section 
    :limit="null"
    :showBrands="false"
    sectionTitle="All Our Services"
    sectionSubtitle="Complete Service Portfolio"
/>
```

## Component Parameters

| Parameter | Type | Default | Description |
|-----------|------|---------|-------------|
| `limit` | `int\|null` | `4` | Number of services to display (null for all) |
| `showBrands` | `bool` | `true` | Whether to show the brands section |
| `sectionTitle` | `string\|null` | `"We're Providing Best Service To Clients"` | Main section title (supports HTML) |
| `sectionSubtitle` | `string\|null` | `"Our Services"` | Section subtitle/tagline |

## Available Methods in ServiceSection Component

### Public Methods
- `getServices($limit, $status)` - Get services with optional limit and status filter
- `getHomeServices()` - Get services for homepage (limited to 8)
- `getAllServices()` - Get all active services
- `getFeaturedServices($limit)` - Get featured services with images
- `getPaginatedServices($perPage)` - Get paginated services for admin/large lists
- `getRelatedServices($currentSlug, $limit)` - Get related services (excluding current)
- `searchServices($query, $limit)` - Search services by title/description
- `getServiceStats()` - Get service statistics
- `getServiceIcon($title)` - Get appropriate icon class for service

### Icon Mapping
The component automatically maps service titles to appropriate icons:

- **Criminal** → `icon-criminal-law`
- **Family** → `icon-family-law`
- **Real Estate** → `icon-real-estate-law`
- **Employment** → `icon-employment-law`
- **Business** → `icon-business-law`
- **Immigration** → `icon-immigration-law`
- **Tax** → `icon-tax-law`
- **Personal Injury** → `icon-personal-injury`
- **Intellectual Property** → `icon-ip-law`
- **Corporate** → `icon-corporate-law`
- **Default** → `icon-law`

## Service Model Requirements

Services should be stored as `Post` records with:
- `type` = `'service'`
- `status` = `'active'`
- `title` (required)
- `slug` (auto-generated from title)
- `description` (required)
- `excerpt` (optional, falls back to truncated description)
- `feature_image` (optional, falls back to default image)

## Database Structure

Services are stored in the `posts` table with the following key fields:
```sql
- id (primary key)
- title (varchar)
- slug (varchar, unique)
- description (text)
- excerpt (text, nullable)
- feature_image (varchar, nullable)
- type (varchar) -- should be 'service'
- status (varchar) -- should be 'active'
- created_at (timestamp)
- updated_at (timestamp)
```

## Routing

The component uses the following route for service detail pages:
```php
Route::get('/service/{slug}', [ServiceController::class, 'show'])->name('service.show');
```

## Customization Tips

### 1. Adding New Icon Mappings
Edit the `getServiceIcon()` method in `app/View/Components/ServiceSection.php`:

```php
$iconMap = [
    'criminal' => 'icon-criminal-law',
    'family' => 'icon-family-law',
    // Add your new mappings here
    'bankruptcy' => 'icon-bankruptcy-law',
];
```

### 2. Customizing Default Images
Update the fallback image path in the blade template:
```php
<img src="{{ asset('assets/images/resources/your-default-image.png') }}" alt="{{ $service->title }}">
```

### 3. Modifying Animation Delays
Adjust the animation delay calculation:
```php
data-wow-delay="{{ $index * 100 }}ms"  // Current: 0ms, 100ms, 200ms, 300ms
data-wow-delay="{{ $index * 150 }}ms"  // Modified: 0ms, 150ms, 300ms, 450ms
```

### 4. Changing Grid Layout
Modify Bootstrap classes for different layouts:
```php
// Current: 4 columns on desktop, 2 on tablet
<div class="col-xl-3 col-md-6 wow fadeInUp" data-wow-delay="{{ $index * 100 }}ms">

// Alternative: 3 columns on desktop, 1 on tablet
<div class="col-xl-4 col-md-12 wow fadeInUp" data-wow-delay="{{ $index * 100 }}ms">
```

## Testing the Implementation

1. **Create test services** in the admin panel
2. **Verify dynamic rendering** on the homepage
3. **Test fallback images** by creating services without feature images
4. **Check icon mapping** by creating services with different titles
5. **Test empty state** by temporarily deactivating all services

## Migration from Static to Dynamic

If upgrading from the previous static version:

1. ✅ **Component file updated**: `resources/views/components/service-section.blade.php`
2. ✅ **Dynamic data binding**: Services now come from database
3. ✅ **URL routing**: Links now use `route('service.show', $service->slug)`
4. ✅ **Icon mapping**: Icons now assigned dynamically
5. ✅ **Image handling**: Fallback system implemented

## Benefits of Dynamic Implementation

1. **Maintainability**: Services can be managed through admin panel
2. **Consistency**: Same component can be used across different pages
3. **Flexibility**: Easy customization through parameters
4. **SEO Friendly**: Proper URLs and meta information
5. **Performance**: Efficient database queries with optional limits
6. **User Experience**: Graceful handling of edge cases

## Next Steps

Consider implementing these additional features:

1. **Service Categories**: Add category filtering
2. **Service Tags**: Tag-based organization
3. **Service Ratings**: User rating system
4. **Service Booking**: Online appointment booking
5. **Dynamic Brands**: Make brands section dynamic too
6. **Service Search**: Advanced search functionality
7. **Service Analytics**: Track service views and interactions
