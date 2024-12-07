<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'room_quantity',
        'person_count',
        'promotion_id',
        'total_cost',
        'booking_status',
        'total_bed',
        'booking_random_id',

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
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

    public function roomservices()
    {
        return $this->hasMany(Roomservice::class);
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }
    public function checkoutDetails()
    {
        return $this->hasMany(CheckoutDetail::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
    public function checkin()
    {
        return $this->hasOne(Checkin::class);
    }

    public function checkout()
    {
        return $this->hasOne(Checkout::class);
    }
    protected static function boot()
    {
        parent::boot();

        // เมื่อมีการสร้าง booking ใหม่ จะเรียกฟังก์ชันนี้
        static::creating(function ($booking) {
            $booking->booking_random_id = self::generateBookingRandomId();
        });
    }
    // ฟังก์ชันสำหรับการสร้างรหัสสุ่ม
    public static function generateBookingRandomId()
    {
        $letters = strtoupper(Str::random(2)); // สุ่มตัวอักษรภาษาอังกฤษ 2 ตัว
        $numbers = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT); // สุ่มตัวเลข 3 ตัว
        return $letters . $numbers; // รวมเป็นรูปแบบที่ต้องการ
    }
}
