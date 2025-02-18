<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Booking_detail;
use Carbon\Carbon;
use Illuminate\Support\Str;

class BookingSeeder extends Seeder
{
    public function run()
    {
        // สร้างข้อมูล 50 รายการ
        for ($i = 0; $i < 50; $i++) {
            // กำหนดช่วงวันที่แบบสุ่ม ตั้งแต่ 1 ม.ค. - 10 ก.พ.
            $checkinDate = Carbon::create(2025, 1, 1)->addDays(rand(0, 40)); // วันที่เข้าพัก
            $checkoutDate = (clone $checkinDate)->addDays(rand(1, 5)); // ออกจากห้อง 1-5 วันถัดไป

            // สร้าง Booking
            $booking = Booking::create([
                'user_id' => rand(1, 2), // จำลอง ID ผู้ใช้
                'room_quantity' => rand(1, 3), // จำนวนห้องที่จอง
                'person_count' => rand(1, 6), // จำนวนคนที่เข้าพัก
                'promotion_id' => null, // ยังไม่มีโปรโมชัน
                'total_cost' => rand(1000, 5000), // ราคาแบบสุ่ม
                'booking_status' => 'ชำระเงินเสร็จสิ้น', // สถานะการจอง
                'total_bed' => rand(1, 3), // จำนวนเตียง
                'booking_random_id' => strtoupper(Str::random(2)) . rand(100, 999), // สร้างรหัสจองแบบสุ่ม
            ]);

            // สร้าง Booking Detail
            for ($j = 0; $j < $booking->room_quantity; $j++) {
                Booking_detail::create([
                    'booking_id' => $booking->id,
                    'room_id' => null, // ยังไม่มีห้อง (รอเลือกห้อง)
                    'booking_name' => 'ลูกค้า ' . ($i + 1),
                    'phone' => '09' . rand(10000000, 99999999),
                    'bookingto_username' => null, // ยังไม่ระบุชื่อผู้เข้าพัก
                    'bookingto_phone' => null,
                    'booking_detail_status' => 'เช็คเอาท์',
                    'occupancy_person' => rand(1, 2),
                    'occupancy_child' => rand(0, 2),
                    'occupancy_baby' => rand(0, 1),
                    'room_type' => 'Standard',
                    'checkin_date' => $checkinDate,
                    'checkout_date' => $checkoutDate,
                    'extra_bed_count' => rand(0, 1),
                    'booking_detail_status' => 'active',
                ]);
            }
        }
    }
}
