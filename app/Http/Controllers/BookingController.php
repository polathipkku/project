<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Booking_detail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        $checkin_date = $request->query('checkin_date');
        $checkout_date = $request->query('checkout_date');
        $number_of_rooms = $request->query('number_of_rooms');
        return view('user.reserve', compact('checkin_date', 'checkout_date', 'number_of_rooms'));
    }

    public function em_reserve($id)
    {
        $rooms = Room::find($id);
        return view('employee.em_reserve', compact('rooms'));
    }

    public function reservation()
    {
        $bookings = Booking::where('user_id', auth()->user()->id)->get();
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
        $request->validate([
            'booking_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'number_of_guests' => 'required|integer|min:1',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'number_of_rooms' => 'required|integer|min:1',
        ]);

        // ตรวจสอบห้องที่ว่าง
        $rooms = Room::where('room_status', 'พร้อมให้บริการ')->get();

        $availableRooms = [];

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

        // คำนวณราคาห้อง
        $checkinDate = new \DateTime($request->checkin_date);
        $checkoutDate = new \DateTime($request->checkout_date);
        $interval = $checkinDate->diff($checkoutDate);
        $days = $interval->days;

        $roomPricePerDay = 500; // ตั้งราคาสำหรับห้องพักค้างคืน
        $totalCost = $days * $roomPricePerDay * $request->number_of_rooms;

        $booking = new Booking();
        $booking->user_id = auth()->user()->id;
        $booking->checkin_date = $request->checkin_date;
        $booking->checkout_date = $request->checkout_date;
        $booking->checkin_by = auth()->user()->id;
        $booking->total_cost = $totalCost;
        $booking->room_type = 'ห้องพักค้างคืน';
        $booking->occupancy_person = $request->number_of_guests;
        $booking->room_quantity = $request->number_of_rooms;
        $booking->save();

        foreach (array_slice($availableRooms, 0, $request->number_of_rooms) as $room) {
            DB::table('booking_details')->insert([
                'booking_id' => $booking->id,
                'room_id' => null, // ตั้งค่าเป็น NULL ทันที
                'booking_name' => $request->booking_name,
                'phone' => $request->phone,
                'bookingto_username' => null,
                'bookingto_phone' => null,
                'booking_status' => 'รอเลือกห้อง', // ย้าย booking_status มาที่ booking_details
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('payment', ['booking_id' => $booking->id])->with('success', 'บันทึกข้อมูลสำเร็จ');
    }
    public function reserves(Request $request)
    {
        $request->validate([
            'booking_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'booker_amount' => 'required|integer|min:1|max:2',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'number_of_rooms' => 'required|integer|min:1',
        ]);

        // ตรวจสอบห้องที่ว่าง
        $rooms = Room::where('room_status', 'พร้อมให้บริการ')->get();

        $availableRooms = [];

        foreach ($rooms as $room) {
            if (
                $this->isRoomAvailable($room, $request->checkin_date, $request->checkout_date) &&
                $request->booker_amount <= $room->room_occupancy
            ) {
                $availableRooms[] = $room;
            }
        }

        if (count($availableRooms) < $request->number_of_rooms) {
            return redirect()->route('home')->with('error', 'ขออภัย, ไม่มีห้องว่างเพียงพอต่อความต้องการของลูกค้า');
        }

        // คำนวณราคาห้อง
        $checkinDate = new \DateTime($request->checkin_date);
        $checkoutDate = new \DateTime($request->checkout_date);
        $interval = $checkinDate->diff($checkoutDate);
        $days = $interval->days;

        $roomPricePerDay = 500; // ตั้งราคาสำหรับห้องพักค้างคืน
        $totalCost = $days * $roomPricePerDay * $request->number_of_rooms;

        $booking = new Booking();
        $booking->user_id = auth()->user()->id;
        $booking->checkin_date = $request->checkin_date;
        $booking->checkout_date = $request->checkout_date;
        $booking->checkin_by = auth()->user()->id;
        $booking->total_cost = $totalCost;
        $booking->room_type = 'ห้องพักค้างคืน';
        $booking->occupancy_person = $request->booker_amount;
        $booking->room_quantity = $request->number_of_rooms;
        $booking->save();

        foreach (array_slice($availableRooms, 0, $request->number_of_rooms) as $room) {
            DB::table('booking_details')->insert([
                'booking_id' => $booking->id,
                'room_id' => null, // ตั้งค่าเป็น NULL ทันที
                'booking_name' => $request->booking_name,
                'phone' => $request->phone,
                'bookingto_username' => $request->bookingto_username,
                'bookingto_phone' => $request->bookingto_phone,
                'booking_status' => 'รอเลือกห้อง', // ย้าย booking_status มาที่ booking_details
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()->route('payment', ['booking_id' => $booking->id])->with('success', 'บันทึกข้อมูลสำเร็จ');
    }



    public function checkAvailability(Request $request)
    {
        $startDate = $request->query('startDate');
        $endDate = $request->query('endDate');
        $numberOfRooms = (int) $request->query('numberOfRooms', 1); // ค่าเริ่มต้นคือ 1 ห้องถ้าไม่ได้ระบุมา

        // ดึงข้อมูลห้องทั้งหมดโดยไม่สนใจ room_status
        $rooms = Room::all();
        $totalRooms = $rooms->count();
        $availableRooms = [];
        $bookingStatuses = ['รอชำระเงิน', 'รอเข้าพัก', 'เช็คอินแล้ว', 'รอทำความสะอาด', 'รอเลือกห้อง'];

        // นับจำนวนการจองที่ยังไม่มีการเลือกห้อง
        $pendingBookings = Booking_detail::whereNull('room_id')
            ->whereIn('booking_status', $bookingStatuses)
            ->whereHas('booking', function ($query) use ($startDate, $endDate) {
                $query->where('checkin_date', '<', $endDate)
                    ->where('checkout_date', '>', $startDate);
            })
            ->count();

        // ปรับจำนวนห้องทั้งหมดโดยหักลบการจองที่ค้างอยู่
        $totalRooms -= $pendingBookings;

        foreach ($rooms as $room) {
            if ($this->isRoomAvailable($room, $startDate, $endDate)) {
                $availableRooms[] = [
                    'id' => $room->id,
                ];
            }
        }

        // ถ้าจำนวนห้องว่างมากกว่าจำนวนห้องทั้งหมดที่ปรับแล้ว ให้ตัดลิสต์เหลือเท่าจำนวนห้องทั้งหมด
        if (count($availableRooms) > $totalRooms) {
            $availableRooms = array_slice($availableRooms, 0, $totalRooms);
        }

        $availableRoomCount = count($availableRooms);

        if ($availableRoomCount < $numberOfRooms) {
            return response()->json([
                'availableRooms' => [],
                'message' => 'ห้องว่างไม่เพียงพอต่อความต้องการของลูกค้า',
                'availableRoomCount' => $availableRoomCount
            ]);
        }

        return response()->json(['availableRooms' => $availableRooms]);
    }

    private function isRoomAvailable($room, $checkinDate, $checkoutDate)
    {
        $bookingStatuses = ['รอชำระเงิน', 'รอเข้าพัก', 'เช็คอินแล้ว', 'รอทำความสะอาด', 'รอเลือกห้อง'];

        $existingBookings = Booking_detail::where('room_id', $room->id)
            ->whereIn('booking_status', $bookingStatuses)
            ->whereHas('booking', function ($query) use ($checkinDate, $checkoutDate) {
                $query->where('checkin_date', '<', $checkoutDate)
                    ->where('checkout_date', '>', $checkinDate);
            })
            ->count();

        // ถ้ามีการจองที่มีสถานะที่ระบุห้องนั้นจะไม่ว่าง
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
