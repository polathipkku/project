<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_room;

class ProductRoomController extends Controller
{
    public function productroom()
    {
        $productroom = Product_room::all();
        return view('owner.productroom', compact('productroom')); // Pass data to view
    }

    public function addProductRoom(Request $request)
    {
        $request->validate([
            'productroom_name' => 'required',
            'productroom_price' => 'required|numeric',
            'product_qty' => 'required|integer|min:1', // ตรวจสอบจำนวนสินค้าหมายเลขที่มีอย่างน้อย 1
        ]);

        $productRoom = new Product_room(); // Assuming you have a model named ProductRoom
        $productRoom->productroom_name = $request->productroom_name;
        $productRoom->productroom_price = $request->productroom_price;
        $productRoom->product_qty = $request->product_qty; // เพิ่มบรรทัดนี้เพื่อบันทึก product_qty
        $productRoom->save();

        return redirect()->route('productroom')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }
}
