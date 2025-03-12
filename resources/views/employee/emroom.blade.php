<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <title>Tunthree</title>


    <script>
        function showToast(toastId) {
            var toast = document.getElementById(toastId);
            toast.classList.remove('toast');
            setTimeout(function() {
                toast.classList.add('toast');
            }, 3000); // แสดง toast นาน 3 วินาที (3000 มิลลิวินาที)
        }
    </script>

</head>

<body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>

    <div style="display: flex; background-color: #F5F3FF;">

        @include('components.em_sidebar')


        <section class="ml-10 bg-white" id="room-table"
            style="width:1100px; padding-left: 2.5%; padding-right: 2.5%; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); ">
            <div class="max-w-screen-xl mx-auto py-10 ">
                <div class="px-2 p-2 flex justify-between items-center mb-4">
                    <h1
                        class="text-3xl font-bold text-gray-800 bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">
                        ห้อง
                    </h1>

                    <div class="flex flex-wrap gap-4">
                        <!-- Check-in date picker -->
                        <div class="flex flex-col">
                            <span class="font-medium text-gray-700 mb-1.5 text-sm">เช็คอิน</span>
                            <div class="relative">
                                <input type="text" id="checkin-date"
                                    class="border border-gray-300 rounded-lg px-3 py-2 pr-10 bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 shadow-sm"
                                    readonly>
                                <i
                                    class="fa-regular fa-calendar absolute right-3 top-1/2 transform -translate-y-1/2 text-indigo-500 pointer-events-none"></i>
                            </div>
                            <input type="hidden" id="startDate" name="startDate">
                        </div>

                        <!-- Check-out date picker -->
                        <div class="flex flex-col">
                            <span class="font-medium text-gray-700 mb-1.5 text-sm">เช็คเอาท์</span>
                            <div class="relative">
                                <input type="text" id="checkout-date"
                                    class="border border-gray-300 rounded-lg px-3 py-2 pr-10 bg-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all duration-200 shadow-sm"
                                    readonly>
                                <i
                                    class="fa-regular fa-calendar absolute right-3 top-1/2 transform -translate-y-1/2 text-indigo-500 pointer-events-none"></i>
                            </div>
                            <input type="hidden" id="endDate" name="endDate">
                            <input type="hidden" id="totalDay" name="totalDay">
                        </div>

                        <!-- Check availability button -->
                        <button id="checkAvailability"
                            class="bg-gradient-to-r from-indigo-500 to-blue-600 hover:from-indigo-600 hover:to-blue-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:-translate-y-1 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50 shadow-md flex items-center self-end">
                            <i class="fa-solid fa-calendar-days mr-2"></i>ตรวจสอบการจอง
                        </button>
                    </div>
                </div>
                <p id="bookingCount" class="text-lg font-medium text-gray-700 mt-4"></p>
            </div>

            <!-- Room table with improved styling but preserved dimensions -->
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gradient-to-r from-blue-100 to-indigo-200 text-left">
                                <th class="text-center px-4 py-3 text-sm font-semibold text-gray-700 rounded-tl-lg">
                                    หมายเลขห้อง</th>
                                <th class="text-center px-4 py-3 text-sm font-semibold text-gray-700">สถานะ</th>
                                <th class="text-center px-4 py-3 text-sm font-semibold text-gray-700">ยืนยันทำความสะอาด</th>
                                <th class="text-center px-4 py-3 text-sm font-semibold text-gray-700">แจ้งซ่อม</th>
                                <th class="text-center px-4 py-3 text-sm font-semibold text-gray-700 rounded-tr-lg">
                                    จองห้องพัก</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                                <tr class="border-b border-gray-100 hover:bg-indigo-50 transition-colors duration-150">
                                    <td class="px-4 py-4 text-gray-800 font-medium text-center">{{ $room->room_name }}</td>
                                    <td class="px-4 py-4 text-center">
                                        @if ($room->room_status === 'ไม่พร้อมให้บริการ')
                                            <span
                                                class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-1 rounded-full">
                                                <span
                                                    class="w-2 h-2 me-1 bg-red-500 rounded-full mr-1.5 pulse-dot"></span>
                                                ไม่ว่าง
                                            </span>
                                        @elseif($room->room_status === 'แจ้งซ่อมห้อง')
                                            <span
                                                class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-1 rounded-full">
                                                <span
                                                    class="w-2 h-2 me-1 bg-red-500 rounded-full mr-1.5 pulse-dot"></span>
                                                แจ้งซ่อมห้อง
                                            </span>
                                        @elseif($room->room_status === 'รอทำความสะอาด')
                                            <span
                                                class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-1 rounded-full">
                                                <span
                                                    class="w-2 h-2 me-1 bg-yellow-400 rounded-full mr-1.5 pulse-dot"></span>
                                                รอทำความสะอาด
                                            </span>
                                        @elseif($room->room_status === 'พร้อมให้บริการ')
                                            <span
                                                class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full">
                                                <span
                                                    class="w-2 h-2 me-1 bg-green-500 rounded-full mr-1.5 pulse-dot"></span>
                                                ว่าง
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-1 rounded-full">
                                                <span
                                                    class="w-2 h-2 me-1 bg-red-500 rounded-full mr-1.5 pulse-dot"></span>
                                                ไม่ว่าง
                                            </span>
                                        @endif
                                    </td>
                                  

                                    <td class="px-4 py-4 text-center">
                                        @if ($room->room_status === 'รอทำความสะอาด')
                                            <form action="{{ route('cleanroom', $room->id) }}" method="post">
                                                @csrf
                                                <button
                                                    class="text-indigo-600 hover:text-indigo-800 transition duration-150 focus:outline-none tooltip-container"
                                                    type="submit">
                                                    <i
                                                        class="fa-solid fa-bucket bg-indigo-100 text-indigo-600 p-2 rounded-full hover:bg-indigo-200 transition"></i>
                                                    <span class="tooltip">ยืนยันทำความสะอาด</span>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 text-center">
                                        <a href="/maintenance/{{ $room->id }}"
                                            class="text-amber-600 hover:text-amber-800 transition duration-150 focus:outline-none tooltip-container">
                                            <i
                                                class="fa-solid fa-tools bg-amber-100 text-amber-600 p-2 rounded-full hover:bg-amber-200 transition"></i>
                                            <span class="tooltip">แจ้งซ่อม</span>
                                        </a>
                                    </td>
                                    <td class="px-4 py-4 text-center" data-room-status="{{ $room->room_status }}">
                                        @if ($room->room_status === 'พร้อมให้บริการ')
                                            <a href="#"
                                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-400 text-white font-medium text-sm rounded-lg hover:from-green-600 hover:to-emerald-700 transition duration-300 ease-in-out transform hover:-translate-y-1 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 shadow-sm book-button"
                                                onclick="event.preventDefault(); 
                                        var checkinDate = encodeURIComponent(document.getElementById('checkin-date').value);
                                        var checkoutDate = encodeURIComponent(document.getElementById('checkout-date').value);
                                        window.location='/em_reserve/{{ $room->id }}?checkin_date=' + checkinDate + '&checkout_date=' + checkoutDate;">
                                                <i class="fa-solid fa-book-open mr-2"></i> จอง
                                            </a>
                                        @else
                                            <button disabled
                                                class="inline-flex items-center px-4 py-2 bg-gray-400 text-white font-medium text-sm rounded-lg cursor-not-allowed opacity-70">
                                                <i class="fa-solid fa-book-open mr-2"></i> ไม่พร้อมให้จอง
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Booking Information Table with improved styling but preserved dimensions -->
            <div id="bookingResults" class="p-6 hidden border-t border-gray-100">
                <h2
                    class="text-2xl font-bold text-gray-800 mb-6 bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">
                    ข้อมูลการจอง</h2>
                <p id="bookingCount" class="mb-4 text-gray-600"></p>

                <div class="overflow-x-auto bg-white rounded-xl shadow-sm border border-gray-200">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class="bg-gradient-to-r from-blue-100 to-indigo-200 text-left border-b border-gray-200">
                                <th class="text-center px-4 py-3 text-sm font-semibold text-gray-700">ชื่อ</th>
                                <th class="text-center px-4 py-3 text-sm font-semibold text-gray-700">
                                    วันที่ลูกค้าเลือกเช็คอิน</th>
                                <th class="text-center px-4 py-3 text-sm font-semibold text-gray-700">
                                    วันที่ลูกค้าเลือกเช็คเอาท์</th>
                                <th class="text-center px-4 py-3 text-sm font-semibold text-gray-700">สถานะ</th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody id="bookingTableBody">
                            <!-- Rows will be dynamically inserted here -->
                        </tbody>
                    </table>
                </div>
            </div>
    </div>
    </section>

    <!-- Custom CSS for additional effects while preserving original dimensions -->
    <style>
        /* Custom pulse animation for status indicators */
        @keyframes pulseEffect {
            0% {
                transform: scale(1);
                opacity: 0.8;
            }

            50% {
                transform: scale(1.1);
                opacity: 1;
            }

            100% {
                transform: scale(1);
                opacity: 0.8;
            }
        }

        .pulse-dot {
            animation: pulseEffect 2s infinite ease-in-out;
        }

        /* Smooth hover transitions */
        a,
        button {
            transition: all 0.2s ease-in-out;
        }

        /* Custom scrollbar for tables */
        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Card hover effect */
        .bg-white {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* Tooltips for icon buttons */
        .tooltip-container {
            position: relative;
        }

        .tooltip {
            visibility: hidden;
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: white;
            text-align: center;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.3s;
            z-index: 10;
            margin-bottom: 5px;
        }

        .tooltip-container:hover .tooltip {
            visibility: visible;
            opacity: 1;
        }


        /* Add subtle shadow to table rows on hover */
        tbody tr:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }
    </style>
  
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkAvailability = document.getElementById('checkAvailability');
            const checkinDateInput = document.getElementById('checkin-date');
            const checkoutDateInput = document.getElementById('checkout-date');
            const bookingResults = document.getElementById('bookingResults');
            const bookingTableBody = document.getElementById('bookingTableBody');
            const bookingCount = document.getElementById('bookingCount');
            const valuestartdate = document.getElementById('startDate');
            const valueenddate = document.getElementById('endDate');
            const totalDay = document.getElementById('totalDay');

            // กำหนด flatpickr สำหรับเลือกวันที่ check-in และ check-out
            flatpickr(checkinDateInput, {
                dateFormat: 'd-m-Y',
                locale: 'th',
                minDate: 'today',
                mode: 'range',
                defaultDate: [new Date(), new Date(Date.now() +
                    86400000)], // Set default to today and tomorrow
                onChange: function(array, str, instance) {
                    if (array.length === 2) {
                        var startDate = array[0];
                        var endDate = array[1];
                        var strStartDate = instance.formatDate(startDate, 'd-m-Y');
                        var strEndDate = instance.formatDate(endDate, 'd-m-Y');

                        // Update hidden fields and input fields with selected dates
                        valuestartdate.value = strStartDate;
                        valueenddate.value = strEndDate;
                        checkinDateInput.value = strStartDate;
                        checkoutDateInput.value = strEndDate;

                        // Calculate total stay days
                        var timeDiff = endDate - startDate;
                        var totalDays = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
                        totalDay.value = totalDays;
                        document.getElementById('stay-days').textContent = totalDays + " วัน";

                        // Call the check availability function automatically
                        checkAvailability.click();
                    }
                }
            });

            // ตรวจสอบการเลือกวันเมื่อโหลดหน้า และตรวจสอบห้องพักโดยอัตโนมัติ
            window.onload = function() {
                const today = new Date();
                const tomorrow = new Date(Date.now() + 86400000);

                // แปลงวันที่เป็น d-m-Y
                const formattedToday = flatpickr.formatDate(today, 'd-m-Y');
                const formattedTomorrow = flatpickr.formatDate(tomorrow, 'd-m-Y');

                // กำหนดค่าลง input
                checkinDateInput.value = formattedToday;
                checkoutDateInput.value = formattedTomorrow;

                valuestartdate.value = formattedToday;
                valueenddate.value = formattedTomorrow;

                checkAvailability.click(); // ตรวจสอบห้องพักเมื่อโหลดหน้า
            };


            checkAvailability.addEventListener('click', () => {
                const checkinDate = checkinDateInput.value;
                const checkoutDate = checkoutDateInput.value;

                if (!checkinDate || !checkoutDate) {
                    alert('Please select both check-in and check-out dates.');
                    return;
                }

                // Make an AJAX request to the server
                fetch(`/pending-room-selection?checkin_date=${checkinDate}&checkout_date=${checkoutDate}`)
                    .then(response => response.json())
                    .then(data => {
                        bookingCount.textContent =
                            `จำนวนการจอง: ${data.bookingCount} การจองในช่วงเวลา ${checkinDate} ถึง ${checkoutDate}`;

                        // Clear previous booking rows
                        bookingTableBody.innerHTML = '';

                        // Group bookings by booking_name
                        const groupedBookings = data.pendingBookings.reduce((acc, booking) => {
                            if (!acc[booking.booking_name]) {
                                acc[booking.booking_name] = {
                                    ...booking,
                                    count: 1
                                };
                            } else {
                                acc[booking.booking_name].count += 1;
                            }
                            return acc;
                        }, {});

                        // Add grouped booking rows
                        Object.values(groupedBookings).forEach((booking, index) => {
                            const row = document.createElement('tr');
                            row.className =
                                'bg-white border-b border-gray-200 hover:bg-gray-100 transition-colors duration-200';
                            row.innerHTML = `
                <td class="px-4 py-2 text-center">
                    ${booking.booking_name} 
                    ${booking.count > 1 ? `<span class="text-red-500 text-xs">(${booking.count})</span>` : ''}
                </td>
                <td class="px-4 py-2 text-center">${booking.checkin_date}</td>
                <td class="px-4 py-2 text-center">${booking.checkout_date}</td>
                <td class="px-4 py-2 text-center">
                    <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                        <span class="w-2 h-2 bg-yellow-300 rounded-full mr-1"></span>
                        ${booking.booking_detail_status}
                    </span>
                </td>`;
                            bookingTableBody.appendChild(row);
                        });

                        // เช็คเงื่อนไขสำหรับปุ่มจอง
                        const availableRooms = document.querySelectorAll(
                            '[data-room-status="พร้อมให้บริการ"]');
                        if (availableRooms.length > 0) {
                            // จำกัดการจองตามจำนวน bookingCount
                            availableRooms.forEach((room, index) => {
                                const bookButton = room.querySelector('.book-button');
                                if (index < data.bookingCount) {
                                    // ถ้าดัชนีห้องน้อยกว่า bookingCount ให้ปิดปุ่มจอง
                                    if (bookButton) {
                                        bookButton.outerHTML = `
                            <button disabled
                                class="inline-flex items-center px-4 py-2 bg-gray-500 text-white font-semibold text-sm rounded-md cursor-not-allowed">
                                <i class="fa-solid fa-book-open mr-2"></i> ไม่พร้อมให้จอง
                            </button>`;
                                    }
                                }
                            });
                        }

                        // Show the booking results section
                        bookingResults.classList.remove('hidden');
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while fetching the booking data.');
                    });

            });
        });
    </script>

    </div>
</body>

</html>
