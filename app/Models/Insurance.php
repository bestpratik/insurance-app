<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Insurance extends Model
{
    use Sluggable;


    protected $table = 'insurances';
    protected $fillable = [
        'uuid',
        'type_of_insurance',
        'name',
        'slug',
        'provider_type',
        'prefix',
        'rent_amount_from',
        'rent_amount_to',
        'validity',
        'net_premium',
        'commission',
        'gross_premium',
        'ipt',
        'total_premium',
        'payable_amount',
        'ipt_on_billable_amount',
        'admin_fee',
        'details_of_cover',
        'image',
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

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_type');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'id');
    }

     public function policyreferralform()
    {
        return $this->belongsTo(Policyreferralform::class, 'id');
    }

    public function staticdocuments()
    {
        return $this->hasMany(Insurancedocument::class, 'insurance_id');
    }

    public function dynamicdocument()
    {
        return $this->hasMany(Insurancedynamicdocument::class, 'insurance_id');
    }

    public function insurancemailtemplate()
    {
        return $this->hasOne(Insuranceemailtemplate::class, 'insurance_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'insurance_id');
    }
}
