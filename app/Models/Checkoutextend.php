<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkoutextend extends Model
{
    use HasFactory;

    protected $fillable = ['booking_detail_id', 'extended_days', 'extra_charge', 'amount_paid', 'payment_method'];

    public function bookingDetail()
    {
        return $this->belongsTo(Booking_detail::class);
    }
}
