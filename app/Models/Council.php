<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Council extends Model
{
    protected $table = 'councils';
    protected $fillable = [
        'council_name',
        'council_email',
        'council_billing_email',
        'council_billing_phone',
        'council_billing_address',
        'council_billing_postcode',
        'created_at',
        'updated_at',
    ];
}
