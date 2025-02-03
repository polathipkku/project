<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <title>Tunthree</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
</head>

<body class="bg-gray-50">
    <div class="flex my-2">
        @include('components.admin_sidebar')
        <div class="flex-1 p-6 bg-white backdrop-blur-md shadow-lg rounded-xl mx-6 w-full">
            <h1 class="text-2xl font-bold mb-6">แดชบอร์ดการจัดการโรงแรม</h1>
            <form action="{{ route('owner.dashboard') }}" method="GET" class="flex items-center mb-6">
                <div class="mr-4">
                    <label for="start_date" class="text-sm text-gray-500">วันที่เริ่มต้น</label>
                    <input type="text" name="start_date" id="start_date" class="ml-2 p-2 border rounded"
                        value="{{ $startDate->format('d/m/Y') }}">
                </div>
                <div class="mr-4">
                    <label for="end_date" class="text-sm text-gray-500">วันที่สิ้นสุด</label>
                    <input type="text" name="end_date" id="end_date" class="ml-2 p-2 border rounded"
                        value="{{ $endDate->format('d/m/Y') }}">
                </div>
                <button type="submit" class="p-2 bg-blue-600 text-white rounded">ค้นหา</button>
            </form>

            <!-- Key Metrics -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <!-- รายได้วันนี้ -->
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">รายได้</p>
                            <p class="text-xl font-bold">฿{{ number_format($totalRevenue, 2) }}</p>
                        </div>
                    </div>
                </div>

                <!-- จำนวนลูกค้า -->
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">จำนวนลูกค้าเช็คอิน</p>
                            <p class="text-xl font-bold">{{ $bookingsCount }}</p>
                        </div>
                    </div>
                </div>

                <!-- ห้องว่าง -->
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-yellow-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">ห้องว่าง</p>
                            <p class="text-xl font-bold">{{ $roomsAvailable }}</p>
                        </div>
                    </div>
                </div>

                <!-- การจอง -->
                <div class="bg-white rounded-lg shadow p-4">
                    <div class="flex items-center">
                        <div class="p-2 bg-purple-100 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm text-gray-500">ยอดการจอง</p>
                            <p class="text-xl font-bold">{{ $bookingsCount }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- รายได้รายเดือน -->
                <div class="bg-white rounded-lg shadow p-4">
                    <h2 class="text-lg font-semibold mb-4">รายได้รายเดือน</h2>
                    <canvas id="revenueChart"></canvas>
                </div>

                <!-- อัตราการเข้าพัก -->
                <div class="bg-white rounded-lg shadow p-4">
                    <h2 class="text-lg font-semibold mb-4">จำนวนการเข้าพัก</h2>
                    <canvas id="occupancyChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new Chart(document.getElementById('revenueChart'), {
                type: 'bar',
                data: {
                    labels: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.',
                        'ต.ค.', 'พ.ย.', 'ธ.ค.'
                    ],
                    datasets: [{
                        label: 'รายได้ (บาท)',
                        data: @json($revenueData),
                        backgroundColor: 'rgba(99, 102, 241, 0.5)',
                        borderColor: 'rgb(99, 102, 241)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            new Chart(document.getElementById('occupancyChart'), {
                type: 'line',
                data: {
                    labels: @json($dates),
                    datasets: [{
                        label: 'จำนวนผู้เข้าพัก',
                        data: @json($guestData),
                        borderColor: 'rgb(34, 197, 94)',
                        tension: 0.1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
      flatpickr("#start_date", {
        dateFormat: "d/m/Y",
        allowInput: false, // ไม่อนุญาตให้พิมพ์
        clickOpens: true   // เปิดปฏิทินเมื่อคลิก
    });

    flatpickr("#end_date", {
        dateFormat: "d/m/Y",
        allowInput: false, // ไม่อนุญาตให้พิมพ์
        clickOpens: true   // เปิดปฏิทินเมื่อคลิก
    });
    </script>
    
</body>

</html>
