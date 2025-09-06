<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'customer_id',
        'product_id',
        'seller_id',
        'message',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function leadAssignments()
    {
        return $this->hasMany(LeadAssignment::class);
    }
}
