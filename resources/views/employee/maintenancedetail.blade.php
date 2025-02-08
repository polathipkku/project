<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">

    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <title>Tunthree</title>
</head>

<body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>

    <div style="display: flex; background-color: #F5F3FF;">

        @include('components.em_sidebar')


        <!-- --------------------------------------------------------------------------------------------------------------------- -->

        <section class="w-full max-w-7xl mx-auto bg-white rounded-lg shadow-lg p-8">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8 border-b pb-4">
                <h1 class="text-3xl font-bold text-gray-800">รายละเอียดการแจ้งซ่อม</h1>
                <button class="text-red-500 hover:text-red-700 transition-colors" onclick="window.location.href='/maintenanceroom'">
                    <i class="fa-solid fa-circle-xmark text-3xl"></i>
                </button>
            </div>

            <!-- Status Overview Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-yellow-50 rounded-xl p-6 border border-yellow-200">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-yellow-700 text-lg font-semibold">รอดำเนินการ</span>
                            <span class="text-2xl font-bold text-yellow-800">{{ $pendingRepairCount }} รายการ</span>
                        </div>
                        <div class="bg-yellow-100 p-3 rounded-full">
                            <i class="fa-solid fa-clock text-2xl text-yellow-700"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-blue-700 text-lg font-semibold">กำลังดำเนินการ</span>
                            <span class="text-2xl font-bold text-blue-800">{{ $progressRepairCount }} รายการ</span>
                        </div>
                        <div class="bg-blue-100 p-3 rounded-full">
                            <i class="fa-solid fa-tools text-2xl text-blue-700"></i>
                        </div>
                    </div>
                </div>

                <div class="bg-green-50 rounded-xl p-6 border border-green-200">
                    <div class="flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-green-700 text-lg font-semibold">ดำเนินการสำเร็จ</span>
                            <span class="text-2xl font-bold text-green-800">{{ $completedRepairCount }} รายการ</span>
                        </div>
                        <div class="bg-green-100 p-3 rounded-full">
                            <i class="fa-solid fa-check text-2xl text-green-700"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Grid -->


            <!-- Maintenance Management Section -->
            <div class="bg-white rounded-xl border border-gray-200">
                <div class="bg-gray-800 p-4 rounded-t-xl">
                    <h2 class="text-xl font-semibold text-white">การจัดการ</h2>
                </div>

                <!-- Tab Buttons -->
                <div class="flex space-x-4 p-4 border-b">
                    <button id="pendingRepairsBtn" class="flex-1 py-3 px-6 rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 bg-blue-500 text-white">
                        <div class="flex items-center justify-between">
                            <span>รายการสิ่งของที่รอซ่อม</span>
                            <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full ml-2">
                                {{ $pendingRepairCount }} รายการ
                            </span>
                        </div>
                    </button>
                    <button id="inProgressRepairsBtn" class="flex-1 py-3 px-6 rounded-lg font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-blue-500 border border-blue-500">
                        <div class="flex items-center justify-between">
                            <span>รายการสิ่งของที่กำลังซ่อม</span>
                            <span class="bg-blue-100 px-3 py-1 rounded-full ml-2">
                                {{ $progressRepairCount }} รายการ
                            </span>
                        </div>
                    </button>
                </div>
                <!-- Pending Repairs List -->
                <div id="pendingRepairs" class="p-6">
                    <!-- รายการที่รอเปลี่ยนสินค้า -->
                    <h2 class="text-lg font-bold text-gray-800 mb-4">รายการที่รอเปลี่ยนสินค้า</h2>
                    <ul class="space-y-4">
                        @forelse ($maintenanceDetail->booking->checkoutDetails as $item)
                        @if ($item->thing_status === 'รอซ่อม' && ($item->repairmaintenances_type ?? 'แจ้งซ่อม') === 'ซื้อเปลี่ยน')
                        <li class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-start space-x-4">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $item->productroom_name ?? 'ไม่มีข้อมูล' }}</p>
                                    <p class="text-yellow-600">สถานะ: {{ $item->thing_status }}</p>
                                </div>
                            </div>
                            <!-- ปุ่มอยู่ข้างกัน -->
                            <div class="flex space-x-2">
                                <form action="{{ route('updateThingStatus', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        เปลี่ยนสินค้า
                                    </button>
                                </form>
                                <form action="{{ route('toggleRepairType', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors focus:outline-none focus:ring-2 focus:ring-green-500">
                                        เปลี่ยนเป็น "แจ้งซ่อม"
                                    </button>
                                </form>
                            </div>
                        </li>
                        @endif
                        @empty
                        <li class="text-gray-500 text-center py-4">ไม่มีรายการสิ่งของที่รอเปลี่ยนสินค้า</li>
                        @endforelse
                    </ul>

                    <!-- รายการที่รอแจ้งซ่อม -->
                    <h2 class="text-lg font-bold text-gray-800 mt-8 mb-4">รายการที่รอแจ้งซ่อม</h2>
                    <ul class="space-y-4">
                        @forelse ($maintenanceDetail->booking->checkoutDetails as $item)
                        @if ($item->thing_status === 'รอซ่อม' && ($item->repairmaintenances_type ?? 'แจ้งซ่อม') === 'แจ้งซ่อม')
                        <li class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-start space-x-4">
                                <div>
                                    <p class="font-medium text-gray-800">{{ $item->productroom_name ?? 'ไม่มีข้อมูล' }}</p>
                                    <p class="text-yellow-600">สถานะ: {{ $item->thing_status }}</p>
                                </div>
                            </div>
                            <!-- ปุ่มอยู่ข้างกัน -->
                            <div class="flex space-x-2">
                                <form action="{{ route('updateThingStatus', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        เปลี่ยนเป็น "กำลังซ่อม"
                                    </button>
                                </form>
                                <form action="{{ route('toggleRepairType', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors focus:outline-none focus:ring-2 focus:ring-green-500">
                                        เปลี่ยนเป็น "ซื้อเปลี่ยน"
                                    </button>
                                </form>
                            </div>
                        </li>
                        @endif
                        @empty
                        <li class="text-gray-500 text-center py-4">ไม่มีรายการสิ่งของที่รอแจ้งซ่อม</li>
                        @endforelse
                    </ul>
                </div>



                <!-- In Progress Repairs List -->
                <div id="inProgressRepairs" class="p-6 hidden">
                    <ul class="space-y-4">
                        @forelse ($maintenanceDetail->booking->checkoutDetails as $item)
                        @if ($item->thing_status === 'กำลังซ่อม')
                        <li class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                            <div>
                                <p class="font-medium text-gray-800">{{ $item->productroom_name ?? 'ไม่มีข้อมูล' }}</p>
                                <p class="text-blue-600">สถานะ: {{ $item->thing_status }}</p>
                            </div>
                            <form action="{{ route('markAsCompleted', $item->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors focus:outline-none focus:ring-2 focus:ring-green-500">
                                    เปลี่ยนเป็น "ซ่อมสำเร็จ"
                                </button>
                            </form>
                        </li>
                        @endif
                        @empty
                        <li class="text-gray-500 text-center py-4">ไม่มีรายการสิ่งของที่กำลังซ่อม</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Room Information -->
                <div class="bg-white rounded-xl p-6 border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fa-solid fa-door-open mr-2 text-gray-600"></i>
                        ข้อมูลห้องพัก
                    </h2>
                    <p class="text-gray-700 mb-2">
                        <span class="font-medium">ชื่อห้อง:</span>
                        <span class="ml-2">{{ optional($maintenanceDetail->room)->room_name }}</span>
                    </p>
                </div>

                <!-- Booking Information -->
                <div class="bg-white rounded-xl p-6 border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fa-solid fa-calendar-check mr-2 text-gray-600"></i>
                        ข้อมูลการจอง
                    </h2>
                    <p class="text-gray-700 mb-2">
                        <span class="font-medium">ชื่อผู้จอง:</span>
                        <span class="ml-2">{{ optional($maintenanceDetail)->booking_name ?? 'ไม่มีข้อมูล' }}</span>
                    </p>
                    <p class="text-gray-700">
                        <span class="font-medium">โทรศัพท์:</span>
                        <span class="ml-2">{{ optional($maintenanceDetail)->phone ?? 'ไม่มีข้อมูล' }}</span>
                    </p>
                </div>

                <!-- Check-in Information -->
                <div class="bg-white rounded-xl p-6 border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fa-solid fa-user-check mr-2 text-gray-600"></i>
                        ข้อมูลผู้เช็คอิน
                    </h2>
                    <p class="text-gray-700 mb-2">
                        <span class="font-medium">ชื่อผู้เช็คอิน:</span>
                        <span class="ml-2">{{ optional($maintenanceDetail->booking->checkin)->name ?? 'ไม่มีข้อมูล' }}</span>
                    </p>
                    <p class="text-gray-700">
                        <span class="font-medium">โทรศัพท์:</span>
                        <span class="ml-2">{{ optional($maintenanceDetail->booking->checkin)->phone ?? 'ไม่มีข้อมูล' }}</span>
                    </p>
                </div>

                <!-- Damage Information -->
                <div class="bg-white rounded-xl p-6 border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                        <i class="fa-solid fa-triangle-exclamation mr-2 text-gray-600"></i>
                        ข้อมูลความเสียหาย
                    </h2>
                    <p class="text-gray-700 mb-2">
                        <span class="font-medium">ค่าเสียหายทั้งหมด:</span>
                        <span class="ml-2">{{ number_format(optional($maintenanceDetail->booking->checkout)->total_damages, 2) ?? 'ไม่มีข้อมูล' }} บาท</span>
                    </p>
                    <p class="text-gray-700">
                        <span class="font-medium">สถานะการซ่อม:</span>
                        <span class="ml-2">{{ optional($maintenanceDetail->room->maintenances->first())->maintenances_status ?? 'ไม่มีข้อมูล' }}</span>
                    </p>
                </div>
            </div>

            <!-- Damage Details -->
            <div class="bg-white rounded-xl p-6 border border-gray-200 mb-8">
                <h2 class="text-xl font-semibold text-gray-800 mb-4 flex items-center">
                    <i class="fa-solid fa-clipboard-list mr-2 text-gray-600"></i>
                    รายละเอียดค่าเสียหาย
                </h2>
                <div class="space-y-4">
                    @forelse ($maintenanceDetail->booking->checkoutDetails as $detail)
                    @if ($detail->booking_detail_id === $maintenanceDetail->id)
                    <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-800">{{ $detail->productroom_name ?? 'ไม่มีข้อมูล' }}</p>
                            <p class="text-gray-600">{{ number_format($detail->totalpriceroom, 2) ?? 'ไม่มีข้อมูล' }} บาท</p>
                        </div>
                    </div>
                    @endif
                    @empty
                    <p class="text-gray-500 text-center py-4">ไม่มีข้อมูล</p>
                    @endforelse
                </div>
            </div>
        </section>

        <script>
            document.getElementById('pendingRepairsBtn').addEventListener('click', function() {
                document.getElementById('pendingRepairs').classList.remove('hidden');
                document.getElementById('inProgressRepairs').classList.add('hidden');

                this.classList.remove('bg-white', 'text-blue-500', 'border', 'border-blue-500');
                this.classList.add('bg-blue-500', 'text-white');

                const inProgressBtn = document.getElementById('inProgressRepairsBtn');
                inProgressBtn.classList.remove('bg-blue-500', 'text-white');
                inProgressBtn.classList.add('bg-white', 'text-blue-500', 'border', 'border-blue-500');
            });

            document.getElementById('inProgressRepairsBtn').addEventListener('click', function() {
                document.getElementById('inProgressRepairs').classList.remove('hidden');
                document.getElementById('pendingRepairs').classList.add('hidden');

                this.classList.remove('bg-white', 'text-blue-500', 'border', 'border-blue-500');
                this.classList.add('bg-blue-500', 'text-white');

                const pendingBtn = document.getElementById('pendingRepairsBtn');
                pendingBtn.classList.remove('bg-blue-500', 'text-white');
                pendingBtn.classList.add('bg-white', 'text-blue-500', 'border', 'border-blue-500');
            });
        </script>

    </div>

</body>

</html>