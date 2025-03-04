<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\Booking_detail;
use App\Models\Checkin;
use App\Models\Checkout;
use App\Models\Payment;
use Faker\Factory as Faker;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) { // สร้าง 10 รายการ
            $createdAt = Carbon::create($faker->dateTimeBetween('2025-01-01', '2025-03-04'));
            $checkoutDate = $createdAt->copy()->addDays($faker->numberBetween(1, 3));

            $booking = Booking::create([
                'user_id' => $faker->randomElement([1, 2]),
                'room_id' => $faker->numberBetween(1, 12),
                'promotion_id' => null,
                'booking_random_id' => 'U' . $faker->unique()->numberBetween(1000, 9999),
                'room_quantity' => $faker->numberBetween(1, 3),
                'person_count' => $faker->numberBetween(1, 4),
                'total_cost' => $faker->numberBetween(500, 3000),
                'total_bed' => $faker->numberBetween(0, 2),
                'booking_status' => $faker->randomElement(['ชำระเงินเสร็จสิ้น', 'รอชำระเงิน', 'ยกเลิก']),
                'created_at' => $createdAt,
                'updated_at' => now(),
                'deleted_at' => null,
            ]);

            // สร้าง booking_details
            Booking_detail::create([
                'booking_id' => $booking->id,
                'room_id' => $booking->room_id,
                'booking_detail_status' => $faker->randomElement(['เช็คอิน', 'เช็คเอาท์']),
                'booking_name' => $faker->name,
                'phone' => '08' . $faker->numberBetween(10000000, 99999999),
                'occupancy_person' => $booking->person_count,
                'occupancy_child' => $faker->numberBetween(0, 2),
                'occupancy_baby' => $faker->numberBetween(0, 1),
                'checkin_date' => $createdAt->format('Y-m-d'),
                'checkout_date' => $checkoutDate->format('Y-m-d'),
                'room_type' => $faker->randomElement(['ห้องพักค้างคืน', 'ห้องพักรายชั่วโมง']),
                'extra_bed_count' => $faker->numberBetween(0, 1),
            ]);

            // สร้าง checkins
            Checkin::create([
                'booking_id' => $booking->id,
                'checked_in_by' => $booking->user_id,
                'checkin' => $createdAt,
                'name' => $faker->name,
                'id_card' => $faker->numerify('###############'),
                'phone' => '08' . $faker->numberBetween(10000000, 99999999),
                'address' => $faker->address,
                'sub_district' => $faker->city,
                'province' => $faker->state,
                'district' => $faker->city,
                'postcode' => $faker->postcode,
            ]);

            // สร้าง checkouts
            Checkout::create([
                'booking_id' => $booking->id,
                'checked_out_by' => $booking->user_id,
                'checkout' => $checkoutDate,
                'total_damages' => 0.00,
            ]);

            // สร้าง payments
            Payment::create([
                'booking_id' => $booking->id,
                'payment_date' => $createdAt,
                'payment_status' => 'completed',
                'total_price' => $booking->total_cost,
                'pay_price' => $booking->total_cost,
                'pay_change' => 0.00,
                'payment_type_id' => 1,
                'amount' => $booking->total_cost,
            ]);
        }
    }
}
