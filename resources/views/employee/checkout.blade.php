<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Tunthree</title>

</head>

<body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>

    <div style="display: flex; background-color: #F5F3FF;">

        @include('components.em_sidebar')


        <section class="ml-10 bg-white" id="room-table"
            style="width:1100px; padding-left: 2.5%; padding-right: 2.5%; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); ">
            <div class="max-w-screen-xl mx-auto py-10 ">
                <div class="px-2 p-2  flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">Check-Out</h1>

                </div>
                @if (count($bookings) > 0)
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-l bg-gray-300">
                            <th class="px-4 py-2">หมายเลขห้อง</th>
                            <th class="px-4 py-2">สถานะ</th>
                            <th class="px-4 py-2">เหลือเวลาเข้าพัก</th>
                            <th class="px-4 py-2">รายละเอียด</th>
                            <th class="px-4 py-2" style="padding-right: 5%;">CheckOut</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($bookings as $booking)
                        @foreach ($booking->bookingDetails as $detail)
                        @if ($detail->booking_detail_status == 'เช็คอินแล้ว' && $detail->booking_detail_status !== 'เช็คเอาท์')
                        <tr>
                            <td class="px-4 py-2">
                                @if ($detail->room)
                                {{ $detail->room->room_name }}
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $detail->booking_detail_status }}</td>
                            <td class="px-4 py-2">
                                {{ \Carbon\Carbon::parse($detail->checkout_date)->format('d-m-y') }}
                            </td>
                            <td class="px-4 py-2">
                                <a href="{{ route('checkoutdetail', ['id' => $booking->id]) }}"
                                    class="text-blue-500 hover:text-blue-700">
                                    <button
                                        class="py-2 px-4 rounded-md hover:underline focus:outline-none focus:shadow-outline-blue active:text-blue-800"
                                        type="button">
                                        รายละเอียด
                                    </button>
                                </a>
                            </td>

                            <td class="px-4 py-4 flex justify-center items-center border-b">
                                @if ($detail->booking_detail_status === 'เช็คอินแล้ว')
                                <button
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition duration-300"
                                    onclick="showCheckoutPopup('{{ $booking->id }}')">
                                    เช็คเอาท์
                                </button>

                                <form id="checkoutForm-{{ $booking->id }}"
                                    action="{{ route('checkoutuser') }}" method="post"
                                    class="hidden">
                                    @csrf
                                    <input type="hidden" name="booking_id"
                                        value="{{ $booking->id }}">
                                </form>
                                @else
                                <p class="text-gray-600">ไม่สามารถเช็คเอาท์ได้</p>
                                @endif
                            </td>
                        </tr>
                        @endif
                        @endforeach
                        @endforeach
                    </tbody>

                    <!-- Popup for checkout confirmation -->
                    <div id="checkoutPopup"
                        class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white p-8 rounded-xl shadow-xl max-w-lg w-full relative">
                            <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">
                                ห้องชำรุดหรือไม่?
                            </h2>
                            <p class="mb-6 text-center text-gray-600">
                                กรุณาเลือกสถานะของห้อง:
                            </p>
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <button id="damagedButton"
                                    class="bg-red-500 hover:bg-red-600 text-white font-semibold py-3 rounded-lg shadow-md transition duration-300">
                                    ชำรุด
                                </button>
                                <button id="notDamagedButton"
                                    class="bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-lg shadow-md transition duration-300">
                                    ไม่ชำรุด
                                </button>
                            </div>
                            <div class="flex justify-center">
                                <button
                                    class="text-gray-500 hover:text-gray-700 font-medium underline transition duration-200"
                                    onclick="closePopup()">
                                    ปิด
                                </button>
                            </div>
                            <!-- Decorative Line -->
                            <div
                                class="absolute inset-x-0 top-0 h-1 bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 rounded-t-xl">
                            </div>
                        </div>
                    </div>

                    <div id="damagedItemsPopup"
                        class="hidden fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center z-50">
                        <div
                            class="bg-white p-8 rounded-xl shadow-lg max-w-3xl w-full transform transition duration-300">
                            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800 tracking-wide">
                                เลือกรายการที่ชำรุด
                            </h2>

                            <form id="damagedItemsForm" action="{{ route('submitDamagedItems') }}" method="post" class="space-y-6">
                                @csrf
                                <input type="hidden" name="booking_id" id="damagedBookingId">

                                <!-- Dropdown Filter -->
                                <div class="relative mb-6">
                                    <label for="categoryFilter" class="block text-sm font-semibold text-gray-700 mb-2">
                                        กรองตามหมวดหมู่
                                    </label>
                                    <select id="categoryFilter"
                                        class="block w-full p-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="">ทั้งหมด</option>
                                        @foreach ($productRooms->groupBy('productroom_category') as $category => $items)
                                        <option value="{{ $category }}">{{ $category }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Search Filter -->
                                <div class="relative mb-6">
                                    <label for="searchFilter" class="block text-sm font-semibold text-gray-700 mb-2">
                                        ค้นหารายการ
                                    </label>
                                    <input id="searchFilter" type="text"
                                        class="block w-full p-3 bg-gray-50 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="พิมพ์เพื่อค้นหา...">
                                </div>

                                <!-- Items Section -->
                                <div id="itemsContainer"
                                    class="max-h-80 overflow-y-auto bg-gray-50 border border-gray-200 rounded-lg p-4 space-y-6 shadow-inner">
                                    @foreach ($productRooms->groupBy('productroom_category') as $category => $items)
                                    <div class="category-group space-y-4"
                                        data-category="{{ $category }}">
                                        <h3
                                            class="text-lg font-medium text-gray-600 border-b border-gray-300 pb-2">
                                            {{ $category }}
                                        </h3>
                                        @foreach ($items as $item)
                                        <div
                                            class="flex items-center justify-between bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition">
                                            <div class="flex items-center">
                                                <input type="checkbox" id="item-{{ $item->id }}"
                                                    name="damaged_items[]" value="{{ $item->id }}"
                                                    class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                                    data-price="{{ $item->productroom_price }}"
                                                    onchange="updateTotalAmount()">
                                                <label for="item-{{ $item->id }}" class="ml-4">
                                                    <p class="text-sm font-medium text-gray-800">
                                                        {{ $item->productroom_name }}
                                                    </p>
                                                    <p class="text-sm text-gray-500">
                                                        ฿{{ number_format($item->productroom_price, 2) }}
                                                    </p>
                                                </label>
                                            </div>
                                            <div class="text-gray-500 text-sm">
                                                {{ $item->productroom_qty }}
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>
                                <div id="customDamagesList" class="space-y-4"></div>

                                <button type="button" onclick="addCustomDamageField()"
                                    class="w-full bg-gray-100 hover:bg-gray-200 text-gray-600 font-medium py-2 px-4 rounded-lg flex items-center justify-center gap-2 transition duration-300 mt-4">
                                    <span>+ เพิ่มรายการ</span>
                                </button>
                                <!-- Action Buttons -->
                                <div class="flex justify-between items-center mt-6">
                                    <button type="submit"
                                        class="bg-indigo-600 text-white font-semibold px-6 py-3 rounded-lg shadow-md hover:bg-indigo-700 transition duration-300">
                                        ยืนยัน
                                    </button>
                                    <button type="button"
                                        class="text-gray-600 font-medium underline hover:text-gray-800 transition duration-300"
                                        onclick="closePopup2()">ยกเลิก</button>
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
                                ยอดชำระทั้งหมด: ฿0.00
                            </p>

                            <!-- Payment Method Selection -->
                            <div class="grid grid-cols-2 gap-4">
                                <label for="payment_transfer"
                                    class="flex flex-col items-center justify-center py-6 px-4 bg-gray-50 rounded-xl border-2 border-gray-200 hover:border-indigo-500 hover:shadow-lg transition-all cursor-pointer">
                                    <input type="radio" name="payment_method" id="payment_transfer"
                                        value="1" class="hidden" onclick="showTransferPaymentFields()">
                                    <span class="text-lg font-medium text-gray-800">โอนเงิน</span>
                                    <span class="text-sm text-gray-400 mt-1">ชำระผ่าน QR Code</span>
                                </label>
                                <label for="payment_cash"
                                    class="flex flex-col items-center justify-center py-6 px-4 bg-gray-50 rounded-xl border-2 border-gray-200 hover:border-indigo-500 hover:shadow-lg transition-all cursor-pointer">
                                    <input type="radio" name="payment_method" id="payment_cash" value="2"
                                        class="hidden" onclick="showCashPaymentFields()">
                                    <span class="text-lg font-medium text-gray-800">เงินสด</span>
                                    <span class="text-sm text-gray-400 mt-1">จ่ายด้วยเงินสด</span>
                                </label>
                            </div>

                            <!-- Cash Payment Fields -->
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

                            <!-- QR Code Payment -->
                            <div id="transferPaymentFields" class="hidden text-center">
                                <p class="text-gray-700 font-medium mb-4">
                                    สแกน QR Code เพื่อชำระเงิน
                                </p>
                                <div class="flex justify-center items-center">
                                    <div
                                        class="bg-white p-6 rounded-lg shadow-xl border-2 border-gray-200 w-60 h-60 flex items-center justify-center">
                                        <img src="{{ asset('images/qrcodeimage.png') }}" alt="QR Code"
                                            class="w-48 h-48">
                                    </div>
                                </div>
                            </div>


                            <!-- Action Buttons -->
                            <div class="flex justify-between items-center">
                                <button onclick="closePopup3()"
                                    class="text-gray-500 hover:text-gray-800 font-medium transition duration-300">
                                    ยกเลิก
                                </button>
                                <button
                                    onclick="confirmPayment(document.querySelector('input[name=payment_method]:checked')?.value)"
                                    class="px-6 py-3 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700 transition duration-300">
                                    ยืนยัน
                                </button>
                            </div>
                        </div>
                    </div>


                    <script>
                        document.querySelector('meta[name="csrf-token"]').content;

                        let currentBookingId;
                        let totalAmount = 0;
                        let customDamageIndex = 0;

                        document.addEventListener("DOMContentLoaded", function() {
                            window.customDamageIndex = 0;
                            const damagedItemsForm = document.getElementById('damagedItemsForm');
                            if (damagedItemsForm) {
                                damagedItemsForm.addEventListener('submit', function(e) {
                                    e.preventDefault(); // ป้องกันการ submit form แบบปกติ
                                    updateTotalAmount(); // คำนวณยอดรวมก่อนแสดง popup ชำระเงิน
                                    document.getElementById('damagedItemsPopup').classList.add('hidden');
                                    showPaymentMethodPopup(); // เพิ่มบรรทัดนี้เพื่อแสดงหน้า paymentMethodPopup
                                    return false;
                                });
                            }

                            function addCustomDamageField() {
                                const listContainer = document.getElementById('customDamagesList');
                                if (!listContainer) {
                                    console.error("❌ ไม่พบ customDamagesList ใน DOM");
                                    return;
                                }

                                const container = document.createElement('div');
                                container.className = 'bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition';
                                container.innerHTML = `
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">ชื่อรายการ</label>
                    <input type="text" 
                        name="custom_damages[${customDamageIndex}][name]"
                        class="w-full p-3 bg-gray-50 border border-gray-300 rounded-lg"
                        placeholder="ระบุชื่อรายการ" required>
                </div>
                <div class="w-32">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">ราคา</label>
                    <input type="number" 
                        name="custom_damages[${customDamageIndex}][price]"
                        class="w-full p-3 bg-gray-50 border border-gray-300 rounded-lg"
                        placeholder="ราคา" 
                        step="0.01" 
                        min="0"
                        required
                        onchange="updateTotalAmount()">
                </div>
                <div class="flex items-end">
                    <button type="button" 
                        class="p-3 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors"
                        onclick="removeCustomDamage(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        `;
                                listContainer.appendChild(container);
                                customDamageIndex++;
                            }

                            window.addCustomDamageField = addCustomDamageField;
                        });

                        // ลบรายการค่าเสียหายที่เพิ่มเอง
                        function removeCustomDamage(button) {
                            button.closest('.bg-white').remove();
                            updateTotalAmount();
                        }

                        // อัปเดตยอดรวมทั้งหมด
                        function updateTotalAmount() {
                            totalAmount = 0;

                            // รวมราคาจาก product_room ที่เลือก
                            const selectedItems = document.querySelectorAll('input[name="damaged_items[]"]:checked');
                            selectedItems.forEach(item => {
                                const price = parseFloat(item.getAttribute('data-price'));
                                if (!isNaN(price)) {
                                    totalAmount += price;
                                }
                            });

                            // รวมราคาจากรายการที่เพิ่มเอง
                            const customPrices = document.querySelectorAll('input[name^="custom_damages"][name$="[price]"]');
                            customPrices.forEach(input => {
                                const price = parseFloat(input.value);
                                if (!isNaN(price)) {
                                    totalAmount += price;
                                }
                            });

                            // อัปเดตแสดงผลราคารวม
                            const paymentExtraCharge = document.getElementById('paymentExtraCharge');
                            if (paymentExtraCharge) {
                                paymentExtraCharge.innerHTML = `ยอดชำระทั้งหมด: ฿${totalAmount.toFixed(2)}`;
                            }
                        }

                        // แสดง Checkout popup
                        function showCheckoutPopup(bookingId) {
                            currentBookingId = bookingId;
                            toggleModal('checkoutPopup', true);
                        }

                        // จัดการกรณีไม่มีความเสียหาย
                        function handleNotDamaged() {
                            fetch('/checkout-user', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                    },
                                    body: JSON.stringify({
                                        booking_id: currentBookingId
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert('เช็คเอาท์สำเร็จ');
                                        window.location.reload();
                                    } else {
                                        alert(data.error || 'เกิดข้อผิดพลาด');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('เกิดข้อผิดพลาดในการเช็คเอาท์');
                                });
                            closeAllModals();
                        }

                        // ปิด Modal ต่างๆ
                        function closePopup() {
                            document.getElementById('checkoutPopup').classList.add('hidden');
                        }

                        function closePopup2() {
                            document.getElementById('damagedItemsPopup').classList.add('hidden');
                        }

                        function closePopup3() {
                            document.getElementById('paymentMethodPopup').classList.add('hidden');
                        }

                        // แสดง Modal รายการที่เสียหาย
                        window.showDamagedItemsPopup = function() {
                            document.getElementById('damagedBookingId').value = currentBookingId;
                            document.getElementById('checkoutPopup').classList.add('hidden');
                            document.getElementById('damagedItemsPopup').classList.remove('hidden');
                            document.getElementById('customDamagesList').innerHTML = '';
                            customDamageIndex = 0;

                            // รีเซ็ตการเลือกวิธีชำระเงิน
                            const paymentMethodInputs = document.querySelectorAll('input[name="payment_method"]');
                            paymentMethodInputs.forEach(input => input.checked = false);

                            // ซ่อนส่วนแสดงผลวิธีชำระเงินทั้งหมด
                            document.getElementById('cashPaymentFields').classList.add('hidden');
                            document.getElementById('transferPaymentFields').classList.add('hidden');
                        };

                        // แสดง Payment Method Popup
                        window.showPaymentMethodPopup = function() {
                            updateTotalAmount();
                            document.getElementById('damagedItemsPopup').classList.add('hidden');
                            document.getElementById('paymentMethodPopup').classList.remove('hidden');

                            const paymentExtraCharge = document.getElementById('paymentExtraCharge');
                            if (paymentExtraCharge) {
                                paymentExtraCharge.innerHTML = `<span class="text-xl font-bold text-gray-800">ยอดชำระทั้งหมด:</span> <span class="text-2xl font-extrabold text-red-600">฿${totalAmount.toFixed(2)}</span>`;
                            }
                        };
                        // คำนวณเงินทอน
                        function calculateChange() {
                            const amountPaid = parseFloat(document.getElementById('amountPaid').value || 0);
                            const warningMessage = document.getElementById('paymentWarning');
                            const cashRefund = document.getElementById('cashRefund');

                            if (!isNaN(amountPaid)) {
                                const change = amountPaid - totalAmount;
                                cashRefund.value = change > 0 ? change.toFixed(2) : '0.00';

                                if (amountPaid < totalAmount) {
                                    warningMessage.classList.remove('hidden');
                                } else {
                                    warningMessage.classList.add('hidden');
                                }
                            }
                        }

                        // สลับการแสดง Modal
                        function toggleModal(modalId, show) {
                            const modal = document.getElementById(modalId);
                            if (modal) {
                                modal.classList.toggle('hidden', !show);
                            }
                        }

                        // ยืนยันการชำระเงิน
                        function confirmPayment() {
                            const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
                            const amountPaid = document.getElementById('amountPaid')?.value;
                            const damagedItems = Array.from(document.querySelectorAll('input[name="damaged_items[]"]:checked'))
                                .map(item => item.value);

                            // เก็บข้อมูลรายการที่เพิ่มเอง
                            const customDamages = [];
                            const customNameInputs = document.querySelectorAll('input[name^="custom_damages"][name$="[name]"]');
                            const customPriceInputs = document.querySelectorAll('input[name^="custom_damages"][name$="[price]"]');

                            customNameInputs.forEach((nameInput, index) => {
                                if (nameInput.value && customPriceInputs[index].value) {
                                    customDamages.push({
                                        name: nameInput.value,
                                        price: parseFloat(customPriceInputs[index].value)
                                    });
                                }
                            });

                            if (!paymentMethod) {
                                alert('กรุณาเลือกวิธีการชำระเงิน');
                                return;
                            }

                            if (paymentMethod === '2' && (!amountPaid || parseFloat(amountPaid) < totalAmount)) {
                                alert('กรุณาระบุจำนวนเงินที่ได้รับให้ถูกต้อง');
                                return;
                            }

                            const formData = {
                                booking_id: currentBookingId,
                                damaged_items: damagedItems,
                                custom_damages: customDamages,
                                payment_method: paymentMethod === '1' ? 'transfer' : 'cash',
                                amount_paid: amountPaid || 0,
                                total_price: totalAmount
                            };

                            fetch('/submit-damaged-items', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                    },
                                    body: JSON.stringify(formData)
                                })
                                .then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        alert('บันทึกข้อมูลเรียบร้อยแล้ว');
                                        window.location.reload();
                                    } else {
                                        alert(data.error || 'เกิดข้อผิดพลาด');
                                    }
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');
                                });
                        }

                        // ปิด Modal ทั้งหมด
                        function closeAllModals() {
                            ['checkoutPopup', 'damagedItemsPopup', 'paymentMethodPopup'].forEach(modalId => {
                                toggleModal(modalId, false);
                            });
                        }

                        // Filter by category
                        document.getElementById('categoryFilter').addEventListener('change', function() {
                            const selectedCategory = this.value.toLowerCase();
                            const categories = document.querySelectorAll('.category-group');

                            categories.forEach(category => {
                                if (!selectedCategory || category.dataset.category.toLowerCase() === selectedCategory) {
                                    category.classList.remove('hidden');
                                } else {
                                    category.classList.add('hidden');
                                }
                            });
                        });

                        // Search filter for items
                        document.getElementById('searchFilter').addEventListener('input', function() {
                            const searchTerm = this.value.toLowerCase();
                            const items = document.querySelectorAll('.category-group .flex.items-center');

                            items.forEach(item => {
                                const itemName = item.querySelector('label p').textContent.toLowerCase();
                                if (itemName.includes(searchTerm)) {
                                    item.classList.remove('hidden');
                                } else {
                                    item.classList.add('hidden');
                                }
                            });
                        });

                        // Event listeners
                        document.addEventListener('DOMContentLoaded', function() {
                            // Damaged/Not damaged buttons
                            document.getElementById('damagedButton')?.addEventListener('click', showDamagedItemsPopup);
                            document.getElementById('notDamagedButton')?.addEventListener('click', handleNotDamaged);

                            // Payment method selection
                            document.getElementById('payment_cash')?.addEventListener('change', () => {
                                document.getElementById('cashPaymentFields').classList.remove('hidden');
                                document.getElementById('transferPaymentFields').classList.add('hidden');
                            });

                            document.getElementById('payment_transfer')?.addEventListener('change', () => {
                                document.getElementById('cashPaymentFields').classList.add('hidden');
                                document.getElementById('transferPaymentFields').classList.remove('hidden');
                            });

                            // Amount paid input
                            document.getElementById('amountPaid')?.addEventListener('input', calculateChange);
                        });
                    </script>
                    <style>
                        #checkoutPopup,
                        #damagedItemsPopup {
                            z - index: 1000;
                        }

                        .modal - enter {
                            opacity: 0;
                            transform: scale(0.9);
                        }

                        .modal - enter - active {
                            opacity: 1;
                            transform: scale(1);
                            transition: opacity 0.3 s,
                                transform 0.3 s;
                        }

                        .modal - leave {
                            opacity: 1;
                            transform: scale(1);
                        }

                        .modal - leave - active {
                            opacity: 0;
                            transform: scale(0.9);
                            transition: opacity 0.3 s,
                                transform 0.3 s;
                        }
                    </style>
                </table>
                @else
                <p class="text-gray-600"> ไม่พบรายการรอเช็คเอาท์ </p>
                @endif


            </div>
        </section>

    </div>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <!-- <script>
        // Attach event listener to check-in button
        const checkInButtons = document.querySelectorAll('.fa-square-minus');
        checkInButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Show SweetAlert dialog with custom styling
                Swal.fire({
                    title: 'เพิ่มรายการ',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'เพิ่ม',
                    cancelButtonText: 'ไม่เพิ่ม',
                    customClass: {
                        confirmButton: 'btn btn-success btn-xl w-24 h-20 mr-12', // กำหนดคลาสของปุ่ม Confirm เป็น btn-success และ btn-lg
                        cancelButton: 'btn btn-danger btn-xl w-24 h-20' // กำหนดคลาสของปุ่ม Cancel เป็น btn-danger และ btn-lg
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'check-out_add.html'

                    } else if (result.dismiss === Swal.DismissReason.cancel) {
                        Swal.fire('สำเร็จ!', 'การเพิ่มรายการเสร็จสิ้น', 'success');
                    }
                });
            });
        });
    </script> -->
</body>

</html>