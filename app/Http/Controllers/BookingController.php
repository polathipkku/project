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
    public function checkin()
    {
        $bookings = Booking::where('booking_status', 'รอเลือกห้อง')->get();
        $rooms = Room::all(); // ดึงห้องทั้งหมดที่มี

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

        return view('employee.checkout', compact('bookings', 'rooms'));
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
        ]);

        // Get available rooms (initialize $availableRooms)
        $rooms = Room::where('room_status', 'พร้อมให้บริการ')->get();
        $availableRooms = []; // Initialize $availableRooms to avoid the undefined variable error

        // Loop through rooms to check availability
        foreach ($rooms as $room) {
            if (
                $this->isRoomAvailable($room, $request->checkin_date, $request->checkout_date) &&
                $request->number_of_guests <= $room->room_occupancy
            ) {
                $availableRooms[] = $room; // Add available room to the array
            }
        }

        // Check if there are enough available rooms
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
        $booking->user_id = auth()->user()->id;
        $booking->checkin_by = auth()->user()->id;
        $booking->checkout_by = auth()->user()->id;
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

    // public function reserves(Request $request)
    // {
    //     // Validate inputs
    //     $request->validate([
    //         'booking_name' => 'required|string|max:255',
    //         'phone' => 'required|string|max:20',
    //         'number_of_guests' => 'required|integer|min:1|max:2',
    //         'checkin_date' => 'required|date',
    //         'checkout_date' => 'required|date|after:checkin_date',
    //         'number_of_rooms' => 'required|integer|min:1',
    //         'bookingto_username' => 'nullable|string|max:255',
    //         'bookingto_phone' => 'nullable|string|max:20',
    //         'occupancy_person' => 'nullable|integer|min:0',
    //         'occupancy_child' => 'nullable|integer|min:0',
    //         'occupancy_baby' => 'nullable|integer|min:0',
    //         'extra_bed_count' => 'nullable|integer|min:0',
    //     ]);

    //     // Fetch available rooms
    //     $availableRooms = Room::where('room_status', 'พร้อมให้บริการ')->get()->filter(function($room) use ($request) {
    //         return $this->isRoomAvailable($room, $request->checkin_date, $request->checkout_date)
    //             && $request->number_of_guests <= $room->room_occupancy;
    //     });

    //     // Check if available rooms meet the number of requested rooms
    //     if ($availableRooms->count() < $request->number_of_rooms) {
    //         return redirect()->route('home')->with('error', 'ขออภัย, ไม่มีห้องว่างเพียงพอต่อความต้องการของลูกค้า');
    //     }

    //     // Calculate total cost based on stay duration
    //     $checkinDate = new \DateTime($request->checkin_date);
    //     $checkoutDate = new \DateTime($request->checkout_date);
    //     $days = $checkinDate->diff($checkoutDate)->days;
    //     $roomPricePerDay = 500; // Fixed room price per day, adjust if needed
    //     $totalCost = $days * $roomPricePerDay * $request->number_of_rooms;

    //     // Create a new booking
    //     $booking = new Booking();
    //     $booking->user_id = auth()->id(); // Use authenticated user's ID
    //     $booking->checkin_by = auth()->id();
    //     $booking->checkout_by = auth()->id();
    //     $booking->save();

    //     // Handle extra bed charges if applicable
    //     if ($request->extra_bed_count > 0) {
    //         $extraBedProduct = Product::where('product_name', 'เตียงเสริม')->first();
    //         if ($extraBedProduct) {
    //             $roomservice = new Roomservice();
    //             $roomservice->product_id = $extraBedProduct->id;
    //             $roomservice->save();

    //             $roomserviceDetail = new Roomservice_detail();
    //             $roomserviceDetail->roomservice_id = $roomservice->id;
    //             $roomserviceDetail->booking_id = $booking->id;
    //             $roomserviceDetail->quantity = $request->extra_bed_count;
    //             $roomserviceDetail->total_price = $extraBedProduct->product_price * $request->extra_bed_count;
    //             $roomserviceDetail->save();

    //             $totalCost += $roomserviceDetail->total_price;
    //         }
    //     }

    //     // Save booking details for each room
    //     foreach ($availableRooms->take($request->number_of_rooms) as $room) {
    //         DB::table('booking_details')->insert([
    //             'booking_id' => $booking->id,
    //             'room_id' => $room->id,
    //             'checkin_date' => $request->checkin_date,
    //             'checkout_date' => $request->checkout_date,
    //             'occupancy_person' => $request->occupancy_person,
    //             'occupancy_child' => $request->occupancy_child,
    //             'total_cost' => $totalCost,
    //         ]);
    //     }

    //     // Redirect to payment page with success message
    //     return redirect()->route('payment', ['booking_id' => $booking->id])->with('success', 'บันทึกข้อมูลสำเร็จ');
    // }


    public function checkAvailability(Request $request)
    {
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');
        $adultCount = (int) $request->query('adultCount', 2);
        $childCount = (int) $request->query('childCount', 0);
        $babyCount = (int) $request->query('babyCount', 0);

        // Calculate equivalent adult count
        $equivalentAdultCount = $adultCount + floor($childCount / 2) + floor($babyCount / 3);

        $numberOfRooms = ceil($equivalentAdultCount / 2);
        $extraBedCount = ($equivalentAdultCount % 2 === 0) ? 0 : 1;

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
        $roomOptions = [];

        // Option 1: Rooms without extra beds
        $roomOptions[] = [
            'type' => 'normal',
            'rooms' => $numberOfRooms,
            'extraBeds' => 0,
            'price' => $numberOfRooms * 500, // Assuming 500 is the base price per room
        ];

        if ($extraBedCount > 0 && $numberOfRooms > 1) {
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
                $query->where('checkin_date', '<', $checkoutDate)
                    ->where('checkout_date', '>', $checkinDate);
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

    // public function selectRoom(Request $request)
    // {
    //     $request->validate([
    //         'booking_id' => 'required|exists:bookings,id',
    //         'room_id' => 'required|exists:rooms,id',
    //     ]);

    //     $booking = Booking::find($request->booking_id);
    //     $room = Room::find($request->room_id);

    //     if ($booking && $room) {
    //         $booking->room_id = $room->id;
    //         $booking->booking_status = 'เช็คอินแล้ว';
    //         $booking->save();

    //         // อัปเดตสถานะห้องให้ไม่พร้อมให้บริการ
    //         $room->room_status = 'ไม่พร้อมให้บริการ';
    //         $room->save();

    //         return redirect()->back()->with('success', 'เลือกห้องเรียบร้อยแล้ว');
    //     }

    //     return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการเลือกห้อง');
    // }
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




    public function checkoutuser(Request $request)
    {
        $bookingId = $request->input('booking_id');

        // ค้นหาข้อมูล booking_details ที่มี booking_id ตรงกับที่ส่งมา
        $bookingDetails = Booking_detail::where('booking_id', $bookingId)
            ->where('booking_status', 'เช็คอินแล้ว')
            ->first();

        if ($bookingDetails) {
            // อัปเดตสถานะของ booking_detail เป็น 'เช็คเอาท์'
            $bookingDetails->booking_status = 'เช็คเอาท์';
            $bookingDetails->save();

            // อัปเดตสถานะห้องให้เป็น 'รอทำความสะอาด'
            $room = $bookingDetails->room; // ตรวจสอบว่า room เชื่อมโยงถูกต้อง
            if ($room) {
                $room->room_status = 'รอทำความสะอาด';
                $room->save();
            }

            return redirect()->back()->with('success', 'เช็คเอาท์สำเร็จ');
        }

        return redirect()->back()->with('error', 'ไม่สามารถทำเช็คเอาท์ได้');
    }


    public function updateBookingDetail(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'room_id' => 'required|exists:rooms,id',
        ]);

        $booking = Booking::find($request->booking_id);
        $room = Room::find($request->room_id);

        if ($booking && $room) {
            $bookingDetail = $booking->bookingDetails()
                ->whereNull('room_id')
                ->first();

            if ($bookingDetail) {
                $bookingDetail->room_id = $room->id;
                $bookingDetail->booking_status = 'เช็คอินแล้ว';

                if ($bookingDetail->save()) {
                    $room->room_status = 'ไม่พร้อมให้บริการ';
                    $room->save();

                    return redirect()->back()->with('success', 'เลือกห้องเรียบร้อยแล้ว');
                } else {
                    return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการบันทึกข้อมูล');
                }
            }

            return redirect()->back()->with('error', 'ไม่พบรายละเอียดการจองที่ตรงกัน');
        }

        return redirect()->back()->with('error', 'เกิดข้อผิดพลาดในการเลือกห้อง');
    }
}
