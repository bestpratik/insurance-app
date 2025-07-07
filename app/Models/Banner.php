<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = "banner";

    protected $fillable = [
        'title',
        'sub_title',
        'image',
        'created_at',
        'updated_at'
    ];
}
