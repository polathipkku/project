<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Promotion;
use Illuminate\Http\Request;
class PromotionController extends Controller
{
    public function index()
    {
        // แสดงรายการโปรโมชั่นทั้งหมด
        $promotions = Promotion::all();
        return view('owner.promotions', compact('promotions'));
    }

    public function create()
    {
        // แสดงฟอร์มสร้างโปรโมชั่น
        return view('owner.add_promotions');
    }

    public function store(Request $request)
    {

        $request->validate([
            'campaign_name' => 'required|string|max:255',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'max_usage_per_code' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $promo_code = Promotion::generatePromoCode(); // สร้างโค้ดโปรโมชั่นแบบสุ่ม

        $promotion = Promotion::create([
            'campaign_name' => $request->campaign_name,
            'discount_percentage' => intval($request->discount_percentage), // แปลงค่าเป็น Integer
            'max_usage_per_code' => $request->max_usage_per_code,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'promo_code' => $promo_code,
        ]);

        return redirect()->route('promotions')->with('success', 'Promotion created successfully.');
    }
    public function usePromoCode(Request $request)
    {
        $request->validate([
            'promo_code' => 'required|string',
            'user_id' => 'required|exists:users,id', // ตรวจสอบว่าผู้ใช้มีอยู่
            'booking_id' => 'required|exists:bookings,id', // ตรวจสอบว่าการจองมีอยู่
        ]);

        // ค้นหาโปรโมชั่นที่ตรงกับโค้ด
        $promotion = Promotion::where('promo_code', $request->promo_code)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if (!$promotion) {
            return response()->json(['message' => 'Promotion code is invalid or expired.'], 400);
        }

        // เช็คจำนวนการใช้งาน
        $usageCount = Booking::where('promotion_id', $promotion->id)->count();
        if ($usageCount >= $promotion->max_usage_per_code) {
            return response()->json(['message' => 'Promotion code has reached its usage limit.'], 400);
        }

        return response()->json(['message' => 'Promotion code used successfully.', 'discount' => $promotion->discount_percentage], 200);
    }

    public function getActivePromotion($booking)
    {
        // ตัวอย่างการตรวจสอบโปรโมชั่นที่ใช้งานได้ตามข้อมูลการจอง
        $promotion = Promotion::where('is_active', 1)->first();

        return $promotion;
    }

    public function edit(Promotion $promotion)
    {
        return view('owner.editpromotion', compact('promotion'));
    }


    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'campaign_name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'max_usage_per_code' => 'required|integer|min:1',
        ]);

        $promotion->update($request->all());

        return redirect()->route('promotions')->with('success', 'โปรโมชั่นอัปเดตเรียบร้อยแล้ว');
    }



    public function destroy(Promotion $promotion)
    {
        // ลบโปรโมชั่น
        $promotion->delete();
        return redirect()->route('promotions')->with('success', 'Promotion deleted successfully.');
    }
}
