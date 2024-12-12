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
use App\Models\CheckoutDetail;
use App\Models\Checkin;
use App\Models\Checkout;
use App\Models\Promotion;
use App\Models\Checkoutextend;
use App\Models\Maintenance;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookingController extends Controller
{
    public function userbooking()
    {
        $rooms = Room::all();
        return view('user.userbooking', compact('rooms',));
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
        })->with(['booking.review']) // ดึงข้อมูลรีวิวมาด้วย
            ->get();

        return view('user.reservation', compact('bookings'));
    }



    public function employeehome()
    {
        $bookings = Booking::where('user_id', auth()->user()->id)->get();
        return view('employee.employeehome', compact('bookings'));
    }
    public function checkinuser()
    {
        $bookings = Booking::whereHas('bookingDetails', function ($query) {
            $query->where('booking_detail_status', 'รอเลือกห้อง')
                ->whereNull('room_id');
        })->with(['bookingDetails' => function ($query) {
            $query->whereNull('room_id');
        }])->get();

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

        return view('employee.checkout', compact('bookings', 'rooms', 'productRooms'));
    }
    public function showRecordDetail($id)
    {
        $booking = Booking::with(['bookingDetails', 'payment', 'promotion'])->findOrFail($id);
        return view('owner.record_detail', compact('booking'));
    }

    public function record()
    {
        $bookings = Booking_detail::all();

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
        // Validation remains the same
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

        // Room availability check remains the same
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
        $roomPricePerDay = 500; // Room price per day
        $totalCost = $days * $roomPricePerDay * $request->number_of_rooms;

        $booking = new Booking();
        $booking->user_id = auth()->check() ? auth()->user()->id : null;
        $booking->room_quantity = $request->number_of_rooms;

        $totalGuests = ($request->number_of_guests ?? 0) + ($request->occupancy_child ?? 0) + ($request->occupancy_baby ?? 0);
        $booking->person_count = $totalGuests;
        // Promo code check remains the same
        if (!empty($request->promo_code)) {
            $promotion = Promotion::where('promo_code', $request->promo_code)
                ->where('start_date', '<=', now())
                ->where('end_date', '>=', now())
                ->first();

            if ($promotion) {
                $usageCount = Booking::where('promotion_id', $promotion->id)->count();

                // Promo validation checks remain the same
                if ($usageCount < $promotion->max_usage_per_code) {
                    if (!is_null($promotion->minimum_nights) && $days < $promotion->minimum_nights) {
                        return redirect()->back()->with('error', 'จำนวนคืนไม่ตรงกับเงื่อนไขของโปรโมชัน');
                    }
                    if (!is_null($promotion->minimum_booking_amount) && $totalCost < $promotion->minimum_booking_amount) {
                        return redirect()->back()->with('error', 'ยอดจองไม่ถึงขั้นต่ำที่กำหนดในโปรโมชัน');
                    }

                    // Calculate discount
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

        // Save the booking (keeping the original conditions)
        $booking->total_cost = $totalCost;
        $booking->booking_status = 'รอชำระเงิน';
        $booking->save();

        // Insert into booking_details and handle extra beds
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
                'checkin_date' => $request->checkin_date,
                'checkout_date' => $request->checkout_date,
                'extra_bed_count' => $insertExtraBed,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Handle remaining extra beds
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

        // Calculate the total extra bed cost
        $totalExtraBeds = $extraBedCount;
        $totalBedCost = 0;

        if ($totalExtraBeds > 0) {
            $extraBedProduct = Product::where('product_name', 'เตียงเสริม')->first();
            if ($extraBedProduct) {
                $totalBedCost = $extraBedProduct->product_price * $totalExtraBeds;

                // Update roomservice for extra beds
                $roomservice = new Roomservice();
                $roomservice->product_id = $extraBedProduct->id;
                $roomservice->booking_id = $booking->id;
                $roomservice->quantity = $totalExtraBeds;
                $roomservice->total_price = $totalBedCost;
                $roomservice->save();
            }
        }

        // Update total_bed and total_cost in the booking
        $booking->total_bed = $totalExtraBeds;
        $booking->total_cost += $totalBedCost; // Add bed cost to total cost
        $booking->save();

        return redirect()->route('payment', ['booking_id' => $booking->id])->with('success', 'บันทึกข้อมูลสำเร็จ');
    }


    public function checkAvailability(Request $request)
    {
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');
        $adultCount = (int) $request->query('adultCount', 2);
        $childCount = (int) $request->query('childCount', 0);
        $babyCount = (int) $request->query('babyCount', 0);
        $requestedRooms = (int) $request->query('numberOfRooms', 0);

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
            // ใช้จำนวนห้องที่ผู้ใช้เลือกถ้าเลือกมากกว่าจำนวนที่คำนวณได้
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

        // ปรับปรุงการตรวจสอบจำนวนการจองที่รอเลือกห้อง
        $pendingRoomSelectionsCount = Booking_detail::where('booking_detail_status', 'รอเลือกห้อง', 'รอชำระเงิน')
            ->whereNull('room_id')
            ->whereHas('booking', function ($query) use ($startDate, $endDate) {
                $query->where('checkin_date', '<', $endDate)
                    ->where('checkout_date', '>', $startDate)
                    ->where('booking_detail_status', '!=', 'ยกเลิกการจอง');
            })
            ->count();

        // ห้องที่ว่างอยู่ (ไม่รวมห้องที่ถูกจอง)
        $availableRooms = Room::where('room_status', 'พร้อมให้บริการ')
            ->whereNotIn('id', $bookedRooms)
            ->get();

        // จำนวนห้องว่างจริง
        $actualAvailableRoomsCount = count($availableRooms) - $pendingRoomSelectionsCount;

        // ดึงข้อมูลเตียงเสริม
        $stock = new Stock();
        $availableExtraBeds = $stock->getAvailableExtraBeds();
        $extraBedProduct = Product::where('product_name', 'เตียงเสริม')->first();
        $extraBedPrice = $extraBedProduct ? $extraBedProduct->product_price : 0;

        // เงื่อนไขใหม่: ตรวจสอบกรณีผู้ใหญ่เกินจำนวนห้องที่ว่าง
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
            // ใช้ค่าที่คำนวณจากเงื่อนไขเดิม
            $extraBedsOption1 = 0;
            $extraBedsOption2 = $equivalentAdultCount % 2 != 0 ? 1 : 0;
        }

        // กรองห้องที่ว่าง
        $filteredAvailableRooms = [];
        foreach ($availableRooms as $room) {
            if ($this->isRoomAvailable($room, $startDate, $endDate)) {
                $filteredAvailableRooms[] = [
                    'id' => $room->id,
                    'room_type' => $room->room_type,
                ];
            }
        }

        // ตัวเลือกห้องพัก
        $roomOptions = [];

        // เงื่อนไขพิเศษสำหรับผู้ใหญ่ 2 คน เด็ก 1 คน เด็กเล็ก 1 คน -> แสดง 2 ห้องหรือ 1 ห้อง + เตียงเสริม
        if ($adultCount == 2 && $childCount == 1 && $babyCount == 1) {
            // แสดงเฉพาะ 2 ห้อง หรือ 1 ห้อง + เตียงเสริม
            $roomOptions[] = [
                'type' => 'special_case_with_extra_bed', // ตัวเลือกกรณีพิเศษ + เตียงเสริม
                'rooms' => 1,
                'extraBeds' => 1,
                'price' => 500 + $extraBedPrice, // ราคา 1 ห้อง + เตียงเสริม
            ];

            $roomOptions[] = [
                'type' => 'special_case', // ตัวเลือกกรณีพิเศษ
                'rooms' => 2,
                'extraBeds' => 0,
                'price' => 2 * 500, // ราคา 2 ห้อง
            ];
        } else {
            // ตัวเลือกที่ 1: จำนวนห้องปกติ
            $roomOptions[] = [
                'type' => 'normal',
                'rooms' => $numberOfRoomsOption1,
                'extraBeds' => $extraBedsOption1,
                'price' => ($numberOfRoomsOption1 * 500) + ($extraBedsOption1 * $extraBedPrice),
            ];

            // ตัวเลือกที่ 2: จำนวนห้องน้อยลง + เตียงเสริม (ถ้าจำเป็น)
            if ($numberOfRoomsOption2 < $numberOfRoomsOption1 || $extraBedsOption2 > $extraBedsOption1) {
                $roomOptions[] = [
                    'type' => 'with_extra_bed',
                    'rooms' => $numberOfRoomsOption2,
                    'extraBeds' => $extraBedsOption2,
                    'price' => ($numberOfRoomsOption2 * 500) + ($extraBedsOption2 * $extraBedPrice),
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
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after_or_equal:checkin_date',
        ]);

        $checkinDate = $request->input('checkin_date');
        $checkoutDate = $request->input('checkout_date');

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
            ->get();

        return response()->json([
            'pendingBookings' => $pendingBookings,
            'bookingCount' => $pendingBookings->count(), // ส่งจำนวนการจอง
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

        $room = Room::find($id);
        $isRoomAvailable = $this->isRoomAvailable($room, $request->checkin_date, $request->checkout_date);

        if (!$isRoomAvailable || $room->room_status !== 'พร้อมให้บริการ') {
            return redirect()->route('home')->with('error', 'ขออภัย, ห้องนี้ไม่สามารถจองได้ในช่วงเวลาที่ระบุ หรือห้องไม่พร้อมให้บริการ');
        }

        if ($request->occupancy_person > $room->room_occupancy) {
            return redirect()->route('home')->with('error', 'ขออภัย, จำนวนคนที่จะเข้าพักเกินกว่าที่ห้องรองรับได้');
        }

        // Update room status
        $room->room_status = 'ไม่พร้อมให้บริการ';
        $room->save();

        // Calculate total cost based on room type and days
        $checkinDate = new \DateTime($request->checkin_date);
        $checkoutDate = new \DateTime($request->checkout_date);
        $interval = $checkinDate->diff($checkoutDate);
        $days = $interval->days;

        $roomPricePerDay = $request->room_type === 'ห้องพักค้างคืน' ? $room->price_night : $room->price_temporary;
        $totalCost = $days * $roomPricePerDay;

        // Save booking to 'bookings' table
        $booking = new Booking();
        $booking->user_id = auth()->user()->id;
        $booking->room_quantity = 1; // assuming 1 room is booked
        $booking->total_cost = $totalCost;
        $booking->total_bed = 0; // Initialize total_bed to 0
        $booking->booking_status = 'รอชำระเงิน';
        $booking->save();

        // Save booking details to 'booking_details' table
        $bookingDetail = new Booking_detail();
        $bookingDetail->booking_id = $booking->id;
        $bookingDetail->room_id = $room->id;
        $bookingDetail->booking_name = $request->booking_name;
        $bookingDetail->phone = $request->phone;
        $bookingDetail->occupancy_person = $request->occupancy_person;
        $bookingDetail->extra_bed_count = $request->extra_bed_count; // Add this line to save extra bed count
        $bookingDetail->checkin_date = $request->checkin_date;
        $bookingDetail->checkout_date = $request->checkout_date;
        $bookingDetail->room_type = $request->room_type;
        $bookingDetail->booking_detail_status = 'เช็คอินแล้ว';
        $bookingDetail->save();

        // Add extra bed count to total_bed in booking
        $booking->total_bed += $request->extra_bed_count; // Add extra beds to total_bed
        $booking->save();

        // Check for extra beds
        if ($request->extra_bed_count > 0) {
            $extraBedProduct = Product::where('product_name', 'เตียงเสริม')->first();
            if ($extraBedProduct) {
                $roomservice = new Roomservice();
                $roomservice->product_id = $extraBedProduct->id;
                $roomservice->booking_id = $booking->id;
                $roomservice->quantity = $request->extra_bed_count;
                $roomservice->total_price = $extraBedProduct->product_price * $request->extra_bed_count;
                $roomservice->save();

                // Add extra bed cost to total cost
                $totalCost += $roomservice->total_price;

                // Update total cost in booking
                $booking->total_cost = $totalCost;
                $booking->save();
            }
        }

        // Save check-in information
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



    public function checkoutuser(Request $request)
    {
        $bookingId = $request->input('booking_id');

        // ค้นหาข้อมูล booking_details ที่เช็คอินแล้ว
        $bookingDetails = Booking_detail::where('booking_id', $bookingId)
            ->where('booking_detail_status', 'เช็คอินแล้ว')
            ->first();

        if ($bookingDetails) {
            // เปลี่ยนสถานะ booking_details เป็น เช็คเอาท์
            $bookingDetails->booking_detail_status = 'เช็คเอาท์';
            $bookingDetails->save();

            // ค้นหาห้องที่เกี่ยวข้อง
            $room = $bookingDetails->room;
            if ($room) {
                // เปลี่ยนสถานะห้องเป็น รอทำความสะอาด
                $room->room_status = 'รอทำความสะอาด';
                $room->save();
            }

            // บันทึกข้อมูลการเช็คเอาท์ในตาราง checkouts
            Checkout::create([
                'booking_id' => $bookingId,
                'checked_out_by' => auth()->id(), // หรือตามวิธีที่คุณใช้ในการจัดการผู้ใช้ที่เช็คเอาท์
                'checkout' => now(), // วันที่เช็คเอาท์
            ]);

            return redirect()->back()->with('success', 'เช็คเอาท์สำเร็จ');
        }

        return redirect()->back()->with('error', 'ไม่สามารถทำเช็คเอาท์ได้');
    }



    public function savePayment(Request $request)
    {
        $checkoutextendId = $request->input('checkoutextend_id');
        $paymentMethod = $request->input('payment_method');
        $cashRefund = $request->input('cash_refund');
        $amountPaid = $request->input('amount_paid'); // Get the amount paid from the request

        // Find the checkoutextend record
        $checkoutextend = Checkoutextend::findOrFail($checkoutextendId);

        // Update payment details
        $checkoutextend->payment_method = $paymentMethod;
        $checkoutextend->cash_refund = $cashRefund;
        $checkoutextend->amount_paid = $amountPaid; // Save the amount paid
        $checkoutextend->save();

        return response()->json(['message' => 'ข้อมูลการชำระเงินถูกบันทึกเรียบร้อยแล้ว']);
    }


    public function submitDamagedItems(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $damagedItems = $request->input('damaged_items', []);
        $totalPrice = 0;

        foreach ($damagedItems as $itemId) {
            $productRoom = Product_room::find($itemId);
            if ($productRoom) {
                // Create a new CheckoutDetail entry
                $checkoutDetail = new CheckoutDetail([
                    'booking_id' => $bookingId,
                    'product_room_id' => $itemId,
                    'totalpriceroom' => $productRoom->productroom_price,
                ]);
                $checkoutDetail->save();

                // Accumulate total damage price
                $totalPrice += $productRoom->productroom_price;
            }
        }

        // Update the booking_details status
        $bookingDetails = Booking_detail::where('booking_id', $bookingId)
            ->where('booking_detail_status', 'เช็คอินแล้ว')
            ->first();

        if ($bookingDetails) {
            $bookingDetails->booking_detail_status = 'เช็คเอาท์';
            $bookingDetails->save();

            // Get the related room and update its status
            $room = $bookingDetails->room;
            if ($room) {
                $room->room_status = 'แจ้งซ่อมห้อง';
                $room->save();
            }

            // Record checkout information
            $checkout = Checkout::create([
                'booking_id' => $bookingId,
                'checked_out_by' => auth()->id(), // Assuming you have an authenticated user
                'checkout' => now(), // Checkout timestamp
                'total_damages' => $totalPrice, // Store total damages here
            ]);


            if (!empty($damagedItems)) {
                foreach ($damagedItems as $itemId) {
                    $productRoom = Product_room::find($itemId);

                    if ($productRoom) {
                        $maintenance = new Maintenance([
                            'booking_id' => $bookingId,
                            'product_room_id' => $itemId,
                            'room_id' => $productRoom->room_id,
                            'damage_cost' => $productRoom->productroom_price,
                            'status' => 'Pending',
                        ]);
                        $maintenance->save();
                    }
                }
            }
            return redirect()->back()->with('success', "เช็คเอาท์สำเร็จ. ค่าเสียหายรวม: ฿" . number_format($totalPrice, 2));
        }

        return redirect()->back()->with('error', 'ไม่สามารถทำเช็คเอาท์ได้');
    }



    public function updateBookingDetail(Request $request)
    {
        // Validation ของข้อมูลที่ส่งเข้ามา
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string|max:255',
            'id_card' => 'required|string|max:20',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'sub_district' => 'required|string|max:255',
            'province' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'postcode' => 'required|string|max:10',
            'extra_bed_count' => 'required|integer|min:0', // Validate จำนวนเตียงเสริม
        ]);

        DB::beginTransaction(); // เริ่มการ transaction เพื่อความปลอดภัยของข้อมูล

        try {
            // ค้นหาข้อมูลการจองและห้องที่เลือก
            $booking = Booking::findOrFail($request->booking_id);
            $room = Room::findOrFail($request->room_id);

            // ค้นหา bookingDetails ที่ยังไม่ได้เลือกห้อง (room_id เป็น NULL)
            $bookingDetail = $booking->bookingDetails()
                ->whereNull('room_id')
                ->firstOrFail(); // ถ้าไม่พบจะ throw exception อัตโนมัติ

            // อัปเดตสถานะการเช็คอินและกำหนด room_id
            $bookingDetail->room_id = $room->id;
            $bookingDetail->booking_detail_status = 'เช็คอินแล้ว';
            $bookingDetail->extra_bed_count = $request->extra_bed_count; // อัปเดตจำนวนเตียงเสริม
            $bookingDetail->save(); // บันทึกการเปลี่ยนแปลง

            // หากมีเตียงเสริมเพิ่มเข้าไปในบริการห้อง
            if ($request->extra_bed_count > 0) {
                $extraBedProduct = Product::where('product_name', 'เตียงเสริม')->first();
                if ($extraBedProduct) {
                    $roomservice = new Roomservice();
                    $roomservice->product_id = $extraBedProduct->id;
                    $roomservice->booking_id = $booking->id;
                    $roomservice->quantity = $request->extra_bed_count; // ใช้จำนวนเตียงเสริมจากฟอร์ม
                    $roomservice->total_price = $extraBedProduct->product_price * $request->extra_bed_count;
                    $roomservice->save();

                    // อัปเดตค่าใช้จ่ายรวมของการจอง
                    $booking->total_cost += $roomservice->total_price; // บวกเพิ่มค่าเตียงเสริม
                }
            }

            // บวกเพิ่มราคาห้องเข้ากับ total_cost
            $roomPrice = $room->room_price; // สมมติว่ามี room_price ในตาราง rooms
            $booking->total_cost += $roomPrice;
            $booking->save(); // บันทึกการเปลี่ยนแปลงค่าใช้จ่าย

            // อัปเดตสถานะห้อง
            $room->room_status = 'ไม่พร้อมให้บริการ';
            $room->save(); // บันทึกสถานะห้อง

            // บันทึกข้อมูลในตาราง Checkin
            Checkin::create([
                'booking_id' => $booking->id,
                'checked_in_by' => auth()->id(), // ผู้เช็คอิน (หากมีการล็อกอิน)
                'checkin' => now(), // วันที่เช็คอิน
                'name' => $request->name,
                'id_card' => $request->id_card,
                'phone' => $request->phone,
                'address' => $request->address,
                'sub_district' => $request->sub_district,
                'province' => $request->province,
                'district' => $request->district,
                'postcode' => $request->postcode,
            ]);

            DB::commit(); // ทำการ commit เมื่อทุกอย่างสำเร็จ

            // ส่งผู้ใช้กลับไปหน้า checkin พร้อมข้อความสำเร็จ
            return redirect()->route('checkin')->with('success', 'เช็คอินเรียบร้อยแล้ว ห้องหมายเลข ' . $room->room_name);
        } catch (\Exception $e) {
            DB::rollBack(); // หากมีข้อผิดพลาด ย้อนกลับการเปลี่ยนแปลงทั้งหมด
            return redirect()->route('checkin')->with('error', 'เกิดข้อผิดพลาดในการเช็คอิน: ' . $e->getMessage());
        }
    }
}
