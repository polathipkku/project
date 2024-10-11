<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">


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

                <a class="inline-block py-2 px-3 text-blue-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-door-open mr-1"></i>Room
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('checkin') }}" id="Stock">
                    <div class="mr-2 text-base flex items-center ">
                        <i class="fa-solid fa-person-walking-luggage mr-1"></i>Check In
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('checkout') }}" id="Stock">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-person-walking-luggage fa-flip-horizontal mr-1"></i>Check Out
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="#" id="Stock">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-house-circle-check mr-1"></i>Stock
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('maintenanceroom') }}" id="maintenanceroom">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-tools mr-1"></i>Maintenance
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

        <section class="ml-10 bg-white" id="room-table" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); ">
            <div class="max-w-screen-xl mx-auto py-10 ">
                <div class="px-2 p-2 flex justify-between items-center mb-4">
                    <h1 class="text-4xl mb-10 max-xl:px-4">ห้อง</h1>
                    <button id="openCalendarModal" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fa-solid fa-calendar-days mr-2"></i>ตรวจสอบการจอง
                    </button>
                </div>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-l bg-gray-300">
                            <th class="px-4 py-2">หมายเลขห้อง</th>
                            <th class="px-4 py-2">สถานะ</th>
                            <th class="px-4 py-2">รายละเอียด</th>
                            <th class="px-4 py-2">จองห้องพัก</th>
                            <th class="px-4 py-2">ยืนยันทำความสะอาด</th>
                            <th class="px-4 py-2">แจ้งซ่อม</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($rooms as $room)
                        <tr class="">
                            <td class="px-4 py-2">{{ $room->room_name }}</td>
                            <td class="px-4 py-2">
                                @if($room->room_status === 'ไม่พร้อมให้บริการ')
                                <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                    <span class="w-2 h-2 me-1 bg-red-300 rounded-full mr-1"></span>
                                    ไม่ว่าง
                                </span>
                                @elseif($room->room_status === 'แจ้งซ่อมห้อง')
                                <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                    <span class="w-2 h-2 me-1 bg-red-300 rounded-full mr-1"></span>
                                    แจ้งซ่อมห้อง
                                </span>
                                @elseif($room->room_status === 'รอทำความสะอาด')
                                <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                    <span class="w-2 h-2 me-1 bg-yellow-300 rounded-full mr-1"></span>
                                    รอทำความสะอาด
                                </span>
                                @elseif($room->booking_status !== 'ทำการจอง' && $room->booking_status !== 'รอชำระเงิน' && $room->booking_status !== 'เช็คอินแล้ว')
                                <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                    <span class="w-2 h-2 me-1 bg-green-300 rounded-full mr-1"></span>
                                    ว่าง
                                </span>
                                @else
                                <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                    <span class="w-2 h-2 me-1 bg-red-300 rounded-full mr-1"></span>
                                    ไม่ว่าง
                                </span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <a href="" class="text-blue-500 hover:text-blue-700">Detail</a>
                            </td>
                            <td class="px-4 py-2">
                                <a href="/em_reserve/{{ $room->id }}" class="text-black hover:text-blue-500">
                                    <i class="fa-solid fa-book-open"></i>
                                </a>
                            </td>
                            <td class="px-4 py-2">
                                @if($room->room_status === 'รอทำความสะอาด')
                                <form action="{{ route('cleanroom', $room->id) }}" method="post">
                                    @csrf
                                    <button class="text-black hover:text-blue-500" type="submit">
                                        <i class="fa-solid fa-bucket"></i>
                                    </button>
                                </form>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                <a href="/maintenance/{{ $room->id }}" class="text-black hover:text-blue-500">
                                    <i class="fa-solid fa-tools"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Calendar Modal -->
            <div id="calendarModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                เลือกวันที่ต้องการตรวจสอบ
                            </h3>
                            <div class="mt-2">
                                <div class="mb-4">
                                    <label for="checkin-date" class="block text-sm font-medium text-gray-700">วันเช็คอิน</label>
                                    <input type="date" id="checkin-date" name="checkin_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <div class="mb-4">
                                    <label for="checkout-date" class="block text-sm font-medium text-gray-700">วันเช็คเอาท์</label>
                                    <input type="date" id="checkout-date" name="checkout_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" id="checkAvailability" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                ตรวจสอบการจองทั้งหมด
                            </button>
                            <button type="button" id="closeCalendarModal" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                ยกเลิก
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="resultModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="result-modal-title">
                                ผลการตรวจสอบห้องว่าง
                            </h3>
                            <div id="bookingResults" class="mt-6">
                                <!-- Results will be dynamically inserted here -->
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button" id="closeResultModal" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                ปิด
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="toast" class="hidden">
            <div id="toast-success" class=" flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                    </svg>
                    <span class="sr-only">Check icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">Item moved successfully.</div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <div id="toast-danger" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                    </svg>
                    <span class="sr-only">Error icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">Item has been deleted.</div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
            <div id="toast-warning" class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                    </svg>
                    <span class="sr-only">Warning icon</span>
                </div>
                <div class="ms-3 text-sm font-normal">Improve password difficulty.</div>
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-warning" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
    </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const openCalendarModal = document.getElementById('openCalendarModal');
            const calendarModal = document.getElementById('calendarModal');
            const closeCalendarModal = document.getElementById('closeCalendarModal');
            const checkAvailability = document.getElementById('checkAvailability');
            const resultModal = document.getElementById('resultModal');
            const closeResultModal = document.getElementById('closeResultModal');
            const checkinDateInput = document.getElementById('checkin-date');
            const checkoutDateInput = document.getElementById('checkout-date');

            openCalendarModal.addEventListener('click', () => {
                calendarModal.classList.remove('hidden');
            });

            closeCalendarModal.addEventListener('click', () => {
                calendarModal.classList.add('hidden');
            });

            closeResultModal.addEventListener('click', () => {
                resultModal.classList.add('hidden');
            });

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
                        const bookingResults = document.getElementById('bookingResults');
                        bookingResults.innerHTML = ''; // Clear previous results

                        // Display the number of bookings
                        const bookingCount = data.pendingBookings.length;
                        const bookingCountMessage = document.createElement('p');
                        bookingCountMessage.className = 'text-center text-sm font-light mb-2';
                        bookingCountMessage.innerText = `จำนวนการจอง: ${bookingCount} การจองในช่วงเวลา ${checkinDate} ถึง ${checkoutDate}`;
                        bookingResults.appendChild(bookingCountMessage);

                        if (bookingCount > 0) {
                            const table = document.createElement('table');
                            table.className = 'min-w-full bg-white border border-gray-200 shadow-md rounded-lg';
                            table.innerHTML = `
                    <table class="table-auto border-collapse w-full text-sm">
                        <thead>
                            <tr>
                                <th class="px-2 py-1 border-b text-sm">No.</th>
                                <th class="px-2 py-1 border-b text-sm">ชื่อ</th>
                                <th class="px-2 py-1 border-b text-sm">Check-in Date</th>
                                <th class="px-2 py-1 border-b text-sm">Check-out Date</th>
                                <th class="px-2 py-1 border-b text-sm">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${data.pendingBookings.map((booking, index) => `
                            <tr class="bg-gray-100 hover:bg-gray-200 transition-colors duration-200">
                                 <td class="px-1 py-1 border-b text-center text-xs font-medium">${index + 1}</td>
                                 <td class="px-2 py-1 border-b text-sm">${booking.booking_name}</td>
                                 <td class="px-2 py-1 border-b text-sm">${booking.checkin_date}</td>
                                 <td class="px-2 py-1 border-b text-sm">${booking.checkout_date}</td>
                                 <td class="px-2 py-1 border-b text-sm">${booking.booking_status}</td>
                            </tr>

                            `).join('')}
                        </tbody>
                    </table>
                `;
                            bookingResults.appendChild(table);
                        } else {
                            bookingResults.innerHTML = '<p class="text-center text-lg font-semibold text-red-500">ไม่มีการจองให้ช่วงเวลาดังกล่าว.</p>';
                        }

                        calendarModal.classList.add('hidden');
                        resultModal.classList.remove('hidden');
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