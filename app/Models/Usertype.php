<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Usertype extends Model
{
    use Sluggable;

    protected $table = 'usertypes';
    protected $fillable = [
        'type_name',
        'slug',
        'status',
        'created_at',
        'updated_at',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'type_name'
            ]
        ];
    }

    public function users()
    {
        return $this->hasMany(User::class, 'type', 'id');
    }

}
