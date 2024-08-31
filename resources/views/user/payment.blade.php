<!DOCTYPE html>
<html>

<head>
    <title>Thunthree Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Kanit', sans-serif !important;
            color: #0c0c0c;
        }
    </style>
    <script src="https://cdn.tailwindcss.com"></script>
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
        @foreach ($bookings as $booking)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-gray-100 p-4 rounded">
                <h2 class="text-lg font-semibold mb-2">ข้อมูลการจอง</h2>
                <p><strong>ชื่อผู้เข้าพัก:</strong> {{ $booking->booking_name }}</p>
                <p><strong>จำนวนผู้เข้าพัก:</strong> {{ $booking->occupancy_person }}</p>
                <p><strong>เบอร์โทรศัพท์:</strong> {{ $booking->phone }}</p>

                <p class="mr-4"><strong>เช็คอิน:</strong>
                    {{ \Carbon\Carbon::parse($booking->checkin_date)->format('d-m-Y') }}
                </p>
                <p><strong>เช็คเอาท์:</strong>
                    {{ \Carbon\Carbon::parse($booking->checkout_date)->format('d-m-Y') }}
                </p>
                <p><strong>จำนวนวันที่เข้าพัก:</strong>
                    {{ \Carbon\Carbon::parse($booking->checkin_date)->diffInDays(\Carbon\Carbon::parse($booking->checkout_date)) }} วัน
                </p>
            </div>

            <div class="bg-gray-100 p-4 rounded">
                <h2 class="text-lg font-semibold mb-2">รายละเอียดการชำระเงิน</h2>
                <p><strong>ยอด:</strong> {{ $booking->total_cost }} บาท</p>
                <p><strong>กำหนดชำระภายใน:</strong> <span id="countdowntime-left">1 นาที</span></p>
                <p><small>ท่านมีเวลาคงเหลืออีก: <span class="text-red" id="countdown"></span></small></p>
            </div>
        </div>
        @endforeach

        <div class="mt-6">
            <h2 class="text-lg font-semibold mb-4">วิธีชำระเงินด้วยรหัส QR Code</h2>
            <div class="flex justify-center">
                <div id="qrcode" class=""></div>
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
            <input type="hidden" id="booking_id" name="booking_id" value="{{ $booking->id }}">
            <div class="flex space-x-4 float-right ">
                <button id="pay-button" type="button" class="w-54 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 ">
                    ชำระเงินด้วยพร้อมเพย์
                </button>
                <form id="cancel-form" action="{{ route('cancel.booking', $booking->id) }}" method="POST">
                    @csrf
                    <button id="cancel-button" type="button" class="w-54 bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700" onclick="cancelBooking('{{ $booking->id }}')">
                        ยกเลิกการชำระเงิน
                    </button>

                    <script>
                        function cancelBooking(bookingId) {
                            fetch(`{{ route('cancel.booking', '') }}/${bookingId}`, {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    },
                                    body: JSON.stringify({
                                        _method: 'DELETE'
                                    })
                                })
                                .then(response => {
                                    (response.ok)
                                    window.location.href = '/home';
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                });
                        }
                    </script>


            </div>
        </form>
    </div>

    <script>
        // ประกาศ Stripe key เพียงครั้งเดียว
        const stripe = Stripe(
            'pk_live_51PZ6omGGaN9QJBWFRRjYbd3EMwWHJeztF2p85kFV3jo3sws9imKNK0KH3SwsWtp57P71eGAY2dvJtyb61UfA3eLR00YwyN3BMj'
        );

        // ประกาศตัวแปร timer ด้านนอกเพื่อใช้งานได้ทั่วสคริปต์
        let timer;

        document.getElementById('pay-button').addEventListener('click', async function() {
            const bookingId = document.getElementById('booking_id').value;

            // เริ่มต้นการนับถอยหลัง 60 วินาที
            let countdown = 60;
            timer = setInterval(updateTimer, 1000);

            function updateTimer() {
                countdown--;
                const minutes = Math.floor(countdown / 60);
                const seconds = countdown % 60;
                document.getElementById('countdown').textContent =
                    `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

                if (countdown <= 0) {
                    clearInterval(timer);
                    document.getElementById('time-left').textContent = 'หมดเวลา';
                    document.getElementById('pay-button').style.display = 'none';
                }
            }

            // ส่งคำขอสร้าง Payment Intent
            try {
                const response = await fetch('/create-payment-intent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        booking_id: bookingId
                    })
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                console.log(data);

                // สร้าง QR Code สำหรับ PromptPay
                new QRCode(document.getElementById('qrcode'), {
                    text: data.client_secret,
                    width: 128,
                    height: 128
                });

                // ซ่อนปุ่มชำระเงินหลังจากสร้าง QR Code เสร็จ
                document.getElementById('pay-button').style.display = 'none';

                // Confirm Payment ผ่าน Stripe
                stripe.confirmPromptPayPayment(data.client_secret).then((result) => {
                    if (result.error) {
                        console.log(result.error.message);
                    } else {
                        document.getElementById("qrcode").innerHTML =
                            `<img src="${result.paymentIntent.next_action.promptpay_display_qr_image_url}" />`;
                    }
                });

            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>

</body>

</html>