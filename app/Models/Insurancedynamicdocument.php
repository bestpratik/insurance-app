<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insurancedynamicdocument extends Model
{
    protected $table = 'insurancedynamicdocuments';
    protected $fillable = [
        'insurance_id',
        'title',
        'header',
        'description',
        'footer',
        'created_at',
        'updated_at',
    ];
}
