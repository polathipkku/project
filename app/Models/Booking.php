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
        'booking_name',
        'phone',
        'checkin_date',
        'checkout_date',
        'checkin_by',
        'checkout_by',
        'total_cost',
        'booking_status',
        'occupancy_person',
        'room_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'booking_id');
    }
}
