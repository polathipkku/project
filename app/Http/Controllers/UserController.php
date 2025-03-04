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
            'photo' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'tel' => ['required', 'string', 'max:255'],
            'birthday' => ['nullable', 'date'],
            'address' => ['nullable', 'string'],
        ]);

        // ตรวจสอบว่ามีการอัปโหลดไฟล์รูปภาพหรือไม่
        if ($request->hasFile('photo')) {
            if ($user->photo) {
                Storage::delete($user->photo); // ลบรูปเก่าหากมี
            }
            $validatedData['photo'] = $request->file('photo')->store('user_photos', 'public');
        }

        // อัปเดตข้อมูล
        $user->update($validatedData);

        return redirect()->route('profile.edit', ['user' => $user->id])->with('success', 'อัปเดตโปรไฟล์เรียบร้อยแล้ว');
    }
}
