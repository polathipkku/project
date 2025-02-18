<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <title>Tunthree</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.1/chart.min.js"></script>
</head>

<body class="bg-gray-50">
    <div class="flex min-h-screen">
        <!-- Sidebar component here -->
        @include('components.admin_sidebar')
        <div class="flex-1">
            <div class="container mx-auto px-4 py-8">
                <div class="bg-white backdrop-blur-md shadow-lg rounded-xl p-8">
                    <h1 class="text-3xl font-bold mb-8 text-gray-800">แดชบอร์ดการจัดการโรงแรม</h1>

                    <!-- Filter Form -->
                    <div class="bg-gray-50 p-6 rounded-lg mb-8">
                        <form action="{{ route('owner.dashboard') }}" method="GET" class="flex flex-wrap gap-6">
                            <div class="flex-1 min-w-[200px]">
                                <label for="month" class="block text-sm font-medium text-gray-700 mb-2">เดือน</label>
                                <select name="month" id="month" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="1" {{ Carbon\Carbon::parse($startDate)->month == 1 ? 'selected' : '' }}>มกราคม</option>
                                    <option value="2" {{ Carbon\Carbon::parse($startDate)->month == 2 ? 'selected' : '' }}>กุมภาพันธ์</option>
                                    <option value="3" {{ Carbon\Carbon::parse($startDate)->month == 3 ? 'selected' : '' }}>มีนาคม</option>
                                    <option value="4" {{ Carbon\Carbon::parse($startDate)->month == 4 ? 'selected' : '' }}>เมษายน</option>
                                    <option value="5" {{ Carbon\Carbon::parse($startDate)->month == 5 ? 'selected' : '' }}>พฤษภาคม</option>
                                    <option value="6" {{ Carbon\Carbon::parse($startDate)->month == 6 ? 'selected' : '' }}>มิถุนายน</option>
                                    <option value="7" {{ Carbon\Carbon::parse($startDate)->month == 7 ? 'selected' : '' }}>กรกฎาคม</option>
                                    <option value="8" {{ Carbon\Carbon::parse($startDate)->month == 8 ? 'selected' : '' }}>สิงหาคม</option>
                                    <option value="9" {{ Carbon\Carbon::parse($startDate)->month == 9 ? 'selected' : '' }}>กันยายน</option>
                                    <option value="10" {{ Carbon\Carbon::parse($startDate)->month == 10 ? 'selected' : '' }}>ตุลาคม</option>
                                    <option value="11" {{ Carbon\Carbon::parse($startDate)->month == 11 ? 'selected' : '' }}>พฤศจิกายน</option>
                                    <option value="12" {{ Carbon\Carbon::parse($startDate)->month == 12 ? 'selected' : '' }}>ธันวาคม</option>
                                </select>
                            </div>

                            <div class="flex-1 min-w-[200px]">
                                <label for="year" class="block text-sm font-medium text-gray-700 mb-2">ปี</label>
                                <select name="year" id="year" class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    @for ($i = Carbon\Carbon::now()->year; $i >= Carbon\Carbon::now()->year - 5; $i--)
                                    <option value="{{ $i }}" {{ Carbon\Carbon::parse($startDate)->year == $i ? 'selected' : '' }}>
                                        {{ $i + 543 }}
                                    </option>
                                    @endfor
                                </select>
                            </div>

                            <div class="flex items-end">
                                <button type="submit" class="p-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                                    <i class="fas fa-search mr-2"></i>ค้นหา
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Key Metrics Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        <!-- Revenue Card -->
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                            <div class="flex items-center">
                                <div class="p-3 bg-blue-100 rounded-lg">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-500">รายได้รวม</p>
                                    <p class="text-xl font-bold text-gray-800">฿{{ number_format($totalRevenueWithDamages, 2) }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Expenses Card -->
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                            <div class="flex items-center">
                                <div class="p-3 bg-red-100 rounded-lg">
                                    <svg class="w-6 h-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-500">รายจ่าย</p>
                                    <p class="text-xl font-bold text-gray-800">{{ number_format($totalExpensesWithSalaries, 2) }} บาท</p>
                                </div>
                            </div>
                        </div>

                        <!-- Available Rooms Card -->
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                            <div class="flex items-center">
                                <div class="p-3 bg-yellow-100 rounded-lg">
                                    <svg class="w-6 h-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-500">ห้องว่าง</p>
                                    <p class="text-xl font-bold text-gray-800">{{ $roomsAvailable }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Bookings Card -->
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                            <div class="flex items-center">
                                <div class="p-3 bg-purple-100 rounded-lg">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm text-gray-500">ยอดการจอง</p>
                                    <p class="text-xl font-bold text-gray-800">{{ $bookingsCount }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts Grid -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Monthly Revenue Chart -->
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                            <h2 class="text-lg font-semibold mb-4 text-gray-800">รายได้รายเดือน</h2>
                            <div class="relative" style="height: 0; padding-bottom: 60%;">
                                <canvas id="revenueChart" class="absolute inset-0 w-full h-full"></canvas>
                            </div>
                        </div>

                        <!-- Occupancy Chart -->
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                            <h2 class="text-lg font-semibold mb-4 text-gray-800">จำนวนการเข้าพัก</h2>
                            <div class="relative" style="height: 0; padding-bottom: 60%;">
                                <canvas id="occupancyChart" class="absolute inset-0 w-full h-full"></canvas>
                            </div>
                        </div>

                        <!-- Daily Occupancy Chart -->
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                            <h2 class="text-lg font-semibold mb-4 text-gray-800">จำนวนการเข้าพักตามวันของสัปดาห์</h2>
                            <div class="relative" style="height: 0; padding-bottom: 60%;">
                                <canvas id="dailyOccupancyChart" class="absolute inset-0 w-full h-full"></canvas>
                            </div>
                        </div>

                        <!-- Expense Categories Chart -->
                        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                            <h2 class="text-lg font-semibold mb-4 text-gray-800">รายจ่ายแยกหมวดหมู่</h2>
                            <div class="relative" style="height: 0; padding-bottom: 60%;">
                                <canvas id="expenseCategoriesChart" class="absolute inset-0 w-full h-full"></canvas>
                            </div>
                        </div>
                    </div>
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
                        },
                        {
                            label: 'รายจ่าย (บาท)',
                            data: @json($expensesData),
                            backgroundColor: 'rgba(255, 99, 132, 0.5)',
                            borderColor: 'rgb(255, 99, 132)',
                            borderWidth: 1
                        }
                    ]
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
            new Chart(document.getElementById('dailyOccupancyChart'), {
                type: 'bar',
                data: {
                    labels: @json($dailyOccupancy['labels']),
                    datasets: [{
                        label: 'จำนวนการเข้าพัก',
                        data: @json($dailyOccupancy['data']),
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    indexAxis: 'y', // This makes it a horizontal bar chart
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
            // Polar Area Chart for Expenses
            new Chart(document.getElementById('expenseCategoriesChart'), {
                type: 'doughnut',
                data: {
                    labels: Object.keys(@json($expenseCategories)),
                    datasets: [{
                        label: 'ค่าใช้จ่าย (บาท)',
                        data: Object.values(@json($expenseCategories)),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.6)',
                            'rgba(54, 162, 235, 0.6)',
                            'rgba(255, 206, 86, 0.6)',
                            'rgba(75, 192, 192, 0.6)',
                            'rgba(153, 102, 255, 0.6)'
                        ]
                    }]
                },
                options: {
                    responsive: true,
                    aspectRatio: 3, // ปรับอัตราส่วนให้สูงกว่ากว้างเพื่อให้กราฟใหญ่ขึ้น
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'รายจ่ายแยกตามหมวดหมู่'
                        }
                    },
                    layout: {
                        padding: {
                            top: 10,
                            right: 10,
                            bottom: 10,
                            left: 10
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
            clickOpens: true // เปิดปฏิทินเมื่อคลิก
        });

        flatpickr("#end_date", {
            dateFormat: "d/m/Y",
            allowInput: false, // ไม่อนุญาตให้พิมพ์
            clickOpens: true // เปิดปฏิทินเมื่อคลิก
        });
    </script>

</body>

</html>