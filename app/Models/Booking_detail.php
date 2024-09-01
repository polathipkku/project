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
        'total_cost',
        'room_type',
        'room_quantity',
        'checkin_date',
        'checkout_date',

    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
