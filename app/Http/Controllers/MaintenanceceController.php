<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Maintenance;


class MaintenanceceController extends Controller
{

    public function maintenance($id)
    {
        $room = Room::find($id);
        return view('employee.maintenance', compact('room'));
    }
    public function maintenanceroom()
    {
        $rooms = Room::all();
        return view('employee.maintenanceroom', compact('rooms',));
    }

    public function maintenancedetail($id)
    {
        $room = Room::find($id);
        $maintenance = Maintenance::where('room_id', $id)->first();
        $user = $maintenance->user;
        return view('employee.maintenancedetail', compact('room', 'maintenance', 'user'));
    }
    
    
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'Problem_detail' => 'required|string',
            'Maintenance_StartDate' => 'required|date',
            'problemType' => 'required|string',
            'room_status' => 'required|in:พร้อมให้บริการ,ไม่พร้อมให้บริการ,แจ้งซ่อมห้อง',
        ]);

        // Create a new maintenance record
        Maintenance::create([
            'room_id' => $request->room_id,
            'Problem_detail' => $request->Problem_detail,
            'Maintenance_StartDate' => $request->Maintenance_StartDate,
            'problemType' => $request->problemType,
            'user_id' => auth()->id()
        ]);

        // Update room status
        $room = Room::find($request->room_id);
        $room->room_status = $request->room_status;
        $room->room_status = $request->room_status;
        $room->save();

        return redirect()->route('maintenanceroom')->with('success', 'บันทึกข้อมูลสำเร็จ');
    }

    public function toggleRoomStatus(Request $request, $id)
{
    $room = Room::findOrFail($id);
    $room->room_status = 'พร้อมให้บริการ';
    $room->save();

    return redirect()->back()->with('success', 'Room status updated successfully');
}

}
