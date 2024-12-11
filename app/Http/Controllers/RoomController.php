<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

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
                ->orWhere('room_description', 'LIKE', "%{$search}%")
                ->get();
        } else {
            $rooms = $this->getAllRooms();
        }
        return view('owner.room', compact('rooms', 'search'));
    }
    public function cleanroom(Request $request, $id)
    {
        $room = Room::findOrFail($id);
        $room->room_status = 'พร้อมให้บริการ';
        $room->save();

        return redirect()->back()->with('success', 'ยกเลิกการจองเรียบร้อยแล้ว');
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
            'room_name' => 'required|unique:rooms,room_name',
            'room_description' => 'required',
            'price_night' => 'required|numeric',
            'price_temporary' => 'required|numeric',
            'room_image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate each image
            'room_status' => 'required',
            'room_occupancy' => 'required',
            'room_bed' => 'required',
            'room_bathroom' => 'required',
        ]);

        // Process each uploaded image
        $images = [];
        if ($request->hasfile('room_image')) {
            foreach ($request->file('room_image') as $file) {
                $originalName = $file->getClientOriginalName(); // Keep original name
                $file->move(public_path('images'), $originalName);
                $images[] = $originalName; // Store image names in an array
            }
        }

        $room = new Room;
        $room->room_name = $request->input('room_name');
        $room->room_description = $request->input('room_description');
        $room->price_night = $request->input('price_night');
        $room->price_temporary = $request->input('price_temporary');
        $room->room_image = json_encode($images); // Save as JSON
        $room->room_status = $request->input('room_status');
        $room->room_occupancy = $request->input('room_occupancy');
        $room->room_bed = $request->input('room_bed');
        $room->room_bathroom = $request->input('room_bathroom');
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
            'room_description' => 'required',
            'price_night' => 'required|numeric',
            'price_temporary' => 'required|numeric',
            'room_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'room_status' => 'required',
            'room_occupancy' => 'required',
            'room_bed' => 'required',
            'room_bathroom' => 'required',
        ]);

        $room->room_name = $request->room_name;
        $room->room_description = $request->room_description;
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
