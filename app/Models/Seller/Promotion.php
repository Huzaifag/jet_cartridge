<?php

namespace App\Models\Seller;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'seller_id',
        'title',
        'description',
        'discount_type',
        'percentage_off',
        'fixed_amount',
        'buy_x',
        'get_y',
        'bogo_type',
        'start_date',
        'end_date',
        'status',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'promotion_product');
    }
}
