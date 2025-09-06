<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'delivery_boy_id',
        'customer_name',
        'delivery_address',
        'status',
        'pickup_location',
        'delivery_date',
        'notes'
    ];

    protected $casts = [
        'delivery_date' => 'datetime'
    ];

    public function deliveryBoy()
    {
        return $this->belongsTo(DeliveryBoy::class);
    }
} 