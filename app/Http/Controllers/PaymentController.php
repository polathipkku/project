<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;
use App\Models\Payment_type;

class PaymentController extends Controller
{
    public function payment()
    {
        $payment = Payment::all();
        $payment_types = $this->payment_types();
        return view('owner.payment', compact('payment', 'payment_types'));
    }
    public function payment_types()
    {
        $payment_types = Payment_type::pluck('payment_typecol')->toArray();
        return $payment_types;
    }

    public function create()
    {
        return view('payment_types.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'payment_type' => 'required|string|max:255',
            'qr_code' => 'nullable|string|max:255',
        ]);

        Payment_type::create([
            'payment_typecol' => $validatedData['payment_type'],
            'QrCode' => $validatedData['qr_code'],
        ]);

        return redirect()->route('payment_types')->with('success', 'Payment type created successfully.');
    }


    // public function calculatePayment(Request $request)
    // {
    //     // รับข้อมูลที่ส่งมาจากหน้าจอ
    //     $roomType = $request->room_type;

    //     // ตรวจสอบประเภทห้องพักและคำนวณราคาตามประเภท
    //     if ($roomType == 'ห้องพักค้างคืน') {
    //         $price = $request->price_night;
    //     } elseif ($roomType == 'ห้องพักชั่วคราว') {
    //         $price = $request->price_temporary;
    //     } else {
    //         // หากไม่มีประเภทห้องพักที่ถูกต้อง
    //         return response()->json(['error' => 'Invalid room type'], 400);
    //     }

    //     // คำนวณราคาทั้งหมด
    //     $totalPrice = $price * $request->number_of_nights;

    //     // ส่งราคาห้องพักกลับไปยังหน้าการจองห้อง
    //     return view('booking', ['totalPrice' => $totalPrice]);
    // }
}
