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
        'updated_at',
        'type_of_insurance',
        'rent_amount_from',
        'rent_amount_to',
        'details_of_cover',
        'validity',
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

    public function purchase(){
        return $this->belongsTo(Purchase::class, 'id');
    }


    public function staticdocuments()
    {
        return $this->hasMany(Insurancedocument::class, 'insurance_id');
    }

    public function dynamicdocument(){
        return $this->hasMany(Insurancedynamicdocument::class, 'insurance_id');
    }

    public function insurancemailtemplate()
    {
        return $this->hasOne(Insuranceemailtemplate::class, 'insurance_id');
    }
    
}


