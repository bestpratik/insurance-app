<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $table = 'insurances';
    protected $fillable = [
        'name',
        'provider_type',
        'slug',
        'prefix',
        'net_premium',
        'commission',
        'gross_premium',
        'ipt',
        'total_premium',
        'payable_amount',
        'image',
        'status',
        'created_at',
        'updated_at'
    ];
}
