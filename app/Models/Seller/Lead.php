<?php

namespace App\Models\Seller;

use App\Models\Employee;
use App\Models\Product;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
      protected $fillable = [
        'buyer_name',
        'email',
        'product_id',
        'message',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the product associated with the lead.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
