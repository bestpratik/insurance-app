<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Purchase extends Model
{
    use Sluggable;

    protected $table = 'purchases';
    protected $fillable = [
        'insurance_id',
        'provider_type',
        'policy_no',
        'policy_holder_type',
        'policy_holder_title',
        'policy_holder_fname',
        'policy_holder_lname',
        'policy_holder_name',
        'company_name',
        'policy_holder_address',
        'policy_holder_email',
        'policy_holder_phone',
        'policy_start_date',
        'policy_end_date',
        'transaction_type',
        'payable_amount',
        'property_address',
        'status',
        'created_at',
        'updated_at',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function insurance(){
        return $this->belongsTo(Insurance::class, 'insurance_id');
    }

     public function provider(){
        return $this->belongsTo(Provider::class, 'provider_type');
    }
}
