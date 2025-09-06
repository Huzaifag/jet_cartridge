<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class AccountPerson extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'account_persons';

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'status',
        'seller_id',
        'visible_password',
        'date_of_birth',
        'gender',
        'emergency_contact',
        'address',
        'city',
        'state',
        'postal_code',
        'country',
        'bio',
        'profile_picture',
        'is_profile_completed'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_profile_completed' => 'boolean',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function setPasswordAttribute($value)
    {
        if ($value && !Hash::isHashed($value)) {
            $this->attributes['password'] = Hash::make($value);
        } else {
            $this->attributes['password'] = $value;
        }
    }
} 