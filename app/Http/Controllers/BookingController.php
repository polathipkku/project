<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;


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
    public function reserve($id)
    {
        $rooms = Room::find($id);
        return view('user.reserve', compact('rooms'));
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
        $bookings = Booking::all();
        $bookings = Booking::with('room')->get();
        return view('employee.checkin', compact('bookings'));
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
        $bookings = Booking::all();
        $bookings = Booking::with('room')->get();
        return view('employee.checkout', compact('bookings'));
    }
    public function addBooking(Request $request, $id)
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
        $booking->booking_status = 'ทำการจอง';
        $booking->room_type = $request->room_type;
        $booking->occupancy_person = $request->number_of_guests;
        $booking->booking_status = $request['booking_status'];
        $booking->save();

        return redirect()->route('payment', ['booking_id' => $booking->id])->with('success', 'บันทึกข้อมูลสำเร็จ');
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
        $booking->booking_status = 'ทำการจอง';
        $booking->room_type = $request->room_type;
        $booking->occupancy_person = $request->number_of_guests;
        $booking->booking_status = $request['booking_status'];
        $booking->save();

        return redirect()->route('checkin')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }



    private function isRoomAvailable($room, $checkinDate, $checkoutDate)
    {
        $existingBookings = Booking::where('room_id', $room->id)
            ->where(function ($query) use ($checkinDate, $checkoutDate) {
                $query->where(function ($query) use ($checkinDate, $checkoutDate) {
                    $query->where('checkin_date', '>=', $checkoutDate)
                        ->orWhere('checkout_date', '<=', $checkinDate);
                })
                    ->orWhere(function ($query) use ($checkinDate, $checkoutDate) {
                        $query->where('checkin_date', '<', $checkinDate)
                            ->where('checkout_date', '>', $checkoutDate);
                    });
            })
            ->where('booking_status', '!=', 'ยกเลิกการจอง')
            ->count();

        $isRoomAvailable = $room->room_status === 'พร้อมให้บริการ' || $existingBookings === 0;

        return $isRoomAvailable;
    }

    public function cancelBooking($id)
    {
        $booking = Booking::find($id);

        if ($booking) {
            if ($booking->booking_status === 'ทำการจอง') {
                // เปลี่ยนค่า booking_status เป็น 'ยกเลิกการจอง'
                $booking->booking_status = 'ยกเลิกการจอง';
                $booking->save();

                // ดึงข้อมูลห้อง
                $room = $booking->room;

                // เปลี่ยนค่า room_status เป็น 'พร้อมให้บริการ'
                $room->room_status = 'พร้อมให้บริการ';
                $room->save();

                return redirect()->back()->with('success', 'ยกเลิกการจองเรียบร้อยแล้ว');
            }
        }

        return redirect()->back()->with('error', 'ไม่สามารถยกเลิกการจองได้');
    }

    public function checkinForm()
    {
        $bookings = Booking::where('user_id', auth()->user()->id)
            ->where('booking_status', 'ทำการจอง')->get();
        return view('user.checkin', compact('bookings'));
    }
    public function checkinuser(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $booking = Booking::find($bookingId);

        if ($booking) {
            $booking->booking_status = 'เช็คอินแล้ว';
            $booking->save();
            return redirect()->back()->with('success', 'เช็คอินแล้ว');
        }
        return redirect()->back()->with('error', 'ไม่สามารถทำเช็คอินได้');
    }

    public function checkoutuser(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $booking = Booking::find($bookingId);
    
        if ($booking && $booking->booking_status === 'เช็คอินแล้ว') {
            $booking->booking_status = 'เช็คเอาท์';
    
            // Assuming there is a room relationship in the booking model
            $room = $booking->room;
            if ($room) {
                $room->room_status = 'พร้อมให้บริการ';
                $room->save();
            }
    
            $booking->save();
    
            return redirect()->back()->with('success', 'เช็คเอาท์สำเร็จ');
        }
    
        return redirect()->back()->with('error', 'ไม่สามารถทำเช็คเอาท์ได้');
    }
    

    public function getAvailableRooms(Request $request)
    {
        // ตรวจสอบว่ามีข้อมูล checkin_date และ checkout_date ที่ถูกส่งมาหรือไม่
        if ($request->has('checkin_date') && $request->has('checkout_date')) {
            $checkinDate = $request->input('checkin_date');
            $checkoutDate = $request->input('checkout_date');

            // Query ห้องพักที่พร้อมใช้งานตามวันที่เช็คอินและเช็คเอาท์
            $availableRooms = Room::whereDoesntHave('bookings', function ($query) use ($checkinDate, $checkoutDate) {
                $query->where(function ($query) use ($checkinDate, $checkoutDate) {
                    $query->where('checkin_date', '<', $checkoutDate)
                        ->where('checkout_date', '>', $checkinDate);
                });
            })->get();
        }
        return response()->json(['available_rooms' => $availableRooms]);
    }
}
