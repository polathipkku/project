<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking_detail extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'booking_id',
        'room_id',
        'booking_name',
        'phone',
        'bookingto_username',
        'bookingto_phone',
        'booking_status',
        'occupancy_person',
        'occupancy_child',
        'occupancy_baby',
        'room_type',
        'checkin_date',
        'checkout_date',
        'extra_bed_count',

    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function checkoutDetails()
    {
        return $this->hasMany(CheckoutDetail::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'promotion_id');
    }
    public function checkoutExtends()
    {
        return $this->hasMany(Checkoutextend::class);
    }
}
