<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thunthree Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        body {
            font-family: 'Kanit', sans-serif !important;
            color: #0c0c0c;
        }
    </style>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg max-w-5xl w-full">
        <div class="border-b pb-4 mb-4 flex justify-between items-center">
            <div class="flex items-center">
                <img src="/images/Logo_2.jpg" alt="Thunthree" class="w-24 h-auto mr-4">
                <h2 class="text-4xl font-semibold font-kanit">Thunthree</h2>
            </div>
            <img src="/images/PromptPay-logo.png" alt="THAI QR PAYMENT" class="w-32 h-auto">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gray-100 p-4 rounded">
                <h2 class="text-lg font-semibold mb-2">ข้อมูลการจอง</h2>
                <p><strong>ชื่อผู้เข้าพัก:</strong> {{ $bookingDetail->booking_name }}</p>
                <p><strong>จำนวนผู้เข้าพัก:</strong> {{ $bookingDetail->booking->person_count }}</p>
                <p><strong>เบอร์โทรศัพท์:</strong> {{ $bookingDetail->phone }}</p>
                <p class="mr-4"><strong>เช็คอิน:</strong>
                    {{ \Carbon\Carbon::parse($bookingDetail->checkin_date)->format('d-m-Y') }}
                </p>
                <p><strong>เช็คเอาท์:</strong>
                    {{ \Carbon\Carbon::parse($bookingDetail->checkout_date)->format('d-m-Y') }}
                </p>
                <p><strong>จำนวนวันที่เข้าพัก:</strong>
                    {{ \Carbon\Carbon::parse($bookingDetail->checkin_date)->diffInDays(\Carbon\Carbon::parse($bookingDetail->checkout_date)) }}
                    วัน
                </p>
            </div>

            <div class="bg-gray-100 p-4 rounded">
                <h2 class="text-lg font-semibold mb-2">รายละเอียดการชำระเงิน</h2>
                <p><strong>ค่าใช้จ่ายทั้งหมด:</strong> {{ $bookingDetail->booking->total_cost }} บาท</p>

                @if (isset($promotionData))
                    <p><strong>รหัสโปรโมชั่น:</strong> {{ $promotionData['promo_code'] }}</p>
                    <p><strong>จำนวนส่วนลด:</strong> {{ $promotionData['discount_value'] }}
                        {{ $promotionData['type'] === 'percentage' ? '%' : '฿' }}
                    </p>
                @else
                    <p><strong>รหัสโปรโมชั่น:</strong> ไม่มีโปรโมชั่น</p>
                @endif

                <p><strong>กำหนดชำระภายใน:</strong> <span id="countdowntime-left">15 นาที</span></p>
                <p><small>ท่านมีเวลาคงเหลืออีก: <span class="text-red" id="countdown"></span></small></p>
            </div>
        </div>

        <div class="mt-6">
            <h2 class="text-lg font-semibold mb-4">วิธีชำระเงินด้วยรหัส QR Code</h2>
            <div class="flex justify-center">
                <div id="qrcode"></div>
            </div>
            <ol class="mt-4 list-decimal list-inside">
                <li>เปิดแอพพลิเคชั่นของธนาคารบนอุปกรณ์มือถือที่ต้องการใช้งาน</li>
                <li>สแกน QR Code หรือปุ่มสแกน QR Code และปฏิบัติตามในแอพพลิเคชั่นธนาคารของท่าน</li>
                <li>ตรวจสอบยอดการชำระเงินและรายละเอียดการชำระเงิน</li>
                <li>ยืนยันการชำระเงินและรอใบยืนยันการจองไปยังอีเมลที่ท่านใช้ในการจอง</li>
            </ol>
        </div>

        <form id="payment-form" action="/create-payment-intent" method="POST" class="mt-4">
            @csrf
            <input type="hidden" id="booking_id" name="booking_id" value="{{ $bookingDetail->booking_id }}">
            <div class="flex space-x-4 float-right">
                <button id="pay-button" type="button"
                    class="w-54 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">
                    ชำระเงินด้วยพร้อมเพย์
                </button>
                <button id="cancel-button" type="button"
                    class="w-54 bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700"
                    onclick="cancelBooking('{{ $bookingDetail->booking_id }}')">
                    ยกเลิกการชำระเงิน
                </button>
            </div>
        </form>
    </div>

    <script>
        const stripe = Stripe("{{ env('STRIPE_KEY') }}");
        let timer;

        document.addEventListener('DOMContentLoaded', function() {
            const expirationTime = new Date("{{ $payment->expiration_time }}");
            const now = new Date();
            let countdown = Math.floor((expirationTime - now) / 1000);

            if (countdown > 0) {
                timer = setInterval(updateTimer, 1000);
            } else {
                handleTimeout();
            }

            function updateTimer() {
                if (countdown <= 0) {
                    clearInterval(timer);
                    handleTimeout();
                    return;
                }

                countdown--;
                const minutes = Math.floor(countdown / 60);
                const seconds = countdown % 60;
                document.getElementById('countdown').textContent =
                    `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            }

            function handleTimeout() {
                document.getElementById('countdown').textContent = 'หมดเวลา';
                document.getElementById('pay-button').style.display = 'none';

                Swal.fire({
                    icon: 'warning',
                    title: 'หมดเวลาชำระเงิน',
                    text: 'การจองของคุณถูกยกเลิกแล้ว',
                    confirmButtonText: 'ตกลง'
                }).then(() => {
                    cancelBooking('{{ $bookingDetail->booking_id }}');
                });
            }
        });

        document.getElementById('pay-button').addEventListener('click', async function() {
            const bookingId = document.getElementById('booking_id').value;

            try {
                const response = await fetch('/create-payment-intent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        booking_id: bookingId
                    })
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                const clientSecret = data.client_secret;

                const {
                    paymentMethod,
                    error: paymentMethodError
                } = await stripe.createPaymentMethod({
                    type: 'promptpay',
                    billing_details: {
                        email: '{{ $bookingDetail->email ?? ($userEmail ?? 'guest@example.com') }}', // Provide a fallback
                        name: '{{ $bookingDetail->booking_name }}',
                        phone: '{{ $bookingDetail->phone }}',
                    }
                });

                if (paymentMethodError) {
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: paymentMethodError.message,
                        confirmButtonText: 'ตกลง'
                    });
                    return;
                }

                const result = await stripe.confirmPromptPayPayment(clientSecret, {
                    payment_method: paymentMethod.id
                });

                if (result.error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: result.error.message,
                        confirmButtonText: 'ตกลง'
                    });
                } else {
                    updatePaymentStatus(bookingId);
                }
            } catch (error) {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                    text: error.message,
                    confirmButtonText: 'ตกลง'
                });
            }
        });

        function updatePaymentStatus(bookingId) {
            fetch('/update-payment-status', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        booking_id: bookingId,
                        payment_status: 'succeeded',
                        booking_detail_status: 'รอเลือกห้อง',
                        booking_status: 'ชำระเงินเสร็จสิ้น'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'ชำระเงินสำเร็จ',
                            text: 'การชำระเงินสำเร็จแล้ว!',
                            confirmButtonText: 'ตกลง'
                        }).then(() => {
                            window.location.href = '/';
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'เกิดข้อผิดพลาด',
                        text: 'ไม่สามารถอัปเดตสถานะการชำระเงินได้',
                        confirmButtonText: 'ตกลง'
                    });
                });
        }

        function cancelBooking(bookingId) {
            fetch('/cancel-booking/' + bookingId, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        payment_status: 'cancel'
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'ยกเลิกสำเร็จ',
                            text: 'การยกเลิกการจองและการชำระเงินสำเร็จแล้ว',
                            confirmButtonText: 'ตกลง'
                        }).then(() => {
                            window.location.href = '/';
                        });
                    }
                });
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>
