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

        <section class="sticky bg-white rounded-2xl p-2" id="nav-content" style="height: 100vh; width: 180px; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; margin-left: 2%; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">
            <div class="w-full lg:w-auto flex-grow lg:flex lg:flex-col bg-white lg:bg-transparent text-black">

                <div style="display: grid; place-items: center; margin-bottom: 30px;">
                    <img src="images/Logo.jpg" alt="Logo" style="width: 80px; height: auto; margin-bottom: -10px;">
                    <div class="text-black text-lg ">Tunthree</div>
                </div>



                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:text-blue-700 hover:text-sm" href="#" id="Users">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-user mr-2"></i>Users
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-door-open mr-1"></i>Room
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="#" id="Stock">
                    <div class="mr-2 text-base flex items-center ">
                        <i class="fa-solid fa-person-walking-luggage mr-1"></i>Check In
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-blue-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="#" id="Stock">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-person-walking-luggage fa-flip-horizontal mr-1"></i>Check Outsssss
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="#" id="Stock">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-house-circle-check mr-1"></i>Stock
                    </div>
                </a>

                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-6 transition duration-300 ease-in-out hover:bg-transparent hover:text-red-500 hover:text-sm" style="position: absolute; bottom: 10px;" id="Logout">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-right-from-bracket mr-1"></i>Logout
                    </div>
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
            </div>
        </section>

        <!-- --------------------------------------------------------------------------------------------------------------------- -->

        <section class="ml-10 bg-white shadow-lg rounded-lg overflow-hidden" id="room-table" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%;">
            <div class="max-w-screen-xl mx-auto py-10">
                <div class="flex justify-between items-center border-b-2 pb-4">
                    <h1 class="text-4xl font-bold text-gray-800">รายละเอียดการแจ้งซ่อม</h1>
                    <button class="relative group" onclick="window.location.href ='/maintenanceroom'">
                        <i class="fa-solid fa-circle-xmark text-4xl text-red-500 group-hover:text-red-900"></i>
                    </button>
                </div>

                <!-- Maintenance Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                    <!-- Room Information -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">ข้อมูลห้องพัก</h2>
                        <p class="mt-4 text-gray-700"><strong>ชื่อห้อง:</strong> <span class="text-gray-500">{{ optional($maintenanceDetail->room)->room_name }}</span></p>
                    </div>

                    <!-- Booking Information -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">ข้อมูลการจอง</h2>
                        <p class="mt-4 text-gray-700"><strong>ชื่อผู้จอง:</strong> <span class="text-gray-500">{{ optional($maintenanceDetail)->booking_name ?? 'ไม่มีข้อมูล' }}</span></p>
                        <p class="mt-2 text-gray-700"><strong>โทรศัพท์ผู้จอง:</strong> <span class="text-gray-500">{{ optional($maintenanceDetail)->phone ?? 'ไม่มีข้อมูล' }}</span></p>
                    </div>

                    <!-- Check-In Information -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">ข้อมูลผู้เช็คอิน</h2>
                        <p class="mt-4 text-gray-700"><strong>ชื่อผู้เช็คอิน:</strong> <span class="text-gray-500">{{ optional($maintenanceDetail->booking->checkin)->name ?? 'ไม่มีข้อมูล' }}</span></p>
                        <p class="mt-2 text-gray-700"><strong>หมายเลขบัตรประชาชนผู้เข้าพัก:</strong> <span class="text-gray-500">{{ optional($maintenanceDetail->booking->checkin)->id_card ?? 'ไม่มีข้อมูล' }}</span></p>
                        <p class="mt-2 text-gray-700"><strong>โทรศัพท์ผู้เช็คอิน:</strong> <span class="text-gray-500">{{ optional($maintenanceDetail->booking->checkin)->phone ?? 'ไม่มีข้อมูล' }}</span></p>
                    </div>

                    <!-- Damages and Maintenance Status -->
                    <div class="bg-gray-50 p-6 rounded-lg shadow-md">
                        <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">ข้อมูลความเสียหาย</h2>
                        <p class="mt-4 text-gray-700"><strong>ค่าเสียหายทั้งหมด:</strong> <span class="text-gray-500">{{ number_format(optional($maintenanceDetail->booking->checkout)->total_damages, 2) ?? 'ไม่มีข้อมูล' }} บาท</span></p>
                        <p class="mt-2 text-gray-700"><strong>สถานะการซ่อม:</strong> <span class="text-gray-500">{{ optional($maintenanceDetail->room->maintenances->first())->maintenances_status ?? 'ไม่มีข้อมูล' }}</span></p>
                      
                    </div>
                </div>

                <!-- Damage Details -->
                <div class="bg-gray-50 p-6 rounded-lg shadow-md mt-8">
                    <h2 class="text-xl font-semibold text-gray-700 border-b pb-2">รายละเอียดค่าเสียหาย</h2>
                    <ul class="list-disc pl-6 text-gray-600 space-y-2 mt-4">
                        @forelse ($maintenanceDetail->booking->checkoutDetails as $detail)
                        @if ($detail->booking_detail_id === $maintenanceDetail->id)
                        <li>
                            <strong>ชื่อสินค้า:</strong> <span class="text-gray-500">{{ $detail->productroom_name ?? 'ไม่มีข้อมูล' }}</span><br>
                            <strong>ราคา:</strong> <span class="text-gray-500">{{ number_format($detail->totalpriceroom, 2) ?? 'ไม่มีข้อมูล' }} บาท</span>
                        </li>
                        @endif
                        @empty
                        <li class="text-gray-500">ไม่มีข้อมูล</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </section>

    </div>


    <script>
        document.getElementById("submit").addEventListener("click", function() {
            window.location.href = "em_room.html"; // เปลี่ยนเป็น URL ที่ต้องการไป
        });

        document.getElementById("cancel").addEventListener("click", function() {
            window.location.href = "em_room.html"; // เปลี่ยนเป็น URL ที่ต้องการไป
        });
    </script>
</body>

</html>