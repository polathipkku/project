<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">


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



                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:text-blue-700 hover:text-sm" href="em_user.html" id="Users">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-user mr-2"></i>Users
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('emroom')}}">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-door-open mr-1"></i>Room
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('checkin') }}" id="checkin">
                    <div class="mr-2 text-base flex items-center ">
                        <i class="fa-solid fa-person-walking-luggage mr-1"></i>Check In
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-blue-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="em_check-out.html" id="Stock">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-person-walking-luggage fa-flip-horizontal mr-1"></i>Check Out
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('store') }}" id="store">
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
                <div class="px-2 p-2  flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">Check-Out</h1>

                </div>
                @if(count($bookings) > 0)
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
                        @foreach($bookings as $booking)
                        @foreach($booking->bookingDetails as $detail)
                        @if($detail->booking_detail_status == 'เช็คอินแล้ว' && $detail->booking_detail_status !== 'เช็คเอาท์')
                        <tr>
                            <td class="px-4 py-2">
                                @if($detail->room)
                                {{ $detail->room->room_name }}
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $detail->booking_detail_status }}</td>
                            <td class="px-4 py-2">{{ $detail->checkout_date }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('checkoutdetail', ['id' => $booking->id]) }}" class="text-blue-500 hover:text-blue-700">
                                    <button class="py-2 px-4 round  ed-md hover:underline focus:outline-none focus:shadow-outline-blue active:text-blue-800" type="button">
                                        รายละเอียด
                                    </button>
                                </a>
                            </td>

                            <td class="px-4 py-4 flex justify-center items-center border-b">
                                @if($detail->booking_detail_status === 'เช็คอินแล้ว')
                                <button
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded transition duration-300"
                                    onclick="showCheckoutPopup('{{ $booking->id }}')">
                                    เช็คเอาท์
                                </button>

                                <form id="checkoutForm-{{ $booking->id }}" action="{{ route('checkoutuser') }}" method="post" class="hidden">
                                    @csrf
                                    <input type="hidden" name="booking_id" value="{{ $booking->id }}">
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
                    <div id="checkoutPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white p-6 rounded-lg shadow-2xl max-w-md w-full">
                            <h2 class="text-2xl font-semibold mb-4 text-center text-gray-800">
                                ห้องชำรุดหรือไม่?
                            </h2>
                            <p class="mb-6 text-center text-gray-600">
                                กรุณาเลือกสถานะของห้อง:
                            </p>
                            <div class="flex space-x-4 justify-center mb-4">
                                <button id="damagedButton"
                                    class="bg-red-500 hover:bg-red-600 text-white font-medium px-6 py-3 rounded-lg transition duration-300">
                                    ชำรุด
                                </button>
                                <button id="notDamagedButton"
                                    class="bg-green-500 hover:bg-green-600 text-white font-medium px-6 py-3 rounded-lg transition duration-300">
                                    ไม่ชำรุด
                                </button>
                            </div>
                            <div class="flex justify-center">
                                <button class="mt-4 text-gray-500 hover:text-gray-700 underline transition duration-200"
                                    onclick="closePopup()">
                                    ปิด
                                </button>
                            </div>
                        </div>
                    </div>

                    <div id="damagedItemsPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white p-6 rounded-lg shadow-xl max-w-lg w-full">
                            <h2 class="text-2xl font-semibold mb-6 text-center text-gray-800">เลือกรายการที่ชำรุด</h2>

                            <!-- Search Bar -->
                            <div class="mb-4">
                                <input
                                    type="text"
                                    id="searchInput"
                                    placeholder="ค้นหาชื่อสินค้า..."
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring focus:ring-blue-200"
                                    oninput="filterItems()">
                            </div>

                            <form id="damagedItemsForm" action="{{ route('submitDamagedItems') }}" method="post" class="space-y-4">
                                @csrf
                                <input type="hidden" name="booking_id" id="damagedBookingId">

                                <!-- Section for items -->
                                <div id="itemsContainer" class="max-h-72 overflow-y-auto divide-y divide-gray-200">
                                    @foreach($productRooms->groupBy('productroom_category') as $category => $items)
                                    <div class="category-group py-3">
                                        <h3 class="text-lg font-medium text-gray-700 mb-3">{{ $category }}</h3>
                                        @foreach($items as $item)
                                        <div class="flex items-start mb-2 item-row">
                                            <input
                                                type="checkbox"
                                                id="item-{{ $item->id }}"
                                                name="damaged_items[]"
                                                value="{{ $item->id }}"
                                                class="w-4 h-4 mt-1 mr-2 border-gray-300 rounded focus:ring-blue-500">
                                            <label for="item-{{ $item->id }}" class="flex items-center justify-between w-full">
                                                <div>
                                                    <span class="block text-gray-800 font-medium item-name">{{ $item->productroom_name }}</span>
                                                    <span class="block text-gray-500 text-sm">฿{{ number_format($item->productroom_price, 2) }}</span>
                                                </div>
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @endforeach
                                </div>

                                <!-- Action buttons -->
                                <div class="flex justify-between items-center mt-6">
                                    <button
                                        type="submit"
                                        class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-md shadow-md transition duration-300">
                                        ยืนยัน
                                    </button>
                                    <button
                                        type="button"
                                        class="text-gray-500 underline hover:text-gray-700 transition duration-300"
                                        onclick="closeDamagedItemsPopup()">
                                        ยกเลิก
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <script>
                        function filterItems() {
                            const searchInput = document.getElementById('searchInput').value.toLowerCase();
                            const itemRows = document.querySelectorAll('.item-row');

                            itemRows.forEach(row => {
                                const itemName = row.querySelector('.item-name').textContent.toLowerCase();
                                row.style.display = itemName.includes(searchInput) ? 'flex' : 'none';
                            });
                        }
                    </script>



                    <div id="paymentMethodPopup" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full">
                        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                            <div class="mt-3 text-center">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">เลือกวิธีการชำระเงิน</h3>
                                <div class="mt-2 px-7 py-3">
                                    <p class="text-sm text-gray-500" id="paymentExtraCharge"></p>
                                    <input type="hidden" id="paymentCheckoutextendId">

                                    <div>
                                        <label>
                                            <input type="radio" name="payment_method" value="cash" onclick="showCashRefundField()"> เงินสด
                                        </label>
                                        <label>
                                            <input type="radio" name="payment_method" value="transfer" onclick="hideCashRefundField()"> โอนเงิน
                                        </label>
                                    </div>

                                    <!-- Amount Paid Field -->
                                    <div>
                                        <label for="amountPaid">จำนวนเงินที่จ่าย:</label>
                                        <input type="number" id="amountPaid" class="mt-2 px-3 py-2 border rounded-md w-full" min="0" step="0.01" placeholder="ระบุจำนวนเงินที่ลูกค้าจ่าย">
                                    </div>
                                    <!-- Cash Refund Field -->
                                    <div id="cashRefundField" class="hidden">
                                        <label for="cashRefund">เงินทอน:</label>
                                        <input type="number" id="cashRefund" class="mt-2 px-3 py-2 border rounded-md w-full" min="0" step="0.01" placeholder="ระบุจำนวนเงินทอน">
                                    </div>
                                </div>

                                <div class="items-center px-4 py-3">
                                    <button onclick="confirmPayment(document.querySelector('input[name=payment_method]:checked').value)"
                                        class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                                        ยืนยัน
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <script>
                        function showCashRefundField() {
                            document.getElementById('cashRefundField').classList.remove('hidden');
                        }

                        function hideCashRefundField() {
                            document.getElementById('cashRefundField').classList.add('hidden');
                        }
                    </script>

                    <script>
                        function showExtendCheckoutModal(bookingId, bookingDetailId) {
                            document.getElementById('bookingId').value = bookingId;
                            document.getElementById('bookingDetailId').value = bookingDetailId;
                            document.getElementById('extendCheckoutModal').classList.remove('hidden');
                        }
                        document.getElementById('confirmExtendCheckout').addEventListener('click', function() {
                            let bookingId = document.getElementById('bookingId').value;
                            let bookingDetailId = document.getElementById('bookingDetailId').value;
                            let extendDays = document.getElementById('extendDays').value;

                            fetch('/extend-checkout', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        booking_id: bookingId,
                                        booking_detail_id: bookingDetailId,
                                        extend_days: extendDays
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    // แสดง popup ให้เลือกวิธีการชำระเงิน
                                    showPaymentMethodPopup(data.checkoutextend_id, data.extra_charge);

                                    // ซ่อน modal หรือทำการอัปเดต UI ตามที่ต้องการ
                                    document.getElementById('extendCheckoutModal').classList.add('hidden');
                                })

                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        });

                        function showPaymentMethodPopup(checkoutextendId, extraCharge) {
                            // แสดง modal หรือ popup ให้ผู้ใช้เลือกวิธีการชำระเงิน
                            // ตัวอย่างการแสดง popup
                            const paymentPopup = document.getElementById('paymentMethodPopup');
                            paymentPopup.classList.remove('hidden');

                            // ตั้งค่า ID ของ checkoutextend และค่าใช้จ่ายเพิ่มเติม
                            document.getElementById('paymentCheckoutextendId').value = checkoutextendId;
                            document.getElementById('paymentExtraCharge').textContent = `ค่าใช้จ่ายเพิ่มเติม: ${extraCharge} บาท`;
                        }

                        // ฟังก์ชันจัดการการชำระเงิน
                        function confirmPayment(method) {
                            const checkoutextendId = document.getElementById('paymentCheckoutextendId').value;
                            const cashRefund = method === 'cash' ? document.getElementById('cashRefund').value : null;
                            const amountPaid = document.getElementById('amountPaid').value; // Get amount paid

                            fetch('/save-payment', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    },
                                    body: JSON.stringify({
                                        checkoutextend_id: checkoutextendId,
                                        payment_method: method,
                                        cash_refund: cashRefund,
                                        amount_paid: amountPaid // Send amount paid in the request
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    alert(data.message);
                                    // Close the popup and update UI as necessary
                                    closePaymentMethodPopup();
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        }


                        function closePaymentMethodPopup() {
                            document.getElementById('paymentMethodPopup').classList.add('hidden');
                        }
                    </script>

                    <script>
                        let currentBookingId;

                        function showCheckoutPopup(bookingId) {
                            currentBookingId = bookingId;
                            document.getElementById('checkoutPopup').classList.remove('hidden');
                        }

                        document.getElementById('damagedButton').onclick = function() {
                            closePopup();
                            showDamagedItemsPopup();
                        };

                        document.getElementById('notDamagedButton').onclick = function() {
                            document.getElementById(`checkoutForm-${currentBookingId}`).submit();
                            closePopup();
                        };

                        function closePopup() {
                            document.getElementById('checkoutPopup').classList.add('hidden');
                        }

                        function showDamagedItemsPopup() {
                            document.getElementById('damagedBookingId').value = currentBookingId;
                            document.getElementById('damagedItemsPopup').classList.remove('hidden');
                        }

                        function closeDamagedItemsPopup() {
                            document.getElementById('damagedItemsPopup').classList.add('hidden');
                        }
                    </script>


                    <style>
                        #checkoutPopup,
                        #damagedItemsPopup {
                            z-index: 1000;
                        }
                    </style>
                </table>
                @else
                <p class="text-gray-600">ไม่พบการจอง</p>
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