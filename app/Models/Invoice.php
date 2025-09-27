<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';
    protected $fillable = [
        'purchase_id',
        'invoice_no',
        'invoice_date',
        'payment_due_date',
        'pon',
        'payment_status',
        'is_invoice',
        'billing_name',
        'billing_email',
        'copy_email',
        'billing_phone',
        'billing_address_one',
        'billing_address_two',
        'billing_postcode',
        'billing_full_addresss',
        'created_at',
        'updated_at',
    ];



    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

     public function policyreferralform()
    {
        return $this->belongsTo(Policyreferralform::class);
    }
}
