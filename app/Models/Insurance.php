<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Insurance extends Model
{
    use Sluggable;

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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function provider(){
        return $this->belongsTo(Provider::class, 'provider_type');
    }
}
