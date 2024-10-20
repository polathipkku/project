<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Booking_detail;
use App\Models\Payment;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function showPaymentPage($id)
    {
        $bookingDetail = Booking_detail::with(['booking.user', 'booking.promotion'])
            ->where('booking_id', $id)
            ->first();

        if (!$bookingDetail) {
            return redirect()->route('home')->with('error', 'ข้อมูลการจองไม่พบ');
        }

        // สร้างหรืออัพเดทข้อมูลการชำระเงิน
        $payment = Payment::updateOrCreate(
            ['booking_id' => $id],
            [
                'amount' => $bookingDetail->booking->total_cost,
                'payment_status' => 'pending',
            ]
        );

        $userEmail = $bookingDetail->booking->user->email ?? null;
        $promotionData = $bookingDetail->booking->promotion ? [
            'promo_code' => $bookingDetail->booking->promotion->promo_code,
            'discount_value' => $bookingDetail->booking->promotion->discount_value,
            'type' => $bookingDetail->booking->promotion->type,
        ] : null;

        return view('user.payment', compact('bookingDetail', 'userEmail', 'promotionData', 'payment'));
    }

    public function createPaymentIntent(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $booking = Booking::findOrFail($bookingId);
        $amount = $booking->total_cost * 100; // Amount in cents

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'thb',
                'payment_method_types' => ['promptpay'],
            ]);

            // อัพเดทข้อมูล Payment
            $payment = Payment::where('booking_id', $bookingId)->first();
            $payment->payment_intent_id = $paymentIntent->id;
            $payment->payment_status = 'awaiting_confirmation';
            $payment->save();

            return response()->json(['client_secret' => $paymentIntent->client_secret]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function updatePaymentStatus(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $status = $request->input('payment_status');
        $bookingStatus = $request->input('booking_status');
        $bookingDetailStatus = $request->input('booking_detail_status'); 
    
    
        $booking = Booking::find($bookingId);
        if ($booking) {
            $booking->booking_status = $bookingStatus;  
            $booking->save();
        }
    
        $payment = Payment::where('booking_id', $bookingId)->first();  
        if ($payment) {
            $payment->payment_status = $status;
            $payment->save();
        }
    
        $bookingDetails = Booking_detail::where('booking_id', $bookingId)->get();  // ดึงหลายรายการ
        if ($bookingDetails->isNotEmpty()) {
            foreach ($bookingDetails as $bookingDetail) {
                $bookingDetail->booking_detail_status = $bookingDetailStatus;  
                $bookingDetail->save();
            }
        }
    
        return response()->json(['success' => true]);
    }

    public function cancelBooking(Request $request, $id)
    {
        // ค้นหาข้อมูลการจองหลักจาก ID ของ booking ที่ส่งมาใน URL
        $booking = Booking::find($id);
        
        // ถ้าไม่พบข้อมูลการจอง ให้คืนค่าข้อความแสดงข้อผิดพลาด
        if (!$booking) {
            return response()->json(['success' => false, 'message' => 'ไม่พบการจองนี้']);
        }
    
        // อัปเดตสถานะใน booking 
        $booking->booking_status = 'ยกเลิกการจอง';
        $booking->save();
    
        // ค้นหารายการ booking_detail ที่มี booking_id ตรงกับการจองหลัก
        $bookingDetails = Booking_detail::where('booking_id', $id)->get();
        
        // ตรวจสอบว่าพบข้อมูลใน booking_detail หรือไม่
        if ($bookingDetails->isEmpty()) {
            return response()->json(['success' => false, 'message' => 'ไม่พบรายละเอียดการจอง']);
        }
    
        foreach ($bookingDetails as $bookingDetail) {
            $bookingDetail->booking_detail_status = 'ยกเลิกการจอง';
            $bookingDetail->save();
            
            $payment = Payment::where('booking_id', $id)->first();
            if ($payment) {
                $payment->payment_status = 'cancel'; 
                $payment->save();
            }
    
            $room = $bookingDetail->room;
            if ($room) {
                $room->room_status = 'พร้อมให้บริการ';
                $room->save();
            }
        }
    
        // คืนค่าข้อความแสดงผลสำเร็จ
        return response()->json(['success' => true, 'message' => 'ยกเลิกการจองและการชำระเงินสำเร็จ']);
    }
    
    
}