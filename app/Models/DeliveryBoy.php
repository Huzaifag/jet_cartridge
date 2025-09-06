<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class DeliveryBoy extends Authenticatable
{
    use HasApiTokens, Notifiable;

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

    public function deliveries()
    {
        return $this->hasMany(Delivery::class);
    }
} 