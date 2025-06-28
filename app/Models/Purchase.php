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
        'user_id',
        'product_type',
        'policy_no',
        'policy_holder_type',
        'policy_holder_title',
        'policy_holder_fname',
        'policy_holder_lname',
        'policy_holder_name',
        'company_name',
        'policy_holder_address',
        'policy_holder_email',
        'copy_email',
        'policy_holder_phone',
        'policy_start_date',
        'policy_end_date',
        'ast_start_date',
        'transaction_type',
        'payable_amount',
        'property_address',
        'tenant_name',
        'tenant_phone',
        'tenant_email',
        'rent_amount',
        'insurance_type',
        'payment_method',
        'door_no',
        'address_one',
        'address_two',
        'address_three',
        'post_code',
        'policy_holder_address_one',
        'policy_holder_address_two',
        'policy_holder_alternative_phone',
        'policy_holder_postcode',
        'policy_holder_company_email',
        'policy_holder_company_phone',
        'policy_term',
        'purchase_date',
        'net_premium',
        'commission',
        'gross_premium',
        'ipt',
        'total_premium',
        'ipt_on_billable_amount',
        'status',
        'purchase_status',
        'purchase_cancel_reason',
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

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
}
