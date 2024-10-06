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

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('checkin') }}" id="checkin">
                    <div class="mr-2 text-base flex items-center ">
                        <i class="fa-solid fa-person-walking-luggage mr-1"></i>Check In
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('checkout') }}">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-person-walking-luggage fa-flip-horizontal mr-1"></i>Check Out
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-blue-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('store') }}" id="store">
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

        <section class="ml-10 bg-white" id="drink-table" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">

            <div class="max-w-screen-xl mx-auto py-10">
                <div class="px-2 p-2 flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">รายการเครื่องดื่ม</h1>
                </div>
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                    {{ session('error') }}
                </div>
                @endif

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-l bg-gray-300">
                            <th class="px-4 py-2">รูปสินค้า</th>
                            <th class="px-4 py-2">ชื่อสินค้า</th>
                            <th class="px-4 py-2">ราคา</th>
                            <th class="px-4 py-2">สถานะ</th>
                            <th class="px-4 py-2">ประเภท</th>
                            <th class="px-4 py-2">จำนวนคงเหลือ</th>
                            <th class="px-4 py-2">เลือกจำนวน</th>
                            <th class="px-4 py-2">ซื้อ</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @if($drinks->isNotEmpty())
                        @foreach($drinks as $drink)
                        <tr>
                            <!-- Display product image -->
                            <td class="px-4 py-2">
                                <img src="{{ asset('images/' . $drink->product_img) }}" alt="{{ $drink->product_name }}" class="w-16 h-16 object-cover rounded-md">
                            </td>
                            <td class="px-4 py-2">{{ $drink->product_name }}</td>
                            <td class="px-4 py-2">{{ $drink->product_price }} บาท</td>
                            <td class="px-4 py-2">
                                @if($drink->product_status === 'พร้อมให้บริการ')
                                <span class="inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300">
                                    <span class="w-2 h-2 me-1 bg-green-300 rounded-full mr-1"></span>
                                    พร้อมให้บริการ
                                </span>
                                @else
                                <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                    <span class="w-2 h-2 me-1 bg-red-300 rounded-full mr-1"></span>
                                    ไม่พร้อมให้บริการ
                                </span>
                                @endif
                            </td>
                            <td class="px-4 py-2">{{ $drink->productType->product_type_name }}</td>
                            <td class="px-4 py-2">{{ $drink->stock->stock_qty }} ชิ้น</td>
                            <td class="px-4 py-2">
                                <form action="{{ route('buyProduct') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $drink->id }}">
                                    <input type="number" name="quantity" id="quantityInput_{{ $drink->id }}" class="border border-gray-300 rounded-md text-center w-16" min="1" max="{{ $drink->stock->stock_qty }}" value="1" required>
                                </form>
                            </td>
                            <td class="px-4 py-2">
                                <button type="button" onclick="openPaymentModal({{ $drink->id }}, {{ $drink->stock->stock_qty }})" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    ซื้อ
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8" class="px-4 py-2 text-gray-600">ไม่มีสินค้าในหมวดเครื่องดื่ม</td>
                        </tr>
                        @endif
                    </tbody>
                </table>

            </div>
        </section>

        <div id="paymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <h1 class="text-center text-2xl font-bold mb-4">เลือกวิธีการชำระเงิน</h1>
                <form id="paymentForm" action="{{ route('buyProduct') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" id="product_id">
                    <input type="hidden" name="quantity" id="quantity">

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">วิธีการชำระเงิน</label>
                        <select name="payment_method" class="border border-gray-300 rounded-md text-center w-full" required>
                            <option value="cash">เงินสด</option>
                            <option value="transfer">โอนเงิน</option>
                        </select>
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">ยืนยันการชำระเงิน</button>
                    </div>
                </form>
            </div>
        </div>


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

    <script>
        // ฟังก์ชันเปิด Modal และตั้งค่า product_id และ quantity
        function openPaymentModal(productId, maxQty) {
            const quantityInput = document.querySelector(`#quantityInput_${productId}`).value;

            document.getElementById('product_id').value = productId;
            document.getElementById('quantity').value = quantityInput;

            document.getElementById('paymentModal').classList.remove('hidden');
        }



        // ฟังก์ชันปิด Modal
        function closePaymentModal() {
            document.getElementById('paymentModal').classList.add('hidden');
        }

        // ตรวจจับการคลิกนอก Modal เพื่อปิด
        window.onclick = function(event) {
            var modal = document.getElementById('paymentModal');
            if (event.target === modal) {
                closePaymentModal();
            }
        }

        // ฟังก์ชันซ่อนหรือแสดง QR Code
        function toggleQRCode() {
            var paymentMethod = document.querySelector('select[name="payment_method"]').value;
            var qrCodeContainer = document.getElementById('qrCodeContainer');
            if (paymentMethod === 'transfer') {
                qrCodeContainer.classList.remove('hidden');
            } else {
                qrCodeContainer.classList.add('hidden');
            }
        }
    </script>
</body>

</html>