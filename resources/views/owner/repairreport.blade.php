<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tunthree - ประวัติการซ่อม</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
</head>

<body class="bg-gray-50">

    <div class="flex min-h-screen bg-gray-50">

        <!-- Sidebar -->
        @include('components.admin_sidebar')

        <main class="flex-1 bg-gradient-to-br from-blue-50 to-gray-100 overflow-x-hidden">
            <div class="container mx-auto px-4 py-6">

                <!-- Header Section with improved mobile responsiveness -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-800">ประวัติการซ่อม</h3>

                    <div class="flex w-full md:w-auto gap-3 flex-col sm:flex-row">
                        <!-- Filter Dropdown -->
                        {{-- <div class="relative">
                            <select name="status_filter" class="appearance-none bg-white pl-4 pr-10 py-3 rounded-full border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 shadow-sm transition duration-200 w-full">
                                <option value="all">ทั้งหมด</option>
                                <option value="ซ่อมสำเร็จ">ซ่อมสำเร็จ</option>
                                <option value="ซื้อเปลี่ยนสำเร็จ">ซื้อเปลี่ยนสำเร็จ</option>
                                <option value="จ่ายเงินค่าซ่อมสำเร็จ">จ่ายเงินค่าซ่อมสำเร็จ</option>
                                <option value="จ่ายเงินค่าซื้อเปลี่ยนสำเร็จ">จ่ายเงินค่าซื้อเปลี่ยนสำเร็จ</option>
                            </select>
                            <div class="absolute top-1/2 right-4 transform -translate-y-1/2 pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div> --}}

                        <!-- Search Bar -->
                        <form action="{{ url('/repairreport') }}" method="GET" class="w-full">
                            @csrf
                            <div class="relative w-full">
                                <input type="text"
                                    name="search"
                                    placeholder="ค้นหาห้องหรือรายการซ่อม"
                                    value="{{ request('search') }}"
                                    class="w-full pl-10 pr-4 py-3 rounded-full border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 shadow-sm transition duration-200">
                                <div class="absolute top-1/2 left-4 transform -translate-y-1/2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Stats Overview -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                    <div class="bg-white rounded-lg shadow p-5 border border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-blue-50 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium">จำนวนห้อง</p>
                                <h3 class="text-xl font-bold text-gray-800">{{ $repairCounts->groupBy('room_id')->count() }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-5 border border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-green-50 text-green-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium">ซ่อมสำเร็จ</p>
                                <h3 class="text-xl font-bold text-gray-800">{{ $repairCounts->where('thing_status', 'ซ่อมสำเร็จ')->count() }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-5 border border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-amber-50 text-amber-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium">ซื้อเปลี่ยนสำเร็จ</p>
                                <h3 class="text-xl font-bold text-gray-800">{{ $repairCounts->where('thing_status', 'ซื้อเปลี่ยนสำเร็จ')->count() }}</h3>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-lg shadow p-5 border border-gray-200">
                        <div class="flex items-center">
                            <div class="p-3 rounded-full bg-purple-50 text-purple-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-gray-500 font-medium">รอชำระเงิน</p>
                                <h3 class="text-xl font-bold text-gray-800">{{ $repairCounts->whereIn('thing_status', ['ซ่อมสำเร็จ', 'ซื้อเปลี่ยนสำเร็จ'])->count() }}</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Status Overview -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 mb-6">
                    <div class="p-5 bg-blue-600 text-white">
                        <h3 class="font-semibold text-lg">สรุปสถานะการชำระเงิน</h3>
                    </div>
                    <div class="p-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                                <div class="p-3 rounded-full bg-amber-100 text-amber-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">รอชำระค่าซ่อม</p>
                                    <p class="text-lg font-semibold">{{ $repairCounts->where('thing_status', 'ซ่อมสำเร็จ')->count() }} รายการ</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                                <div class="p-3 rounded-full bg-amber-100 text-amber-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">รอชำระค่าซื้อเปลี่ยน</p>
                                    <p class="text-lg font-semibold">{{ $repairCounts->where('thing_status', 'ซื้อเปลี่ยนสำเร็จ')->count() }} รายการ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <h4 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        ประวัติการซ่อมแยกตามห้อง
                    </h4>

                    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($repairCounts->groupBy('room_id')->take(6) as $roomId => $items)
                        @php
                        $roomName = $items->first()->room->room_name ?? 'ไม่มีข้อมูล';
                        $waitingPayment = $items->whereIn('thing_status', ['ซ่อมสำเร็จ', 'ซื้อเปลี่ยนสำเร็จ'])->count();
                        $paid = $items->whereIn('thing_status', ['จ่ายเงินค่าซ่อมสำเร็จ', 'จ่ายเงินค่าซื้อเปลี่ยนสำเร็จ'])->count();
                        @endphp

                        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition-shadow duration-300">
                            <!-- Room Header -->
                            <div class="p-5 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                        <h3 class="text-lg font-semibold">ห้อง {{ $roomName }}</h3>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="bg-white bg-opacity-20 rounded-full px-3 py-1">
                                            <span class="text-sm font-medium">{{ $items->count() }} รายการ</span>
                                        </div>
                                        @if($waitingPayment > 0)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-200 text-amber-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            รอชำระ {{ $waitingPayment }}
                                        </span>
                                        @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-200 text-green-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            ชำระแล้ว
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Button to trigger popup -->
                            <div class="p-4">
                                <button type="button"
                                    onclick="openRepairModal('repair-modal-{{ $roomId }}')"
                                    class="w-full flex items-center justify-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 hover:bg-blue-100 transition duration-200 rounded-lg font-medium">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                    </svg>
                                    แสดงรายการซ่อม
                                </button>
                            </div>
                        </div>

                        <!-- Modal for repair details -->
                        <div id="repair-modal-{{ $roomId }}"
                            class="fixed inset-0 z-50 hidden overflow-auto"
                            aria-labelledby="modal-title"
                            role="dialog"
                            aria-modal="true">
                            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block">
                                <!-- Background overlay -->
                                <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"
                                    aria-hidden="true"
                                    onclick="closeRepairModal('repair-modal-{{ $roomId }}')"></div>

                                <!-- This element centers the modal contents -->
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                                <!-- Modal panel -->
                                <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl sm:w-full relative">
                                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 flex justify-between items-center">
                                        <h3 class="text-lg font-semibold flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                            รายการซ่อมห้อง {{ $roomName }}
                                        </h3>
                                        <button type="button"
                                            onclick="closeRepairModal('repair-modal-{{ $roomId }}')"
                                            class="text-white hover:text-gray-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>

                                    <div class="max-h-96 overflow-y-auto divide-y divide-gray-100">
                                        @foreach($items as $repair)
                                        <div class="p-4 hover:bg-gray-50 transition-colors duration-200">
                                            <div class="flex justify-between items-start gap-3">
                                                <div>
                                                    <h4 class="font-medium text-gray-900 truncate max-w-xs">{{ $repair->productroom_name }}</h4>
                                                    <div class="flex flex-wrap gap-2 mt-2">
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                            </svg>
                                                            {{ \Carbon\Carbon::parse($repair->created_at)->format('d/m/Y') }}
                                                        </span>

                                                        @if(in_array($repair->thing_status, ['จ่ายเงินค่าซ่อมสำเร็จ', 'จ่ายเงินค่าซื้อเปลี่ยนสำเร็จ']))
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                            </svg>
                                                            {{ $repair->thing_status }}
                                                        </span>
                                                        @else
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                            {{ $repair->thing_status }}
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <!-- แสดงฟอร์มเฉพาะสถานะ ซ่อมสำเร็จ หรือ ซื้อเปลี่ยนสำเร็จ -->
                                                @if(in_array($repair->thing_status, ['ซ่อมสำเร็จ', 'ซื้อเปลี่ยนสำเร็จ']))
                                                <form action="{{ route('updateRepairStatus', $repair->id) }}" method="POST" class="flex gap-2 items-center">
                                                    @csrf
                                                    <div class="relative">
                                                        <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                                            <span class="text-gray-500 text-sm">฿</span>
                                                        </div>
                                                        <input type="number" name="expenses_price" placeholder="ราคา" required
                                                            class="pl-6 py-2 w-24 rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                                    </div>

                                                    <input type="text" name="expenses_note" placeholder="หมายเหตุ (ถ้ามี)"
                                                        class="py-2 px-3 w-48 rounded-lg border-gray-200 text-sm focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                                    <button type="submit" class="px-3 py-2 bg-green-600 hover:bg-green-700 text-white text-sm rounded-lg transition duration-200 flex items-center">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        บันทึก
                                                    </button>
                                                </form>

                                                @else
                                                <!-- แสดงค่าใช้จ่ายสำหรับรายการที่ชำระแล้ว -->
                                                <div class="bg-gray-50 border border-gray-100 rounded-lg px-3 py-2 text-sm">
                                                    <p class="text-gray-500 text-xs">ค่าใช้จ่าย</p>
                                                    @php
                                                    // ค้นหาค่าใช้จ่ายจากตาราง expenses
                                                    $expense = App\Models\Expense::where('expenses_name', $repair->productroom_name)
                                                    ->where('room_id', $repair->room_id)
                                                    ->first();
                                                    $amount = $expense ? $expense->expenses_price : 0;
                                                    @endphp
                                                    <p class="font-medium">฿{{ number_format($amount) }}</p>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                        <button type="button"
                                            onclick="closeRepairModal('repair-modal-{{ $roomId }}')"
                                            class="w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                            ปิด
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Add this JavaScript to the bottom of your page or in your layout file -->
                <script>
                    function openRepairModal(modalId) {
                        document.getElementById(modalId).classList.remove('hidden');
                        document.body.classList.add('overflow-hidden');
                    }

                    function closeRepairModal(modalId) {
                        document.getElementById(modalId).classList.add('hidden');
                        document.body.classList.remove('overflow-hidden');
                    }

                    // Close modal when clicking ESC key
                    document.addEventListener('keydown', function(event) {
                        if (event.key === 'Escape') {
                            const visibleModals = document.querySelectorAll('[id^="repair-modal-"]:not(.hidden)');
                            visibleModals.forEach(modal => {
                                closeRepairModal(modal.id);
                            });
                        }
                    });
                </script>

                <!-- Pagination Controls -->
                @if($repairCounts->groupBy('room_id')->count() > 6)
                <div class="mt-6 flex justify-center">
                    <nav class="flex items-center space-x-2">
                        <a href="#" class="px-3 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
                            <span class="sr-only">Previous</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </a>
                        <a href="#" class="px-4 py-2 rounded-md bg-blue-600 text-white font-medium">1</a>
                        <a href="#" class="px-4 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium">2</a>
                        <a href="#" class="px-4 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium">3</a>
                        <a href="#" class="px-3 py-2 rounded-md bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
                            <span class="sr-only">Next</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </nav>
                </div>
                @endif
            </div>

            <!-- Empty State - Only shown when no data -->
            @if($repairCounts->count() === 0)
            <div class="flex flex-col items-center justify-center p-10 bg-white rounded-xl shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                </svg>
                <h3 class="text-xl font-medium text-gray-700 mb-1">ไม่พบข้อมูลการซ่อม</h3>
                <p class="text-gray-500 mb-4">ไม่มีประวัติการซ่อมบำรุงในระบบ</p>
            </div>
            @endif
    </div>
    </main>
    </div>

    <!-- Add tooltips and progressive enhancement with a small script -->
    <script>
        // Enable tooltips and other progressive enhancements
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-close details on smaller screens for better UX
            if (window.innerWidth < 768) {
                const detailsElements = document.querySelectorAll('details');
                detailsElements.forEach(details => {
                    details.removeAttribute('open');
                });
            }

            // ตั้งค่า Filter Dropdown
            const statusFilter = document.querySelector('select[name="status_filter"]');
            statusFilter.addEventListener('change', function() {
                const status = this.value;
                // เลือกรายการตาม status
                document.querySelectorAll('.repair-item').forEach(item => {
                    if (status === 'all' || item.dataset.status === status) {
                        item.style.display = '';
                    } else {
                        item.style.display = 'none';
                    }
                });
            });
        });
    </script>
</body>

</html>