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
        return view('employee.emroom', compact('rooms',));
    }
    public function t()
    {
        $rooms = Room::all();
        return view('user.t', compact('rooms',));
    }
    public function showReserveForm(Request $request)
    {
        $extra_bed_count = $request->input('extra_bed_count', 0); // ค่าเริ่มต้นเป็น 0 ถ้าไม่ส่งมา
        $checkin_date = $request->input('checkin_date');
        $checkout_date = $request->input('checkout_date');
        $number_of_rooms = $request->input('number_of_rooms');
        $number_of_guests = $request->input('number_of_guests', 0);
        $occupancy_child = $request->input('occupancy_child', 0);
        $occupancy_baby = $request->input('occupancy_baby', 0);

        return view('user.reserve', compact('checkin_date', 'checkout_date', 'number_of_rooms', 'extra_bed_count', 'number_of_guests', 'occupancy_child', 'occupancy_baby'));
    }


    public function em_reserve($id)
    {
        $rooms = Room::find($id);
        return view('employee.em_reserve', compact('rooms'));
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
            $query->where('booking_status', 'รอเลือกห้อง')
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
        $bookingDetails = Booking_detail::where('booking_status', 'เช็คอินแล้ว')->get();
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
            'checkoutExtends' 
        ])->find($bookingdetail_id);
    
        if (!$bookingDetail) {
            return redirect()->route('record')->with('error', 'ไม่พบข้อมูลการจอง');
        }
        return view('owner.record_detail', compact('bookingDetail'));
    }

    public function reserve(Request $request)
    {
        // Validate the request inputs
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
        ]);

        // Get available rooms (initialize $availableRooms)
        $rooms = Room::where('room_status', 'พร้อมให้บริการ')->get();
        $availableRooms = [];

        // Loop through rooms to check availability
        foreach ($rooms as $room) {
            if (
                $this->isRoomAvailable($room, $request->checkin_date, $request->checkout_date) &&
                $request->number_of_guests <= $room->room_occupancy
            ) {
                $availableRooms[] = $room;
            }
        }

        if (count($availableRooms) < $request->number_of_rooms) {
            return redirect()->route('home')->with('error', 'ขออภัย, ไม่มีห้องว่างเพียงพอต่อความต้องการของลูกค้า');
        }

        // Calculate total cost
        $checkinDate = new \DateTime($request->checkin_date);
        $checkoutDate = new \DateTime($request->checkout_date);
        $interval = $checkinDate->diff($checkoutDate);
        $days = $interval->days;
        $roomPricePerDay = 500; // Room price per day
        $totalCost = $days * $roomPricePerDay * $request->number_of_rooms;

        // Create a new booking
        $booking = new Booking();
        $booking->user_id = auth()->check() ? auth()->user()->id : null;

        $promotion = null;

        if (!empty($request->promo_code)) {
            $promotion = Promotion::where('promo_code', $request->promo_code)
                ->where('start_date', '<=', now()) // โปรโมชั่นเริ่มต้นแล้ว
                ->where('end_date', '>=', now()) // โปรโมชั่นยังไม่หมดอายุ
                ->first();

            if ($promotion) {
                $bookingDate = now(); // หรือคุณอาจใช้วันที่ที่ต้องการ
                // ตรวจสอบว่าลูกค้าสามารถใช้โปรโมชั่นได้หรือไม่
                if ($bookingDate >= $promotion->start_date && $bookingDate <= $promotion->end_date) {
                    // ตรวจสอบว่ามีการใช้โปรโมชั่นมากกว่าที่อนุญาตหรือไม่
                    $usageCount = Booking::where('promotion_id', $promotion->id)->count();

                    if ($usageCount < $promotion->max_usage_per_code) {
                        // คำนวณส่วนลด
                        $discountPercentage = $promotion->discount_percentage;
                        $discountAmount = ($discountPercentage / 100) * $totalCost;
                        $totalCost -= $discountAmount;

                        // อัปเดตการใช้งานโปรโมชั่น
                        $promotion->usage_count += 1;
                        $promotion->save();
                    } else {
                        return redirect()->back()->with('error', 'โปรโมชันนี้มีการใช้งานถึงขีดจำกัดแล้ว');
                    }
                } else {
                    return redirect()->back()->with('error', 'โค้ดโปรโมชันไม่ถูกต้องหรือหมดอายุ');
                }
            } else {
                return redirect()->back()->with('error', 'โค้ดโปรโมชันไม่ถูกต้องหรือหมดอายุ');
            }
        }

        // ถ้ามีโปรโมชั่นที่ถูกต้อง ให้กำหนด promotion_id
        if ($promotion) {
            $booking->promotion_id = $promotion->id; // กำหนด promotion_id ถ้าใช้ได้
        }

        $booking->save();

        // Insert into booking_details table
        foreach (array_slice($availableRooms, 0, $request->number_of_rooms) as $room) {
            DB::table('booking_details')->insert([
                'booking_id' => $booking->id,
                'room_id' => null,
                'booking_name' => $request->booking_name,
                'phone' => $request->phone,
                'bookingto_username' => $request->bookingto_username,
                'bookingto_phone' => $request->bookingto_phone,
                'booking_status' => 'รอเลือกห้อง',
                'room_type' => 'ห้องพักค้างคืน',
                'occupancy_person' => $request->number_of_guests,
                'occupancy_child' => $request->occupancy_child,
                'occupancy_baby' => $request->occupancy_baby,
                'checkin_date' => $request->checkin_date,
                'checkout_date' => $request->checkout_date,
                'room_quantity' => $request->number_of_rooms,
                'total_cost' => $totalCost,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Handle extra bed
        if ($request->extra_bed_count > 0) {
            // Find the extra bed product
            $extraBedProduct = Product::where('product_name', 'เตียงเสริม')->first();

            if ($extraBedProduct) {
                // Create a new Roomservice entry
                $roomservice = new Roomservice();
                $roomservice->product_id = $extraBedProduct->id;
                $roomservice->save();

                // Create a new Roomservice_detail entry
                $roomserviceDetail = new Roomservice_detail();
                $roomserviceDetail->roomservice_id = $roomservice->id;
                $roomserviceDetail->booking_id = $booking->id;
                $roomserviceDetail->quantity = $request->extra_bed_count;
                $roomserviceDetail->total_price = $extraBedProduct->product_price * $request->extra_bed_count;
                $roomserviceDetail->save();

                // Update the total cost of the booking
                $totalCost += $roomserviceDetail->total_price;
            }
        }

        // Update the total cost in the booking_details table
        DB::table('booking_details')
            ->where('booking_id', $booking->id)
            ->update(['total_cost' => $totalCost]);

        // Redirect to the payment page with success message
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

        // Calculate equivalent adult count
        $equivalentAdultCount = $adultCount + floor($childCount / 2) + floor($babyCount / 3);

        // Determine the number of rooms
        if ($requestedRooms > 0 && $requestedRooms > ceil($equivalentAdultCount / 2)) {
            $numberOfRooms = $requestedRooms;
        } else {
            $numberOfRooms = ceil($equivalentAdultCount / 2);
        }
        if ($equivalentAdultCount == 1) {
            $extraBedCount = 0;
        } else {
            $extraBedCount = ($equivalentAdultCount % 2 === 0) ? 0 : 1;
        }
        // Fetch all rooms
        $rooms = Room::all();
        $totalRooms = $rooms->count();
        $availableRooms = [];
        $bookingStatuses = ['รอชำระเงิน', 'รอเข้าพัก', 'เช็คอินแล้ว', 'รอทำความสะอาด', 'รอเลือกห้อง'];

        // Calculate rooms booked but not yet assigned
        $pendingBookings = Booking_detail::whereNull('room_id')
            ->whereIn('booking_status', $bookingStatuses)
            ->whereHas('booking', function ($query) use ($startDate, $endDate) {
                $query->where('checkin_date', '<', $endDate)
                    ->where('checkout_date', '>', $startDate);
            })
            ->count();

        $totalRooms -= $pendingBookings;

        foreach ($rooms as $room) {
            if ($this->isRoomAvailable($room, $startDate, $endDate)) {
                $availableRooms[] = [
                    'id' => $room->id,
                    'room_type' => $room->room_type,
                ];
            }
        }

        // Fetch extra bed information
        $stock = new Stock();
        $availableExtraBeds = $stock->getAvailableExtraBeds();
        $extraBedProduct = Product::where('product_name', 'เตียงเสริม')->first();
        $extraBedPrice = $extraBedProduct ? $extraBedProduct->product_price : 0;

        // Prepare room options
        // Prepare room options
        $roomOptions = [];

        // Option 1: Rooms without extra beds
        $roomOptions[] = [
            'type' => 'normal',
            'rooms' => $numberOfRooms,
            'extraBeds' => 0,
            'price' => $numberOfRooms * 500, // Assuming 500 is the base price per room
        ];

        // Option 2: Rooms with extra beds only if available
        if ($extraBedCount > 0 && $numberOfRooms > 1 && $availableExtraBeds > 0) {
            $roomOptions[] = [
                'type' => 'with_extra_bed',
                'rooms' => $numberOfRooms - 1,
                'extraBeds' => 1,
                'price' => (($numberOfRooms - 1) * 500) + $extraBedPrice,
            ];
        }


        return response()->json([
            'availableRooms' => $availableRooms,
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
            ->whereIn('booking_status', $bookingStatuses)
            ->whereHas('booking', function ($query) use ($checkinDate, $checkoutDate) {
                $query->where(function ($query) use ($checkinDate, $checkoutDate) {
                    // ครอบคลุมการจองที่เริ่มหรือสิ้นสุดในวันเดียวกัน
                    $query->where('checkin_date', '<=', $checkoutDate)
                        ->where('checkout_date', '>=', $checkinDate);
                });
            })
            ->count();

        return $existingBookings === 0;
    }


    public function emaddBooking(Request $request, $id)
    {
        $request->validate([
            'booking_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'number_of_guests' => 'required|integer|min:1',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'room_type' => 'required|string',
        ]);

        $room = Room::find($id);
        $isRoomAvailable = $this->isRoomAvailable($room, $request->checkin_date, $request->checkout_date);

        if (!$isRoomAvailable || $room->room_status !== 'พร้อมให้บริการ') {
            return redirect()->route('home')->with('error', 'ขออภัย, ห้องนี้ไม่สามารถจองได้ในช่วงเวลาที่ระบุ หรือห้องไม่พร้อมให้บริการ');
        }
        if ($request->number_of_guests > $room->room_occupancy) {
            return redirect()->route('home')->with('error', 'ขออภัย, จำนวนคนที่จะเข้าพักเกินกว่าที่ห้องรองรับได้');
        }

        $room->room_status = 'ไม่พร้อมให้บริการ';
        $room->save();

        // คำนวณราคาห้อง
        $checkinDate = new \DateTime($request->checkin_date);
        $checkoutDate = new \DateTime($request->checkout_date);
        $interval = $checkinDate->diff($checkoutDate);
        $days = $interval->days;

        $roomPricePerDay = $request->room_type === 'ห้องพักค้างคืน' ? 500 : 300;
        $totalCost = $days * $roomPricePerDay;

        $booking = new Booking();
        $booking->user_id = auth()->user()->id;
        $booking->room_id = $room->id;
        $booking->booking_name = $request->booking_name;
        $booking->phone = $request->phone;
        $booking->checkin_date = $request->checkin_date;
        $booking->checkout_date = $request->checkout_date;
        $booking->checkin_by = auth()->user()->id;
        $booking->total_cost = $totalCost;
        $booking->booking_status = 'รอชำระเงิน';
        $booking->room_type = $request->room_type;
        $booking->occupancy_person = $request->number_of_guests;
        $booking->booking_status = $request['booking_status'];
        $booking->save();
        return redirect()->route('checkin')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function cancelBooking($id)
    {
        $booking = Booking::find($id);

        if ($booking) {
            if ($booking->booking_status === 'รอชำระเงิน') {
                // เปลี่ยนค่า booking_status เป็น 'ยกเลิกการจอง'
                $booking->booking_status = 'ยกเลิกการจอง';
                $booking->save();

                // ดึงข้อมูลห้อง
                $room = $booking->room;

                // เปลี่ยนค่า room_status เป็น 'พร้อมให้บริการ'
                $room->room_status = 'พร้อมให้บริการ';
                $room->save();

                return redirect()->route('home')->with('success', 'ยกเลิกการจองเรียบร้อยแล้ว');
            }
        }

        return redirect()->route('home')->with('error', 'ขออภัย, ยกเลิกไม่สำเร็จ');
    }

    public function checkoutuser(Request $request)
    {
        $bookingId = $request->input('booking_id');

        // ค้นหาข้อมูล booking_details ที่เช็คอินแล้ว
        $bookingDetails = Booking_detail::where('booking_id', $bookingId)
            ->where('booking_status', 'เช็คอินแล้ว')
            ->first();

        if ($bookingDetails) {
            // เปลี่ยนสถานะ booking_details เป็น เช็คเอาท์
            $bookingDetails->booking_status = 'เช็คเอาท์';
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

    public function extendCheckout(Request $request)
    {
        $bookingDetailId = $request->input('booking_detail_id');
        $extendDays = $request->input('extend_days');

        // หา booking_detail ที่เกี่ยวข้อง
        $bookingDetail = Booking_detail::findOrFail($bookingDetailId);

        // อัปเดต checkout_date โดยเพิ่มจำนวนวัน
        $currentCheckoutDate = Carbon::parse($bookingDetail->checkout_date);
        $newCheckoutDate = $currentCheckoutDate->addDays($extendDays);

        // คำนวณค่าใช้จ่ายเพิ่มเติม
        $extraCharge = $extendDays * 500; // 500 บาทต่อวัน

        // อัปเดต checkout_date ใน booking_detail
        $bookingDetail->checkout_date = $newCheckoutDate;
        $bookingDetail->save();

        // บันทึกข้อมูลการเลื่อนเวลาเช็คเอาท์ลงในตาราง checkoutextend
        $checkoutextend = Checkoutextend::create([
            'booking_detail_id' => $bookingDetailId,
            'extended_days' => $extendDays,
            'extra_charge' => $extraCharge,
        ]);

        // คืนค่าข้อมูลเพื่อใช้ใน popup การชำระเงิน
        return response()->json([
            'extra_charge' => $extraCharge,
            'checkoutextend_id' => $checkoutextend->id // ส่ง ID ของ checkoutextend เพื่อใช้ในการบันทึกการชำระเงิน
        ]);
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
            ->where('booking_status', 'เช็คอินแล้ว')
            ->first();

        if ($bookingDetails) {
            $bookingDetails->booking_status = 'เช็คเอาท์';
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

            // You can optionally return the checkout ID or details if needed
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
            $bookingDetail->booking_status = 'เช็คอินแล้ว';
            $bookingDetail->save(); // บันทึกการเปลี่ยนแปลง

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
