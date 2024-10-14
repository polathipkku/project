<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Promotion;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $promotions = Promotion::all();

            foreach ($promotions as $promotion) {
                if ($promotion->promotion_status == 1 && $promotion->end_date < now()) {
                    $promotion->promotion_status = 2; // ตั้งสถานะเป็น 'หมดอายุ'
                    $promotion->save(); // บันทึกค่าที่เปลี่ยนลงฐานข้อมูล
                }
            }
        })->daily(); // ตรวจสอบทุกวัน
    }


    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
