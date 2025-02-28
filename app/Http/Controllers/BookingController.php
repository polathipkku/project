<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Roomservice_detail;
use App\Models\Booking_detail;
use App\Models\Product;
use App\Models\Roomservice;
use App\Models\Stock;
use App\Models\Product_room;
use App\Models\Product_type;
use App\Models\CheckoutDetail;
use App\Models\Checkin;
use App\Models\Checkout;
use App\Models\Promotion;
use App\Models\Maintenance;
use App\Models\Payment;
use App\Models\StockPackage;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\PaymentType;


class BookingController extends Controller
{
    public function userbooking(Request $request)
    {
        // รับค่าจาก query string
        $checkin = $request->query('checkin');
        $checkout = $request->query('checkout');
        $adults = $request->query('adults', 1);
        $children = $request->query('children', 0);
        $infants = $request->query('infants', 0);
        $rooms = Room::all();
        return view('user.userbooking', compact('rooms', 'checkin', 'checkout', 'adults', 'children', 'infants'));
    }

    public function emroom()
    {
        $rooms = Room::all();
        return view('employee.emroom', compact('rooms'));
    }

    public function t()
    {
        $rooms = Room::all();
        return view('user.t', compact('rooms',));
    }

    public function test(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $holyDays = $this->generateHolyDays($year);

        return view('owner.test', compact('holyDays'));
    }

    private function generateHolyDays($year)
    {
        $holyDays = collect();

        for ($month = 1; $month <= 12; $month++) {
            for ($day = 1; $day <= 31; $day++) {
                try {
                    $date = Carbon::create($year, $month, $day);

                    // วันขึ้น 15 ค่ำ และแรม 15 ค่ำ
                    if (in_array($date->day, [1, 15, 16])) {
                        $holyDays->push((object)[
                            'date' => $date,
                            'description' => $this->getHolyDayDescription($date->day)
                        ]);
                    }
                } catch (\Exception $e) {
                    // Skip invalid dates
                    continue;
                }
            }
        }

        return $holyDays;
    }

    private function getHolyDayDescription($day)
    {
        $descriptions = [
            1 => 'แรม 1 ค่ำ',
            15 => 'ขึ้น 15 ค่ำ',
            16 => 'แรม 15 ค่ำ'
        ];

        return $descriptions[$day] ?? '';
    }


    public function calendar()
    {
        // ข้อมูลเช็คอิน
        $checkinDetails = Booking_detail::selectRaw('checkin_date, COUNT(*) as room_count')
            ->where('booking_detail_status', '!=', 'ยกเลิกการจอง')
            ->groupBy('checkin_date')
            ->get();

        // ข้อมูลเช็คเอาท์
        $checkoutDetails = Booking_detail::selectRaw('checkout_date, COUNT(*) as room_count')
            ->where('booking_detail_status', '!=', 'ยกเลิกการจอง')
            ->groupBy('checkout_date')
            ->get();

        // เตรียมข้อมูลสำหรับปฏิทิน
        $events = $checkinDetails->map(function ($detail) {
            return [
                'title' => "{$detail->room_count}  (เช็คอิน)",
                'date' => Carbon::parse($detail->checkin_date)->toDateString(),
                'type' => 'checkin',
            ];
        })->merge($checkoutDetails->map(function ($detail) {
            return [
                'title' => "{$detail->room_count}  (เช็คเอาท์)",
                'date' => Carbon::parse($detail->checkout_date)->toDateString(),
                'type' => 'checkout',
            ];
        }));

        return view('owner.calendar', ['events' => $events]);
    }

    public function showReserveForm(Request $request)
    {
        $extra_bed_count = $request->input('extra_bed_count', 0);
        $checkin_date = $request->input('checkin_date');
        $checkout_date = $request->input('checkout_date');
        $number_of_rooms = $request->input('number_of_rooms');
        $occupancy_person = $request->input('number_of_guests', 0);
        $occupancy_child = $request->input('occupancy_child', 0);
        $occupancy_baby = $request->input('occupancy_baby', 0);

        $user = auth()->user(); // ดึงข้อมูลผู้ใช้งานที่ล็อกอิน (ถ้ามี)

        return view('user.reserve', compact(
            'checkin_date',
            'checkout_date',
            'number_of_rooms',
            'extra_bed_count',
            'occupancy_person',
            'occupancy_child',
            'occupancy_baby',
            'user'
        ));
    }

    public function em_reserve(Request $request, $id)
    {
        $rooms = Room::find($id);

        // รับค่าพารามิเตอร์จาก URL
        $checkinDate = $request->query('checkin_date');
        $checkoutDate = $request->query('checkout_date');

        // ตรวจสอบว่าค่าพารามิเตอร์ถูกต้องหรือไม่
        if (is_null($checkinDate) || is_null($checkoutDate)) {
            return redirect()->back()->withErrors('Invalid check-in or check-out date.');
        }

        return view('employee.em_reserve', compact('rooms', 'checkinDate', 'checkoutDate'));
    }

    public function reservation()
    {
        $bookings = Booking_detail::whereHas('booking', function ($query) {
            $query->where('user_id', auth()->user()->id);
        })
            ->with([
                'booking.review',
                'booking.payment',
            ])
            ->orderBy('created_at', 'desc') // ดึงข้อมูลที่มีการสร้างใหม่ที่สุด
            ->get();

        // จัดกลุ่มข้อมูลและกรองสถานะ "รอชำระเงิน"
        $countdownData = $bookings->groupBy('booking_id')->map(function ($bookings, $bookingId) {
            $firstBooking = $bookings->first();
            // ตรวจสอบสถานะการจองว่าเป็น "รอชำระเงิน" และยังไม่ถูกยกเลิก
            if ($firstBooking->booking_detail_status === 'รอชำระเงิน' && $firstBooking->booking->payment->status !== 'cancel') {
                $expirationTime = optional($firstBooking->booking->payment)->expiration_time;
                return $expirationTime ? [
                    'bookingId' => $bookingId,
                    'expirationTime' => $expirationTime,
                    'bookingStatus' => 'รอชำระเงิน'
                ] : null;
            }
            return null;
        })->filter()->values(); // กรองข้อมูลที่ไม่ตรงตามเงื่อนไข

        return view('user.reservation', compact('bookings', 'countdownData'));
    }

    public function employeehome()
    {
        $bookings = Booking::where('user_id', auth()->user()->id)->get();
        return view('employee.employeehome', compact('bookings'));
    }
    public function checkinuser()
    {
        // อัปเดตสถานะเป็น "ไม่มาเช็คอิน" หากเลยวันเช็คเอาท์แล้วแต่ยังอยู่ใน "รอเลือกห้อง"
        Booking_detail::where('booking_detail_status', 'รอเลือกห้อง')
            ->whereDate('checkout_date', '<=', Carbon::today()) // วันที่ปัจจุบันเกินวันเช็คเอาท์
            ->update(['booking_detail_status' => 'ไม่มาเช็คอิน']);

        // ดึงข้อมูลการจองที่ต้องเช็คอินวันนี้
        $bookings = Booking::whereHas('bookingDetails', function ($query) {
            $query->where('booking_detail_status', 'รอเลือกห้อง')
                ->whereNull('room_id')
                ->whereDate('checkin_date', Carbon::today());
        })->with([
            'bookingDetails' => function ($query) {
                $query->whereNull('room_id')
                    ->whereDate('checkin_date', Carbon::today());
            }
        ])->get();

        $rooms = Room::where('room_status', 'พร้อมให้บริการ')->get();

        return view('employee.checkin', compact('bookings', 'rooms'));
    }
    public function checkindetail($id)
    {
        $booking = Booking::find($id);
        $bookings = Booking::where('id', $id)->get();
        return view('employee.checkindetail', compact('booking', 'bookings'));
    }
    public function checkoutdetail($id)
    {
        $booking = Booking::find($id);
        $bookings = Booking::where('id', $id)->get();
        return view('employee.checkoutdetail', compact('booking', 'bookings'));
    }
    public function checkout()
    {
        $bookingDetails = Booking_detail::where('booking_detail_status', 'เช็คอินแล้ว')->get();
        $bookingIds = $bookingDetails->pluck('booking_id')->unique();

        $bookings = Booking::whereIn('id', $bookingIds)->get();
        $rooms = Room::all();
        $productRooms = Product_room::all();

        return view('employee.checkout', compact('bookings', 'rooms', 'productRooms', 'bookingDetails'));
    }

    public function showRecordDetail($id)
    {
        $booking = Booking::with(['bookingDetails', 'payment', 'promotion'])->findOrFail($id);
        return view('owner.record_detail', compact('booking'));
    }

    public function record(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date') ?? $startDate;

        $query = Booking_detail::with('booking');

        if ($startDate) {
            $query->whereBetween('checkin_date', [$startDate, $endDate]);
        }

        // Get all bookings first
        $allBookings = $query->get();

        // Group the bookings by booking_id
        $groupedBookings = $allBookings->groupBy('booking_id');

        // Manually paginate the grouped results
        $perPage = 10;
        $currentPage = request()->get('page', 1);
        $currentPageItems = $groupedBookings->forPage($currentPage, $perPage);

        // Create a new LengthAwarePaginator instance
        $bookings = new \Illuminate\Pagination\LengthAwarePaginator(
            $currentPageItems,
            $groupedBookings->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('owner.record', compact('bookings'));
    }


    public function record_detail($bookingdetail_id)
    {
        $bookingDetail = Booking_detail::with([
            'booking',
            'booking.checkin.user',
            'booking.checkout.user',
            'booking.checkoutDetails',
            'booking.promotion',
        ])->find($bookingdetail_id);

        if (!$bookingDetail) {
            return redirect()->route('record')->with('error', 'ไม่พบข้อมูลการจอง');
        }

        return view('owner.record_detail', compact('bookingDetail'));
    }

    public function reserve(Request $request)
    {

        $request->validate([
            'number_of_guests' => 'required|integer|min:1',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'number_of_rooms' => 'required|integer|min:1',
            'booking_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'occupancy_person' => 'nullable|integer|min:0',
            'occupancy_child' => 'nullable|integer|min:0',
            'occupancy_baby' => 'nullable|integer|min:0',
            'promo_code' => 'nullable|string',
            'extra_bed_count' => 'nullable|integer|min:0',
        ]);
        $checkin_date = \Carbon\Carbon::createFromFormat('d-m-Y', $request->checkin_date)->format('Y-m-d');
        $checkout_date = \Carbon\Carbon::createFromFormat('d-m-Y', $request->checkout_date)->format('Y-m-d');

        $rooms = Room::where('room_status', 'พร้อมให้บริการ')->get();
        $availableRooms = [];

        foreach ($rooms as $room) {
            if ($this->isRoomAvailable($room, $request->checkin_date, $request->checkout_date)) {
                $availableRooms[] = $room;
            }
        }

        if (count($availableRooms) < $request->number_of_rooms) {
            return redirect()->route('home')->with('error', 'ขออภัย, ไม่มีห้องว่างเพียงพอต่อความต้องการของลูกค้า');
        }

        $checkinDate = new \DateTime($request->checkin_date);
        $checkoutDate = new \DateTime($request->checkout_date);
        $interval = $checkinDate->diff($checkoutDate);
        $days = $interval->days;
        $roomPricePerDay = 500;
        $totalCost = $days * $roomPricePerDay * $request->number_of_rooms;

        $booking = new Booking();
        $booking->user_id = auth()->check() ? auth()->user()->id : null;
        $booking->room_quantity = $request->number_of_rooms;

        $totalGuests = ($request->number_of_guests ?? 0) + ($request->occupancy_child ?? 0) + ($request->occupancy_baby ?? 0);
        $booking->person_count = $totalGuests;
        if (!empty($request->promo_code)) {
            $promotion = Promotion::where('promo_code', $request->promo_code)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            if ($promotion) {
                $usageCount = Booking::where('promotion_id', $promotion->id)->count();

                if ($usageCount < $promotion->max_usage_per_code) {
                    if (!is_null($promotion->minimum_nights) && $days < $promotion->minimum_nights) {
                        return redirect()->back()->with('error', 'จำนวนคืนไม่ตรงกับเงื่อนไขของโปรโมชัน');
                    }
                    if (!is_null($promotion->minimum_booking_amount) && $totalCost < $promotion->minimum_booking_amount) {
                        return redirect()->back()->with('error', 'ยอดจองไม่ถึงขั้นต่ำที่กำหนดในโปรโมชัน');
                    }

                    $discountAmount = $promotion->type === 'percentage'
                        ? ($promotion->discount_value / 100) * $totalCost
                        : min($promotion->discount_value, $totalCost);

                    $totalCost -= $discountAmount;
                    $promotion->usage_count += 1;
                    $promotion->save();
                    $booking->promotion_id = $promotion->id;
                } else {
                    return redirect()->back()->with('error', 'โปรโมชันนี้มีการใช้งานถึงขีดจำกัดแล้ว');
                }
            } else {
                return redirect()->back()->with('error', 'โค้ดโปรโมชันไม่ถูกต้องหรือหมดอายุ');
            }
        }

        $booking->total_cost = $totalCost;
        $booking->booking_status = 'รอชำระเงิน';
        $booking->save();

        $extraBedCount = $request->extra_bed_count ?? 0;
        $extraBedRemaining = $extraBedCount;

        foreach (array_slice($availableRooms, 0, $request->number_of_rooms) as $room) {
            $insertExtraBed = 0;
            if ($extraBedRemaining > 0) {
                $insertExtraBed = min(1, $extraBedRemaining);
                $extraBedRemaining -= $insertExtraBed;
            }

            DB::table('booking_details')->insert([
                'booking_id' => $booking->id,
                'room_id' => null,
                'booking_name' => $request->booking_name,
                'phone' => $request->phone,
                'bookingto_username' => $request->bookingto_username,
                'bookingto_phone' => $request->bookingto_phone,
                'booking_detail_status' => 'รอชำระเงิน',
                'room_type' => 'ห้องพักค้างคืน',
                'occupancy_person' => $request->number_of_guests,
                'occupancy_child' => $request->occupancy_child,
                'occupancy_baby' => $request->occupancy_baby,
                'checkin_date' => $checkin_date,
                'checkout_date' => $checkout_date,
                'extra_bed_count' => $request->extra_bed_count ?? 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        while ($extraBedRemaining > 0) {
            DB::table('booking_details')->insert([
                'booking_id' => $booking->id,
                'room_id' => null,
                'booking_name' => $request->booking_name,
                'phone' => $request->phone,
                'bookingto_username' => $request->bookingto_username,
                'bookingto_phone' => $request->bookingto_phone,
                'booking_detail_status' => 'รอชำระเงิน',
                'room_type' => 'ห้องพักค้างคืน',
                'occupancy_person' => $request->number_of_guests,
                'occupancy_child' => $request->occupancy_child,
                'occupancy_baby' => $request->occupancy_baby,
                'checkin_date' => $request->checkin_date,
                'checkout_date' => $request->checkout_date,
                'extra_bed_count' => min(1, $extraBedRemaining),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $extraBedRemaining--;
        }

        $totalExtraBeds = $extraBedCount;
        $totalBedCost = 0;

        if ($totalExtraBeds > 0) {
            $extraBedProduct = Product::where('product_name', 'เตียงเสริม')->first();
            if ($extraBedProduct) {
                $totalBedCost = $extraBedProduct->product_price * $totalExtraBeds;

                $roomservice = new Roomservice();
                $roomservice->product_id = $extraBedProduct->id;
                $roomservice->booking_id = $booking->id;
                $roomservice->quantity = $totalExtraBeds;
                $roomservice->total_price = $totalBedCost;
                $roomservice->save();
            }
        }

        $booking->total_bed = $totalExtraBeds;
        $booking->total_cost += $totalBedCost;
        $booking->save();

        return redirect()->route('payment', ['booking_id' => $booking->id])->with('success', 'บันทึกข้อมูลสำเร็จ');
    }


    public function checkAvailability(Request $request)
    {
        $startDate = \Carbon\Carbon::createFromFormat('d-m-Y', $request->query('startDate'))->format('Y-m-d');
        $endDate = \Carbon\Carbon::createFromFormat('d-m-Y', $request->query('endDate'))->format('Y-m-d');

        $adultCount = (int) $request->query('adultCount', 2);
        $childCount = (int) $request->query('childCount', 0);
        $babyCount = (int) $request->query('babyCount', 0);
        $requestedRooms = (int) $request->query('numberOfRooms', 0);

        // คำนวณจำนวนวันเข้าพัก
        $stayDays = (new \DateTime($startDate))->diff(new \DateTime($endDate))->days;

        // คำนวณจำนวนผู้ใหญ่เทียบเท่า
        $equivalentAdultCount = $adultCount + floor($childCount / 2) + floor($babyCount / 3);

        if ($childCount + $babyCount >= 4) {
            $equivalentAdultCount += 2;
        }

        // จำนวนผู้เข้าพักทั้งหมด
        $totalOccupants = $adultCount + $childCount + $babyCount;

        // คำนวณจำนวนห้องตามเงื่อนไขเดิม
        $numberOfRoomsOption1 = ceil($equivalentAdultCount / 2);
        $numberOfRoomsOption2 = floor($equivalentAdultCount / 2);

        // ปรับจำนวนห้องให้ไม่น้อยกว่า 1
        $numberOfRoomsOption1 = max(1, $numberOfRoomsOption1);
        $numberOfRoomsOption2 = max(1, $numberOfRoomsOption2);

        // คำนวณจำนวนห้องที่จำเป็นตามจำนวนผู้เข้าพัก (ห้องละไม่เกิน 4 คน)
        $numberOfRoomsOption1 = max($numberOfRoomsOption1, ceil($totalOccupants / 4));
        $numberOfRoomsOption2 = max($numberOfRoomsOption2, ceil($totalOccupants / 4));

        // ตรวจสอบว่าผู้ใช้เลือกจำนวนห้องมากกว่าจำนวนที่คำนวณได้หรือไม่
        if ($requestedRooms > max($numberOfRoomsOption1, $numberOfRoomsOption2)) {
            $numberOfRoomsOption1 = $requestedRooms;
            $numberOfRoomsOption2 = $requestedRooms;
        }

        // ปรับปรุงเงื่อนไขการตรวจสอบห้องที่ถูกจอง
        $bookedRooms = Booking_detail::whereIn('booking_detail_status', ['รอเข้าพัก', 'เช็คอินแล้ว', 'รอทำความสะอาด'])
            ->whereHas('booking', function ($query) use ($startDate, $endDate) {
                $query->where('checkin_date', '<', $endDate)
                    ->where('checkout_date', '>', $startDate)
                    ->where('booking_detail_status', '!=', 'ยกเลิกการจอง');
            })
            ->pluck('room_id')
            ->toArray();

        $pendingRoomSelectionsCount = Booking_detail::where('booking_detail_status', 'รอเลือกห้อง', 'รอชำระเงิน')
            ->whereNull('room_id')
            ->whereHas('booking', function ($query) use ($startDate, $endDate) {
                $query->where('checkin_date', '<', $endDate)
                    ->where('checkout_date', '>', $startDate)
                    ->where('booking_detail_status', '!=', 'ยกเลิกการจอง');
            })
            ->count();

        $availableRooms = Room::where('room_status', 'พร้อมให้บริการ')
            ->whereNotIn('id', $bookedRooms)
            ->get();

        $actualAvailableRoomsCount = count($availableRooms) - $pendingRoomSelectionsCount;

        $stock = new Stock();
        $availableExtraBeds = $stock->getAvailableExtraBeds();
        $extraBedProduct = Product::where('product_name', 'เตียงเสริม')->first();
        $extraBedPrice = $extraBedProduct ? $extraBedProduct->product_price : 0;

        $maxAdultsPerRoom = 2;
        $requiredRooms = ceil($adultCount / $maxAdultsPerRoom);

        if ($requiredRooms > $actualAvailableRoomsCount) {
            $extraBedsNeeded = $adultCount - ($actualAvailableRoomsCount * $maxAdultsPerRoom);

            if ($extraBedsNeeded > $actualAvailableRoomsCount || $extraBedsNeeded > $availableExtraBeds) {
                return response()->json([
                    'message' => 'ห้องหรือเตียงเสริมไม่เพียงพอสำหรับจำนวนผู้เข้าพัก',
                    'availableRooms' => [],
                    'roomOptions' => [],
                ], 400);
            }

            $numberOfRoomsOption1 = $actualAvailableRoomsCount;
            $numberOfRoomsOption2 = $actualAvailableRoomsCount;
            $extraBedsOption1 = $extraBedsNeeded;
            $extraBedsOption2 = $extraBedsNeeded;
        } else {
            $extraBedsOption1 = 0;
            $extraBedsOption2 = $equivalentAdultCount % 2 != 0 ? 1 : 0;
        }

        $filteredAvailableRooms = [];
        foreach ($availableRooms as $room) {
            if ($this->isRoomAvailable($room, $startDate, $endDate)) {
                $filteredAvailableRooms[] = [
                    'id' => $room->id,
                    'room_type' => $room->room_type,
                ];
            }
        }

        $roomOptions = [];

        if ($adultCount == 2 && $childCount == 1 && $babyCount == 1) {
            $roomOptions[] = [
                'type' => 'special_case_with_extra_bed',
                'rooms' => 1,
                'extraBeds' => 1,
                'price' => $stayDays * (500 + $extraBedPrice),
            ];

            $roomOptions[] = [
                'type' => 'special_case',
                'rooms' => 2,
                'extraBeds' => 0,
                'price' => $stayDays * (2 * 500),
            ];
        } else {
            $roomOptions[] = [
                'type' => 'normal',
                'rooms' => $numberOfRoomsOption1,
                'extraBeds' => $extraBedsOption1,
                'price' => $stayDays * (($numberOfRoomsOption1 * 500) + ($extraBedsOption1 * $extraBedPrice)),
            ];

            if ($numberOfRoomsOption2 < $numberOfRoomsOption1 || $extraBedsOption2 > $extraBedsOption1) {
                $roomOptions[] = [
                    'type' => 'with_extra_bed',
                    'rooms' => $numberOfRoomsOption2,
                    'extraBeds' => $extraBedsOption2,
                    'price' => $stayDays * (($numberOfRoomsOption2 * 500) + ($extraBedsOption2 * $extraBedPrice)),
                ];
            }
        }

        return response()->json([
            'availableRooms' => $filteredAvailableRooms,
            'roomOptions' => $roomOptions,
            'extraBedPrice' => $extraBedPrice,
            'availableExtraBeds' => $availableExtraBeds,
            'equivalentAdultCount' => $equivalentAdultCount,
        ]);
    }



    private function isRoomAvailable($room, $checkinDate, $checkoutDate)
    {
        if ($room->room_status !== 'พร้อมให้บริการ') {
            return false;
        }

        $bookingStatuses = ['รอชำระเงิน', 'รอเข้าพัก', 'เช็คอินแล้ว', 'รอทำความสะอาด', 'รอเลือกห้อง'];

        $existingBookings = Booking_detail::where('room_id', $room->id)
            ->whereIn('booking_detail_status', $bookingStatuses)
            ->whereHas('booking', function ($query) use ($checkinDate, $checkoutDate) {
                $query->where('checkin_date', '<', $checkoutDate)
                    ->where('checkout_date', '>', $checkinDate)
                    ->where('booking_detail_status', '!=', 'ยกเลิกการจอง'); // เพิ่มเงื่อนไขนี้เพื่อไม่นับการจองที่ถูกยกเลิก
            })
            ->count();

        return $existingBookings === 0;
    }

    public function showPendingRoomSelection(Request $request)
    {
        $request->validate([
            'checkin_date' => 'required|date_format:d-m-Y',
            'checkout_date' => 'required|date_format:d-m-Y|after_or_equal:checkin_date',
        ]);

        $checkinDate = \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('checkin_date'))->format('Y-m-d');
        $checkoutDate = \Carbon\Carbon::createFromFormat('d-m-Y', $request->input('checkout_date'))->format('Y-m-d');

        $pendingBookings = Booking_detail::where('booking_detail_status', 'รอเลือกห้อง')
            ->where(function ($query) use ($checkinDate, $checkoutDate) {
                $query->where(function ($q) use ($checkinDate, $checkoutDate) {
                    $q->where('checkin_date', '>=', $checkinDate)
                        ->where('checkin_date', '<', $checkoutDate);
                })
                    ->orWhere(function ($q) use ($checkinDate, $checkoutDate) {
                        $q->where('checkout_date', '>', $checkinDate)
                            ->where('checkout_date', '<=', $checkoutDate);
                    })
                    ->orWhere(function ($q) use ($checkinDate, $checkoutDate) {
                        $q->where('checkin_date', '<=', $checkinDate)
                            ->where('checkout_date', '>=', $checkoutDate);
                    });
            })
            ->get()
            ->map(function ($booking) {
                return [
                    'id' => $booking->id,
                    'checkin_date' => \Carbon\Carbon::parse($booking->checkin_date)->format('d-m-Y'),
                    'checkout_date' => \Carbon\Carbon::parse($booking->checkout_date)->format('d-m-Y'),
                    'booking_name' => $booking->booking_name,
                    'booking_detail_status' => $booking->booking_detail_status,
                ];
            });

        return response()->json([
            'pendingBookings' => $pendingBookings,
            'bookingCount' => $pendingBookings->count(),
        ]);
    }

    public function emaddBooking(Request $request, $id)
    {
        $request->validate([
            'booking_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'occupancy_person' => 'required|integer|min:1',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'room_type' => 'required|string',
            'id_card' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'sub_district' => 'required|string|max:100',
            'province' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'postcode' => 'required|string|max:10',
            'extra_bed_count' => 'nullable|integer|min:0',
        ]);

        $extraBedCount = $request->has('extra_bed_count') ? $request->extra_bed_count : 0;

        $room = Room::find($id);
        $isRoomAvailable = $this->isRoomAvailable($room, $request->checkin_date, $request->checkout_date);

        if (!$isRoomAvailable || $room->room_status !== 'พร้อมให้บริการ') {
            return redirect()->route('home')->with('error', 'ขออภัย, ห้องนี้ไม่สามารถจองได้ในช่วงเวลาที่ระบุ หรือห้องไม่พร้อมให้บริการ');
        }

        if ($request->occupancy_person > $room->room_occupancy) {
            return redirect()->route('home')->with('error', 'ขออภัย, จำนวนคนที่จะเข้าพักเกินกว่าที่ห้องรองรับได้');
        }

        $room->room_status = 'ไม่พร้อมให้บริการ';
        $room->save();

        // ใช้ Carbon เพื่อแปลงวันที่ให้เป็นรูปแบบ Y-m-d
        $checkinDate = Carbon::createFromFormat('d-m-Y', $request->checkin_date)->format('Y-m-d');
        $checkoutDate = Carbon::createFromFormat('d-m-Y', $request->checkout_date)->format('Y-m-d');

        // คำนวณจำนวนวันระหว่าง checkin และ checkout
        $days = Carbon::parse($checkinDate)->diffInDays(Carbon::parse($checkoutDate));

        $roomPricePerDay = $request->room_type === 'ห้องพักค้างคืน' ? $room->price_night : $room->price_temporary;
        $totalCost = $days * $roomPricePerDay;

        $booking = new Booking();
        $booking->user_id = auth()->user()->id;
        $booking->room_quantity = 1;
        $booking->total_cost = $totalCost;
        $booking->total_bed = 0;
        $booking->booking_status = 'ชำระเงินเสร็จสิ้น';
        $booking->save();

        $bookingDetail = new Booking_detail();
        $bookingDetail->booking_id = $booking->id;
        $bookingDetail->room_id = $room->id;
        $bookingDetail->booking_name = $request->booking_name;
        $bookingDetail->phone = $request->phone;
        $bookingDetail->occupancy_person = $request->occupancy_person;
        $bookingDetail->extra_bed_count = $extraBedCount;
        $bookingDetail->checkin_date = $checkinDate;  // แปลงวันที่เป็น Y-m-d
        $bookingDetail->checkout_date = $checkoutDate;  // แปลงวันที่เป็น Y-m-d
        $bookingDetail->room_type = $request->room_type;
        $bookingDetail->booking_detail_status = 'เช็คอินแล้ว';
        $bookingDetail->save();

        $booking->total_bed += $extraBedCount;
        $booking->save();

        if ($extraBedCount > 0) {
            $extraBedProduct = Product::where('product_name', 'เตียงเสริม')->first();
            if ($extraBedProduct) {
                $roomservice = new Roomservice();
                $roomservice->product_id = $extraBedProduct->id;
                $roomservice->booking_id = $booking->id;
                $roomservice->quantity = $extraBedCount;
                $roomservice->total_price = $extraBedProduct->product_price * $extraBedCount;
                $roomservice->save();

                $totalCost += $roomservice->total_price;

                $booking->total_cost = $totalCost;
                $booking->save();
            }
        }

        $payment = new Payment();
        $payment->payment_date = now();
        $payment->payment_status = 'completed'; // เริ่มต้นสถานะรอการยืนยัน
        $payment->total_price = $totalCost;
        $payment->booking_id = $booking->id;
        $payment->payment_type_id = $request->payment_method === 'cash' ? 2 : 1;

        // กรณีชำระเงินด้วยเงินสด
        if ($payment->payment_type_id == 2) {
            $payment->pay_price = $request->amount_paid;
            $payment->pay_change = $request->amount_paid - $totalCost;

            if ($payment->pay_price < $totalCost) {
                return redirect()->back()->with('error', 'จำนวนเงินที่ได้รับต้องมากกว่าหรือเท่ากับยอดชำระทั้งหมด');
            }
        } else {
            // กรณีโอนเงิน
            $payment->pay_price = 0;
            $payment->pay_change = 0;
        }

        // บันทึกข้อมูลการชำระเงิน
        $payment->save();

        $checkin = new Checkin();
        $checkin->booking_id = $booking->id;
        $checkin->checked_in_by = auth()->user()->id;
        $checkin->checkin = now();
        $checkin->name = $request->booking_name;
        $checkin->phone = $request->phone;
        $checkin->id_card = $request->id_card;
        $checkin->address = $request->address;
        $checkin->sub_district = $request->sub_district;
        $checkin->province = $request->province;
        $checkin->district = $request->district;
        $checkin->postcode = $request->postcode;
        $checkin->save();

        return redirect()->route('emroom')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function submitDamagedItems(Request $request)
    {
        try {
            $request->validate([
                'booking_id' => 'required|exists:bookings,id',
                'damaged_items' => 'nullable|array',
                'payment_method' => 'required|in:cash,transfer',
                'amount_paid' => 'nullable|numeric|min:0',
                'custom_damages' => 'nullable|array',
                'custom_damages.*.name' => 'nullable|string|max:255',
                'custom_damages.*.price' => 'nullable|numeric|min:0',
            ]);

            $bookingId = $request->input('booking_id');
            $damagedItems = $request->input('damaged_items', []);
            $paymentMethod = $request->input('payment_method');
            $amountPaid = $request->input('amount_paid', 0);
            $totalPrice = 0;

            DB::beginTransaction();

            $bookingDetails = Booking_detail::where('booking_id', $bookingId)
                ->where('booking_detail_status', 'เช็คอินแล้ว')
                ->first();

            if (!$bookingDetails) {
                return response()->json(['success' => false, 'error' => 'ไม่พบข้อมูลการจองที่เช็คอินแล้ว']);
            }

            $bookingDetailId = $bookingDetails->id;
            $roomId = $bookingDetails->room_id;  // ดึง room_id จาก Booking_detail

            // Process predefined damaged items
            foreach ($damagedItems as $itemId) {
                $productRoom = Product_room::find($itemId);
                if ($productRoom) {
                    CheckoutDetail::create([
                        'booking_id' => $bookingId,
                        'product_room_id' => $itemId,
                        'totalpriceroom' => $productRoom->productroom_price,
                        'productroom_name' => $productRoom->productroom_name,
                        'booking_detail_id' => $bookingDetailId,
                        'room_id' => $roomId,  // เพิ่มการบันทึก room_id
                        'thing_status' => 'รอซ่อม',
                        'repairmaintenances_type' => $productRoom->repair_type,
                    ]);
                    $totalPrice += $productRoom->productroom_price;
                }
            }

            // Process custom damages
            $customDamages = $request->input('custom_damages', []);
            foreach ($customDamages as $damage) {
                if (!empty($damage['name']) && !empty($damage['price'])) {
                    CheckoutDetail::create([
                        'booking_id' => $bookingId,
                        'product_room_id' => null,
                        'totalpriceroom' => $damage['price'],
                        'productroom_name' => $damage['name'],
                        'booking_detail_id' => $bookingDetailId,
                        'room_id' => $roomId,  // เพิ่มการบันทึก room_id
                        'thing_status' => 'รอซ่อม',
                        'repairmaintenances_type' => 'แจ้งซ่อม',
                    ]);
                    $totalPrice += $damage['price'];
                }
            }

            // Create maintenance record if damages exist
            if ($totalPrice > 0) {
                $room = $bookingDetails->room;
                if ($room) {
                    Maintenance::create([
                        'room_id' => $room->id,
                        'booking_detail_id' => $bookingDetailId,
                        'maintenances_status' => 'กำลังซ่อม',
                        'maintenance_StartDate' => now(),
                        'user_id' => auth()->id(),
                    ]);
                }
            }

            // Create payment record
            if ($totalPrice > 0) {
                $payChange = $paymentMethod === 'cash' ? max(0, $amountPaid - $totalPrice) : 0;
                Payment::create([
                    'payment_date' => now(),
                    'payment_status' => 'completed',
                    'total_price' => $totalPrice,
                    'pay_price' => $amountPaid,
                    'pay_change' => $payChange,
                    'booking_id' => $bookingId,
                    'payment_type_id' => $paymentMethod === 'cash' ? 2 : 1,
                ]);
            }

            // Update room status
            $room = $bookingDetails->room;
            if ($room) {
                $newRoomStatus = $totalPrice > 0 ? 'แจ้งซ่อมห้อง' : 'รอทำความสะอาด';
                $room->update(['room_status' => $newRoomStatus]);
            }

            DB::commit();

            return $this->checkoutuser($request);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => 'เกิดข้อผิดพลาด: ' . $e->getMessage()
            ], 500);
        }
    }


    public function checkoutuser(Request $request)
    {
        $bookingId = $request->input('booking_id');

        $bookingDetails = Booking_detail::where('booking_id', $bookingId)
            ->where('booking_detail_status', 'เช็คอินแล้ว')
            ->first();

        if ($bookingDetails) {
            $bookingDetails->update(['booking_detail_status' => 'เช็คเอาท์']);

            $room = $bookingDetails->room;
            $totalDamages = CheckoutDetail::where('booking_detail_id', $bookingDetails->id)
                ->sum('totalpriceroom');

            if ($totalDamages <= 0 && $room) {
                // ถ้าค่าเสียหายรวมเป็น 0 ให้ตั้งสถานะห้องเป็น "รอทำความสะอาด"
                $room->update(['room_status' => 'รอทำความสะอาด']);
            } elseif ($room) {
                // ถ้ามีค่าเสียหายรวม ให้ตั้งสถานะห้องเป็น "แจ้งซ่อมห้อง"
                $room->update(['room_status' => 'แจ้งซ่อมห้อง']);
            }

            Checkout::create([
                'booking_id' => $bookingId,
                'checked_out_by' => auth()->id(),
                'checkout' => now(),
                'total_damages' => $totalDamages,
            ]);

            return response()->json(['success' => true, 'message' => 'เช็คเอาท์สำเร็จ']);
        }

        return response()->json(['success' => false, 'error' => 'ไม่สามารถทำเช็คเอาท์ได้']);
    }

    public function updateBookingDetail(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'room_id' => 'required|exists:rooms,id',
            'name_*' => 'required|array|min:1',
            'id_card_*' => 'required|array|min:1',
            'phone_*' => 'required|array|min:1',
            'address_*' => 'required|array|min:1',
            'sub_district_*' => 'required|array|min:1',
            'province_*' => 'required|array|min:1',
            'district_*' => 'required|array|min:1',
            'postcode_*' => 'required|array|min:1',
            'extra_bed_count' => 'required|integer|min:0',

        ]);

        DB::beginTransaction();

        try {
            $booking = Booking::findOrFail($request->booking_id);
            $room = Room::findOrFail($request->room_id);

            $bookingDetail = $booking->bookingDetails()
                ->whereNull('room_id')
                ->firstOrFail();

            $bookingDetail->room_id = $room->id;
            $bookingDetail->booking_detail_status = 'เช็คอินแล้ว';
            $bookingDetail->extra_bed_count = $request->extra_bed_count;
            $bookingDetail->save();

            $roomPrice = $room->room_price;
            $booking->total_cost += $roomPrice;



            if ($request->extra_bed_count > 0) {
                $extraBedProduct = Product::where('product_name', 'เตียงเสริม')->first();
                if ($extraBedProduct) {
                    $extraBedTotalPrice = $extraBedProduct->product_price * $request->extra_bed_count;

                    $roomservice = new Roomservice();
                    $roomservice->product_id = $extraBedProduct->id;
                    $roomservice->booking_id = $booking->id;
                    $roomservice->quantity = $request->extra_bed_count;
                    $roomservice->total_price = $extraBedTotalPrice;
                    $roomservice->save();

                    // เพิ่มราคาของเตียงเสริมในค่าใช้จ่ายทั้งหมดของการจอง
                    $booking->total_cost += $extraBedTotalPrice;
                    $booking->save();

                    if ($extraBedTotalPrice > 0) {
                        $payment = new Payment();
                        $payment->payment_date = now();
                        $payment->payment_status = 'completed'; // เริ่มต้นสถานะการชำระเงิน
                        $payment->total_price = $extraBedTotalPrice;
                        $payment->booking_id = $booking->id;
                        $payment->amount = $extraBedTotalPrice;

                        // ตรวจสอบประเภทการชำระเงิน (เงินสดหรือโอนเงิน)
                        $payment->payment_type_id = $request->payment_method === 'cash' ? 2 : 1;

                        if ($payment->payment_type_id == 2) {
                            // กรณีชำระเงินสด
                            $payment->pay_price = $request->amount_paid;
                            $payment->pay_change = $request->amount_paid - $extraBedTotalPrice;

                            // ตรวจสอบว่าจำนวนเงินที่ได้รับเพียงพอ
                            if ($payment->pay_price < $extraBedTotalPrice) {
                                return redirect()->back()->with('error', 'จำนวนเงินที่ได้รับต้องมากกว่าหรือเท่ากับยอดชำระทั้งหมดสำหรับเตียงเสริม');
                            }
                        } else {
                            // กรณีโอนเงิน
                            $payment->pay_price = 0;
                            $payment->pay_change = 0;
                        }
                        $payment->save();
                    }
                }
            }


            $booking->save();

            $room->room_status = 'ไม่พร้อมให้บริการ';
            $room->save();

            $name = $request->input('name_');
            $id_card = $request->input('id_card_');
            $phone = $request->input('phone_');
            $address = $request->input('address_');
            $sub_district = $request->input('sub_district_');
            $province = $request->input('province_');
            $district = $request->input('district_');
            $postcode = $request->input('postcode_');

            foreach ($name as $index => $na) {
                Checkin::create([
                    'booking_id' => $booking->id,
                    'checked_in_by' => auth()->id(),
                    'checkin' => now(),
                    'name' => $na,
                    'id_card' => $id_card[$index],
                    'phone' => $phone[$index],
                    'address' => $address[$index],
                    'sub_district' => $sub_district[$index],
                    'province' => $province[$index],
                    'district' => $district[$index],
                    'postcode' => $postcode[$index],
                ]);
            }

            DB::commit();
            return redirect()->route('checkin')->with('success', 'เช็คอินเรียบร้อยแล้ว ห้องหมายเลข ' . $room->room_name);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('checkin')->with('error', 'เกิดข้อผิดพลาดในการเช็คอิน: ' . $e->getMessage());
        }
    }

    public function receiptpickuprent($id)
    {
        // ดึงข้อมูลการจองพร้อมความสัมพันธ์ที่เกี่ยวข้อง
        $booking = Booking::with([
            'bookingDetails.room',
            'payment.paymentType',
            'user',
            'promotion'
        ])->findOrFail($id);

        // สร้างเลขที่ใบเสร็จ
        $receipt_number = 'INV' . str_pad($booking->id, 8, '0', STR_PAD_LEFT);

        // เตรียมข้อมูลสำหรับ view
        $data = [
            'booking' => $booking,
            'customer_name' => $booking->user->name,
            'customer_phone' => $booking->user->tel,
            'receipt_number' => $receipt_number,
            'date' => now()->format('d/m/Y H:i'),
            'room_cost' => number_format($booking->room_quantity * 500, 2), // ค่าห้อง
            'extra_bed_cost' => number_format($booking->total_bed * 200, 2), // ค่าเตียงเสริม
            // 'total_cost' => number_format($booking->payment->total_price, 2), // ราคาทั้งหมด
        ];

        // สร้าง PDF
        if (view()->exists('user.receipt')) {  // แก้ path ให้ตรงกับที่เก็บไฟล์ view
            $pdf = PDF::loadView('user.receipt', $data);
            $pdf->setPaper('A4');
            return $pdf->stream('receipt.pdf');
        }

        return response()->json(['error' => 'ไม่พบไฟล์ view'], 404);
    }


    public function receiptpickuprentt()
    {

        $pdf = PDF::loadView('user.tt');
        $pdf->setPaper('A4');
        return $pdf->stream('receipt.pdf');
        return $pdfs->stream();
    }

    public function requestSoap($id)
    {
        $bookingDetail = Booking_detail::findOrFail($id);

        if (is_null($bookingDetail->soap_requested)) {
            $bookingDetail->soap_requested = now(); // บันทึกวันที่-เวลาเมื่อขอสบู่
            $bookingDetail->save();

            // ค้นหาประเภทสินค้า "เครื่องอาบน้ำ"
            $bathroomProductType = Product_type::where('product_type_name', 'เครื่องอาบน้ำ')->first();

            if ($bathroomProductType) {
                // ค้นหาสินค้าทั้งหมดที่อยู่ในประเภท "เครื่องอาบน้ำ"
                $products = Product::where('product_types_id', $bathroomProductType->id)->get();

                foreach ($products as $product) {
                    // ค้นหาสต็อกของสินค้านั้น
                    $stock = Stock::find($product->stocks_id);

                    if ($stock && $stock->stock_qty >= 2) {
                        // ลด stock_qty ลง 2
                        $stock->stock_qty -= 2;

                        // จำนวนที่ต้องลด
                        $remainingToReduce = 2;

                        // ค้นหา stock_packages ของ stock_id นี้ และเรียง id น้อยสุดก่อน
                        $stockPackages = StockPackage::where('stock_id', $stock->id)
                            ->orderBy('id') // ✅ ลดจาก id น้อยสุดก่อน
                            ->get();

                        foreach ($stockPackages as $package) {
                            if ($remainingToReduce <= 0) {
                                break;
                            }

                            if ($package->sumitem >= $remainingToReduce) {
                                $package->sumitem -= $remainingToReduce;
                                $remainingToReduce = 0;
                            } else {
                                $remainingToReduce -= $package->sumitem;
                                $package->sumitem = 0;
                            }

                            $package->save();
                        }

                        // คำนวณค่า pack_qty ใหม่
                        if ($stock->items_per_pack > 0) {
                            $stock->pack_qty = ceil($stock->stock_qty / $stock->items_per_pack);
                        }

                        $stock->save();
                    }
                }
            }

            return redirect()->back()->with('success', 'ขอสบู่เพิ่มเรียบร้อย');
        }

        return redirect()->back()->with('error', 'คุณขอสบู่ไปแล้ว');
    }
}
