<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    protected $table = 'seos';
    protected $fillable = [
        'ref_id',
        'meta_title',
        'meta_description',
        'meta_keyword',
        'page_title',
        'page_slug',
        'seo_title',
        'locale',
        'page_type',
        'type',
        'url',
        'site_name',
        'ogimage',
        'twitter_card',
        'twitter_site',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'has_short_slug',
        'short_slug'
    ];
}
