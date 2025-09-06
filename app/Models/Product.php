<?php

namespace App\Models;

use App\Models\Seller\Promotion;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'name',
        'description',
        'price',
        'moq', // Minimum Order Quantity
        'stock_quantity',
        'category',
        'brand',
        'model',
        'specifications',
        'images',
        'status',
        'is_featured',
        'rating',
        'verification_status'
    ];

    protected $casts = [
        'specifications' => 'array',
        'images' => 'array',
        'price' => 'decimal:2',
        'rating' => 'decimal:1',
    ];

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function creator()
    {
        return $this->belongsTo(Employee::class, 'created_by');
    }

    public function getMainImageAttribute()
    {
        return $this->images[0] ?? 'default-product.jpg';
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class, 'promotion_product');
    }
}
