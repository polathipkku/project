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
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>Tunthree</title>




</head>

<body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>

    <div style="display: flex; background-color: #F5F3FF;">

        @include('components.em_sidebar')


        <section class="ml-10 bg-white rounded-lg" id="drink-table" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <div class="max-w-screen-xl mx-auto py-6">
                <div class="px-2 p-2 flex justify-between items-center border-b border-gray-200 pb-4">
                    <h1 class="text-3xl font-semibold text-black max-xl:px-4">สต็อกสินค้า</h1>
                    <div class="flex items-center">
                        <i class="fas fa-coffee text-blue-600 mr-2 text-xl"></i>
                        <span class="text-gray-600">สต็อกสินค้าทั้งหมด: {{ $drinks->count() ?? 0 }}</span>
                    </div>
                </div>
                
                @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 px-4 py-3 rounded my-4 shadow-sm">
                    <div class="flex">
                        <div class="py-1"><i class="fas fa-check-circle text-green-500 mr-2"></i></div>
                        <div>{{ session('success') }}</div>
                    </div>
                </div>
                @endif
        
                @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded my-4 shadow-sm">
                    <div class="flex">
                        <div class="py-1"><i class="fas fa-exclamation-circle text-red-500 mr-2"></i></div>
                        <div>{{ session('error') }}</div>
                    </div>
                </div>
                @endif
        
                <div class="mt-6 overflow-hidden rounded-lg border border-gray-200">
                    <table class="w-full border-collapse bg-white">
                        <thead>
                            <tr class="text-sm font-medium uppercase tracking-wider text-gray-700 bg-gradient-to-r from-blue-100 to-indigo-200 border-b">
                                <th class="px-6 py-3 text-center">ชื่อสินค้า</th>
                                <th class="px-6 py-3 text-center">จำนวนคงเหลือ</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @if($drinks->isNotEmpty())
                            @foreach($drinks as $drink)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-center"> <!-- เพิ่ม text-center ที่นี่ -->
                                    <div class="flex items-center justify-center"> <!-- เพิ่ม justify-center ที่นี่ -->
                                        <span class="font-medium text-gray-900">{{ $drink->product_name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <span class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full {{ $drink->stock->stock_qty > 10 ? 'bg-green-100 text-green-800' : ($drink->stock->stock_qty > 5 ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ $drink->stock->stock_qty }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="2" class="px-6 py-4 text-center text-gray-500 italic">
                                    <div class="flex flex-col items-center justify-center py-4">
                                        <i class="fa-solid fa-soap text-gray-400 text-3xl mb-2"></i>
                                        ไม่มีสินค้า
                                    </div>
                                </td>
                            </tr>
                            @endif
                        </tbody>                        
                    </table>
                </div>
            </div>
        </section>

        <div id="paymentModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <h1 class="text-center text-2xl font-bold mb-4">เลือกวิธีการชำระเงิน</h1>
                <form id="paymentForm">
                    @csrf
                    <input type="hidden" name="product_id" id="product_id">
                    <input type="hidden" name="quantity" id="quantity">

                    <div class="mb-4">
                        <label class="block mb-2 text-sm font-medium text-gray-700">วิธีการชำระเงิน</label>
                        <select name="payment_method" id="payment_method" class="border border-gray-300 rounded-md text-center w-full" required>
                            <option value="">-- กรุณาเลือกวิธีการชำระเงิน --</option>

                            <option value="cash">เงินสด</option>
                            <option value="transfer">โอนเงิน</option>
                        </select>
                    </div>

                    <div id="cashPaymentDetails" class="mb-4 hidden">
                        <label class="block mb-2 text-sm font-medium text-gray-700">จำนวนเงินที่รับ</label>
                        <input type="number" name="received_amount" id="received_amount" class="border border-gray-300 rounded-md text-center w-full" step="0.01" min="0">
                    </div>

                    <div class="flex justify-center">
                        <button type="submit" id="submitPayment" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">ยืนยันการชำระเงิน</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="paymentResultModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <h1 class="text-center text-2xl font-bold mb-4">ผลการชำระเงิน</h1>
                <div id="paymentResultContent"></div>
                <div class="flex justify-center mt-4">
                    <button onclick="closePaymentResultModal()" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">ปิด</button>
                </div>
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
        function openPaymentModal(productId, maxQty) {
            const quantityInput = document.querySelector(`#quantityInput_${productId}`).value;
            document.getElementById('product_id').value = productId;
            document.getElementById('quantity').value = quantityInput;
            document.getElementById('paymentModal').classList.remove('hidden');
        }

        function closePaymentModal() {
            document.getElementById('paymentModal').classList.add('hidden');
        }

        document.getElementById('payment_method').addEventListener('change', function() {
            const cashDetails = document.getElementById('cashPaymentDetails');
            if (this.value === 'cash') {
                cashDetails.classList.remove('hidden');
            } else {
                cashDetails.classList.add('hidden');
            }
        });

        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const paymentMethod = document.getElementById('payment_method').value;
            const receivedAmount = document.getElementById('received_amount').value;

            if (paymentMethod === 'cash' && (!receivedAmount || receivedAmount <= 0)) {
                alert('กรุณากรอกจำนวนเงินที่รับให้ถูกต้อง');
                return;
            }

            fetch('{{ route("buyProduct") }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('เกิดข้อผิดพลาดในการทำรายการ');
                    }
                    return response.json();
                })
                .then(data => {
                    closePaymentModal();

                    // ไม่ต้องแสดงผลการชำระเงินที่ modal อีกต่อไป
                    alert(data.message || 'การทำรายการเสร็จสมบูรณ์');
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert(error.message || 'เกิดข้อผิดพลาดในการทำรายการ');
                });
        });

        window.onclick = function(event) {
            var modal = document.getElementById('paymentModal');
            if (event.target === modal) {
                closePaymentModal();
            }
        }
    </script>

</body>

</html>