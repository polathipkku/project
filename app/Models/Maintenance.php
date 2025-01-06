<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Maintenance extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'room_id',
        'Maintenance_StartDate',
        'booking_detail_id',
        'maintenances_status',
        'problemType',
        'user_id'
    ];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    public function booking_detail()
    {
        return $this->belongsTo(Booking_detail::class, 'booking_detail_id');
    }
}
