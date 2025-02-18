<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment_type;
use Illuminate\Support\Facades\Storage;

class PaymentTypeController extends Controller
{
    public function index()
    {
        $payment_types = Payment_type::all();
        return view('owner.payment_type', compact('payment_types'));
    }
    public function create()
    {
        return view('owner.create_payment_type');
    }


    public function store(Request $request)
    {
        // ตรวจสอบข้อมูลที่ซ้ำ
        $request->validate([
            'payment_type' => 'required|unique:payment_types,payment_type',
            'qr_code' => 'nullable|image|max:2048',
        ]);
    
        // การจัดการข้อมูลหลังจากผ่านการตรวจสอบ
        $paymentType = new Payment_type();
        $paymentType->payment_type = $request->payment_type;
    
        // ตรวจสอบว่าอัปโหลดไฟล์ QR Code หรือไม่
        if ($request->hasFile('qr_code')) {
            $path = $request->file('qr_code')->store('public/qr_codes');
            $paymentType->qr_code = basename($path);
        }
    
        $paymentType->save();
    
        return redirect()->route('payment_types.index')->with('success', 'เพิ่มประเภทการชำระเงินสำเร็จ');
    }
    
    

    public function edit($id)
    {
        $paymentType = Payment_type::findOrFail($id);
        return view('owner.edit_payment_type', compact('paymentType'));
    }

    public function update(Request $request, $id)
{
    $paymentType = Payment_type::findOrFail($id);

    $request->validate([
        'payment_type' => 'required|string|max:255',
        'qr_code' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // ตรวจสอบว่าเป็นประเภท "โอนเงิน" หรือไม่
    if ($request->payment_type === 'โอนเงิน' && !$request->hasFile('qr_code') && !$paymentType->qr_code) {
        return back()->withErrors(['qr_code' => 'กรุณาอัปโหลด QR Code สำหรับประเภทการชำระเงิน "โอนเงิน"']);
    }

    $data = [
        'payment_type' => $request->payment_type,
    ];

    if ($request->hasFile('qr_code')) {
        // ลบไฟล์เก่า
        if ($paymentType->qr_code) {
            Storage::delete('public/' . $paymentType->qr_code);
        }
        // เพิ่ม qr_code ใหม่เข้าไปใน data array
        $data['qr_code'] = $request->file('qr_code')->store('qr_codes', 'public');
    }

    $paymentType->update($data);

    return redirect()->route('payment_types.index')
        ->with('success', 'อัปเดตประเภทการชำระเงินเรียบร้อย');
}

public function destroy($id)
{
    $paymentType = Payment_type::findOrFail($id);

    // ลบ QR Code ถ้ามี
    if ($paymentType->qr_code) {
        Storage::delete('public/qr_codes/' . $paymentType->qr_code);
    }

    // ลบถาวร (ถ้าใช้ SoftDeletes)
    $paymentType->forceDelete();

    return redirect()->route('payment_types.index')->with('success', 'ลบประเภทการชำระเงินเรียบร้อย');
}


    
}
