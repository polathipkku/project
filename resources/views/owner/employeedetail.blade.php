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
    <div style="display: flex; background-color: #F5F3FF;">


        <!-- Sidebar -->
        @include('components.admin_sidebar')
        <!-- --------------------------------------------------------------------------------------------------------------------- -->

        <section class="ml-10 bg-white shadow-lg rounded-lg" id="employee-details" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%;">
            <div class="max-w-screen-xl mx-auto py-10">
                <!-- Header with back button -->
                <div class="px-2 p-2 flex justify-between items-center border-b pb-4">
                    <h1 class="text-3xl font-bold text-gray-800 max-xl:px-4">รายละเอียดพนักงาน</h1>
                    <button class="relative mb-4 group transition-all duration-300" onclick="window.location.href ='/employee'">
                        <div class="flex items-center gap-2">
                            <span class="text-gray-700 group-hover:text-gray-900">กลับ</span>
                            <i class="fa-solid fa-circle-xmark text-3xl text-red-500 group-hover:text-red-600 transition-colors"></i>
                        </div>
                    </button>
                </div>

                <!-- Employee Profile Card -->
                <div class="mt-8 bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="flex flex-col md:flex-row">
                        <!-- Left side - Image and basic info -->
                        <div class="w-full md:w-1/3 bg-gray-50 p-6 flex flex-col items-center justify-start border-r">
                            <div class="relative w-48 h-48 rounded-full overflow-hidden border-4 border-blue-100 shadow-md mb-4">
                                <img src="{{ asset('images/' . $employee->image) }}" alt="{{ $employee->name }}" class="w-full h-full object-cover" />
                            </div>
                            <h2 class="text-2xl font-bold text-gray-800 mt-4">{{ $employee->name }}</h2>
                            <div class="mt-2 px-4 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                {{ $employee->position ?? 'พนักงาน' }}
                            </div>
                            <div class="flex items-center mt-4 text-gray-600">
                                <i class="fa-solid fa-phone mr-2"></i>
                                <span>{{ $employee->tel }}</span>
                            </div>
                            <div class="flex items-center mt-2 text-gray-600">
                                <i class="fa-solid fa-envelope mr-2"></i>
                                <span>{{ $employee->email ?? 'ไม่มีข้อมูล' }}</span>
                            </div>
                        </div>

                        <!-- Right side - Details -->
                        <div class="w-full md:w-2/3 p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Personal Information Section -->
                                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">ข้อมูลส่วนตัว</h3>

                                    <div class="space-y-3">
                                        <div class="flex flex-col">
                                            <span class="text-sm text-gray-500">วันเกิด</span>
                                            <span class="font-medium flex items-center">
                                                <i class="fa-solid fa-cake-candles mr-2 text-blue-500"></i>
                                                @if($employee->birthday && !is_null($employee->birthday))
                                                {{ date('d/m/Y', strtotime($employee->birthday)) }}
                                                @else
                                                ไม่มีข้อมูล
                                                @endif
                                            </span>
                                        </div>

                                        <div class="flex flex-col">
                                            <span class="text-sm text-gray-500">ที่อยู่</span>
                                            <span class="font-medium flex items-start">
                                                <i class="fa-solid fa-location-dot mr-2 mt-1 text-blue-500"></i>
                                                <span>{{ $employee->address ?? 'ไม่มีข้อมูล' }}</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Employment Information Section -->
                                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                                    <h3 class="text-lg font-semibold text-gray-800 border-b pb-2 mb-4">ข้อมูลการทำงาน</h3>

                                    <div class="space-y-3">
                                        <div class="flex flex-col">
                                            <span class="text-sm text-gray-500">วันที่เริ่มทำงาน</span>
                                            <span class="font-medium flex items-center">
                                                <i class="fa-solid fa-calendar-check mr-2 text-green-500"></i>
                                                @if($employee->start_date && !is_null($employee->start_date))
                                                {{ date('d/m/Y', strtotime($employee->start_date)) }}
                                                @else
                                                ไม่มีข้อมูล
                                                @endif
                                            </span>
                                        </div>

                                        <div class="flex flex-col">
                                            <span class="text-sm text-gray-500">กะเวลาทำงาน</span>
                                            <span class="font-medium flex items-center">
                                                <i class="fa-solid fa-clock mr-2 text-green-500"></i>
                                                {{ $employee->work_shift ?? 'ไม่มีข้อมูล' }}
                                            </span>
                                        </div>

                                        <div class="flex flex-col">
                                            <span class="text-sm text-gray-500">วันที่จ่ายเงินเดือน</span>
                                            <span class="font-medium flex items-center">
                                                <i class="fa-solid fa-money-bill-wave mr-2 text-green-500"></i>
                                                @if($employee->payment_date && !is_null($employee->payment_date))
                                                {{ date('d/m/Y', strtotime($employee->payment_date)) }}
                                                @else
                                                ไม่มีข้อมูล
                                                @endif
                                            </span>
                                        </div>

                                        <div class="flex flex-col">
                                            <span class="text-sm text-gray-500">เงินเดือน</span>
                                            <span class="font-medium flex items-center">
                                                <i class="fa-solid fa-coins mr-2 text-yellow-500"></i>
                                                {{ $employee->salary ? number_format($employee->salary, 2) . ' บาท' : 'ไม่มีข้อมูล' }}
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="mt-8">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">ประวัติการทำงาน</h3>

                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-100 text-left">
                                        <th class="px-6 py-3 text-gray-600 font-medium">วันที่</th>
                                        <th class="px-6 py-3 text-gray-600 font-medium">กิจกรรม</th>
                                        <th class="px-6 py-3 text-gray-600 font-medium">หมายเหตุ</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">
                                            @if($employee->start_date && !is_null($employee->start_date))
                                            {{ date('d/m/Y', strtotime($employee->start_date)) }}
                                            @else
                                            ไม่มีข้อมูล
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">เริ่มทำงาน</td>
                                        <td class="px-6 py-4">ตำแหน่ง: {{ $employee->position ?? 'ไม่มีข้อมูล' }}</td>
                                    </tr>
                                    <!-- เพิ่มข้อมูลประวัติการทำงานเพิ่มเติม (ถ้ามี) -->
                                    @if($employee->employmentHistory && $employee->employmentHistory->isNotEmpty())
                                    @foreach($employee->employmentHistory as $history)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4">{{ date('d/m/Y', strtotime($history->date)) }}</td>
                                        <td class="px-6 py-4">{{ $history->activity }}</td>
                                        <td class="px-6 py-4">{{ $history->note }}</td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr class="hover:bg-gray-50">
                                        <td colspan="3" class="px-6 py-4 text-center">ไม่มีข้อมูลประวัติการทำงาน</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
        </section>

    </div>

</body>

</html>