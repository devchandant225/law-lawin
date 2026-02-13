@props(['post'])

@php
    // Handle different column names between Post (service/practice) and Publication models
    // Post model uses: meta_title, meta_description, meta_keywords
    // Publication model uses: metatitle, metadescription, metakeywords
    
    // Use ?: (elvis operator) to handle empty strings as false, ensuring fallbacks work
    $title = ($post->meta_title ?: ($post->metatitle ?: $post->title));
    
    // For description, prioritize meta descriptions, then excerpt, then limit content
    $rawDescription = ($post->meta_description ?: ($post->metadescription ?: ($post->excerpt ?: ($post->description ?? ''))));
    $description = Str::limit(strip_tags($rawDescription), 160);
    
    $keywords = ($post->meta_keywords ?: ($post->metakeywords ?: ''));
    
    // Handle image URL
    // Both Post and Publication models have getFeatureImageUrlAttribute accessor
    $image = $post->feature_image_url ?: asset('images/default-og-image.jpg');
    
    $url = request()->url();
    $siteName = config('app.name', 'Professional Law Organization');
    $locale = 'en_US'; // Default locale
    
    // Schema
    $schemaData = null;
    
    // Check for direct google_schema json/array
    if (!empty($post->google_schema)) {
         if (is_string($post->google_schema)) {
             $schemaData = $post->google_schema;
         } else {
             $schemaData = json_encode($post->google_schema, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
         }
    } 
    // Check for accessor
    elseif (isset($post->google_schema_json)) {
        $schemaData = $post->google_schema_json;
    }
    
    // Fallback schema if empty
    if (empty($schemaData)) {
         // Determine schema type
         $schemaType = 'Article'; // Default
         
         // Check if it's a Service (Post model with type='service')
         if (isset($post->type) && $post->type === 'service') {
             $schemaType = 'Service';
         }
         
         $schemaData = json_encode([
            '@context' => 'https://schema.org',
            '@type' => $schemaType,
            'name' => $title,
            'description' => $description,
            'url' => $url,
            'image' => $image,
            'datePublished' => $post->created_at->toISOString(),
            'dateModified' => $post->updated_at->toISOString(),
            'author' => [
                '@type' => 'Organization',
                'name' => $siteName
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => $siteName,
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.png')
                ]
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }
@endphp

<title>{{ $title }}</title>
<meta name="description" content="{{ $description }}">
<meta name="keywords" content="{{ $keywords }}">
<meta name="author" content="{{ $siteName }}">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ $url }}">

{{-- Open Graph Meta Tags --}}
<meta property="og:type" content="article">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="{{ $locale }}">

{{-- Twitter Card --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
<meta name="twitter:url" content="{{ $url }}">

{{-- Theme --}}
<meta name="theme-color" content="#6f64d3">
<meta name="msapplication-TileColor" content="#6f64d3">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">

{{-- JSON-LD --}}
<script type="application/ld+json">
{!! $schemaData !!}
</script>
