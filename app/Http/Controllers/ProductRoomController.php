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

    public function addProductroom(Request $request)
    {
        $request->validate([
            'productroom_name' => 'required|string|max:255',  
            'productroom_price' => 'required|numeric|min:0',
        ]);

        $addProductroom = new Product_room;
        $addProductroom->productroom_name = $request->input('productroom_name'); 
        $addProductroom->productroom_price = $request->input('productroom_price');

        $addProductroom->save();

        return redirect()->route('productroom')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }
}
