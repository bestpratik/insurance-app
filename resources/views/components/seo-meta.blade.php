@php
    use App\Models\Seo;

    // Detect current page slug dynamically
    $currentSlug = $pageSlug ?? request()->path();
    if ($currentSlug === '' || $currentSlug === '/') {
        $currentSlug = '/';
    }

    // Try to get SEO data
    $seo = Seo::where('page_slug', $currentSlug)->first();

    // Define defaults (used if SEO record not found)
    $default = [
        'meta_title' => config('app.name', 'MoneyWise Investments Plc'),
        'meta_description' =>
            'MoneyWise Investments Plc offers expert financial planning, investment advisory, and policy management solutions to help you secure your financial future.',
        'meta_keyword' => 'moneywise, investments, finance, policy, insurance, wealth management',
        'page_type' => 'website',
        'locale' => 'en_US',
        'site_name' => 'MoneyWise Investments Plc',
        'ogtitle' => 'MoneyWise Investments Plc',
        'ogimage' => 'logo.jpg',
        'twitter_card' => 'summary_large_image',
        'twitter_site' => '@moneywiseplc',
        'twitter_title' => 'MoneyWise Investments Plc',
        'twitter_description' => 'Build a better financial future with professional investment and policy advice.',
        'twitter_image' => 'logo.jpg',
    ];

    // Merge SEO record or fallback to defaults
    $meta = $seo ? array_merge($default, $seo->toArray()) : $default;
@endphp

<title>{{ $meta['meta_title'] }}</title>

{{-- Primary Meta Tags --}}
<meta name="title" content="{{ $meta['meta_title'] }}">
<meta name="description" content="{{ strip_tags($meta['meta_description']) }}">
<meta name="keywords" content="{{ $meta['meta_keyword'] }}">

{{-- Open Graph / Facebook --}}
<meta property="og:type" content="{{ $meta['page_type'] }}">
<meta property="og:locale" content="{{ $meta['locale'] }}">
<meta property="og:title" content="{{ $meta['ogtitle'] }}">
<meta property="og:description" content="{{ strip_tags($meta['meta_description']) }}">
<meta property="og:site_name" content="{{ $meta['site_name'] }}">
<meta property="og:url" content="{{ url()->current() }}">
@if (!empty($meta['ogimage']))
    <meta property="og:image" content="{{ asset('uploads/seo/' . $meta['ogimage']) }}">
@endif

{{-- Twitter --}}
<meta name="twitter:card" content="{{ $meta['twitter_card'] }}">
<meta name="twitter:title" content="{{ $meta['twitter_title'] }}">
<meta name="twitter:description" content="{{ strip_tags($meta['twitter_description']) }}">
<meta name="twitter:site" content="{{ $meta['twitter_site'] }}">
<meta name="twitter:creator" content="{{ $meta['twitter_site'] }}">
@if (!empty($meta['twitter_image']))
    <meta name="twitter:image" content="{{ asset('uploads/seo/' . $meta['twitter_image']) }}">
@endif
