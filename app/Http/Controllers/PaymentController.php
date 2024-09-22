<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking_detail;
use Illuminate\Http\Request;
use Stripe\PaymentIntent;
use Stripe\Stripe;

class PaymentController extends Controller
{
    public function showPaymentPage($id)
    {
        // Fetch booking details for the given booking ID
        $booking = Booking_detail::with(['booking.user'])->where('booking_id', $id)->first();

        if (!$booking) {
            return redirect()->route('home')->with('error', 'ข้อมูลการจองไม่พบ');
        }

        // Get the user's email
        $userEmail = $booking->booking->user->email ?? null;

        return view('user.payment', compact('booking', 'userEmail'));
    }

    public function createPaymentIntent(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $booking = Booking_detail::where('booking_id', $bookingId)->first();

        // Check if booking was found
        if (!$booking) {
            return response()->json(['error' => 'Booking not found'], 404);
        }

        // Ensure total_cost is accessible
        if (!isset($booking->total_cost)) {
            return response()->json(['error' => 'Total cost not found'], 500);
        }

        $amount = $booking->total_cost * 100; // Amount in cents

        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'thb',
                'payment_method_types' => ['promptpay'],
            ]);

            $payment = new Payment();
            $payment->booking_id = $bookingId;
            $payment->amount = $amount / 100; // Convert back to currency
            $payment->payment_intent_id = $paymentIntent->id;
            $payment->payment_status = 'pending'; // Default value
            $payment->payment_slip = null; // No slip yet
            $payment->save();

            return response()->json(['client_secret' => $paymentIntent->client_secret]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
