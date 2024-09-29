<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'name',
        'id_card',
        'phone',
        'address',
        'sub_district',
        'province',
        'district',
        'postcode',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
