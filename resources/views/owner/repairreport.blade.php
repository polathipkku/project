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
        @include('components.admin_sidebar')


        <!-- Promotion Management Table -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-8">
                <div class="flex justify-between items-center mb-6">
                    {{-- <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden">
                        <i class="fas fa-bars"></i>
                    </button> --}}
                    <h3 class="text-3xl font-medium text-gray-700">ประวัติการซ่อม</h3>
                </div>

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                            <form action="#" method="GET" class="w-full md:w-auto mb-4 md:mb-0">
                                @csrf
                                <div class="relative">
                                    <input type="text" name="search" placeholder="ค้นหาห้อง" class="w-full md:w-80 pl-10 pr-4 py-2 rounded-lg border focus:border-blue-300 focus:outline-none focus:shadow-outline">
                                    <div class="absolute top-1/2 left-3 transform -translate-y-1/2">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>

                            </form>

                        </div>

                        <!-- Promotion Table -->
                        <div class="overflow-x-auto">

                            <table class="w-full border-collapse border border-gray-300">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="border border-gray-300 p-2">#</th>
                                        <th class="border border-gray-300 p-2">หมายเลขห้อง</th>
                                        <th class="border border-gray-300 p-2">จำนวนครั้งที่เคยซ่อม</th>
                                        <th class="border border-gray-300 p-2">ชื่อค่าเสียหาย</th>
                                        <th class="border border-gray-300 p-2">ค่าปรับรวม</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-100">
                                    @foreach($repairCounts as $index => $repair)
                                    <tr class="hover:bg-gray-200">
                                        <td class="border border-gray-300 p-2 text-center">{{ $index + 1 }}</td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            {{ $repair->room->room_name ?? 'ไม่ระบุห้อง' }}
                                        </td>
                                        <td class="border border-gray-300 p-2 text-center">
                                            {{ $repair->repair_count }} ครั้ง
                                        </td>
                                        <td class="border border-gray-300 p-2">{{ $repair->productroom_name }}</td>
                                       
                                        <td class="border border-gray-300 p-2 text-right">{{ number_format($repair->total_price, 2) }} บาท</td>
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