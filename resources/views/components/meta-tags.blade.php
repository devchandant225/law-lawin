@php
    // Initialize defaults that were previously in @props
    $siteName = config('app.name', 'Professional Law Organization');
    $locale = 'en_US';

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
    
    // Set meta values with priority: props > post specific > database > defaults
    // Use ?: (elvis operator) to handle empty strings as missing values
    // Use optional() or checks to handle null post
    $postMetaTitle = $post ? $post->meta_title : null;
    $postTitle = $post ? $post->title : null;
    $postMetaDesc = $post ? $post->meta_description : null;
    $postExcerpt = $post ? $post->excerpt : null;
    $postMetaKeywords = $post ? $post->meta_keywords : null;
    $postImage = $post ? $post->feature_image_url : null;

    $metaTitle = $title ?: ($postMetaTitle ?: ($postTitle ?: ($dbMetaTag->title ?? config('app.name'))));
    $metaDescription = $description ?: ($postMetaDesc ?: ($postExcerpt ?: ($dbMetaTag->desc ?? 'Professional legal services and expertise')));
    $metaKeywords = $keywords ?: ($postMetaKeywords ?: ($dbMetaTag->keyword ?? 'legal services, law firm, professional legal advice'));
    $metaImage = $image ?: ($postImage ?: ($dbMetaTag && $dbMetaTag->image ? \Storage::url($dbMetaTag->image) : asset('images/default-og-image.jpg')));
    $metaUrl = request()->url();
    
    // Generate Schema.org structured data
    $schemaData = null;
    if (isset($customSchema)) {
        $schemaData = $customSchema;
    } elseif ($post && $post->google_schema_json) {
        $schemaData = $post->google_schema_json;
    } elseif ($dbMetaTag && $dbMetaTag->schema_json_ld) {
        $schemaData = json_encode($dbMetaTag->schema_json_ld, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    } elseif (isset($schema)) {
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
                'name' => $siteName ?? config('app.name')
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => $siteName ?? config('app.name'),
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
