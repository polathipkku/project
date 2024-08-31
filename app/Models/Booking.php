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
        'checkin_date',
        'checkout_date',
        'checkin_by',
        'checkout_by',
        'total_cost',
        'occupancy_person',
        'room_type',
        'room_quantity',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
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
    
}
