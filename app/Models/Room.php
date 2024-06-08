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
        return $this->hasMany(Booking::class, 'room_id');
    }

}
