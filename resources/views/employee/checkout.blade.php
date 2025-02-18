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
                    <h1 class="text-4xl mb-10 max-xl:px-4">เช็คเอาท์</h1>

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
                                                {{ \Carbon\Carbon::parse($detail->checkout_date)->format('d/m/y') }}
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
                            <div
                                class="bg-white rounded-xl shadow-xl max-w-lg w-full relative transform transition-all duration-300">
                                <!-- Gradient Header Bar -->
                                <div
                                    class="absolute inset-x-0 top-0 h-2 bg-gradient-to-r from-blue-400 via-blue-500 to-blue-600 rounded-t-xl">
                                </div>

                                <div class="p-8">
                                    <h2 class="text-2xl font-bold mb-4 text-center text-gray-800">
                                        ตรวจสอบความเสียหาย
                                    </h2>
                                    <p class="mb-6 text-center text-gray-600">
                                        กรุณาตรวจสอบความเสียหายของห้องพักก่อนดำเนินการเช็คเอาท์
                                    </p>

                                    <div class="grid grid-cols-2 gap-4 mb-6">
                                        <button id="damagedButton"
                                            class="flex items-center justify-center gap-2 px-6 py-4 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg shadow-md transition duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                            พบความเสียหาย
                                        </button>
                                        <button id="notDamagedButton"
                                            class="flex items-center justify-center gap-2 px-6 py-4 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg shadow-md transition duration-300">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            ไม่พบความเสียหาย
                                        </button>
                                    </div>

                                    <div class="flex justify-center">
                                        <button onclick="closePopup()"
                                            class="text-gray-500 hover:text-gray-700 font-medium transition duration-200">
                                            ยกเลิก
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="damagedItemsPopup"
                            class="hidden fixed inset-0 z-50 flex items-center justify-center p-4">
                            <!-- Backdrop -->
                            <div class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm"></div>

                            <!-- Modal -->
                            <div class="relative w-full max-w-lg animate-in fade-in zoom-in-95 duration-200">
                                <div class="relative rounded-xl bg-white shadow-2xl ring-1 ring-slate-900/10">
                                    <!-- Header -->
                                    <div class="flex items-center justify-between border-b border-slate-100 px-6 py-4">
                                        <h2 class="text-lg font-semibold text-slate-900">
                                            เลือกรายการที่ชำรุด
                                        </h2>
                                        <button onclick="closePopup2()"
                                            class="rounded-full p-2 text-slate-400 hover:bg-slate-50 hover:text-slate-500">
                                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none">
                                                <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" />
                                            </svg>
                                        </button>
                                    </div>

                                    <form id="damagedItemsForm" action="{{ route('submitDamagedItems') }}"
                                        method="post">
                                        @csrf
                                        <input type="hidden" name="booking_id" id="damagedBookingId">

                                        <div class="p-6">
                                            <!-- Filters Section -->
                                            <div class="grid gap-4 md:grid-cols-2 mb-4">
                                                <div class="space-y-1.5">
                                                    <label for="categoryFilter"
                                                        class="text-sm font-medium text-slate-700">
                                                        หมวดหมู่
                                                    </label>
                                                    <div class="relative">
                                                        <select id="categoryFilter"
                                                            class="w-full rounded-lg border-slate-200 bg-slate-50 pl-10 pr-4 py-2.5 text-sm text-slate-800 shadow-sm transition-colors hover:border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                                                            <option value="">ทั้งหมด</option>
                                                            @foreach ($productRooms->groupBy('productroom_category') as $category => $items)
                                                                <option value="{{ $category }}">
                                                                    {{ $category }}</option>
                                                            @endforeach
                                                        </select>
                                                        <svg class="absolute left-3 top-1/3 -translate-y-1/2 h-5 w-5 text-slate-400"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                                        </svg>
                                                    </div>
                                                </div>

                                                <div class="space-y-1.5">
                                                    <label for="searchFilter"
                                                        class="text-sm font-medium text-slate-700">
                                                        ค้นหา
                                                    </label>
                                                    <div class="relative">
                                                        <input id="searchFilter" type="text"
                                                            class="w-full rounded-lg border-slate-200 bg-slate-50 pl-10 pr-4 py-2.5 text-sm text-slate-800 shadow-sm transition-colors hover:border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20"
                                                            placeholder="พิมพ์เพื่อค้นหา...">
                                                        <svg class="absolute left-3 top-1/3 -translate-y-1/2 h-5 w-5 text-slate-400"
                                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Items Container with fixed height -->
                                            <div id="itemsContainer" class=" max-h-64 overflow-y-auto rounded-lg border border-slate-200 bg-slate-50/50 scrollbar-thin scrollbar-thumb-slate-300 hover:scrollbar-thumb-slate-400">

                                                <div class="p-4 space-y-4">
                                                    @foreach ($productRooms->groupBy('productroom_category') as $category => $items)
                                                        <div class="category-group"
                                                            data-category="{{ $category }}">
                                                            <div
                                                                class="top-0 z-10 -mx-4 -mt-4 bg-slate-50/95 px-4 py-2 backdrop-blur-sm border-y border-slate-200">
                                                                <h3
                                                                    class=" text-sm font-semibold uppercase tracking-wider text-slate-500">
                                                                    {{ $category }}
                                                                </h3>
                                                            </div>
                                                            <div class="pt-2 space-y-3">
                                                                @foreach ($items as $item)
                                                                    <div
                                                                        class="group rounded-lg bg-white p-3 shadow-sm ring-1 ring-slate-200 transition-all hover:bg-slate-50 hover:shadow-md">
                                                                        <div class="flex items-center justify-between">
                                                                            <div class="flex items-center space-x-4">
                                                                                <div
                                                                                    class="relative flex h-5 items-center">
                                                                                    <input type="checkbox"
                                                                                        id="item-{{ $item->id }}"
                                                                                        name="damaged_items[]"
                                                                                        value="{{ $item->id }}"
                                                                                        data-price="{{ $item->productroom_price }}"
                                                                                        class="h-4 w-4 rounded-sm border-slate-300 text-blue-600 transition-colors focus:ring-2 focus:ring-blue-500/20"
                                                                                        onchange="updateTotalAmount()">
                                                                                </div>
                                                                                <label for="item-{{ $item->id }}"
                                                                                    class="flex-1 cursor-pointer">
                                                                                    <p
                                                                                        class="font-medium text-slate-900">
                                                                                        {{ $item->productroom_name }}
                                                                                    </p>
                                                                                    <p
                                                                                        class="mt-0.5 text-sm text-slate-500">
                                                                                        ฿{{ number_format($item->productroom_price, 2) }}
                                                                                    </p>
                                                                                </label>
                                                                            </div>
                                                                            <div class="flex items-center">
                                                                                <span
                                                                                    class="rounded-full bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-600">
                                                                                    {{ $item->productroom_qty }} ชิ้น
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>

                                            <!-- Custom Items -->
                                            <div id="customDamagesList" class="mt-4 space-y-3"></div>

                                            <!-- Add Custom Item Button -->
                                            <button type="button" onclick="addCustomDamageField()"
                                                class="mt-4 w-full rounded-lg border border-blue-600 bg-blue-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition-all hover:bg-transparent hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500/20">
                                                <span class="flex items-center justify-center gap-2">
                                                    <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    เพิ่มรายการ
                                                </span>
                                            </button>
                                        </div>

                                        <!-- Footer -->
                                        <div
                                            class="flex items-center justify-end gap-3 border-t border-slate-100 bg-slate-50 px-6 py-4 rounded-b-xl">
                                            <button type="button" onclick="closePopup2()"
                                                class="rounded-lg px-4 py-2 text-sm font-medium text-slate-600 hover:text-slate-800">
                                                ยกเลิก
                                            </button>
                                            <button type="submit"
                                                class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                                ยืนยัน
                                            </button>
                                        </div>
                                    </form>
                                </div>
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
                        class="p-3 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors mt-4"
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
                                    paymentExtraCharge.innerHTML =
                                        `<span class="text-xl font-bold text-gray-800">ยอดชำระทั้งหมด:</span> <span class="text-2xl font-extrabold text-red-600">฿${totalAmount.toFixed(2)}</span>`;
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

                            /* .modal - enter {
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
                            } */
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
