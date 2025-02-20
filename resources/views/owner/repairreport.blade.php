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
    <div style="display: flex; background-color: #F5F3FF;">
        @include('components.admin_sidebar')

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-4 py-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-3xl font-medium text-gray-700">ประวัติการซ่อม</h3>
                </div>

                <!-- Search Bar -->
                <div class="mb-6">
                    <form action="{{ url('/repairreport') }}" method="GET">
                        @csrf
                        <div class="relative max-w-md">
                            <input type="text" name="search" placeholder="ค้นหาห้อง" value="{{ request('search') }}"
                                class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 focus:outline-none">
                            <div class="absolute top-1/2 left-3 transform -translate-y-1/2">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Room Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @php
                    $groupedByRoom = $repairCounts->groupBy('room_id');
                    @endphp

                    @foreach($groupedByRoom as $roomId => $items)
                    @php
                    $roomName = $items->first()->room->room_name ?? 'ไม่มีข้อมูล';
                    @endphp
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-5 border-b border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-800">ห้อง {{ $roomName }}</h3>
                        </div>

                        <div class="p-5">
                            <button
                                onclick="toggleDropdown('dropdown-{{ $roomId }}')"
                                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md transition duration-200 flex items-center justify-center">
                                <span>จ่ายเงิน</span>
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- Dropdown Content -->
                            <div id="dropdown-{{ $roomId }}" class="hidden mt-4 border border-gray-200 rounded-md shadow-md bg-gray-50">
                                @foreach($items as $repair)
                                <div class="p-4 border-b border-gray-200 last:border-b-0">
                                    <div class="flex flex-col space-y-3">
                                        <div class="flex justify-between">
                                            <span class="font-medium text-gray-700">ชื่อสินค้า:</span>
                                            <span>{{ $repair->productroom_name }}</span>
                                        </div>
                                        <div class="flex justify-between">
                                            <span class="font-medium text-gray-700">สถานะ:</span>
                                            <span class="{{ $repair->thing_status === 'ซ่อมสำเร็จ' ? 'text-green-600' : 'text-orange-600' }}">
                                                {{ $repair->thing_status }}
                                            </span>
                                        </div>

                                        <form action="{{ route('updateRepairStatus', $repair->id) }}" method="POST" class="mt-3">
                                            @csrf
                                            <div class="flex flex-col sm:flex-row gap-3">
                                                <div class="flex-grow">
                                                    <input type="number" name="expenses_price" placeholder="ราคา" required
                                                        class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 py-2 px-3">
                                                </div>
                                                <button type="submit"
                                                    class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-4 rounded-md transition duration-200">
                                                    ยืนยันการจ่าย
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </main>

        <!-- JavaScript for dropdown functionality -->
        <script>
            function toggleDropdown(id) {
                const dropdown = document.getElementById(id);
                if (dropdown.classList.contains('hidden')) {
                    dropdown.classList.remove('hidden');
                } else {
                    dropdown.classList.add('hidden');
                }
            }
        </script>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</body>

</html>