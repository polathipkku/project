<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class checkout extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'booking_id',
        'checked_out_by',
        'checkout',
        'total_damages',
        
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'checked_out_by');
    }

    public function productRooms()
    {
        return $this->belongsToMany(Product_room::class, 'checkout_details')
            ->withPivot('totalpriceroom');
    }
}
