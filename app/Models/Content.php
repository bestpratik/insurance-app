<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'contents';

    protected $fillable = [
        'title', 
        'page_slug', 
        'description', 
        'created_at',
        'updated_at'
    ];
}
