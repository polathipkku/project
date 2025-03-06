<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_room;

class ProductRoomController extends Controller
{
    public function add_productroom()
    {
        $add_productroom = Product_room::all();
        return view('owner.add_productroom', compact('add_productroom'));
    }
    
    public function productroom()
    {
        $productroom = Product_room::all();
        return view('owner.productroom', compact('productroom'));
    }

    public function addProductRoom(Request $request)
    {
        $request->validate([
            'productroom_name' => 'required',
            'productroom_price' => 'required|numeric',
            'product_qty' => 'required|integer|min:1',
            'productroom_category' => 'required|string',
            'repair_type' => 'required|string',
        ]);
        
        $productRoom = new Product_room();
        $productRoom->productroom_name = $request->productroom_name;
        $productRoom->productroom_price = $request->productroom_price;
        $productRoom->product_qty = $request->product_qty;
        $productRoom->productroom_category = $request->productroom_category;
        $productRoom->repair_type = $request->repair_type;
        $productRoom->save();
        
        return redirect()->route('productroom')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function editProductRoom($id)
    {
        $productRoom = Product_room::findOrFail($id);
        return view('owner.edit_productroom', compact('productRoom'));
    }
    public function index()
    {
        $productroom = ProductRoom::paginate(10); // 10 items per page
        return view('owner.productroom', compact('productroom'));
    }
    public function updateProductRoom(Request $request, $id)
    {
        $request->validate([
            'productroom_name' => 'required',
            'productroom_price' => 'required|numeric',
            'product_qty' => 'required|integer|min:1',
            'productroom_category' => 'required|string',
            'repair_type' => 'required|string',
        ]);
        
        $productRoom = Product_room::findOrFail($id);
        $productRoom->update($request->all());
        
        return redirect()->route('productroom')->with('success', 'อัปเดตข้อมูลสำเร็จ');
    }

    public function deleteProductRoom($id)
    {
        $productRoom = Product_room::findOrFail($id);
        $productRoom->delete();
        
        return redirect()->route('productroom')->with('success', 'ลบข้อมูลสำเร็จ');
    }
}