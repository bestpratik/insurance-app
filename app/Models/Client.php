<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = "clients";

    protected $fillable = [
        'title',
        'image',
        'created_at',
        'updated_at'
    ];
}
