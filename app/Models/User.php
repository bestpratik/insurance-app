<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'council_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userType()
    {
        return $this->belongsTo(Usertype::class, 'type', 'id');
    }

    public function isAdmin()
    {
        return $this->userType?->slug === 'admin';
    }

    public function isCouncilOfficer()
    {
        return $this->userType?->slug === 'council-officer';
    }

    public function council()
    {
        return $this->belongsTo(Council::class, 'council_id', 'id');
    }


    public function councilOfficer()
    {
        return $this->hasOne(Councilofficer::class, 'user_id', 'id');
    }

    // App\Models\User.php

    public function hasType($type)
    {
        // return $this->type === $type;
        return $this->userType && $this->userType->slug === $type;
    }
}
