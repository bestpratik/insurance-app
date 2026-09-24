<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Council extends Model
{
    protected $table = 'councils';
    protected $fillable = [
        'council_name',
        'council_email',
        'created_at',
        'updated_at',
    ];
}
