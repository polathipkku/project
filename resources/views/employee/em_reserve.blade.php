<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist\output.css">
    <link rel="shortcut icon" href="images/TTbell.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet" />
    <!-- <link href="css/font-awesome.min.css" rel="stylesheet" /> -->
    <link href="/css/style.css" rel="stylesheet" />
    <title>Thunthree</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
    <!--owl slider stylesheet -->
    <!-- <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" /> -->
    <!-- <link rel="stylesheet" href="css/style-head.css"> -->
    <!-- Magnific Popup CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"> -->
    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <!-- Magnific Popup JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script> -->
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript"
        src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript"
        src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>

    <link rel="stylesheet"
        href="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <script type="text/javascript"
        src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>

</head>


<body>
    <div class="text-white py-4" style="background-color:#042a48;">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">

            <span class="text-xl font-pacifico" style="font-family: 'Pacifico', cursive;">Thunthree</span>

            <!-- Steps Bar -->
            <div class="flex items-center space-x-4 mx-auto pr-16">
                <!-- Step 1: Booking (Gold Color) -->
                <div class="flex items-center space-x-2">
                    <div
                        class="w-8 h-8 flex items-center justify-center rounded-full border-2 border-gold-500 text-gold-500">
                        1
                    </div>
                    <span class="text-sm text-gold-500">จองห้อง</span>
                </div>

                <!-- Connector Line -->
                <div class="h-0.5 w-12 bg-gray-200"></div>

                <!-- Step 2: Payment -->
                <div class="flex items-center space-x-2">
                    <div class="w-8 h-8 flex items-center justify-center rounded-full border-2 border-white text-white">
                        2
                    </div>
                    <span class="text-sm text-indigo-200">ชำระเงิน</span>
                </div>
            </div>
        </div>
    </div>


    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Page Header --}}
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 sm:text-4xl">จองห้องพัก</h1>
                <p class="mt-2 text-gray-600">กรุณากรอกข้อมูลเพื่อทำการจองห้องพัก</p>
            </div>

            {{-- Main Form Card --}}
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <form action="{{ url('/em_reserve/' . $rooms->id) }}" method="post" enctype="multipart/form-data"
                    class="p-6">
                    @csrf

                    {{-- Personal Information Section --}}

                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="">
                                <label for="booking_name"
                                    class="block text-sm font-medium text-gray-700 ">ชื่อผู้จอง</label>
                                <input type="text" id="booking_name" name="booking_name"
                                    class="mt-1 block w-full h-8 rounded-md border-2 border-gray-500 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>

                            </div>
                            <div>
                                <label for="phone"
                                    class="block text-sm font-medium text-gray-700">เบอร์โทรศัพท์</label>
                                <input type="tel" id="phone" name="phone"
                                    class="mt-1 block w-full h-8 rounded-md border-2 border-gray-500 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                            </div>
                        </div>
                        <div>
                            <label for="id_card"
                                class="block text-sm font-medium text-gray-700">หมายเลขบัตรประชาชน</label>
                            <input type="text" id="id_card" name="id_card"
                                class="mt-1 block w-full h-8 rounded-md border-2 border-gray-500 focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4 space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label for="occupancy_person"
                                    class="block text-sm font-medium text-gray-700">จำนวนผู้ใหญ่</label>
                                <input type="number" id="occupancy_person" name="occupancy_person" value="1"
                                    class="mt-1 block w-full h-8 rounded-md border-2 border-gray-500 focus:border-indigo-500 focus:ring-indigo-500"
                                    required min="1">
                            </div>
                            <div>
                                <label for="occupancy_child"
                                    class="block text-sm font-medium text-gray-700">จำนวนเด็ก</label>
                                <input type="number" id="occupancy_child" name="occupancy_child" value="0"
                                    class="mt-1 block w-full h-8 rounded-md border-2 border-gray-500 focus:border-indigo-500 focus:ring-indigo-500"
                                    required min="0">
                            </div>
                            <div>
                                <label for="occupancy_baby"
                                    class="block text-sm font-medium text-gray-700">จำนวนทารก</label>
                                <input type="number" id="occupancy_baby" name="occupancy_baby" value="0"
                                    class="mt-1 block w-full h-8 rounded-md border-2 border-gray-500 focus:border-indigo-500 focus:ring-indigo-500"
                                    required min="0">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="checkin-date"
                                    class="block text-sm font-medium text-gray-700">วันที่เข้าพัก</label>
                                <input type="text" id="checkin-date" name="checkin_date"
                                    value="{{ $checkinDate }}"
                                    class="mt-1 block w-full h-8 rounded-md border-2 border-gray-500 bg-gray-100 shadow-sm"
                                    readonly>
                            </div>
                            <div>
                                <label for="checkout-date"
                                    class="block text-sm font-medium text-gray-700">วันที่ออก</label>
                                <input type="text" id="checkout-date" name="checkout_date"
                                    value="{{ $checkoutDate }}"
                                    class="mt-1 block w-full h-8 rounded-md border-2 border-gray-500 bg-gray-100 shadow-sm"
                                    readonly>
                            </div>
                        </div>

                        <div>
                            <label for="extra_bed_count"
                                class="block text-sm font-medium text-gray-700">ต้องการเตียงเสริม</label>
                            <div class="flex items-center mt-2">
                                <input type="checkbox" id="extra_bed_count" name="extra_bed_count" value="1"
                                    class="h-4 w-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500" />
                                <span class="ml-3 text-sm text-gray-700">เลือกเตียงเสริม (มีค่าใช้จ่ายเพิ่มเติม)</span>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">ห้องพักสามารถเพิ่มเตียงเสริมได้ 1 เตียง</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="address"
                                    class="block text-sm font-medium text-gray-700">บ้านเลขที่/หมู่</label>
                                <input type="text" id="address" name="address"
                                    class="mt-1 block w-full h-8 rounded-md border-2 border-gray-500 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                            </div>
                            <div>
                                <label for="sub_district" class="block text-sm font-medium text-gray-700">ตำบล</label>
                                <input type="text" id="sub_district" name="sub_district"
                                    class="mt-1 block w-full h-8 rounded-md border-2 border-gray-500 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                            </div>
                            <div>
                                <label for="district" class="block text-sm font-medium text-gray-700">อำเภอ</label>
                                <input type="text" id="district" name="district"
                                    class="mt-1 block w-full h-8 rounded-md border-2 border-gray-500 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                            </div>
                            <div>
                                <label for="province" class="block text-sm font-medium text-gray-700">จังหวัด</label>
                                <input type="text" id="province" name="province"
                                    class="mt-1 block w-full h-8 rounded-md border-2 border-gray-500 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                            </div>
                            <div>
                                <label for="postcode"
                                    class="block text-sm font-medium text-gray-700">รหัสไปรษณีย์</label>
                                <input type="text" id="postcode" name="postcode"
                                    class="mt-1 block w-full h-8 rounded-md border-2 border-gray-500 focus:border-indigo-500 focus:ring-indigo-500"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <div>
                            <label for="room_type"
                                class="block text-sm font-medium text-gray-700">เลือกประเภทห้องพัก</label>
                            <select id="room_type" name="room_type"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                                <option value="ห้องพักค้างคืน">ห้องพักค้างคืน -
                                    ฿{{ number_format($rooms->price_night) }}</option>
                                <option value="ห้องพักชั่วคราว">ห้องพักชั่วคราว -
                                    ฿{{ number_format($rooms->price_temporary) }}</option>
                            </select>
                        </div>
                    </div>
                    <!-- เพิ่มส่วนการชำระเงิน -->
                    <div class="p-4 bg-gray-50 rounded-lg border-2 border-gray-300 mt-6">
                        <h2 class="text-lg font-semibold text-[#042a48] mb-4">การชำระเงิน</h2>

                        <!-- แสดงราคารวม -->
                        <div class="mb-4">
                            <h3 class="text-md font-medium text-[#042a48]">รายละเอียดค่าใช้จ่าย</h3>
                            <div class="mt-2 p-3 bg-white rounded-md border border-gray-300">
                                <div class="flex justify-between items-center mb-2">
                                    <span>ค่าห้องพัก:</span>
                                    <span class="font-medium"
                                        id="roomPrice">฿{{ number_format($rooms->price_night) }}</span>
                                </div>
                                <div class="flex justify-between items-center mb-2" id="extraBedCostDiv"
                                    style="display: none;">
                                    <span>ค่าเตียงเสริม:</span>
                                    <span class="font-medium" id="extraBedCost">฿0</span>
                                </div>
                                <div class="flex justify-between items-center pt-2 border-t border-gray-200">
                                    <span class="font-medium">ราคารวมทั้งหมด:</span>
                                    <span class="font-bold text-[#042a48]"
                                        id="totalCost">฿{{ number_format($rooms->price_night) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- วิธีการชำระเงิน -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-[#042a48] mb-2">วิธีการชำระเงิน</label>
                            <div class="space-y-2">
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="payment_method" value="cash" required
                                        class="h-4 w-4 text-blue-500 border-gray-300 focus:ring-blue-500"
                                        onclick="togglePaymentFields('cash')">
                                    <span>เงินสด</span>
                                </label>
                                <label class="flex items-center space-x-3">
                                    <input type="radio" name="payment_method" value="bank_transfer" required
                                        class="h-4 w-4 text-blue-500 border-gray-300 focus:ring-blue-500"
                                        onclick="togglePaymentFields('bank_transfer')">
                                    <span>โอนเงิน</span>
                                </label>
                            </div>
                        </div>

                        <!-- ฟิลด์สำหรับเงินสด -->
                        <div id="cashFields" style="display: none;">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-[#042a48]">จำนวนเงินที่รับ</label>
                                    <input type="number" name="amount_paid" step="0.01" min="0"
                                        class="mt-1 w-full h-10 rounded-md border-2 border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                                        oninput="calculateChange(this.value)">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-[#042a48]">เงินทอน</label>
                                    <input type="text" id="change" readonly
                                        class="mt-1 w-full h-10 rounded-md border-2 border-gray-300 bg-gray-50">
                                </div>
                            </div>
                        </div>

                        <!-- ฟิลด์สำหรับการโอนเงิน -->
                        <div id="bankTransferFields" style="display: none;">
                            <div class="text-center">
                                <label class="block text-sm font-medium text-[#042a48] mb-4">
                                    สแกน QR Code เพื่อชำระเงิน
                                </label>
                                @foreach($paymentTypes as $paymentType)
                                    @if($paymentType->qr_code)
                                        <img src="{{ asset('storage/qr_codes/' . $paymentType->qr_code) }}" 
                                             alt="QR Code" class="w-48 h-48 mx-auto mb-2">
                                    @endif
                                @endforeach
                            </div>
                        </div>                                                                
                    </div>


                    {{-- Submit Button --}}
                    <div class="flex justify-between items-center gap-4 mt-6">
                        <a href="{{ url('/emroom') }}"
                            class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-800 font-medium py-3 px-8 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                            ย้อนกลับ
                        </a>
                        <button type="submit"
                            class="flex-1 text-center bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-3 px-8 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors">
                            ยืนยันการจอง
                        </button>
                    </div>


                </form>
            </div>
        </div>
    </div>

    <x-footer />

    <script>
        function calculateTotal() {
            const roomType = document.getElementById('room_type').value;
            const basePrice = roomType === 'ห้องพักค้างคืน' ? {{ $rooms->price_night }} : {{ $rooms->price_temporary }};
            const extraBedChecked = document.getElementById('extra_bed_count').checked;
            const extraBedPrice = extraBedChecked ? 200 : 0; // สมมติว่าเตียงเสริมราคา 500 บาท

            const totalPrice = basePrice + extraBedPrice;

            document.getElementById('roomPrice').textContent = '฿' + basePrice.toLocaleString();
            document.getElementById('extraBedCostDiv').style.display = extraBedChecked ? 'flex' : 'none';
            document.getElementById('extraBedCost').textContent = '฿' + extraBedPrice.toLocaleString();
            document.getElementById('totalCost').textContent = '฿' + totalPrice.toLocaleString();

            return totalPrice;
        }

        // สลับการแสดงฟิลด์ตามวิธีการชำระเงิน
        function togglePaymentFields(method) {
            document.getElementById('cashFields').style.display = method === 'cash' ? 'block' : 'none';
            document.getElementById('bankTransferFields').style.display = method === 'bank_transfer' ? 'block' : 'none';
        }

        // คำนวณเงินทอน
        function calculateChange(amountPaid) {
            const totalCost = calculateTotal();
            const change = amountPaid - totalCost;
            document.getElementById('change').value = change >= 0 ? '฿' + change.toLocaleString() : '฿0';
        }

        // Event listeners
        document.getElementById('room_type').addEventListener('change', calculateTotal);
        document.getElementById('extra_bed_count').addEventListener('change', calculateTotal);

        // Initial calculation
        calculateTotal();

        document.querySelector('form').addEventListener('submit', function(event) {
            // Check if the checkbox is not checked, set the value to 0
            var extraBed = document.getElementById('extra_bed_count');
            if (!extraBed.checked) {
                extraBed.value = 0;
            }
        });

        function submitForm() {
            const contactName = document.getElementById("contactName").value;
            const phoneNumber = document.getElementById("phoneNumber").value;
            const numberOfGuests = document.getElementById("numberOfGuests").value;
            const checkInDate = document.getElementById("checkInDate").value;
            const checkOutDate = document.getElementById("checkOutDate").value;
            const accommodationType = document.getElementById("accommodationType").value;

            console.log("Form submitted with:", {
                contactName,
                phoneNumber,
                numberOfGuests,
                checkInDate,
                checkOutDate,
                accommodationType,
            });
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
