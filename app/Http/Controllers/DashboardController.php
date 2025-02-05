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
        // ตรวจสอบและแปลงวันที่จาก input (ถ้ามีค่าเข้ามา)
        if ($request->has('filter_days')) {
            $endDate = Carbon::today();
            $startDate = Carbon::today()->subDays($request->filter_days);
        } else {
            $startDate = $request->has('start_date') ? Carbon::createFromFormat('d/m/Y', $request->start_date) : Carbon::today();
            $endDate = $request->has('end_date') ? Carbon::createFromFormat('d/m/Y', $request->end_date) : Carbon::today();
        }

        // คำนวณจำนวนห้องที่มีสถานะ "พร้อมให้บริการ"
        $availableRoomsCount = Room::where('room_status', 'พร้อมให้บริการ')->count();

        // คำนวณจำนวนห้องที่ถูกจองในช่วงวันที่เลือก
        $bookedRoomsCount = Room::where('room_status', 'พร้อมให้บริการ')
            ->whereHas('bookingDetails.booking', function ($query) use ($startDate, $endDate) {
                $query->whereBetween('checkin_date', [$startDate, $endDate])
                      ->where('booking_status', 'ชำระเงินเสร็จสิ้น');
            })
            ->count();

        // คำนวณจำนวนห้องว่าง
        $roomsAvailable = $availableRoomsCount - $bookedRoomsCount;

        // นับจำนวนการจอง
        $bookingsCount = Booking_detail::whereBetween('checkin_date', [$startDate, $endDate])
            ->whereHas('booking', function ($query) {
                $query->where('booking_status', 'ชำระเงินเสร็จสิ้น');
            })
            ->count();

        // คำนวณรายได้ในช่วงวันที่เลือก
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

        // จัดรูปแบบรายได้รายเดือน
        $revenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenueData[] = $monthlyRevenue[$i] ?? 0;
        }

        // คำนวณจำนวนผู้เข้าพักในแต่ละวัน
        $guestData = [];
        $dates = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $guests = Booking_detail::join('bookings', 'booking_details.booking_id', '=', 'bookings.id')
                ->whereDate('booking_details.checkin_date', $currentDate)
                ->where('bookings.booking_status', 'ชำระเงินเสร็จสิ้น')
                ->sum('bookings.room_quantity');

            $guestData[] = $guests;
            $dates[] = $currentDate->locale('th')->isoFormat('D MMM');
            $currentDate->addDay();
        }

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