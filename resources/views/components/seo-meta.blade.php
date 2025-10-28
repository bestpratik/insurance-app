@php
    use App\Models\Seo;

    // Detect the current page slug dynamically
    $currentSlug = $pageSlug ?? request()->path();

    // Fetch SEO data for the page slug
    $seo = Seo::where('page_slug', $currentSlug)->first();
@endphp

@if($seo)
    <title>{{ $seo->meta_title ?? $seo->page_title ?? config('app.name') }}</title>

    {{-- Primary Meta Tags --}}
    <meta name="title" content="{{ $seo->meta_title }}">
    <meta name="description" content="{{ $seo->meta_description }}">
    <meta name="keywords" content="{{ $seo->meta_keyword }}">

    {{-- Open Graph / Facebook --}}
    <meta property="og:type" content="{{ $seo->page_type ?? 'website' }}">
    <meta property="og:locale" content="{{ $seo->locale ?? 'en_US' }}">
    <meta property="og:title" content="{{ $seo->ogtitle ?? $seo->meta_title }}">
    <meta property="og:description" content="{{ $seo->meta_description }}">
    @if($seo->ogimage)
        <meta property="og:image" content="{{ asset('uploads/seo/' . $seo->ogimage) }}">
    @endif
    <meta property="og:site_name" content="{{ $seo->site_name ?? config('app.name') }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="{{ $seo->twitter_card ?? 'summary_large_image' }}">
    <meta name="twitter:title" content="{{ $seo->twitter_title ?? $seo->meta_title }}">
    <meta name="twitter:description" content="{{ $seo->twitter_description ?? $seo->meta_description }}">
    @if($seo->twitter_image)
        <meta name="twitter:image" content="{{ asset('uploads/seo/' . $seo->twitter_image) }}">
    @endif
    <meta name="twitter:site" content="{{ $seo->twitter_site }}">
    <meta name="twitter:creator" content="{{ $seo->twitter_site }}">
@else
    {{-- Default Fallback --}}
    <title>{{ config('app.name') }}</title>
@endif
