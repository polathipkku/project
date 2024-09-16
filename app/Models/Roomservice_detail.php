<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roomservice_detail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'roomservice_id',
        'booking_id',
        'quantity',
        'total_price',
    ];

    public function roomservice()
    {
        return $this->belongsTo(Roomservice::class, 'roomservice_id');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }
}
