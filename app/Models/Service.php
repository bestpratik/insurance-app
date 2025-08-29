<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = "services";

    protected $fillable = [
        'insurance_id',
        'title',
        'sub_title',
        'image',
        'offer',
        'description',
        'created_at',
        'updated_at'
    ];

    public function insurance()
    {
        return $this->belongsTo(Insurance::class, 'insurance_id');
    }

    public function insurancedocuments()
    {
        return $this->insurance->staticdocuments();
    }

    
}
