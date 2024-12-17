<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_room;

class ProductRoomController extends Controller
{
    public function add_productroom()
    {
        $add_productroom = Product_room::all();
        return view('owner.add_productroom', compact('add_productroom')); // Pass data to view
    }
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
            'product_qty' => 'required|integer|min:1',
            'productroom_category' => 'required|string', // ตรวจสอบหมวดหมู่
        ]);
        

        $productRoom = new Product_room(); // Assuming you have a model named ProductRoom
        $productRoom->productroom_name = $request->productroom_name;
        $productRoom->productroom_price = $request->productroom_price;
        $productRoom->product_qty = $request->product_qty;
        $productRoom->productroom_category = $request->productroom_category; // บันทึกหมวดหมู่
        $productRoom->save();
        

        return redirect()->route('productroom')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }
}
