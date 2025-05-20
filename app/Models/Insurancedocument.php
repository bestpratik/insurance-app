<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Insurancedocument extends Model
{
    use Sluggable;

    protected $table = 'insurancedocuments';
    protected $fillable = [
        'insurance_id',
        'title',
        'slug',
        'document',
        'created_at',
        'updated_at'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
            ]
        ];
    }
}
