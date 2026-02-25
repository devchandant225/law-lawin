@props(['post'])

@php
    // Handle different column names between Post (service/practice) and Publication models
    // Post model uses: meta_title, meta_description, meta_keywords
    // Publication model uses: metatitle, metadescription, metakeywords
    
    // Use ?: (elvis operator) to handle empty strings as false, ensuring fallbacks work
    $title = ($post->meta_title ?: ($post->metatitle ?: ($post->title ?? $post->name)));
    
    // For description, prioritize meta descriptions, then excerpt, then limit content
    $rawDescription = ($post->meta_description ?: ($post->metadescription ?: ($post->excerpt ?: ($post->tagline ?: ($post->description ?? '')))));
    $description = Str::limit(strip_tags($rawDescription), 160);
    
    $keywords = ($post->meta_keywords ?: ($post->metakeywords ?: ''));
    
    // Handle image URL
    // Post/Publication models use feature_image_url, Team uses image_url
    $image = $post->feature_image_url ?: ($post->image_url ?: asset('images/default-og-image.jpg'));
    
    $url = request()->url();
    $siteName = config('app.name', 'Professional Law Organization');
    $locale = 'en_US'; // Default locale
    
    // Schema
    $schemaHeadArray = $post->schema_head_json ?? [];
    $schemaBodyArray = $post->schema_body_json ?? [];
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

{{-- JSON-LD (Head) --}}
@foreach($schemaHeadArray as $schemaItem)
<script type="application/ld+json">
{!! is_array($schemaItem) ? json_encode($schemaItem, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $schemaItem !!}
</script>
@endforeach

{{-- JSON-LD (Body) --}}
@if(count($schemaBodyArray) > 0)
@push('scripts')
@foreach($schemaBodyArray as $schemaItem)
<script type="application/ld+json">
{!! is_array($schemaItem) ? json_encode($schemaItem, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : $schemaItem !!}
</script>
@endforeach
@endpush
@endif
