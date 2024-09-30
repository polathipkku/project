<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'quantity',
        'total_price',
        'change_amount',
        'payment_method',
    ];

    // ความสัมพันธ์กับโมเดล Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // ความสัมพันธ์กับโมเดล User (ผู้ขายสินค้า)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
