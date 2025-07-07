<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contactform extends Model
{
    protected $table = 'contactform';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'comment'
    ];
}
