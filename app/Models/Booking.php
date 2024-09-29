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
        'room_id',
        'checkin_by',
        'checkout_by',


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
        return $this->belongsToMany(Roomservice::class, 'roomservice_details');
    }
    public function review()
    {
        return $this->hasOne(Review::class);
    }
    public function checkoutDetails()
    {
        return $this->hasMany(CheckoutDetail::class);
    }
}
