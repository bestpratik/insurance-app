<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    protected $table = 'blogtags';
    protected $fillable = [
        'tag_name',
        'status',
        'is_popular'
    ];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blogwisetags', 'tag_id', 'blog_id');
    }
}
