<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = "contact";

    protected $fillable = [
        'address',
        'phone',
        'email',
        'link1',
        'link2',
        'link3',
        'link4',
    ];
}
