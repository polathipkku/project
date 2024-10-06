<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_room extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'productroom_name',
        'productroom_price',
        'product_qty',
    ];

    public function checkoutDetails()
    {
        return $this->hasMany(CheckoutDetail::class);
    }
    public function checkouts()
    {
        return $this->belongsToMany(Checkout::class, 'checkout_details')
            ->withPivot('totalpriceroom');
    }
}
