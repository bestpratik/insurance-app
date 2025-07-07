<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fact extends Model
{
    protected $table = 'facts';
    protected $fillable = [
        'title',
        'icon',
        'description',
        'created_at',
        'updated_at'
    ];
}
