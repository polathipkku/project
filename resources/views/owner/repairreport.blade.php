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
            <div class="container mx-auto px-6 py-8">

                <!-- Header Section -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-6">
                    <h3 class="text-3xl font-bold text-gray-800">ประวัติการซ่อม</h3>
                    
                    <!-- Search Bar -->
                    <form action="{{ url('/repairreport') }}" method="GET" class="w-full md:w-auto">
                        @csrf
                        <div class="relative w-full">
                            <input type="text" 
                                   name="search" 
                                   placeholder="ค้นหาห้อง" 
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

                <!-- Room Cards Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

                    @foreach($repairCounts->groupBy('room_id') as $roomId => $items)
                    @php
                    $roomName = $items->first()->room->room_name ?? 'ไม่มีข้อมูล';
                    @endphp
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-gray-200 hover:shadow-xl transition-shadow duration-300">
                        <!-- Room Header -->
                        <div class="p-6 bg-gradient-to-r from-blue-600 to-blue-700 text-white">
                            <div class="flex justify-between items-center">
                                <h3 class="text-xl font-semibold">ห้อง {{ $roomName }}</h3>
                                <div class="flex items-center bg-white bg-opacity-20 rounded-full px-4 py-2">
                                    <span class="text-sm font-medium">รายการทั้งหมด: {{ $items->count() }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Repair List -->
                        <details class="group" open>
                            <summary class="flex items-center justify-between p-5 cursor-pointer border-b border-gray-200 hover:bg-gray-50 transition-colors duration-200">
                                <span class="font-medium text-blue-600">แสดงรายการซ่อม</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 group-open:rotate-180 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            
                            <div class="divide-y divide-gray-200">
                                @foreach($items as $repair)
                                <div class="p-5 hover:bg-gray-50 transition-colors duration-200">
                                    <div class="flex flex-col md:flex-row justify-between md:items-center gap-3 mb-4">
                                        <div>
                                            <h4 class="font-medium text-gray-900">{{ $repair->productroom_name }}</h4>
                                            <p class="text-sm text-gray-500 mt-1 flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                {{ \Carbon\Carbon::parse($repair->created_at)->format('d/m/Y') }}
                                            </p>
                                        </div>
                                        
                                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium self-start md:self-auto
                                            {{ $repair->thing_status === 'ซ่อมสำเร็จ' ? 
                                               'bg-green-100 text-green-800' : 
                                               'bg-amber-100 text-amber-800' }}">
                                            @if($repair->thing_status === 'ซ่อมสำเร็จ')
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                            {{ $repair->thing_status }}
                                        </span>
                                    </div>

                                    <form action="{{ route('updateRepairStatus', $repair->id) }}" method="POST" 
                                          class="mt-4 bg-gray-50 rounded-lg p-6 border border-gray-200 shadow-sm">
                                        @csrf
                                        <div class="flex flex-col sm:flex-row gap-4">
                                            <div class="flex-1">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    ค่าใช้จ่าย
                                                </label>
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                        <span class="text-gray-500">฿</span>
                                                    </div>
                                                    <input type="number" 
                                                           name="expenses_price" 
                                                           placeholder="ระบุจำนวนเงิน" 
                                                           required
                                                           class="pl-8 w-full rounded-lg border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                                </div>
                                            </div>
                                            <button type="submit"
                                                    class="self-end px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-200 flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                บันทึก
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                @endforeach
                            </div>
                        </details>
                    </div>
                    @endforeach
                </div>

                <!-- Empty State -->
                @if($repairCounts->count() === 0)
                <div class="flex flex-col items-center justify-center p-10 bg-white rounded-xl shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                    <h3 class="text-xl font-medium text-gray-700 mb-1">ไม่พบข้อมูลการซ่อม</h3>
                    <p class="text-gray-500">ไม่มีประวัติการซ่อมบำรุงในระบบ</p>
                </div>
                @endif
            </div>
        </main>
    </div>

</body>
</html>
