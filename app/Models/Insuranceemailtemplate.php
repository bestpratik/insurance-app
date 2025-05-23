<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insuranceemailtemplate extends Model
{
    protected $table = 'insuranceemailtemplates';
    protected $fillable = [
        'insurance_id',
        'title',
        'description',
        'created_at',
        'updated_at',
    ];
}
