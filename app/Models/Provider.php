<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Provider extends Model
{
    use Sluggable;
     
    protected $table = 'providers';
    protected $fillable = [
        'name',
        'slug',
        'status',
        'created_at',
        'updated_at'
    ];


    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    
    
}
