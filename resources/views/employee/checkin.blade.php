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
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>

    <link rel="stylesheet" href="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>

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

                <a class="inline-block py-2 px-3 text-blue-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="={{ route('checkin') }}">
                    <div class="mr-2 text-base flex items-center ">
                        <i class="fa-solid fa-person-walking-luggage mr-1"></i>Check In
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('checkout') }}">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-person-walking-luggage fa-flip-horizontal mr-1"></i>Check Out
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('store') }}" id="store">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-house-circle-check mr-1"></i>Store
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

        <section class="ml-10 bg-white" id="room-table" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">
            <div class="max-w-screen-xl mx-auto py-10">
                <div class="px-2 p-2 flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">Check-In</h1>
                    <input id="checkin-date" type="text" class="flatpickr input px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="เลือกวันที่เช็คอิน" data-default-date="today" />
                </div>
                <table class="w-full border-collapse bg-white rounded-lg overflow-hidden shadow-lg">
                    <thead>
                        <tr class="text-lg bg-gray-300">
                            <th class="px-4 py-2">ชื่อผู้จอง</th>
                            <th class="px-4 py-2">วันที่เช็คอิน</th>
                            <th class="px-4 py-2">รายละเอียด</th>
                            <th class="px-4 py-2">สถานะ</th>
                            <th class="px-4 py-2" style="padding-right: 5%;">เช็คอิน</th>
                        </tr>
                    </thead>
                    <tbody class="text-center" id="booking-rows">
                        @if(isset($bookings) && $bookings->isNotEmpty())
                        @php
                        $groupedBookings = [];
                        foreach ($bookings as $booking) {
                        foreach ($booking->bookingDetails->where('room_id', NULL) as $detail) {
                        $groupedBookings[$detail->booking_id][] = $detail;
                        }
                        }
                        @endphp

                        @foreach($groupedBookings as $bookingId => $details)
                        <tr class="border-b border-gray-200 cursor-pointer" onclick="toggleDropdown('{{ $bookingId }}')">
                            <td class="px-4 py-2">
                                <span class="font-semibold">{{ $details[0]->booking_name }}</span>

                                @if(count($details) == 1 && $details[0]->extra_bed_count > 0)
                                <span class="text-red-500 text-sm ">มีเตียงเสริม</span>
                                @endif

                                @if(count($details) > 1)
                                <span class="text-blue-500 text-sm "> ({{ count($details) }} ห้อง)</span>
                                @endif
                            </td>
                            <td class="px-4 py-2">
                                {{ \Carbon\Carbon::parse($details[0]->checkin_date)->format('d-m-y') }}
                            </td>

                            <td class="py-2 px-4">
                                <a href="{{ route('checkindetail', ['id' => $details[0]->booking->id]) }}" class="text-blue-500 hover:text-blue-700 transition duration-300">
                                    <button class="py-2 px-4 rounded-md hover:underline focus:outline-none focus:shadow-outline-blue active:text-blue-800" type="button">
                                        รายละเอียด
                                    </button>
                                </a>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    <span class="w-2 h-2 me-1 bg-yellow-300 rounded-full mr-1"></span>
                                    {{ $details[0]->booking_detail_status }}
                                </span>
                            </td>
                            <td class="px-4 py-2 text-center">
                                @if(count($details) == 1 && $details[0]->booking_detail_status === 'รอเลือกห้อง')
                                <button onclick="showModal('{{ $details[0]->booking->id }}')" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded transition duration-300">
                                    เช็คอิน
                                </button>
                                @else
                                <button class="bg-gray-300 text-gray-500 px-4 py-2 rounded cursor-not-allowed" disabled>
                                    เช็คอิน
                                </button>
                                @endif
                            </td>
                        </tr>

                        <!-- หากมีมากกว่า 1 รายการจอง จะแสดง dropdown -->
                        @if(count($details) > 1)
                        <tr id="dropdown-{{ $bookingId }}" class="hidden">
                            <td colspan="5" class="bg-gray-100 p-4 border border-gray-300">
                                <table class="w-full border-collapse">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th class="px-4 py-2">ลำดับที่</th>
                                            <th class="px-4 py-2">วันที่เช็คอิน</th>
                                            <th class="px-4 py-2">สถานะ</th>
                                            <th class="px-4 py-2">เช็คอิน</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($details as $index => $detail)
                                        <tr class="text-center border-b border-gray-300">
                                            <td class="px-4 py-2 relative">
                                                <span class="inline-block">{{ $index + 1 }}</span>
                                                @if($detail->extra_bed_count > 0)
                                                <span class="absolute right-6 text-red-500 text-sm mt-0.5">มีเตียงเสริม</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">
                                                {{ \Carbon\Carbon::parse($detail->checkin_date)->format('d-m-y') }}
                                            </td>
                                            <td class="px-4 py-2">
                                                <span class="inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                                                    <span class="w-2 h-2 me-1 bg-yellow-300 rounded-full mr-1"></span>
                                                    {{ $detail->booking_detail_status }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-2">
                                                @if($detail->booking_detail_status === 'รอเลือกห้อง')
                                                <button onclick="showModal('{{ $detail->booking->id }}')" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition duration-300">
                                                    เช็คอิน
                                                </button>
                                                @else
                                                <span class="text-gray-500">ไม่สามารถเช็คอินได้</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        @endif
                    </tbody>

                </table>
            </div>
        </section>

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
                <form id="check-in-form" action="{{ route('updateBookingDetail') }}" method="post">
                    @csrf
                    <input type="hidden" name="booking_id" id="modal_booking_id">

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


                            <div class="mb-4">
                                <label class="block text-sm font-medium">ต้องการเตียงเสริมหรือไม่:</label>
                                <div class="flex items-center space-x-4">
                                    <label>
                                        <input type="radio" id="extra_bed_no" name="extra_bed_count"
                                            value="0" checked class="form-radio">
                                        ไม่เอาเตียงเสริม
                                    </label>
                                    <label>
                                        <input type="radio" id="extra_bed_yes" name="extra_bed_count"
                                            value="1" class="form-radio">
                                        เอาเตียงเสริม
                                    </label>
                                </div>
                            </div>



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
                    @if(isset($extraBedPrice) && $extraBedPrice > 0)
                <p>ราคาของเตียงเสริม: {{ number_format($extraBedPrice, 2) }} บาท</p>
                dd()
                @else
                <p>ไม่พบข้อมูลราคาของเตียงเสริม</p>
                @endif
                </p>

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
                    '<button class="bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-all duration-300 flex items-center justify-center shadow-md" type="button" onclick="removediv(' + count + ')">' +
                    '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24" stroke="none">' +
                    '<path d="M5 5h14l-1.5 14H6.5L5 5zm6 2v8h2V7h-2zM9 7v8h2V7H9zm6 0v8h2V7h-2z"/>' +
                    '<path d="M16 4h-4V3h-4v1H4v2h16V4h-4z"/>' +
                    '</svg>' +
                    '</button>' +
                    '</div>' +
                    '<div class="mb-4">' +
                    '<label for="name" class="block text-sm font-medium">ชื่อ:</label>' +
                    '<input type="text" id="name" name="name_[' + count + ']" required class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="ชื่อ">' +
                    '</div>' +
                    '<div class="grid grid-cols-2 gap-4 mb-4">' +
                    '<div>' +
                    '<label for="id_card" class="block text-sm font-medium">บัตรประชาชน:</label>' +
                    '<input type="text" id="id_card" name="id_card_[' + count + ']" required class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="บัตรประชาชน">' +
                    '</div>' +
                    '<div>' +
                    '<label for="phone" class="block text-sm font-medium">เบอร์โทร:</label>' +
                    '<input type="text" id="phone" name="phone_[' + count + ']" required class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="เบอร์โทร">' +
                    '</div>' +
                    '</div>' +
                    '<div class="mb-4">' +
                    '<label for="address" class="block text-sm font-medium">ที่อยู่:</label>' +
                    '<input type="text" id="address" name="address_[' + count + ']" required class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="บ้านเลขที่/หมู่บ้าน">' +
                    '</div>' +
                    '<div class="grid grid-cols-3 gap-4 mb-4">' +
                    '<div>' +
                    '<label for="sub_district" class="block text-sm font-medium">ตำบล/แขวง:</label>' +
                    '<input id="sub_district" name="sub_district_[' + count + ']" type="text" class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="ตำบล">' +
                    '</div>' +
                    '<div>' +
                    '<label for="district" class="block text-sm font-medium">อำเภอ/เขต:</label>' +
                    '<input id="district" name="district_[' + count + ']" type="text" class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="อำเภอ">' +
                    '</div>' +
                    '<div>' +
                    '<label for="province" class="block text-sm font-medium">จังหวัด:</label>' +
                    '<input id="province" name="province_[' + count + ']" type="text" class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="จังหวัด">' +
                    '</div>' +
                    '</div>' +
                    '<div class="mb-4">' +
                    '<label for="postcode" class="block text-sm font-medium">รหัสไปรษณีย์:</label>' +
                    '<input id="postcode" name="postcode_[' + count + ']" type="text" required class="w-full px-3 py-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="รหัสไปรษณีย์">' +
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
                    dateFormat: "Y-m-d",
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

            function showModal(bookingId) {
                document.getElementById('modal_booking_id').value = bookingId;
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