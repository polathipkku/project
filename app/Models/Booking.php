<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'room_quantity',
        'promotion_id',
        'total_cost',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class, 'booking_details');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id');
    }
    public function bookingDetails()
    {
        return $this->hasMany(Booking_detail::class, 'booking_id');
    }

    public function roomservices()
    {
        return $this->hasMany(Roomservice::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
    public function checkoutDetails()
    {
        return $this->hasMany(CheckoutDetail::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
    public function checkin()
    {
        return $this->hasOne(Checkin::class, 'booking_id');
    }
    public function checkout()
    {
        return $this->hasOne(Checkout::class, 'booking_id');
    }
}
