<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Promotion extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'campaign_name',
        'discount_value',
        'max_usage_per_code',
        'promo_code',
        'type',
        'minimum_nights',
        'minimum_booking_amount',
        'usage_count',
        'promotion_status',
        'start_date',
        'end_date',
    ];
    protected $dates = ['start_date', 'end_date'];


    public function bookings()
    {
        return $this->hasMany(Booking::class, 'promotion_id');
    }
    public static function generatePromoCode($length = 6)
    {
        return strtoupper(Str::random($length));
    }
}
