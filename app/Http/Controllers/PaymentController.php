<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function showPaymentPage($id)
    {
        $booking = Booking::find($id);
        $bookings = Booking::where('id', $id)->get();

        return view('user.payment', compact('bookings'));
    }

    public function createPaymentIntent(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $booking = Booking::findOrFail($bookingId);
        $amount = $booking->total_cost;

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount * 100,
            'currency' => 'thb',
            'payment_method_types' => ['promptpay'],
        ]);

        $payment = new Payment();
        $payment->booking_id = $bookingId;
        $payment->amount = $amount;
        $payment->payment_intent_id = $paymentIntent->id;
        $payment->payment_status = 'pending'; // กำหนดค่าเริ่มต้นเป็น 'pending' หรือค่าอื่นๆ ตามที่ต้องการ
        $payment->payment_slip = null; // กำหนดให้เป็น null เพราะยังไม่มีข้อมูลใบเสร็จชำระเงิน
        $payment->save();

        return response()->json(['client_secret' => $paymentIntent->client_secret]);
    }
}
