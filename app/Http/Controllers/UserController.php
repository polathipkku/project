<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class UserController extends Controller
{

    public function edit()
    {
        $user = auth()->user();
        return view('user.profile', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        // ตรวจสอบว่ามีการอัปโหลดรูปใหม่หรือไม่
        if ($request->hasFile('image')) {
            // ลบรูปเก่าถ้ามี
            if ($user->image) {
                Storage::delete('public/' . $user->image);
            }

            // บันทึกไฟล์ใหม่
            $path = $request->file('image')->store('profiles', 'public');
            $validatedData['image'] = $path;
        }

        // อัปเดตข้อมูลในฐานข้อมูล
        $user->update($validatedData);

        return redirect()->route('profile.edit', $user->id)->with('success', 'อัปเดตข้อมูลสำเร็จ!');
    }
}
