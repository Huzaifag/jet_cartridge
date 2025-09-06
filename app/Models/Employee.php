<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'visible_password',
        'seller_id',
        'position',
        'permissions',
        'is_active',
        'role',
        'status',
        'profile_picture',
        'work_experience',
        'skills',
        'bio'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'visible_password'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'work_experience' => 'array',
        'skills' => 'array',
        'permissions' => 'array',
        'is_active' => 'boolean'
    ];

    /**
     * Set the employee's password.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
        $this->attributes['visible_password'] = $value;
    }


    public function products()
    {
        return $this->hasMany(Product::class, 'created_by');
    }

    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions ?? []);
    }

    public function hasAnyPermission(array $permissions)
    {
        return !empty(array_intersect($permissions, $this->permissions ?? []));
    }

    public function hasAllPermissions(array $permissions)
    {
        return empty(array_diff($permissions, $this->permissions ?? []));
    }

    public function grantPermission($permission)
    {
        $permissions = $this->permissions ?? [];
        if (!in_array($permission, $permissions)) {
            $permissions[] = $permission;
            $this->permissions = $permissions;
            $this->save();
        }
        return $this;
    }

    public function revokePermission($permission)
    {
        $permissions = $this->permissions ?? [];
        if (($key = array_search($permission, $permissions)) !== false) {
            unset($permissions[$key]);
            $this->permissions = array_values($permissions);
            $this->save();
        }
        return $this;
    }

    public function syncPermissions(array $permissions)
    {
        $this->permissions = $permissions;
        $this->save();
        return $this;
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'employee_followers', 'employee_id', 'follower_id')
                    ->withTimestamps();
    }

    public function isFollowedBy(User $user)
    {
        return $this->followers()->where('follower_id', $user->id)->exists();
    }

    public function leadAssignments()
    {
        return $this->hasMany(LeadAssignment::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function orderInvoices()
    {
        return $this->hasMany(OrderInvoice::class);
    }
} 