<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckoutDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booking_id',
        'product_room_id',
        'booking_detail_id',
        'totalpriceroom',
        'productroom_name',
    ];
    

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function productRoom()
    {
        return $this->belongsTo(Product_room::class);
    }
}

