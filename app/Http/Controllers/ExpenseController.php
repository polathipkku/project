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
        // กำหนดค่า default ให้กับ expenses_name ถ้าประเภทไม่ใช่ ค่าน้ำ หรือ ค่าไฟ
        $expenses_name = ($request->type === 'Water_bill' || $request->type === 'Electricity_bill') ? null : $request->expenses_name;
    
        // กำหนดกฎการตรวจสอบ
        $request->validate([
            'expenses_name' => 'nullable|string|max:255', // ปรับให้เป็น nullable
            'expenses_price' => 'required|numeric|min:0',
            'expenses_date' => 'required|date',
            'type' => 'required|string',
        ]);
    
        // บันทึกข้อมูล
        Expense::create([
            'expenses_name' => $expenses_name,
            'expenses_price' => $request->expenses_price,
            'expenses_date' => $request->expenses_date,
            'type' => $request->type,
        ]);
    
        return redirect()->route('expenses')->with('success', 'เพิ่มค่าใช้จ่ายเรียบร้อย');
    }
    
    
    public function edit($id)
    {
        $expense = Expense::findOrFail($id);
        return view('owner.expenses_edit', compact('expense'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'expenses_name' => 'required|string|max:255',
            'expenses_price' => 'required|numeric',
            'expenses_date' => 'required|date',
        ]);

        $expense = Expense::findOrFail($id);
        $expense->update([
            'expenses_name' => $request->expenses_name,
            'expenses_price' => $request->expenses_price,
            'expenses_date' => $request->expenses_date,
        ]);

        return redirect()->route('expenses')->with('success', 'อัปเดตค่าใช้จ่ายเรียบร้อย');
    }

    public function destroy($id)
    {
        $expense = Expense::findOrFail($id);
        $expense->delete();

        return redirect()->route('expenses')->with('success', 'ลบค่าใช้จ่ายเรียบร้อยแล้ว');
    }




}
