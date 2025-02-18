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
use App\Models\Expense;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getDailyOccupancy($startDate, $endDate)
    {
        // Define days of the week in Thai
        $daysOfWeek = ['จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์', 'อาทิตย์'];

        // Initialize an array to store daily occupancy
        $dailyOccupancy = array_fill(0, 7, 0);

        // Query to get bookings grouped by day of the week
        $occupancyQuery = Booking_detail::join('bookings', 'booking_details.booking_id', '=', 'bookings.id')
            ->whereBetween('booking_details.checkin_date', [$startDate, $endDate])
            ->where('bookings.booking_status', 'ชำระเงินเสร็จสิ้น')
            ->selectRaw('DAYOFWEEK(booking_details.checkin_date) as day_of_week, SUM(bookings.room_quantity) as total_guests')
            ->groupBy('day_of_week')
            ->get();

        // Adjust day of week (MySQL DAYOFWEEK starts from Sunday=1)
        foreach ($occupancyQuery as $entry) {
            $adjustedDay = ($entry->day_of_week - 1 + 6) % 7; // Convert to 0-indexed, starting from Monday
            $dailyOccupancy[$adjustedDay] = $entry->total_guests;
        }

        return [
            'labels' => $daysOfWeek,
            'data' => $dailyOccupancy
        ];
    }

    public function dashboard(Request $request)
    {
        // กำหนดค่าเริ่มต้นเป็นเดือนและปีปัจจุบัน
        $month = $request->input('month', Carbon::now()->month);
        $year = $request->input('year', Carbon::now()->year);

        // สร้างวันที่เริ่มต้นและสิ้นสุดของเดือนที่เลือก
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate = Carbon::createFromDate($year, $month, 1)->endOfMonth();

        // คำนวณจำนวนห้องที่มีสถานะ "พร้อมให้บริการ"
        $availableRoomsCount = Room::where('room_status', 'พร้อมให้บริการ')->count();

        // คำนวณจำนวนห้องที่ถูกจองในเดือนที่เลือก
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

        // คำนวณรายได้ในเดือนที่เลือก
        $totalRevenue = Booking::whereHas('bookingDetails', function ($query) {
            $query->where('booking_status', 'ชำระเงินเสร็จสิ้น');
        })
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('total_cost');

        $totalDamages = Checkout::whereBetween('created_at', [$startDate, $endDate])
            ->whereHas('booking', function ($query) {
                $query->where('booking_status', 'ชำระเงินเสร็จสิ้น');
            })
            ->sum('total_damages');

        // รวมค่าห้อง + ค่าปรับทั้งหมด
        $totalRevenueWithDamages = $totalRevenue + $totalDamages;

        // รายได้รายวันในเดือนที่เลือก
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

        $dailyOccupancy = $this->getDailyOccupancy($startDate, $endDate);

        // คำนวณค่าใช้จ่ายในเดือนที่เลือก
        $totalExpenses = Expense::whereBetween('expenses_date', [$startDate, $endDate])->sum('expenses_price');
        $totalEmployeeSalaries = User::sum('salary');
        $totalExpensesWithSalaries = $totalExpenses + $totalEmployeeSalaries;

        // ข้อมูลค่าใช้จ่ายตามประเภท
        $expenseCategories = DB::table('expenses')
            ->whereBetween('expenses_date', [$startDate, $endDate])
            ->selectRaw('type, SUM(expenses_price) as total')
            ->groupBy('type')
            ->union(
                DB::table('users')->selectRaw('"ค่าจ้างพนักงาน" as type, SUM(salary) as total')
            )
            ->pluck('total', 'type')
            ->toArray();

        // รายได้และค่าใช้จ่ายรายเดือนตลอดทั้งปี
        $revenueData = $this->getMonthlyRevenue($year);
        $expensesData = $this->getMonthlyExpenses($year);

        return view('owner.dashboard', compact(
            'totalRevenueWithDamages',
            'revenueData',
            'roomsAvailable',
            'bookingsCount',
            'guestData',
            'dates',
            'startDate',
            'endDate',
            'expensesData',
            'expenseCategories',
            'dailyOccupancy',
            'totalExpensesWithSalaries',
        ));
    }

    // Helper method สำหรับคำนวณรายได้รายเดือน
    private function getMonthlyRevenue($year)
    {
        $monthlyRevenue = Booking::whereYear('created_at', $year)
            ->whereHas('bookingDetails', function ($query) {
                $query->where('booking_status', 'ชำระเงินเสร็จสิ้น');
            })
            ->selectRaw('MONTH(created_at) as month, SUM(total_cost) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $monthlyDamages = Checkout::whereYear('created_at', $year)
            ->whereHas('booking', function ($query) {
                $query->where('booking_status', 'ชำระเงินเสร็จสิ้น');
            })
            ->selectRaw('MONTH(created_at) as month, SUM(total_damages) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $revenueData = [];
        for ($i = 1; $i <= 12; $i++) {
            $revenueData[] = ($monthlyRevenue[$i] ?? 0) + ($monthlyDamages[$i] ?? 0);
        }

        return $revenueData;
    }

    // Helper method สำหรับคำนวณค่าใช้จ่ายรายเดือน
    private function getMonthlyExpenses($year)
    {
        $expensesByMonth = Expense::whereYear('expenses_date', $year)
            ->selectRaw('MONTH(expenses_date) as month, SUM(expenses_price) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $employeeExpensesByMonth = collect(range(1, 12))->mapWithKeys(function ($month) {
            return [$month => User::sum('salary')];
        });

        $expensesData = [];
        for ($i = 1; $i <= 12; $i++) {
            $expensesData[] = ($expensesByMonth[$i] ?? 0) + ($employeeExpensesByMonth[$i] ?? 0);
        }

        return $expensesData;
    }
}
