<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'payment_date',
        'payment_status',
        'payment_slip',
        'total_price',
        'pay_price',
        'pay_change',
        'booking_id',
        'payment_type_id',
    ];


    public function bookings()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function paymentType()
    {
        return $this->belongsTo(Payment_type::class, 'payment_type_id');
    }
}
