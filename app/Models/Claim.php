<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $table = 'claims';
    protected $fillable = [
        'title',
        'description'
    ];
}
