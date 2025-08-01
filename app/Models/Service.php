<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = "services";

    protected $fillable = [
        'title',
        'sub_title',
        'image',
        'description',
        'created_at',
        'updated_at'
    ];
}
