<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <title>Tunthree</title>




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



                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:text-blue-700 hover:text-sm" href="" id="Users">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-user mr-2"></i>Users
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('emroom')}}">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-door-open mr-1"></i>Room
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-blue-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="={{ route('checkin') }}" id="Stock">
                    <div class="mr-2 text-base flex items-center ">
                        <i class="fa-solid fa-person-walking-luggage mr-1"></i>Check In
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('checkout') }}" id="checkout">
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
            <div class="max-w-screen-xl mx-auto py-10">
                <div class="px-2 p-2 flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">Check-In</h1>
                    <input id="checkin-date" type="text" class="flatpickr input px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Select Check-In Date" data-default-date="today" />
                </div>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-l bg-gray-300">
                            <th class="px-4 py-2">ชื่อผู้จอง</th>
                            <th class="px-4 py-2">วันที่เช็คอิน</th>
                            <th class="px-4 py-2">รายละเอียด</th>
                            <th class="px-4 py-2">สถานะ</th>
                            <th class="px-4 py-2" style="padding-right: 5%;">CheckIn</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="booking-rows">
                        @if(isset($bookings) && $bookings->isNotEmpty())
                        @foreach($bookings as $booking)
                        @foreach($booking->bookingDetails->where('room_id', NULL) as $detail)
                        <tr class="booking-row" data-checkin-date="{{ $detail->checkin_date }}">
                            <td class="px-4 py-2">{{ $detail->booking_name }}<br></td>
                            <td class="px-4 py-2">{{ $detail->checkin_date }}</td>
                            <td class="py-2 px-4">
                                <a href="{{ route('checkindetail', ['id' => $booking->id]) }}" class="text-blue-500 hover:text-blue-700">
                                    <button class="py-2 px-4 rounded-md hover:underline focus:outline-none focus:shadow-outline-blue active:text-blue-800" type="button">
                                        detail
                                    </button>
                                </a>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                    <span class="w-2 h-2 me-1 bg-yellow-300 rounded-full mr-1"></span>
                                    {{ $detail->booking_status }}
                                </span>
                            </td>
                            <td class="px-4 py-4 flex justify-center items-center">
                                @if($detail->booking_status === 'รอเลือกห้อง')
                                <form action="{{ route('updateBookingDetail') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                    <select name="room_id" required class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        <option value="" disabled selected>กรุณาเลือกห้องที่ว่าง</option>
                                        @if(isset($rooms) && $rooms->isNotEmpty())
                                        @foreach($rooms as $room)
                                        <option value="{{ $room->id }}">{{ $room->room_name }}</option>
                                        @endforeach
                                        @else
                                        <option value="">ไม่มีห้องที่ว่าง</option>
                                        @endif
                                    </select>
                                    <button class="text-black hover:text-blue-500 ml-2">
                                        <i class="fa-solid fa-square-check"></i>
                                    </button>
                                </form>
                                @else
                                <p class="text-gray-600">ไม่สามารถเช็คอินได้</p>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                        @endforeach
                        @else
                        <p>ไม่พบการจอง</p>
                        @endif

                    </tbody>

                </table>
                <p id="no-bookings-message" class="hidden text-center text-gray-600">ไม่มีรายการที่ต้องเช็คอินในวันนี้</p>
            </div>
        </section>


    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#checkin-date", {
                dateFormat: "Y-m-d",
                defaultDate: new Date(),
                onChange: function(selectedDates, dateStr, instance) {
                    filterBookings(dateStr);
                }
            });

            function filterBookings(selectedDate) {
                const rows = document.querySelectorAll('.booking-row');
                let hasBookings = false;
                rows.forEach(row => {
                    if (row.getAttribute('data-checkin-date') === selectedDate) {
                        row.style.display = '';
                        hasBookings = true;
                    } else {
                        row.style.display = 'none';
                    }
                });

                document.getElementById('no-bookings-message').classList.toggle('hidden', hasBookings);
            }

            // Initialize with today's bookings
            filterBookings(flatpickr.formatDate(new Date(), "Y-m-d"));
        });
    </script>
</body>

</html>