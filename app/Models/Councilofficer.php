<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Councilofficer extends Model
{
    protected $table = 'councilofficers';
    protected $fillable = [
        'user_id',
        'council_id',
        'status',
        'created_at',
        'updated_at',
    ];

     public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function council()
    {
        return $this->belongsTo(Council::class, 'council_id', 'id');
    }
}
