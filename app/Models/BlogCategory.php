<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table = 'blogcategories';
    protected $fillable = [
        'title',
        'status'
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blogwisecategories', 'category_id', 'blog_id');
    }
}
