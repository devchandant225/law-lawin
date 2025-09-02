@props([
    'title' => null,
    'description' => null,
    'keywords' => null,
    'image' => null,
    'url' => null,
    'type' => 'website',
    'siteName' => config('app.name', 'Professional Law Organization'),
    'locale' => 'en_US',
    'schema' => null,
    'post' => null, // Post model instance
    'customSchema' => null
])

@php
    // Determine page type from current URL
    $currentPath = request()->path();
    $pageType = null;
    
    // Map URL patterns to page types
    $urlToPageTypeMap = [
        '' => 'home',
        '/' => 'home',
        'about' => 'about',
        'about/introduction' => 'about',
        'about/executive-committee' => 'about',
        'service' => 'service',
        'services' => 'services',
        'publication' => 'publication',
        'more-publication' => 'more-publication',
        'practice' => 'practice',
        'practices' => 'practices',
        'language' => 'language',
        'languages' => 'languages',
        'service-location' => 'service-location',
        'service-locations' => 'service-locations',
        'calculator' => 'calculator',
        'privacy' => 'privacy',
        'terms-condition' => 'terms-condition',
        'team' => 'team',
        'contact' => 'contact',
        'portfolios' => 'portfolios',
        'help-desk' => 'help-desk',
        'help-desk/nrn-legal' => 'help-desk',
        'help-desk/fdi-legal' => 'help-desk'
    ];
    
    // Find page type by checking URL patterns
    foreach ($urlToPageTypeMap as $pattern => $type) {
        if ($currentPath === $pattern || (strpos($currentPath, $pattern) === 0 && $pattern !== '')) {
            $pageType = $type;
            break;
        }
    }
    
    // If we have a page type, try to fetch meta tags from database
    $dbMetaTag = null;
    if ($pageType) {
        $dbMetaTag = \App\Models\MetaTag::getByPageType($pageType);
    }
    
    // Set meta values with priority: props > database > post > defaults
    $metaTitle = $title ?? ($dbMetaTag->title ?? ($post->title ?? config('app.name')));
    $metaDescription = $description ?? ($dbMetaTag->desc ?? ($post->excerpt ?? $post->meta_description ?? 'Professional legal services and expertise'));
    $metaKeywords = $keywords ?? ($dbMetaTag->keyword ?? ($post->meta_keywords ?? 'legal services, law firm, professional legal advice'));
    $metaImage = $image ?? ($dbMetaTag && $dbMetaTag->image ? \Storage::url($dbMetaTag->image) : ($post->feature_image_url ?? asset('images/default-og-image.jpg')));
    $metaUrl = $url ?? request()->url();
    
    // Generate Schema.org structured data
    $schemaData = null;
    if ($customSchema) {
        $schemaData = $customSchema;
    } elseif ($dbMetaTag && $dbMetaTag->schema_json_ld) {
        $schemaData = json_encode($dbMetaTag->schema_json_ld, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    } elseif ($post && $post->google_schema_json) {
        $schemaData = $post->google_schema_json;
    } elseif ($schema) {
        $schemaData = $schema;
    } else {
        $schemaData = json_encode([
            '@context' => 'https://schema.org',
            '@type' => $type === 'article' ? 'Article' : ($type === 'service' ? 'Service' : 'WebPage'),
            'name' => $metaTitle,
            'description' => $metaDescription,
            'url' => $metaUrl,
            'image' => $metaImage,
            'datePublished' => $post ? $post->created_at->toISOString() : now()->toISOString(),
            'dateModified' => $post ? $post->updated_at->toISOString() : now()->toISOString(),
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

{{-- Basic Meta Tags --}}
<title>{{ $metaTitle }}</title>
<meta name="description" content="{{ $metaDescription }}">
<meta name="keywords" content="{{ $metaKeywords }}">
<meta name="author" content="{{ $siteName }}">
<meta name="robots" content="index, follow">
<link rel="canonical" href="{{ $metaUrl }}">

{{-- Open Graph Meta Tags (Facebook) --}}
<meta property="og:type" content="{{ $type }}">
<meta property="og:title" content="{{ $metaTitle }}">
<meta property="og:description" content="{{ $metaDescription }}">
<meta property="og:image" content="{{ $metaImage }}">
<meta property="og:url" content="{{ $metaUrl }}">
<meta property="og:site_name" content="{{ $siteName }}">
<meta property="og:locale" content="{{ $locale }}">

{{-- Twitter Card Meta Tags --}}
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $metaTitle }}">
<meta name="twitter:description" content="{{ $metaDescription }}">
<meta name="twitter:image" content="{{ $metaImage }}">
<meta name="twitter:url" content="{{ $metaUrl }}">

{{-- Additional Meta Tags for Better SEO --}}
<meta name="theme-color" content="#6f64d3">
<meta name="msapplication-TileColor" content="#6f64d3">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="format-detection" content="telephone=no">

{{-- Article specific meta tags --}}
@if($type === 'article' && $post)
    <meta property="article:published_time" content="{{ $post->created_at->toISOString() }}">
    <meta property="article:modified_time" content="{{ $post->updated_at->toISOString() }}">
    <meta property="article:author" content="{{ $siteName }}">
    @if($post->meta_keywords)
        @foreach(explode(',', $post->meta_keywords) as $tag)
            <meta property="article:tag" content="{{ trim($tag) }}">
        @endforeach
    @endif
@endif

{{-- Service specific meta tags --}}
@if($type === 'service' && $post)
    <meta property="product:availability" content="in stock">
    <meta property="product:condition" content="new">
@endif

{{-- JSON-LD Structured Data --}}
<script type="application/ld+json">
{!! $schemaData !!}
</script>

{{-- Preload critical resources --}}
<link rel="preload" href="{{ asset('css/app.css') }}" as="style">
<link rel="preload" href="{{ asset('js/app.js') }}" as="script">

{{-- DNS Prefetch for external resources --}}
<link rel="dns-prefetch" href="//fonts.googleapis.com">
<link rel="dns-prefetch" href="//fonts.gstatic.com">

{{-- Viewport and responsive meta tags --}}
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">

{{-- Additional schema for organization (if homepage) --}}
@if(request()->is('/') || request()->is('home'))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "{{ $siteName }}",
  "url": "{{ url('/') }}",
  "logo": "{{ asset('images/logo.png') }}",
  "description": "{{ $metaDescription }}",
  "contactPoint": {
    "@type": "ContactPoint",
    "contactType": "customer service",
    "availableLanguage": "English"
  },
  "sameAs": [
    "https://www.facebook.com/yourorganization",
    "https://www.linkedin.com/company/yourorganization",
    "https://twitter.com/yourorganization"
  ]
}
</script>
@endif

{{-- Breadcrumb Schema for non-homepage --}}
@if(!request()->is('/') && !request()->is('home'))
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "{{ url('/') }}"
    }
    @if(request()->is('services*'))
    ,{
      "@type": "ListItem", 
      "position": 2,
      "name": "Services",
      "item": "{{ route('services.index') }}"
    }
    @endif
    @if($post && request()->route()->getName() === 'service.show')
    ,{
      "@type": "ListItem",
      "position": 3, 
      "name": "{{ $post->title }}",
      "item": "{{ $metaUrl }}"
    }
    @endif
  ]
}
</script>
@endif
