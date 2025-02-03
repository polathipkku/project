<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Roomservice_detail;
use App\Models\Booking_detail;
use App\Models\CheckoutDetail;
use App\Models\Checkin;
use App\Models\Checkout;
use App\Models\Promotion;
use App\Models\Maintenance;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // รับค่าจากฟอร์ม
        $startDate = $request->input('start_date', Carbon::today()->toDateString());
        $endDate = $request->input('end_date', Carbon::today()->toDateString());

        // แปลงวันที่ให้เป็น Carbon object
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        // คำนวณจำนวนห้องที่มีสถานะ "พร้อมให้บริการ"
        $availableRoomsCount = Room::where('room_status', 'พร้อมให้บริการ')->count();

        // คำนวณจำนวนห้องที่ถูกจองแล้วในช่วงวันที่เลือก
        $bookedRoomsCount = Room::where('room_status', 'พร้อมให้บริการ')
            ->whereHas('bookingDetails.booking', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('checkin_date', [$startDate, $endDate])
                    ->where('booking_status', 'ชำระเงินเสร็จสิ้น');
            })
            ->count();

        // จำนวนห้องว่าง = จำนวนห้องที่พร้อมให้บริการ - จำนวนห้องที่ถูกจอง
        $roomsAvailable = $availableRoomsCount - $bookedRoomsCount;

        // การจองในช่วงวันที่เลือก
        $bookingsCount = Booking_detail::whereBetween('checkin_date', [$startDate, $endDate])
            ->whereHas('booking', function ($query) {
                $query->where('booking_status', 'ชำระเงินเสร็จสิ้น');
            })
            ->count();

        // รายได้ในช่วงวันที่เลือก
        $totalRevenue = Booking::whereHas('bookingDetails', function ($query) {
            $query->where('booking_status', 'ชำระเงินเสร็จสิ้น');
        })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_cost');

        // รายได้รายเดือน
        $monthlyRevenue = Booking::whereHas('bookingDetails', function ($query) {
            $query->where('booking_status', 'ชำระเงินเสร็จสิ้น');
        })
            ->whereYear('created_at', Carbon::now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(total_cost) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        // สร้าง array รายได้ตามเดือน (ม.ค. - ธ.ค.)
        $revenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenueData[] = $monthlyRevenue[$i] ?? 0;
        }

        // คำนวณจำนวนผู้เข้าพักในแต่ละวันของเดือนนี้
        $guestData = [];
        $dates = [];

        // เก็บค่าเริ่มต้นของ $startDate ไว้ในตัวแปรใหม่เพื่อไม่ให้ $startDate ถูกเปลี่ยนแปลง
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            // คำนวณจำนวนผู้เข้าพัก (room_quantity) ในวันที่ $currentDate
            $guests = Booking_detail::join('bookings', 'booking_details.booking_id', '=', 'bookings.id')
                ->whereDate('booking_details.checkin_date', $currentDate)
                ->where('bookings.booking_status', 'ชำระเงินเสร็จสิ้น')
                ->sum('bookings.room_quantity');

            // เพิ่มข้อมูลผู้เข้าพักใน array
            $guestData[] = $guests;

            // แปลงชื่อเดือนให้เป็นภาษาไทย
            $monthNameInThai = $currentDate->locale('th')->isoFormat('D MMM');
            $dates[] = $monthNameInThai;

            // เพิ่มวันโดยไม่แก้ไข $startDate โดยตรง
            $currentDate->addDay();
        }

        // ส่งข้อมูลทั้งหมดไปยัง View
        return view('owner.dashboard', compact(
            'totalRevenue',
            'revenueData',
            'roomsAvailable',
            'bookingsCount',
            'guestData',
            'dates',
            'startDate',
            'endDate'
        ));
    }
}
