<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function show($id)
    {
        $employee = User::findOrFail($id);

        // ตรวจสอบว่าผู้ใช้ที่เข้าถึงเป็น owner หรือไม่
        // หากไม่ใช่ owner ให้ตรวจสอบว่า employee นี้ถูกเข้าถึงโดย owner เท่านั้น
        if (auth()->user()->userType !== '0' && $employee->userType !== '1') {
            abort(403, 'Unauthorized action.');
        }

        return view('employees.show', compact('employee'));
    }
}
