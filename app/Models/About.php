<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = "about";

    protected $fillable = [
        'image',
        'title',
        'sub_title',
        'description',
        'created_at',
        'updated_at'
    ];
}
