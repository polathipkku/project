<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WeekendBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $startDate = Carbon::create(2024, 1, 1); // เริ่ม 1 ม.ค. 2024
        $endDate = Carbon::create(2024, 2, 24); // สิ้นสุด 24 ก.พ. 2024

        while ($startDate->lte($endDate)) {
            if ($startDate->isSaturday() || $startDate->isSunday()) {
                $booking_id = DB::table('bookings')->insertGetId([
                    'user_id' => rand(1, 2),
                    'room_id' => null,
                    'promotion_id' => null,
                    'booking_random_id' => 'IO' . rand(100, 999),
                    'room_quantity' => rand(1, 3),
                    'person_count' => rand(1, 6),
                    'total_cost' => rand(500, 5000),
                    'total_bed' => 0,
                    'booking_status' => 'ชำระเงินเสร็จสิ้น',
                    'created_at' => $startDate->toDateTimeString(),
                    'updated_at' => $startDate->toDateTimeString(),
                    'deleted_at' => null,
                ]);

                // เพิ่มข้อมูลใน booking_details
                $room_id = rand(1, 12);
                DB::table('booking_details')->insert([
                    'booking_id' => $booking_id,
                    'room_id' => $room_id,
                    'booking_detail_status' => 'เช็คเอาท์',
                    'booking_name' => 'admin',
                    'phone' => '09' . rand(10000000, 99999999),
                    'bookingto_username' => null,
                    'bookingto_phone' => null,
                    'occupancy_person' => rand(1, 6),
                    'occupancy_child' => null,
                    'occupancy_baby' => null,
                    'checkin_date' => $startDate->toDateString(),
                    'checkout_date' => $startDate->copy()->addDay()->toDateString(),
                    'room_type' => 'ห้องพักค้างคืน',
                    'soap_requested' => null,
                    'extra_bed_count' => 0,
                    'created_at' => $startDate->toDateTimeString(),
                    'updated_at' => $startDate->toDateTimeString(),
                    'deleted_at' => null,
                ]);

                // เพิ่มข้อมูลใน checkins
                DB::table('checkins')->insert([
                    'booking_id' => $booking_id,
                    'checked_in_by' => 1,
                    'checkin' => $startDate->copy()->addHours(rand(12, 18))->toDateTimeString(),
                    'name' => 'พลอธิป',
                    'id_card' => rand(1000000000000, 9999999999999),
                    'phone' => '09' . rand(10000000, 99999999),
                    'address' => rand(1, 99),
                    'sub_district' => 'บก',
                    'province' => 'ศรีสะเกษ',
                    'district' => 'โนนคูณ',
                    'postcode' => rand(10000, 99999),
                    'created_at' => $startDate->toDateTimeString(),
                    'updated_at' => $startDate->toDateTimeString(),
                    'deleted_at' => null,
                ]);

                // เพิ่มข้อมูลใน checkouts
                DB::table('checkouts')->insert([
                    'booking_id' => $booking_id,
                    'checked_out_by' => 1,
                    'checkout' => $startDate->copy()->addDay()->addHours(rand(6, 12))->toDateTimeString(),
                    'total_damages' => 0.00,
                    'created_at' => $startDate->toDateTimeString(),
                    'updated_at' => $startDate->toDateTimeString(),
                    'deleted_at' => null,
                ]);
            }
            $startDate->addDay(); // เพิ่มวัน
        }
    }
}
