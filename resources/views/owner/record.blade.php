<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="/src/hero.css">
    <title>Tunthree</title>
</head>

<body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>

    <div style="display: flex; background-color: #F5F3FF;">

        @include('components.admin_sidebar')

        <section class="mx-10 bg-white w-4/5">
            <div class="mx-4 py-10 p-5 mb-10">
                <h1 class="text-5xl mb-10 max-xl:px-4">ประวัติการจอง</h1>

                <!-- Flex container for "ค้นหา" (left) and "ปฏิทินการจอง" (right) -->
                <div class="flex items-center justify-between mb-6">
                    <!-- Form for search on the left -->
                    <form action="{{ route('record') }}" method="GET" class="flex items-center space-x-4">
                        <div class="flex flex-col">
                            <label for="start_date" class="block text-gray-700">วันที่เริ่มต้น</label>
                            <input type="text" id="start_date" name="start_date" class="flatpickr-input bg-gray-100 border border-gray-300 rounded-lg py-2 px-3 w-full lg:w-80" placeholder="เลือกวันที่เริ่มต้น" readonly>
                        </div>
                        <div class="flex flex-col">
                            <label for="end_date" class="block text-gray-700">วันที่สิ้นสุด</label>
                            <input type="text" id="end_date" name="end_date" class="flatpickr-input bg-gray-100 border border-gray-300 rounded-lg py-2 px-3 w-full lg:w-80" placeholder="เลือกวันที่สิ้นสุด" readonly>
                        </div>
                        <button type="submit" class="py-2 px-4 mt-6 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                            ค้นหา
                        </button>
                    </form>

                    <!-- Link for "ปฏิทินการจอง" on the right -->
                    <a class="py-2 px-5 text-gray-700 no-underline lg:flex lg:flex-col items-center justify-center transition duration-300 ease-in-out hover:bg-blue-600 hover:text-white hover:scale-105 transform rounded-lg shadow-lg"
                        href="{{ route('calendar') }}" id="Promotion">
                        <div class="mr-2 text-base flex items-center space-x-2">
                            <i class="fa-solid fa-calendar-alt mr-1 text-xl"></i>
                            <span class="font-semibold text-lg">ปฏิทินการจอง</span>
                        </div>
                    </a>

                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        flatpickr("#start_date", {
                            dateFormat: "d-m-Y",
                        });
                        flatpickr("#end_date", {
                            dateFormat: "d-m-Y",
                        });
                    });
                </script>
            </div>



            <div class="grid justify-items-stretch max-lg:grid-cols-1 max-xl:px-4">
                <div class="grid max-lg:grid-cols-1">
                    @if (count($bookings) > 0)
                    <div class="content">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            @php
                            $groupedBookings = $bookings->groupBy('booking_id');
                            @endphp
                            <table class="w-full text-x text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-3 py-3 text-center">หมายเลขการจอง</th>
                                        <th scope="col" class="px-3 py-3 text-center">ชื่อผู้จอง</th>
                                        <th scope="col" class="px-3 py-3 text-center">วันที่เช็คอิน</th>
                                        <th scope="col" class="px-3 py-3 text-center">วันที่เช็คเอาท์</th>
                                        <th scope="col" class="px-3 py-3 text-center">ประเภทห้องพัก</th>
                                        <th scope="col" class="px-3 py-3 text-center">สถานะการจอง</th>
                                        <th scope="col" class="px-3 py-3 text-center">จำนวนเตียงเสริม</th>
                                        <th scope="col" class="px-3 py-3 text-center">ราคารวม</th>
                                        <th scope="col" class="px-3 py-3 text-center">รายละเอียดเพิ่มเติม</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($groupedBookings as $bookingId => $bookings)
                                    @php
                                    $firstBooking = $bookings->first();
                                    $hasDuplicates = $bookings->count() > 1;
                                    @endphp
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-center"
                                        data-booking-id="{{ $bookingId }}"
                                        onclick="toggleDropdown(this.dataset.bookingId);">
                                        <th scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                            {{ $bookingId }}
                                        </th>
                                        <td class="px-3 py-4 text-center">{{ $firstBooking->booking_name }} @if ($hasDuplicates) <span class="text-red-500">({{ $bookings->count() }})</span> @endif </td>
                                        <td class="px-3 py-4 text-center">{{ \Carbon\Carbon::parse($firstBooking->checkin_date)->format('d-m-y') }}</td>
                                        <td class="px-3 py-4 text-center">{{ \Carbon\Carbon::parse($firstBooking->checkout_date)->format('d-m-y') }}</td>

                                        <td class="px-3 py-4 text-center">{{ $firstBooking->room_type }}</td>
                                        <td class="px-3 py-4 text-center">
                                            @if ($firstBooking->booking_detail_status === 'ทำการจอง')
                                            <span class="mr-2 inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">ทำการจอง</span>
                                            @elseif($firstBooking->booking_detail_status === 'รอเลือกห้อง')
                                            <span class="mr-2 inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">รอเช็คอิน</span>
                                            @elseif($firstBooking->booking_detail_status === 'เช็คเอาท์')
                                            <span class="mr-2 inline-flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">เช็คเอาท์</span>
                                            @elseif($firstBooking->booking_detail_status === 'เช็คอินแล้ว')
                                            <span class="mr-2 inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">เช็คอินแล้ว</span>
                                            @elseif($firstBooking->booking_detail_status === 'รอชำระเงิน')
                                            <span class="mr-2 inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">รอชำระเงิน</span>
                                            @elseif($firstBooking->booking_detail_status === 'ไม่มาเช็คอิน')
                                            <span class="mr-2 inline-flex items-center bg-gray-100 text-orange-800 text-xs font-medium px-2.5 py-0.5 rounded-full">ไม่มาเช็คอิน</span>
                                            @elseif($firstBooking->booking_detail_status === 'ยกเลิกการจอง')
                                            <span class="mr-2 inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full">ยกเลิกการจอง</span>
                                            @endif
                                        </td>
                                        <td class="px-3 py-4 text-center">
                                            {{ number_format($firstBooking->extra_bed_count) }}
                                        </td>
                                        <td class="px-3 py-4 text-center">
                                            {{ number_format($firstBooking->booking->total_cost, 2) }}
                                        </td>

                                        <td class="px-4 py-2">
                                            <!-- Update the link to use bookingdetail_id -->
                                            <a href="{{ route('record_detail', ['id' => $firstBooking->id]) }}" class="text-blue-500 hover:text-blue-700">
                                                <button class="py-2 px-4 rounded-md bg-blue-500 text-white hover:bg-blue-700">รายละเอียด</button>
                                            </a>
                                        </td>
                                    </tr>
                                    @if ($hasDuplicates)
                                    <tr id="dropdown-{{ $bookingId }}" class="hidden">
                                        <td colspan="8" class="px-3 py-4 bg-gray-100">
                                            <table class="w-full text-sm">
                                                <thead class="text-md text-gray-700 uppercase bg-gray-200">
                                                    <tr>
                                                        <th scope="col" class="px-3 py-3 text-center">ชื่อผู้จอง</th>
                                                        <th scope="col" class="px-3 py-3 text-center">วันที่เช็คอิน</th>
                                                        <th scope="col" class="px-3 py-3 text-center">วันที่เช็คเอาท์</th>
                                                        <th scope="col" class="px-3 py-3 text-center">ประเภทห้องพัก</th>
                                                        <th scope="col" class="px-3 py-3 text-center">สถานะการจอง</th>
                                                        <th scope="col" class="px-3 py-3 text-center">รายละเอียดเพิ่มเติม</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="bg-white text-center">
                                                        <td class="px-3 py-4">{{ $firstBooking->booking_name }}</td>
                                                        <td class="px-3 py-4">{{ $firstBooking->checkin_date }}</td>
                                                        <td class="px-3 py-4">{{ $firstBooking->checkout_date }}</td>
                                                        <td class="px-3 py-4">{{ $firstBooking->room_type }}</td>
                                                        <td class="px-3 py-4">{{ $firstBooking->booking_status }}</td>
                                                        <td class="px-4 py-2">
                                                            <a href="{{ route('record_detail', ['id' => $firstBooking->id]) }}" class="text-blue-500 hover:text-blue-700">
                                                                <button class="py-2 px-4 rounded-md bg-blue-500 text-white hover:bg-blue-700">Detail</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @foreach ($bookings->slice(1) as $booking)
                                                    <tr class="bg-white text-center">
                                                        <td class="px-3 py-4">{{ $booking->booking_name }}</td>
                                                        <td class="px-3 py-4">{{ $booking->occupancy_person }}</td>
                                                        <td class="px-3 py-4">{{ $booking->checkin_date }}</td>
                                                        <td class="px-3 py-4">{{ $booking->checkout_date }}</td>
                                                        <td class="px-3 py-4">{{ $booking->room_type }}</td>
                                                        <td class="px-3 py-4">{{ $booking->booking_status }}</td>
                                                        <td class="px-4 py-2">
                                                            <a href="{{ route('record_detail', ['id' => $booking->id]) }}" class="text-blue-500 hover:text-blue-700">
                                                                <button class="py-2 px-4 rounded-md bg-blue-500 text-white hover:bg-blue-700">Detail</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    @endif

                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @else
                    <p class="text-center text-gray-600">ไม่มีข้อมูลการจอง</p>
                    @endif
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
    </section>
    </div>
</body>

</html>