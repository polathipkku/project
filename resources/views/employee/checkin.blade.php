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

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript"
        src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript"
        src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>

    <link rel="stylesheet"
        href="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <script type="text/javascript"
        src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>

    <title>Tunthree</title>




</head>

<body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>

    <div style="display: flex; background-color: #F5F3FF;">

        @include('components.em_sidebar')


        <section class="bg-white rounded-lg shadow-lg mx-5 w-full my-8">
            <div class="w-full mx-auto py-8">
                <!-- Header with responsive design -->
                <div class="px-4 sm:px-6 flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6">
                    <h1 class="text-2xl ml-7 sm:text-4xl font-bold text-gray-800 mb-4 sm:mb-0">เช็คอิน</h1>
                    <div class="w-full sm:w-auto">
                        <input id="checkin-date" type="text"
                            class="flatpickr input w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="เลือกวันที่เช็คอิน" data-default-date="today" />
                    </div>
                </div>

                @if (count($bookings) > 0)
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse bg-white rounded-lg overflow-hidden shadow-md">
                        <thead>
                            <tr
                                class="text-md sm:text-base bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-blue-200">
                                <th class="px-4 py-3 text-gray-700 font-semibold text-center">ชื่อผู้จอง</th>
                                <th class="px-4 py-3 text-gray-700 font-semibold text-center">วันที่เช็คอิน</th>
                                <th class="px-4 py-3 text-gray-700 font-semibold text-center">รายละเอียด</th>
                                <th class="px-4 py-3 text-gray-700 font-semibold text-center">สถานะ</th>
                                <th class="px-4 py-3 text-gray-700 font-semibold text-center">เช็คอิน</th>
                            </tr>
                        </thead>
                        <tbody id="booking-rows">
                            @if (isset($bookings) && $bookings->isNotEmpty())
                            @php
                            $groupedBookings = [];
                            foreach ($bookings as $booking) {
                            foreach ($booking->bookingDetails->where('room_id', null) as $detail) {
                            $groupedBookings[$detail->booking_id][] = $detail;
                            }
                            }
                            @endphp

                            @foreach ($groupedBookings as $bookingId => $details)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 transition duration-150"
                                onclick="toggleDropdown('{{ $bookingId }}')">
                                <td class="px-3 sm:px-4 py-3 text-center">
                                    <div class="flex flex-col items-center sm:flex-row sm:justify-center">
                                        <span
                                            class="font-semibold text-gray-800">{{ $details[0]->booking_name }}</span>
                                        <div class="flex mt-1 sm:mt-0 sm:ml-2">
                                            @if (count($details) == 1 && $details[0]->extra_bed_count > 0)
                                            <span
                                                class="text-red-500 text-xs px-2 py-1 rounded-full bg-red-50 font-medium">มีเตียงเสริม</span>
                                            @endif

                                            @if (count($details) > 1)
                                            <span
                                                class="text-blue-500 text-xs px-2 py-1 rounded-full bg-blue-50 font-medium ml-1">{{ count($details) }}
                                                ห้อง</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-3 sm:px-4 py-3 text-gray-700 text-center">
                                    {{ \Carbon\Carbon::parse($detail->checkout_date)->locale('th')->translatedFormat('d F Y') }}
                                </td>

                                <td class="px-3 sm:px-4 py-3 text-center">
                                    <a href="{{ route('checkindetail', ['id' => $details[0]->booking->id]) }}"
                                        class="inline-block text-blue-600 hover:text-blue-800 transition duration-300">
                                        <button
                                            class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white py-1.5 px-4 rounded-md  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50"
                                            type="button">
                                            <div class="flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                    fill="none" viewBox="0 0 24 24"
                                                    stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                รายละเอียด
                                            </div>
                                        </button>
                                    </a>
                                </td>
                                <td class="px-3 sm:px-4 py-3 text-center">
                                    <span
                                        class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-1 rounded-full">
                                        <span class="w-2 h-2 me-1 bg-yellow-500 rounded-full mr-1"></span>
                                        {{ $details[0]->booking_detail_status }}
                                    </span>
                                </td>
                                <td class="px-3 sm:px-4 py-3 text-center">
                                    @if (count($details) == 1 && $details[0]->booking_detail_status === 'รอเลือกห้อง')
                                    <button

                                        onclick="event.stopPropagation(); showModal('{{ $details[0]->id }}', '{{ $details[0]->booking->id }}', '{{ $details[0]->extra_bed_count ?? 0 }}')"
                                        class=" bg-gradient-to-r from-green-400 to-green-400 hover:from-green-500 hover:to-green-600 text-white px-4 py-2 rounded-md transition duration-300 shadow-sm transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            เช็คอิน
                                        </div>
                                    </button>
                                    @else
                                    <button
                                        class="bg-gray-200 text-gray-500 px-4 py-2 rounded-md cursor-not-allowed shadow-sm flex items-center justify-center mx-auto"
                                        disabled>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        เช็คอิน
                                    </button>
                                    @endif
                                </td>
                            </tr>

                            <!-- Dropdown for multiple bookings -->
                            @if (count($details) > 1)
                            <tr id="dropdown-{{ $bookingId }}" class="hidden">
                                <td colspan="5" class="bg-gray-50 p-0 border border-gray-200">
                                    <div class="p-4">
                                        <table
                                            class="w-full border-collapse rounded-md overflow-hidden shadow-sm">
                                            <thead>
                                                <tr
                                                    class="bg-gradient-to-r from-gray-100 to-gray-200 text-gray-700">
                                                    <th class="px-3 py-2 text-center font-medium">
                                                        ลำดับที่</th>
                                                    <th class="px-3 py-2 text-center font-medium">
                                                        วันที่เช็คอิน</th>
                                                    <th class="px-3 py-2 text-center font-medium">สถานะ
                                                    </th>
                                                    <th class="px-3 py-2 text-center font-medium">
                                                        เช็คอิน</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($details as $index => $detail)
                                                <tr
                                                    class="text-gray-700 border-b border-gray-200 hover:bg-white transition duration-150">
                                                    <td class="px-3 py-2 text-center">
                                                        <div
                                                            class="flex items-center justify-center">
                                                            <span
                                                                class="font-medium">{{ $index + 1 }}</span>
                                                            @if ($detail->extra_bed_count > 0)
                                                            <span
                                                                class="ml-2 text-red-500 text-xs px-2 py-0.5 rounded-full bg-red-50 font-medium">มีเตียงเสริม</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td class="px-3 py-2 text-center">
                                                        {{ \Carbon\Carbon::parse($detail->checkin_date)->format('d M Y') }}
                                                    </td>
                                                    <td class="px-3 py-2 text-center">
                                                        <span
                                                            class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2 py-0.5 rounded-full">
                                                            <span
                                                                class="w-2 h-2 me-1 bg-yellow-500 rounded-full mr-1"></span>
                                                            {{ $detail->booking_detail_status }}
                                                        </span>
                                                    </td>
                                                    <td class="px-3 py-2 text-center">
                                                        @if ($detail->booking_detail_status === 'รอเลือกห้อง')
                                                        <button
                                                            onclick="event.stopPropagation(); showModal('{{ $details[0]->id }}', '{{ $details[0]->booking->id }}', '{{ $details[0]->extra_bed_count ?? 0 }}')"
                                                            class="bg-gradient-to-r from-green-400 to-green-700 hover:from-green-600 hover:to-green-700 text-white px-3 py-1 rounded-md transition duration-300 shadow-sm transform hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50 flex items-center mx-auto">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-3 w-3 mr-1"
                                                                fill="none"
                                                                viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M5 13l4 4L19 7" />
                                                            </svg>
                                                            เช็คอิน
                                                        </button>
                                                        @else
                                                        <span
                                                            class="text-gray-500 text-sm flex items-center justify-center">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                class="h-3 w-3 mr-1"
                                                                fill="none"
                                                                viewBox="0 0 24 24"
                                                                stroke="currentColor">
                                                                <path stroke-linecap="round"
                                                                    stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                            </svg>
                                                            ไม่สามารถเช็คอินได้
                                                        </span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                @else
                <div class="text-center py-10">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                    <h3 class="mt-2 text-lg font-medium text-gray-900">ไม่พบรายการรอเช็คอิน</h3>
                    <p class="mt-1 text-sm text-gray-500">ขณะนี้ไม่มีการจองที่รอเช็คอิน</p>
                </div>
                @endif
            </div>
        </section>

        <script>
            // Toggle dropdown visibility for multiple bookings
            function toggleDropdown(bookingId) {
                const dropdown = document.getElementById(`dropdown-${bookingId}`);
                if (dropdown) {
                    dropdown.classList.toggle('hidden');
                }
            }

            // Initialize flatpickr with Thai locale
            document.addEventListener('DOMContentLoaded', function() {
                flatpickr("#checkin-date", {
                    dateFormat: "d/m/Y",
                    locale: "th",
                    defaultDate: "today",
                    onChange: function(selectedDates, dateStr) {
                        // Add your date filter logic here
                        console.log("Selected date:", dateStr);
                        // You could refresh the table with AJAX here
                    }
                });
            });

            // Show check-in modal
            function showModal(bookingId) {
                // Implement your modal logic here
                console.log("Opening check-in modal for booking:", bookingId);
                // Example: window.location.href = `/checkin/process/${bookingId}`;
            }
        </script>

        <script>
            function toggleDropdown(bookingName) {
                const dropdown = document.getElementById('dropdown-' + bookingName);
                dropdown.classList.toggle('hidden');
            }

            function showModal(bookingId, checkinDate) {
                // ใส่ลอจิกเพื่อแสดงโมดัลที่นี่
                console.log(`Show modal for booking ID: ${bookingId}, Check-in Date: ${checkinDate}`);
            }
        </script>
        <div id="userInformationModal"
            class="hidden fixed inset-0 bg-black bg-opacity-50 overflow-y-auto flex justify-center items-center">
            <div class="bg-white p-8 rounded-lg shadow-xl max-w-md w-full max-h-screen overflow-y-auto">
                <h2 class="text-2xl font-bold mb-4">กรอกข้อมูลผู้เข้าพัก</h2>

                <!-- Initially hide the Booking ID and Booking Detail ID -->
                <h1 id="modal_booking_id_text" class="text-xl font-bold text-gray-700 hidden"></h1>
                <h1 id="modal_booking_detail_id_text" class="text-xl font-bold text-gray-700 hidden"></h1>


                <form id="check-in-form" action="{{ route('updateBookingDetail') }}" method="post">
                    @csrf
                    <!-- Input ซ่อนค่า -->
                    <input type="hidden" name="booking_id" id="modal_booking_id">
                    <input type="hidden" name="booking_detail_id" id="modal_booking_detail_id">


                    <div id="guest-forms-container">

                        <div class="mb-4">
                            <label for="room_id" class="block mb-2">เลือกห้อง:</label>
                            <select name="room_id" id="room_id" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="" disabled selected>กรุณาเลือกห้องที่ว่าง</option>
                                @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">ห้อง {{ $room->room_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div id="text" class="guest-form mb-4 border-b border-gray-300 pb-4">
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium">ชื่อ:</label>
                                <input type="text" id="name" name="name_[1]" required
                                    class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="ชื่อ">
                            </div>
                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="id_card" class="block text-sm font-medium">บัตรประชาชน:</label>
                                    <input type="text" id="id_card" name="id_card_[1]" required
                                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="บัตรประชาชน">
                                </div>
                                <div>
                                    <label for="phone" class="block text-sm font-medium">เบอร์โทร:</label>
                                    <input type="text" id="phone" name="phone_[1]" required
                                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="เบอร์โทร">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="address" class="block text-sm font-medium">ที่อยู่:</label>
                                <input type="text" id="address" name="address_[1]" required
                                    class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="บ้านเลขที่/หมู่บ้าน">
                            </div>

                            <div class="grid grid-cols-3 gap-4 mb-4">
                                <div>
                                    <label for="sub_district" class="block text-sm font-medium">ตำบล/แขวง:</label>
                                    <input id="sub_district" name="sub_district_[1]" type="text"
                                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="ตำบล">
                                </div>
                                <div>
                                    <label for="district" class="block text-sm font-medium">อำเภอ/เขต:</label>
                                    <input id="district" name="district_[1]" type="text"
                                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="อำเภอ">
                                </div>
                                <div>
                                    <label for="province" class="block text-sm font-medium">จังหวัด:</label>
                                    <input id="province" name="province_[1]" type="text"
                                        class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                        placeholder="จังหวัด">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="postcode" class="block text-sm font-medium">รหัสไปรษณีย์:</label>
                                <input id="postcode" name="postcode_[1]" type="text" required
                                    class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    placeholder="รหัสไปรษณีย์">
                            </div>

                            <p id="modal_extra_bed_count_text">ไม่พบข้อมูล</p>


                            <div id="extra_bed_radio_group" class="mb-4 hidden">
                                <label class="block text-sm font-medium">ต้องการเตียงเสริมหรือไม่:</label>
                                <div class="flex items-center space-x-4">
                                    <label>
                                        <input type="radio" id="extra_bed_no" name="extra_bed_count" value="0" checked class="form-radio">
                                        ไม่เอาเตียงเสริม
                                    </label>
                                    <label>
                                        <input type="radio" id="extra_bed_yes" name="extra_bed_count" value="1" class="form-radio">
                                        เอาเตียงเสริม
                                    </label>
                                </div>
                            </div>
                            <input type="hidden" name="extra_bed_count" id="modal_extra_bed_count" value="">


                        </div>

                        <button type="button" id="add_name"
                            class="flex items-center gap-2 text-blue-500 hover:text-blue-700">
                            <i class="fas fa-plus-circle"></i> เพิ่มข้อมูลผู้เข้าพัก
                        </button>

                        <div class="flex justify-end mt-4">
                            <button type="button" onclick="closeModal()"
                                class="mr-2 px-4 py-2 text-gray-600 hover:text-gray-800">ยกเลิก</button>
                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">บันทึกข้อมูล</button>
                        </div>
                </form>
            </div>
        </div>

        <div id="paymentMethodPopup"
            class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50">
            <div
                class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 space-y-8 transform transition-all duration-300">
                <h2 class="text-2xl font-bold text-center text-gray-800 tracking-wide">
                    เลือกวิธีการชำระเงิน
                </h2>

                <p class="text-center text-gray-500" id="paymentExtraCharge">
                <p>ราคาของเตียงเสริม: 200 บาท</p>

                <div class="grid grid-cols-2 gap-4">
                    <label for="payment_transfer"
                        class="flex flex-col items-center justify-center py-6 px-4 bg-gray-50 rounded-xl border-2 border-gray-200 hover:border-indigo-500 hover:shadow-lg transition-all cursor-pointer">
                        <input type="radio" name="payment_method" id="payment_transfer" value="transfer"
                            class="hidden">
                        <span class="text-lg font-medium text-gray-800">โอนเงิน</span>
                        <span class="text-sm text-gray-400 mt-1">ชำระผ่าน QR Code</span>
                    </label>
                    <label for="payment_cash"
                        class="flex flex-col items-center justify-center py-6 px-4 bg-gray-50 rounded-xl border-2 border-gray-200 hover:border-indigo-500 hover:shadow-lg transition-all cursor-pointer">
                        <input type="radio" name="payment_method" id="payment_cash" value="cash"
                            class="hidden">
                        <span class="text-lg font-medium text-gray-800">เงินสด</span>
                        <span class="text-sm text-gray-400 mt-1">จ่ายด้วยเงินสด</span>
                    </label>
                </div>

                <div id="cashPaymentFields" class="hidden space-y-4">
                    <div>
                        <label for="amountPaid" class="block text-gray-700 font-medium mb-2">
                            จำนวนเงินที่ได้รับ:
                        </label>
                        <input type="number" id="amountPaid"
                            class="w-full px-4 py-3 border rounded-lg bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            min="0" step="0.01" placeholder="ระบุจำนวนเงินที่ลูกค้าจ่าย"
                            oninput="calculateChange()">
                    </div>
                    <div>
                        <label for="cashRefund" class="block text-gray-700 font-medium mb-2">
                            เงินทอน:
                        </label>
                        <input type="text" id="cashRefund"
                            class="w-full px-4 py-3 border rounded-lg bg-gray-100 text-gray-500 cursor-not-allowed"
                            readonly placeholder="คำนวณอัตโนมัติ">
                    </div>
                    <p id="paymentWarning" class="text-sm text-red-500 hidden">
                        จำนวนเงินที่ได้รับต้องมากกว่าหรือเท่ากับยอดชำระทั้งหมด
                    </p>
                </div>

                <div id="transferPaymentFields" class="hidden text-center">
                    <p class="text-gray-700 font-medium mb-4">
                        สแกน QR Code เพื่อชำระเงิน
                    </p>
                    <div class="flex justify-center items-center">
                        <div
                            class="bg-white p-6 rounded-lg shadow-xl border-2 border-gray-200 w-60 h-60 flex items-center justify-center">
                            <img src="{{ asset('images/qrcodeimage.png') }}" alt="QR Code" class="w-48 h-48">
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center">
                    <button onclick="closePaymentPopup()"
                        class="text-gray-500 hover:text-gray-800 font-medium transition duration-300">
                        ยกเลิก
                    </button>
                    <button onclick="confirmPayment()"
                        class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition duration-300">
                        ยืนยัน
                    </button>
                </div>
            </div>
        </div>

        <script>
            document.querySelectorAll('input[name="payment_method"]').forEach((radio) => {
                radio.addEventListener('change', function() {
                    // ซ่อนฟอร์มเงินสดและโอนเงินก่อน
                    document.getElementById('cashPaymentFields').classList.add('hidden');
                    document.getElementById('transferPaymentFields').classList.add('hidden');

                    // เช็คว่าผู้ใช้เลือกอะไร
                    if (this.value === 'cash') {
                        document.getElementById('cashPaymentFields').classList.remove('hidden');
                    } else if (this.value === 'transfer') {
                        document.getElementById('transferPaymentFields').classList.remove('hidden');
                    }
                });
            });

            // ฟังก์ชันสำหรับปิด popup และรีเซ็ตข้อมูล
            function closePaymentPopup() {
                // ปิด popup
                document.getElementById('paymentMethodPopup').classList.add('hidden');

                // รีเซ็ตการเลือกวิธีการชำระเงิน (ถ้าต้องการ)
                var paymentMethods = document.getElementsByName('payment_method');
                paymentMethods.forEach(function(method) {
                    method.checked = false;
                });

                // ซ่อนฟิลด์การชำระเงินสดและการโอนเงิน
                document.getElementById('cashPaymentFields').classList.add('hidden');
                document.getElementById('transferPaymentFields').classList.add('hidden');

                // รีเซ็ตฟอร์มการกรอกเงินสด
                document.getElementById('amountPaid').value = '';
                document.getElementById('cashRefund').value = '';
                document.getElementById('paymentWarning').classList.add('hidden');
            }

            // ฟังก์ชั่นคำนวณเงินทอน
            function calculateChange() {
                const amountPaid = parseFloat(document.getElementById('amountPaid').value);
                const totalAmount = 200;

                if (!isNaN(amountPaid)) {
                    const change = amountPaid - totalAmount;
                    if (change >= 0) {
                        document.getElementById('cashRefund').value = `฿${change.toFixed(2)}`;
                    } else {
                        document.getElementById('cashRefund').value = '฿0.00';
                    }
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                // ฟังก์ชันที่ตรวจสอบการเลือกเตียงเสริม
                const extraBedRadios = document.querySelectorAll('input[name="extra_bed_count"]');
                const checkInForm = document.getElementById('check-in-form');
                const paymentMethodPopup = document.getElementById('paymentMethodPopup');

                // ตรวจสอบการเลือกเตียงเสริมเมื่อกด "บันทึกข้อมูล"
                checkInForm.addEventListener('submit', function(event) {
                    event.preventDefault(); // ป้องกันการส่งฟอร์มทันที

                    const selectedExtraBed = document.querySelector('input[name="extra_bed_count"]:checked')
                        .value;

                    if (selectedExtraBed === '1') {
                        // หากเลือกเตียงเสริม ให้แสดงป๊อปอัพการชำระเงิน
                        paymentMethodPopup.classList.remove('hidden');
                    } else {
                        // หากไม่เลือกเตียงเสริม ให้ส่งฟอร์มต่อไป
                        checkInForm.submit();
                    }
                });

                // ฟังก์ชันยืนยันการชำระเงิน
                window.confirmPayment = function() {
                    const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
                    if (!paymentMethod) {
                        alert('กรุณาเลือกวิธีการชำระเงิน');
                        return;
                    }

                    // ถ้าผู้ใช้เลือกชำระเงินด้วยเงินสด
                    if (paymentMethod.value === 'cash') {
                        const amountPaid = parseFloat(document.getElementById('amountPaid').value);
                        const totalAmount = parseFloat(document.getElementById('paymentExtraCharge').dataset
                            .totalAmount);

                        if (isNaN(amountPaid) || amountPaid < totalAmount) {
                            document.getElementById('paymentWarning').classList.remove('hidden');
                            return; // หยุดการส่งฟอร์มถ้ายังไม่จ่ายครบ
                        } else {
                            document.getElementById('paymentWarning').classList.add('hidden');
                        }
                    }

                    // ส่งฟอร์มหลังจากยืนยัน
                    checkInForm.submit();
                };
            });

            var show_text = document.getElementById('text');
            var add_name = document.getElementById('add_name');
            var count = 1; // จำนวนเริ่มต้น

            // ฟังก์ชันเพิ่มผู้เข้าพัก
            add_name.addEventListener('click', function() {
                // ตรวจสอบค่าจำนวนเตียงเสริมจาก radio buttons
                var extraBedCount = document.querySelector('input[name="extra_bed_count"]:checked').value;

                // กำหนดจำนวนสูงสุดของผู้เข้าพักที่สามารถเพิ่มได้
                var maxGuests = extraBedCount === "1" ? 3 : 2;

                // ถ้าจำนวนผู้เข้าพักเกินจำนวนสูงสุดที่กำหนดให้ไม่สามารถเพิ่มได้
                if (count >= maxGuests) {
                    alert("คุณสามารถเพิ่มข้อมูลผู้เข้าพักได้สูงสุด " + maxGuests + " คน");
                    return;
                }

                // เพิ่มจำนวนผู้เข้าพัก
                count++;
                var create_div = document.createElement('div');
                create_div.id = 'text' + count;
                create_div.innerHTML =
                    '<hr>' +
                    '<div class="flex justify-end mt-3">' +
                    '<button class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-all duration-300 flex items-center justify-center shadow-md" type="button" onclick="removediv(' +
                    count + ')">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" stroke="none">' +
                    '<path d="M5 5h14l-1.5 14H6.5L5 5zm6 2v8h2V7h-2zM9 7v8h2V7H9zm6 0v8h2V7h-2z"/>' +
                    '<path d="M16 4h-4V3h-4v1H4v2h16V4h-4z"/>' +
                    '</svg>' +
                    '</button>' +
                    '</div>' +
                    '<div class="mb-4">' +
                    '<label for="name" class="block text-sm font-medium">ชื่อ:</label>' +
                    '<input type="text" id="name" name="name_[' + count +
                    ']" required class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="ชื่อ">' +
                    '</div>' +
                    '<div class="grid grid-cols-2 gap-4 mb-4">' +
                    '<div>' +
                    '<label for="id_card" class="block text-sm font-medium">บัตรประชาชน:</label>' +
                    '<input type="text" id="id_card" name="id_card_[' + count +
                    ']" required class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="บัตรประชาชน">' +
                    '</div>' +
                    '<div>' +
                    '<label for="phone" class="block text-sm font-medium">เบอร์โทร:</label>' +
                    '<input type="text" id="phone" name="phone_[' + count +
                    ']" required class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="เบอร์โทร">' +
                    '</div>' +
                    '</div>' +
                    '<div class="mb-4">' +
                    '<label for="address" class="block text-sm font-medium">ที่อยู่:</label>' +
                    '<input type="text" id="address" name="address_[' + count +
                    ']" required class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="บ้านเลขที่/หมู่บ้าน">' +
                    '</div>' +
                    '<div class="grid grid-cols-3 gap-4 mb-4">' +
                    '<div>' +
                    '<label for="sub_district" class="block text-sm font-medium">ตำบล/แขวง:</label>' +
                    '<input id="sub_district" name="sub_district_[' + count +
                    ']" type="text" class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="ตำบล">' +
                    '</div>' +
                    '<div>' +
                    '<label for="district" class="block text-sm font-medium">อำเภอ/เขต:</label>' +
                    '<input id="district" name="district_[' + count +
                    ']" type="text" class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="อำเภอ">' +
                    '</div>' +
                    '<div>' +
                    '<label for="province" class="block text-sm font-medium">จังหวัด:</label>' +
                    '<input id="province" name="province_[' + count +
                    ']" type="text" class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="จังหวัด">' +
                    '</div>' +
                    '</div>' +
                    '<div class="mb-4">' +
                    '<label for="postcode" class="block text-sm font-medium">รหัสไปรษณีย์:</label>' +
                    '<input id="postcode" name="postcode_[' + count +
                    ']" type="text" required class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="รหัสไปรษณีย์">' +
                    '</div>';

                show_text.appendChild(create_div);
            });

            // ฟังก์ชันลบข้อมูล
            function removediv(id) {
                var element = document.getElementById('text' + id);
                element.parentNode.removeChild(element);

                // อัพเดตค่า count ให้เท่ากับจำนวน div ที่เหลืออยู่
                count = document.querySelectorAll('[id^="text"]').length;
            }
        </script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                flatpickr("#checkin-date", {
                    dateFormat: "d-m-Y",
                    defaultDate: "today",
                    onChange: function(selectedDates, dateStr, instance) {
                        filterBookings(dateStr);
                    }
                });

                function filterBookings(date) {
                    const rows = document.querySelectorAll('.booking-row');
                    let visibleRows = 0;

                    rows.forEach(row => {
                        if (row.dataset.checkinDate === date) {
                            row.style.display = '';
                            visibleRows++;
                        } else {
                            row.style.display = 'none';
                        }
                    });

                    const noBookingsMessage = document.getElementById('no-bookings-message');
                    if (visibleRows === 0) {
                        noBookingsMessage.classList.remove('hidden');
                    } else {
                        noBookingsMessage.classList.add('hidden');
                    }
                }

                // Initial filtering
                filterBookings(flatpickr.formatDate(new Date(), "Y-m-d"));
            });

            function showModal(booking_detail_id, bookingId, extra_bed_count) {
                console.log('booking_detail_id:', booking_detail_id);
                console.log('bookingId:', bookingId);
                console.log('extra_bed_count:', extra_bed_count);

                // Set hidden input values
                document.getElementById('modal_booking_detail_id').value = booking_detail_id;
                document.getElementById('modal_booking_id').value = bookingId;

                // Handle extra bed count
                const extraBedText = document.getElementById('modal_extra_bed_count_text');
                const extraBedRadioGroup = document.getElementById('extra_bed_radio_group');
                const modalExtraBedCount = document.getElementById('modal_extra_bed_count');

                if (extra_bed_count == 1) {
                    // Extra bed already set
                    extraBedText.innerText = "เพิ่มเตียงเสริมไม่ได้";
                    extraBedRadioGroup.classList.add('hidden');
                    modalExtraBedCount.value = 1; // Set to 1 to prevent changing
                } else {
                    // Can add extra bed
                    extraBedText.innerText = "สามารถเพิ่มเตียงเสริมได้";
                    extraBedRadioGroup.classList.remove('hidden');

                    // Reset radio buttons
                    document.getElementById('extra_bed_no').checked = true;
                    modalExtraBedCount.value = 0;
                }

                // Add event listeners to radio buttons
                document.querySelectorAll('input[name="extra_bed_count"]').forEach(radio => {
                    radio.addEventListener('change', function() {
                        modalExtraBedCount.value = this.value;
                    });
                });

                // Show the modal
                document.getElementById('userInformationModal').classList.remove('hidden');
            }


            function closeModal() {
                document.getElementById('userInformationModal').classList.add('hidden');
                document.getElementById('check-in-form').reset();
            }

            $.Thailand({
                database: 'https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/database/db.json', // เพิ่มลิงก์ไปยัง database
                $district: $("#sub_district"), // input ของตำบล
                $amphoe: $("#district"), // input ของอำเภอ
                $province: $("#province"), // input ของจังหวัด
                $zipcode: $("#postcode") // input ของรหัสไปรษณีย์
            });
        </script>


</body>

</html>