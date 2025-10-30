<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RentGuarantee extends Model
{
    protected $table = 'rent_guarantees';
    protected $fillable = [
        'title',
        'image',
        'image_alt',
        'description',
        'button_text',
        'button_link',
        'phone_number'
    ];
}
