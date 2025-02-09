<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function expenses()
    {
        $expenses = Expense::all();
        return view('owner.expenses', compact('expenses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'expenses_name' => 'required|string|max:255',
            'expenses_price' => 'required|numeric|min:0',
            'expenses_date' => 'required|date', // ตรวจสอบรูปแบบวันที่
        ]);

        Expense::create([
            'expenses_name' => $request->expenses_name,
            'expenses_price' => $request->expenses_price,
            'expenses_date' => $request->expenses_date,
        ]);

        return redirect()->route('expenses')->with('success', 'เพิ่มค่าใช้จ่ายเรียบร้อย');
    }
}
