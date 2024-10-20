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
            'discount_value' => 'required|numeric|min:0' . ($request->type === 'percentage' ? '|max:100' : ''), // สำหรับ percentage ต้องอยู่ระหว่าง 0-100
            'max_usage_per_code' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'type' => 'required|string|in:fix,percentage', // เพิ่มการตรวจสอบประเภท
            'minimum_nights' => 'nullable|integer|min:1',
            'minimum_booking_amount' => 'nullable|numeric|min:0',
            'promotion_status' => 'required|boolean',
        ]);

        $promo_code = Promotion::generatePromoCode(); // สร้างโค้ดโปรโมชั่นแบบสุ่ม

        // แปลง discount_value ตามประเภท
        $discountValue = $request->type === 'fix' ? intval($request->discount_value) : floatval($request->discount_value);

        $promotion = Promotion::create([
            'campaign_name' => $request->campaign_name,
            'discount_value' => $discountValue, // เก็บค่าลดราคา
            'max_usage_per_code' => $request->max_usage_per_code,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'promo_code' => $promo_code,
            'type' => $request->type, // เพิ่มประเภท
            'minimum_nights' => $request->minimum_nights,
            'minimum_booking_amount' => $request->minimum_booking_amount,
            'promotion_status' => $request->promotion_status,
        ]);

        return redirect()->route('promotions')->with('success', 'Promotion created successfully.');
    }

    public function usePromoCode(Request $request)
    {
        $request->validate([
            'promo_code' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'booking_id' => 'required|exists:bookings,id',
        ]);

        // ค้นหาโปรโมชั่นที่ใช้งานได้และยังไม่หมดอายุ
        $promotion = Promotion::where('promo_code', $request->promo_code)
            ->where('promotion_status', 1) // ตรวจสอบว่าโปรโมชั่นเปิดใช้งานอยู่
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        if (!$promotion) {
            return response()->json(['message' => 'Promotion code is invalid or expired.'], 400);
        }

        // ดึงข้อมูลการจอง
        $booking = Booking::find($request->booking_id);

        // ตรวจสอบเงื่อนไขจำนวนคืนและยอดการจองขั้นต่ำ
        if (!$promotion->isValidForBooking($booking->nights, $booking->total_cost)) {
            return response()->json(['message' => 'Promotion conditions not met.'], 400);
        }

        // เช็คจำนวนการใช้งาน
        $usageCount = Booking::where('promotion_id', $promotion->id)->count();
        if ($usageCount >= $promotion->max_usage_per_code) {
            return response()->json(['message' => 'Promotion code has reached its usage limit.'], 400);
        }

        // อัปเดต usage_count
        $promotion->usage_count += 1;
        $promotion->save();

        return response()->json(['message' => 'Promotion code used successfully.', 'discount' => $promotion->discount_value], 200);
    }


    public function getActivePromotion($booking)
    {
        // ตัวอย่างการตรวจสอบโปรโมชั่นที่ใช้งานได้ตามข้อมูลการจอง
        $promotion = Promotion::where('promotion_status', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        return $promotion;
    }
    public function toggleStatus($id)
    {
        $promotion = Promotion::findOrFail($id);

        if ($promotion->promotion_status === '1') {
            $promotion->promotion_status = '0'; // ปิดใช้งาน
        } elseif ($promotion->promotion_status === '0') {
            $promotion->promotion_status = '2'; // หมดอายุ
        } else {
            $promotion->promotion_status = '1'; // เปิดใช้งานใหม่
        }

        $promotion->save();

        return redirect()->route('promotions')->with('success', 'สถานะโปรโมชั่นได้ถูกเปลี่ยนแล้ว');
    }
    public function scopeActive($query)
    {
        return $query->where('promotion_status', 1);
    }
    public function isValidForBooking($days, $totalCost, $promotion)
    {
        // ตรวจสอบจำนวนคืนขั้นต่ำ
        if (!is_null($promotion->minimum_nights) && $days < $promotion->minimum_nights) {
            return false;
        }

        // ตรวจสอบยอดจองขั้นต่ำ
        if (!is_null($promotion->minimum_booking_amount) && $totalCost < $promotion->minimum_booking_amount) {
            return false;
        }

        return true;
    }

    public function showPromotionsForHome()
    {
        // Fetch only active promotions
        $promotions = Promotion::where('promotion_status', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->get();

        // Pass the promotions to the 'home' view
        return view('user.home', compact('promotions'));
    }



    public function calculateDiscount($totalCost, $promotion)
    {
        if ($promotion->type == 'percentage') {
            return ($totalCost * $promotion->discount_value) / 100;
        } elseif ($promotion->type == 'fix') {
            return min($promotion->discount_value, $totalCost);
        }

        return 0;
    }

    public function edit(Promotion $promotion)
    {
        return view('owner.editpromotion', compact('promotion'));
    }

    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'campaign_name' => 'required|string|max:255',
            'discount_value' => 'required|numeric|min:0' . ($request->type === 'percentage' ? '|max:100' : ''), // สำหรับ percentage ต้องอยู่ระหว่าง 0-100
            'max_usage_per_code' => 'required|integer|min:1',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|string|in:fix,percentage',
            'minimum_nights' => 'nullable|integer|min:1',
            'minimum_booking_amount' => 'nullable|numeric|min:0',
            'promotion_status' => 'required|boolean',
        ]);

        // อัปเดตโปรโมชั่น
        $promotion->update([
            'campaign_name' => $request->campaign_name,
            'discount_value' => $request->type === 'fix' ? $request->discount_value : $request->discount_value,
            'max_usage_per_code' => $request->max_usage_per_code,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'type' => $request->type,
            'minimum_nights' => $request->minimum_nights,
            'minimum_booking_amount' => $request->minimum_booking_amount,
            'promotion_status' => $request->promotion_status,
        ]);

        return redirect()->route('promotions')->with('success', 'Promotion updated successfully.');
    }

    public function destroy(Promotion $promotion)
    {
        // ลบโปรโมชั่น
        $promotion->delete();
        return redirect()->route('promotions')->with('success', 'Promotion deleted successfully.');
    }
}
