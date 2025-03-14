<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Payment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'payment_date',
        'payment_status',
        'payment_slip',
        'total_price',
        'pay_price',
        'pay_change',
        'booking_id',
        'payment_type_id',
        'payment_intent_id',
        'expiration_time',
        'transaction_id',
        'amount',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'booking_id');
    }

    public function paymentType()
    {
        return $this->belongsTo(Payment_type::class, 'payment_type_id');
    }

    /**
     * ตรวจสอบว่าสถานะการชำระเงินสำเร็จหรือไม่
     */
    public function isPaymentSuccessful()
    {
        return $this->payment_status === 'success';
    }

    /**
     * ตรวจสอบว่าการชำระเงินหมดอายุหรือยัง
     */
    public function isExpired()
    {
        return $this->expiration_time && Carbon::now()->greaterThan(Carbon::parse($this->expiration_time));
    }

    /**
     * คำนวณเวลาที่เหลือก่อนหมดอายุ (เป็นวินาที)
     */
    public function remainingTime()
    {
        if (!$this->expiration_time) {
            return null;
        }

        $expiration = Carbon::parse($this->expiration_time);
        $remaining = $expiration->diffInSeconds(Carbon::now(), false);

        return $remaining > 0 ? $remaining : 0;
    }
}
    
