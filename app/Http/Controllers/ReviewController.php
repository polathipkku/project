<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Booking;
class ReviewController extends Controller
{
    public function submitReview(Request $request)
    {
        $request->validate([
            'booking_id' => 'required|exists:bookings,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // ตรวจสอบว่ามีรีวิวแล้วหรือยัง
        $existingReview = Review::where('booking_id', $request->booking_id)->first();
        if ($existingReview) {
            return back()->with('error', 'คุณได้ทำการรีวิวแล้ว');
        }

        // บันทึกรีวิวใหม่
        Review::create([
            'booking_id' => $request->booking_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'รีวิวของคุณถูกบันทึกเรียบร้อยแล้ว');
    }
    public function index()
    {
        $reviews = Review::with('booking', 'booking.user')->get();
        return view('user.review', compact('reviews'));
    }
}
