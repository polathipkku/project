<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Room extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'room_Number',
        'room_description',
        'price_night',
        'price_temporary',
        'room_image',
        'room_status',
        'room_occupancy',
        'room_bed',
        'room_bathroom'
    ];

    public function bookings()
    {
        return $this->belongsToMany(Booking::class, 'booking_details');
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'room_id');
    }

    public function bookingDetails()
    {
        return $this->hasMany(Booking_detail::class, 'room_id');
    }
    public function pendingBookings()
    {
        // สมมติว่าคุณมีสถานะ "รอเลือกห้อง" สำหรับการจองที่ยังรอห้อง
        return $this->bookings()->where('booking_status', 'รอเลือกห้อง');
    }

}
