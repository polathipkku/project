<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Product;
use App\Models\Stock;
use App\Models\StockPackage;
use App\Models\Product_type;

class RoomController extends Controller
{
    protected function getAllRooms()
    {
        return Room::all();
    }
    public function room(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $rooms = Room::where('room_name', 'LIKE', "%{$search}%")
                ->get();
        } else {
            $rooms = $this->getAllRooms();
        }
        return view('owner.room', compact('rooms', 'search'));
    }
    public function cleanroom(Request $request, $id)
    {
        // ค้นหาห้อง
        $room = Room::findOrFail($id);

        // อัปเดตสถานะห้อง
        $room->room_status = 'พร้อมให้บริการ';
        $room->save();

        // ค้นหาประเภทสินค้า "เครื่องอาบน้ำ"
        $bathroomProductType = Product_type::where('product_type_name', 'เครื่องอาบน้ำ')->first();

        if ($bathroomProductType) {
            // ค้นหาสินค้าทั้งหมดที่อยู่ในประเภท "เครื่องอาบน้ำ"
            $products = Product::where('product_types_id', $bathroomProductType->id)->get();

            foreach ($products as $product) {
                // ค้นหาสต็อกของสินค้านั้น
                $stock = Stock::find($product->stocks_id);

                if ($stock && $stock->stock_qty >= 2) {
                    // ลด stock_qty ลง 2
                    $stock->stock_qty -= 2;

                    // จำนวนที่ต้องลด
                    $remainingToReduce = 2;

                    // ค้นหา stock_packages ของ stock_id นี้ และเรียง id น้อยสุดก่อน
                    $stockPackages = StockPackage::where('stock_id', $stock->id)
                        ->orderBy('id')
                        ->get();

                    foreach ($stockPackages as $package) {
                        if ($remainingToReduce <= 0) {
                            break;
                        }

                        if ($package->sumitem >= $remainingToReduce) {
                            $package->sumitem -= $remainingToReduce;
                            $remainingToReduce = 0;
                        } else {
                            $remainingToReduce -= $package->sumitem;
                            $package->sumitem = 0;
                        }

                        $package->save();
                    }

                    // คำนวณค่า pack_qty ใหม่
                    if ($stock->items_per_pack > 0) {
                        $stock->pack_qty = ceil($stock->stock_qty / $stock->items_per_pack);
                    }

                    $stock->save();
                }
            }
        }

        return redirect()->back()->with('success', 'ทำความสะอาดห้องเรียบร้อย และลดสต็อกสินค้าแล้ว');
    }


    public function add_room()
    {
        $rooms = Room::all();
        return view('owner.add_room', compact('rooms'));
    }
    public function roomdetail()
    {
        $rooms = Room::all();
        return view('owner.roomdetail', compact('rooms'));
    }
    public function text()
    {
        $rooms = Room::all();
        return view('owner.text', compact('rooms'));
    }

    public function employeehome()
    {
        $rooms = Room::all();
        return view('employee.employeehome', compact('rooms'));
    }

    public function userbooking()
    {
        $rooms = Room::all();
        return view('user.userbooking', compact('rooms'));
    }

    public function addroom(Request $request)
    {
        $request->validate([
            'room_name' => 'required|unique:rooms,room_name,NULL,id,deleted_at,NULL',
            'price_night' => 'required|numeric',
            'price_temporary' => 'required|numeric',
            'room_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each image
            'room_status' => 'required',
            'room_occupancy' => 'required',
            'room_bed' => 'required',
            'room_bathroom' => 'required',
        ]);

        $room = new Room;
        $room->room_name = $request->input('room_name');
        $room->price_night = $request->input('price_night');
        $room->price_temporary = $request->input('price_temporary');
        $room->room_status = $request->input('room_status');
        $room->room_occupancy = $request->input('room_occupancy');
        $room->room_bed = $request->input('room_bed');
        $room->room_bathroom = $request->input('room_bathroom');

        // ตรวจสอบว่ามีการอัปโหลดไฟล์หรือไม่
        $imagePaths = [];
        if ($request->hasFile('room_image')) {
            foreach ($request->file('room_image') as $image) {
                $imageName = time() . '_' . uniqid() . '.' . $image->extension();
                $image->move(public_path('images'), $imageName);
                $imagePaths[] = $imageName;
            }
        }

        // บันทึก path ของรูปภาพลงในฐานข้อมูล
        $room->room_image = json_encode($imagePaths);
        $room->save();

        return redirect()->route('room')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }



    public function edit($id)
    {
        $rooms = Room::find($id);
        return view('owner.editroom', compact('rooms'));
    }
    public function update(Request $request, $id)
    {
        $room = Room::find($id);

        $request->validate([
            'room_name' => 'required',
            'price_night' => 'required|numeric',
            'price_temporary' => 'required|numeric',
            'room_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'room_status' => 'required',
            'room_occupancy' => 'required',
            'room_bed' => 'required',
            'room_bathroom' => 'required',
        ]);

        $room->room_name = $request->room_name;
        $room->price_night = $request->price_night;
        $room->price_temporary = $request->price_temporary;
        $room->room_status = $request->room_status;
        $room->room_occupancy = $request->room_occupancy;
        $room->room_bed = $request->room_bed;
        $room->room_bathroom = $request->room_bathroom;

        // Check if a new image is uploaded
        if ($request->hasFile('room_image')) {
            $imageName = time() . '.' . $request->room_image->extension();
            $request->room_image->move(public_path('images'), $imageName);
            // Delete the old image
            if ($room->room_image) {
                unlink(public_path('images') . '/' . $room->room_image);
            }
            $room->room_image = $imageName;
        }

        $room->save();
        return redirect()->route('room')->with('success', "อัพเดตข้อมูลสำเร็จ");
    }
    public function delete($id)
    {
        $delete = Room::find($id)->delete();
        return redirect()->route('room')->with('success', "ลบข้อมูลสำเร็จ");
    }
}
