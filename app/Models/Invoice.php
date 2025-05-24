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
        'billing_name',
        'billing_email',
        'billing_phone',
        'created_at',
        'updated_at',
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
}
