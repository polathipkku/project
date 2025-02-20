<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Maintenance;
use App\Models\CheckoutDetail;
use App\Models\Booking_detail;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;


class MaintenanceceController extends Controller
{

    public function maintenance($id)
    {
        $room = Room::find($id);
        return view('employee.maintenance', compact('room'));
    }

    // public function repairreport()
    // {
    //     $repairCounts = CheckoutDetail::select(
    //         'room_id',
    //         'product_room_id',
    //         'productroom_name',
    //         'repairmaintenances_type',
    //         DB::raw('SUM(totalpriceroom) as total_price'),
    //         DB::raw('COUNT(*) as repair_count')
    //     )
    //     ->with('room') // Eager load room relationship
    //     ->whereNotNull('repairmaintenances_type')
    //     ->groupBy(
    //         'room_id',
    //         'product_room_id',
    //         'productroom_name',
    //         'repairmaintenances_type'
    //     )
    //     ->get();

    //     return view('owner.repairreport', compact('repairCounts'));
    // }

    public function repairreport()
    {
        // ดึงเฉพาะข้อมูลที่มีสถานะ "ซ่อมสำเร็จ" หรือ "ซื้อเปลี่ยนสำเร็จ"
        $repairCounts = CheckoutDetail::whereIn('thing_status', ['ซ่อมสำเร็จ', 'ซื้อเปลี่ยนสำเร็จ'])
            ->orderBy('thing_status', 'ASC')
            ->get();

        return view('owner.repairreport', compact('repairCounts'));
    }

    public function updateRepairStatus(Request $request, $id)
    {
        $checkoutDetail = CheckoutDetail::findOrFail($id);

        // กำหนดค่า type และ status ใหม่
        if ($checkoutDetail->thing_status === 'ซ่อมสำเร็จ') {
            $newStatus = 'จ่ายเงินค่าซ่อมสำเร็จ';
            $type = 'ซ่อมห้อง';
        } elseif ($checkoutDetail->thing_status === 'ซื้อเปลี่ยนสำเร็จ') {
            $newStatus = 'จ่ายเงินค่าซื้อเปลี่ยนสำเร็จ';
            $type = 'เปลี่ยนสินค้าในห้อง';
        } else {
            return redirect()->back()->with('error', 'ไม่สามารถเปลี่ยนสถานะได้');
        }

        // อัปเดตสถานะ
        $checkoutDetail->thing_status = $newStatus;
        $checkoutDetail->save();

        // บันทึกลงตาราง expenses
        Expense::create([
            'expenses_name' => $checkoutDetail->productroom_name,
            'expenses_price' => $request->input('expenses_price'),
            'expenses_date' => now(),
            'type' => $type,
            'room_id' => $checkoutDetail->room_id,
        ]);

        return redirect()->back()->with('success', 'อัปเดตสถานะเรียบร้อยแล้ว');
    }


    public function maintenanceroom()
    {
        $roomsUnderMaintenance = Room::whereHas('maintenances', function ($query) {
            $query->where('maintenances_status', 'กำลังซ่อม');
        })->get();

        $bookingDetails = Booking_detail::whereIn('id', function ($query) {
            $query->select('booking_detail_id')
                ->from('maintenances')
                ->where('maintenances_status', 'กำลังซ่อม');
        })->get();

        return view('employee.maintenanceroom', compact('roomsUnderMaintenance', 'bookingDetails'));
    }
    public function maintenancedetail($booking_detail_id)
    {
        $maintenanceDetail = Booking_detail::with([
            'room.maintenances' => function ($query) use ($booking_detail_id) {
                $query->where('booking_detail_id', $booking_detail_id);
            },
            'booking.payment', // Add this to eagerly load the payment details
            'booking.checkoutDetails' // Load checkout details for counting thing_status
        ])->find($booking_detail_id);

        if (!$maintenanceDetail) {
            return redirect()->route('maintenanceroom')->with('error', 'ไม่พบข้อมูลการแจ้งซ่อม');
        }

        $pendingRepairCount = $maintenanceDetail->booking->checkoutDetails
            ->where('thing_status', 'รอซ่อม')
            ->count();
        $progressRepairCount = $maintenanceDetail->booking->checkoutDetails
            ->where('thing_status', 'กำลังซ่อม')
            ->count();

        $completedRepairCount = $maintenanceDetail->booking->checkoutDetails
            ->where('thing_status', 'ซ่อมสำเร็จ')
            ->count();

        return view('employee.maintenancedetail', compact('maintenanceDetail', 'pendingRepairCount', 'completedRepairCount', 'progressRepairCount'));
    }

    public function markAsCompleted($id)
    {
        // ค้นหาข้อมูลที่ต้องการเปลี่ยนสถานะ
        $checkoutDetail = CheckoutDetail::find($id);

        if (!$checkoutDetail) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลที่ต้องการเปลี่ยนสถานะ');
        }

        // เปลี่ยนสถานะเป็น "ซ่อมสำเร็จ"
        $checkoutDetail->thing_status = 'ซ่อมสำเร็จ';
        $checkoutDetail->save();

        return redirect()->back()->with('success', 'เปลี่ยนสถานะเป็น "ซ่อมสำเร็จ" เรียบร้อยแล้ว');
    }


    public function updateThingStatus($id)
    {
        $thing = CheckoutDetail::find($id);

        if (!$thing) {
            return redirect()->back()->with('error', 'ไม่พบรายการสิ่งของ');
        }

        $repairType = $thing->repairmaintenances_type ?? 'แจ้งซ่อม';

        if ($repairType === 'ซื้อเปลี่ยน') {
            $thing->thing_status = 'ซื้อเปลี่ยนสำเร็จ';
        } else {
            $thing->thing_status = 'กำลังซ่อม';
        }

        $thing->save();

        return redirect()->back()->with('success', 'สถานะอัปเดตเรียบร้อยแล้ว');
    }

    public function toggleRepairType($id)
    {
        $thing = CheckoutDetail::find($id);

        if (!$thing) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลสิ่งของ');
        }

        if ($thing->repairmaintenances_type === 'แจ้งซ่อม') {
            $thing->repairmaintenances_type = 'ซื้อเปลี่ยน';
        } else {
            $thing->repairmaintenances_type = 'แจ้งซ่อม';
        }

        $thing->save();

        return redirect()->back()->with('success', 'เปลี่ยนสถานะซ่อมสำเร็จ');
    }


    public function updateMultipleThingStatus(Request $request)
    {
        $selectedItems = $request->input('selected_items', []);

        if (empty($selectedItems)) {
            return redirect()->back()->with('error', 'กรุณาเลือกรายการที่ต้องการอัปเดต');
        }

        $items = CheckoutDetail::whereIn('id', $selectedItems)->get();

        foreach ($items as $item) {
            // ตรวจสอบว่ามี productroom หรือไม่
            $repairType = $item->productroom->repair_type ?? 'แจ้งซ่อม';

            if ($repairType === 'ซื้อเปลี่ยน') {
                $item->thing_status = 'ซ่อมสำเร็จ';
            } else {
                $item->thing_status = 'กำลังซ่อม';
            }

            $item->save();
        }

        return redirect()->back()->with('success', 'สถานะของสินค้าที่เลือกได้รับการอัปเดตเรียบร้อยแล้ว');
    }



    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'Maintenance_StartDate' => 'required|date',
            'problemType' => 'required|string',
            'room_status' => 'required|in:พร้อมให้บริการ,ไม่พร้อมให้บริการ,แจ้งซ่อมห้อง',
        ]);

        // Create a new maintenance record
        Maintenance::create([
            'room_id' => $request->room_id,
            'Maintenance_StartDate' => $request->Maintenance_StartDate,
            'problemType' => $request->problemType,
            'user_id' => auth()->id(), // ตรวจสอบค่าที่ส่งมาว่าเป็น NULL หรือไม่
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
        // ค้นหาห้องตาม id
        $room = Room::findOrFail($id);

        // อัปเดตสถานะห้องเป็น 'พร้อมให้บริการ'
        $room->room_status = 'พร้อมให้บริการ';
        $room->save();

        // ค้นหาการแจ้งซ่อมที่เกี่ยวข้องกับห้องนี้ (ถ้ามี)
        $maintenance = $room->maintenances()->where('maintenances_status', 'กำลังซ่อม')->first();

        // หากมีการแจ้งซ่อมให้เปลี่ยนสถานะเป็น 'ซ่อมสำเร็จ'
        if ($maintenance) {
            $maintenance->maintenances_status = 'ซ่อมสำเร็จ';
            $maintenance->save();
        }

        // คืนค่ากลับไปยังหน้าก่อนหน้า
        return redirect()->back()->with('success', 'Room status and maintenance status updated successfully');
    }
}
