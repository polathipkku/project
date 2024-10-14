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
        // Fetch booking details for the given booking ID
        $bookingDetail = Booking_detail::with(['booking.user', 'booking.promotion'])
            ->where('booking_id', $id)
            ->first();

        if (!$bookingDetail) {
            return redirect()->route('home')->with('error', 'ข้อมูลการจองไม่พบ');
        }

        // Get the user's email
        $userEmail = $bookingDetail->booking->user->email ?? null;

        return view('user.payment', compact('bookingDetail', 'userEmail'));
    }

    public function createPaymentIntent(Request $request)
    {
        $bookingId = $request->input('booking_id');

        // Fetch the booking directly to get total_cost
        $booking = Booking::with(['bookingDetails'])
            ->where('id', $bookingId)
            ->first();

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

            // Create and save the payment record
            $payment = new Payment();
            $payment->booking_id = $bookingId;
            $payment->amount = $amount / 100; // Store amount in original currency
            $payment->payment_intent_id = $paymentIntent->id;
            $payment->payment_status = 'pending';
            $payment->payment_slip = null; // Handle payment slip if applicable
            $payment->save();

            return response()->json(['client_secret' => $paymentIntent->client_secret]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function updatePaymentStatus(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $status = $request->input('status');

        $payment = Payment::where('booking_id', $bookingId)->first();

        if ($payment) {
            $payment->payment_status = $status;
            $payment->save();

            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Payment not found'], 404);
        }
    }

}
