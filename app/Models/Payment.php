<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'txanid',
        'status',
        'created_at',
        'updated_at',
    ];
}
