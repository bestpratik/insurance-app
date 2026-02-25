@php
    $meta_title = $seo->meta_title ?? config('app.name');
    $meta_description = $seo->meta_description ?? '';
    $meta_keyword = $seo->meta_keyword ?? '';
    $og_title = $seo->og_title ?? $meta_title;
    $og_description = $seo->og_description ?? $meta_description;
    // $ogimage = $seo->ogimage ?? 'default.jpg';
    $twitter_title = $seo->twitter_title ?? $meta_title;
    $twitter_description = $seo->twitter_description ?? $meta_description;
    // $twitter_image = $seo->twitter_image ?? 'default.jpg';

    // $ogImageUrl =  asset('uploads/seo/' . $ogimage) ?: asset('uploads/service/'. $image) ?: asset('uploads/blogs/' . $image) ?: asset('uploads/seo/default.jpg') ;
    $ogImageUrl = null;

    // If service page
    if (isset($model) && strtolower(class_basename($model)) === 'service' && !empty($model->image)) {
        $ogImageUrl = asset('uploads/service/' . $model->image);
    }

    // If blog page
    elseif (isset($model) && strtolower(class_basename($model)) === 'blog' && !empty($model->image)) {
        $ogImageUrl = asset('uploads/blogs/' . $model->image);
    }

    // If SEO has custom uploaded image
    elseif (isset($seo) && !empty($seo->ogimage)) {
        $ogImageUrl = asset('uploads/seo/' . $seo->ogimage);
    }
@endphp

<title>{{ $meta_title }}</title>

<meta name="description" content="{{ strip_tags($meta_description) }}">
<meta name="keywords" content="{{ $meta_keyword }}">

<meta property="og:title" content="{{ $og_title }}">
<meta property="og:description" content="{{ strip_tags($og_description) }}">
<meta property="og:url" content="{{ url()->current() }}">
{{-- @php
    $ogImageUrl = null;

    if (isset($seo) && !empty($seo->ogimage)) {
        $ogImageUrl = asset('uploads/seo/' . $seo->ogimage);
    } elseif (isset($blog) && !empty($blog->image)) {
        $ogImageUrl = asset('uploads/blogs/' . $blog->image);
    } elseif (isset($service) && !empty($service->image)) {
        $ogImageUrl = asset('uploads/service/' . $service->image);
    } else {
        $ogImageUrl = asset('uploads/seo/default.jpg');
    }
@endphp --}}

<meta property="og:image" content="{{ $ogImageUrl }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $twitter_title }}">
<meta name="twitter:description" content="{{ strip_tags($twitter_description) }}">
<meta name="twitter:image" content="{{ $ogImageUrl }}">
