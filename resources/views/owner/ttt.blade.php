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
            <div class="container mx-auto px-6 py-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-3xl font-medium text-gray-700">ประวัติการซ่อม</h3>
                </div>
    
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <!-- Search Bar -->
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                            <form action="{{ url('/repairreport') }}" method="GET" class="w-full md:w-auto mb-4 md:mb-0">
                                @csrf
                                <div class="relative">
                                    <input type="text" 
                                        name="search" 
                                        placeholder="ค้นหาห้อง" 
                                        value="{{ request('search') }}"
                                        class="w-full md:w-80 pl-10 pr-4 py-2 rounded-lg border focus:border-blue-300 focus:outline-none focus:shadow-outline">
                                    <div class="absolute top-1/2 left-3 transform -translate-y-1/2">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                            </form>
                        </div>
    
                        <!-- Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-center">หมายเลขห้อง</th>
                                        <th class="py-3 px-6 text-center">จำนวนครั้งที่เคยซ่อม</th>
                                        <th class="py-3 px-6 text-center">ชื่อค่าเสียหาย</th>
                                        <th class="py-3 px-6 text-center">ค่าปรับรวม</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm">
                                    @forelse($repairCounts as $repair)
                                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                                            <td class="py-3 px-6 text-center">
                                                {{ $repair->room->room_name ?? 'ไม่ระบุห้อง' }}
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">
                                                    {{ $repair->repair_count }} ครั้ง
                                                </span>
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                {{ $repair->productroom_name }}
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                {{ number_format($repair->total_price, 2) }} บาท
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="py-3 px-6 text-center text-gray-500">
                                                ไม่พบข้อมูลการซ่อม
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
    
                        <!-- Pagination -->
                        @if(method_exists($repairCounts, 'hasPages') && $repairCounts->hasPages())
                            <div class="mt-4">
                                {{ $repairCounts->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</body>
</html>