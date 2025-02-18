<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // สร้างข้อมูลห้องจาก room_name1 - room_name12
        for ($i = 1; $i <= 12; $i++) {
            DB::table('rooms')->insert([
                'room_name' => $i,  // ใช้ตัวเลขแทนข้อความ เช่น room_name1 -> 1, room_name2 -> 2
                'price_night' => 500,
                'price_temporary' => 250,
                'room_image' => 'default_image.jpg',
                'room_status' => 'พร้อมให้บริการ',
                'room_occupancy' => 2,
                'room_bed' => 1,
                'room_bathroom' => 1,
            ]);
        }
    }
}
