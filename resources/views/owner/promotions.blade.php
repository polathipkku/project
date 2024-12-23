<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">

    <title>Tunthree - Promotion Management</title>

    <script>
        function showToast(toastId) {
            var toast = document.getElementById(toastId);
            toast.classList.add('show');
            setTimeout(function() {
                toast.classList.remove('show');
            }, 3000); // แสดง toast นาน 3 วินาที (3000 มิลลิวินาที)
        }
    </script>
</head>

<body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>

    <div style="display: flex; background-color: #F5F3FF;">

        <!-- Sidebar -->
        <section class="sticky bg-white rounded-2xl p-2" id="nav-content"
            style="height: 100vh; width: 180px; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; margin-left: 2%; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">
            <div class="w-full lg:w-auto flex-grow lg:flex lg:flex-col bg-white lg:bg-transparent text-black">

                <!-- Logo -->
                <div style="display: grid; place-items: center; margin-bottom: 30px;">
                    <img src="/images/Logo.jpg" alt="Logo" style="width: 80px; height: auto; margin-bottom: -10px;">
                    <div class="text-black text-lg ">Tunthree</div>
                </div>

                <!-- Menu Items -->
                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:text-blue-700 hover:text-sm"
                    href="#" id="Dashboard">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-layer-group mr-1"></i>
                        Dashboard
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:text-blue-700 hover:text-sm"
                    href="#" id="Users">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-user mr-2"></i>Users
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm"
                    href="{{ route('employee') }}" id="Employee">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-users mr-1"></i>Employee
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm"
                    href="{{ route('room') }}" id="Room">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-door-open mr-1"></i>Room
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm"
                    href="product" id="Stock">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-house-circle-check mr-1"></i>Stock
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-blue-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm"
                    href="{{ route('promotions') }}" id="Promotion">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-rectangle-ad mr-1"></i>Promotion
                    </div>
                </a>
                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm"
                    href="{{ route('productroom') }}" id="Breakage">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-house-chimney-crack"></i>Breakage
                    </div>
                </a>
                <a class="inline-block py-2 px-3 text-gray-500 lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm"
                    href="{{ route('record') }}" id="Review">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-database mr-1"></i>Record
                    </div>

                    <!-- Logout -->
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-6 transition duration-300 ease-in-out hover:bg-transparent hover:text-red-500 hover:text-sm"
                        style="position: absolute; bottom: 10px;" id="Logout">
                        <div class="mr-2 text-base flex items-center">
                            <i class="fa-solid fa-right-from-bracket mr-1"></i>Logout
                        </div>
                    </a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
            </div>
        </section>

        <!-- Promotion Management Table -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-8">
                <div class="flex justify-between items-center mb-6">
                    {{-- <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden">
                        <i class="fas fa-bars"></i>
                    </button> --}}
                    <h3 class="text-3xl font-medium text-gray-700">จัดการโปรโมชั่น</h3>
                </div>

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                            <form action="#" method="GET" class="w-full md:w-auto mb-4 md:mb-0">
                                @csrf
                                <div class="relative">
                                    <input type="text" name="search" placeholder="ค้นหาโปรโมชั่น" class="w-full md:w-80 pl-10 pr-4 py-2 rounded-lg border focus:border-blue-300 focus:outline-none focus:shadow-outline">
                                    <div class="absolute top-0 left-0 inline-flex items-center p-2">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                            </form>
                            <button onclick="window.location.href='{{ route('add_promotion') }}'" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                                <i class="fas fa-plus mr-2"></i>เพิ่มโปรโมชั่น
                            </button>
                        </div>

                        <!-- Promotion Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">ลำดับ</th>
                                        <th class="py-3 px-6 text-left">ชื่อโปรโมชั่น</th>
                                        <th class="py-3 px-6 text-left">โค้ดโปรโมชั่น</th>
                                        <th class="py-3 px-6 text-center">วันเริ่มต้น</th>
                                        <th class="py-3 px-6 text-center">วันสิ้นสุด</th>
                                        <th class="py-3 px-6 text-center">จำนวนที่ใช้ / สูงสุด</th>
                                        <th class="py-3 px-6 text-center">ส่วนลด</th>
                                        <th class="py-3 px-6 text-center">สถานะ</th>
                                        <th class="py-3 px-6 text-center">ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm">
                                    @foreach($promotions as $promotion)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-300 ease-in-out">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">
                                            <span class="font-medium">{{ $loop->index + 1 }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <span>{{ $promotion->campaign_name }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-left">
                                            <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-sm">{{ $promotion->promo_code }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <span>{{ $promotion->start_date->format('d-m-Y') }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <span>{{ $promotion->end_date->format('d-m-Y') }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <span>{{ $promotion->usage_count }} / {{ $promotion->max_usage_per_code }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-sm">
                                                {{ $promotion->type === 'percentage' ? $promotion->discount_value . ' %' : $promotion->discount_value . ' ฿' }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            @if($promotion->usage_count >= $promotion->max_usage_per_code)
                                            <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-sm">ถึงขีดจำกัด</span>
                                            @elseif($promotion->promotion_status && $promotion->end_date >= now())
                                            <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-sm">เปิดใช้งาน</span>
                                            @elseif($promotion->promotion_status && $promotion->end_date < now())
                                            <span class="bg-yellow-100 text-yellow-800 py-1 px-3 rounded-full text-sm">หมดอายุ</span>
                                             @else
                                            <span class="bg-red-100 text-red-800 py-1 px-3 rounded-full text-sm">ปิดใช้งาน</span>
                                            @endif
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex item-center justify-center">
                                                <button class="transform hover:text-blue-500 hover:scale-110 transition duration-300 ease-in-out mr-3" onclick="showDetails({{ $promotion->id }})">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                                <a href="{{ route('editpromotion', $promotion->id) }}" class="transform hover:text-yellow-500 hover:scale-110 transition duration-300 ease-in-out mr-3">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" onsubmit="return confirm('คุณต้องการลบโปรโมชั่นนี้หรือไม่?')" class="inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="transform hover:text-red-500 hover:scale-110 transition duration-300 ease-in-out">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal for promotion details -->
    @foreach($promotions as $promotion)
    <div id="details-modal-{{ $promotion->id }}" class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-lg p-8 max-w-md w-full m-4 relative">
            <button onclick="closeDetails({{ $promotion->id }})" class="absolute top-4 right-4 text-gray-600 hover:text-gray-800">
                <i class="fas fa-times"></i>
            </button>
            <h3 class="text-2xl font-bold mb-4">รายละเอียดโปรโมชั่น</h3>
            <div class="mb-4">
                <p class="text-gray-700 mb-2">
                    <strong>เงื่อนไขการเข้าพักขั้นต่ำ:</strong>
                    <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-sm">
                        {{ $promotion->minimum_nights ?? 'ไม่มี' }} คืน
                    </span>
                </p>
                <p class="text-gray-700">
                    <strong>ยอดจองขั้นต่ำ:</strong>
                    <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-sm">
                        {{ $promotion->minimum_booking_amount ? $promotion->minimum_booking_amount . ' บาท' : 'ไม่มี' }}
                    </span>
                </p>
            </div>
            <button onclick="closeDetails({{ $promotion->id }})" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-lg hover:bg-indigo-700 transition duration-300 ease-in-out">
                ปิด
            </button>
        </div>
    </div>
    @endforeach

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>

    <script>
        function showDetails(id) {
            document.getElementById('details-modal-' + id).classList.remove('hidden');
        }

        function closeDetails(id) {
            document.getElementById('details-modal-' + id).classList.add('hidden');
        }
    </script>

</body>

</html>