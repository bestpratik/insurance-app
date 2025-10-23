<?php

namespace App\Models;

use App\Models\BlogCategory;
use App\Models\BlogTag;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'status',
        'blog_author',
        'author_image',
        'date',
        'type'
    ];

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blogwisecategories', 'blog_id', 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blogwisetags', 'blog_id', 'tag_id');
    }
}
