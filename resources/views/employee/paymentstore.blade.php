<div class="bg-gray-100 p-4 rounded">
    <h2 class="text-lg font-semibold mb-2">รายละเอียดการชำระเงิน</h2>
    <p><strong>ค่าใช้จ่ายทั้งหมด:</strong> {{ $booking->total_cost }} บาท</p>
    <p><strong>กำหนดชำระภายใน:</strong> <span id="countdowntime-left">1 นาที</span></p>
    <p><small>เวลาคงเหลือ: <span class="text-red" id="countdown"></span></small></p>
</div>

<div class="mt-6">
    <h2 class="text-lg font-semibold mb-4">ชำระเงินผ่าน QR Code</h2>
    <div class="flex justify-center">
        <div id="qrcode"></div>
    </div>
    <ol class="mt-4 list-decimal list-inside">
        <li>เปิดแอปพลิเคชันธนาคารและสแกน QR Code</li>
        <li>ตรวจสอบยอดชำระ</li>
        <li>ยืนยันการชำระเงิน</li>
        <li>รอการยืนยันและรับใบยืนยันการจองทางอีเมล</li>
    </ol>
</div>

<form id="payment-form" action="/create-payment-intent" method="POST" class="mt-4">
    @csrf
    <input type="hidden" id="booking_id" name="booking_id" value="{{ $booking->booking_id }}">
    <div class="flex space-x-4 float-right">
        <button id="pay-button" type="button" class="w-54 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">
            ชำระเงินด้วย PromptPay
        </button>
        <button id="cancel-button" type="button" class="w-54 bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700"
            onclick="cancelBooking('{{ $booking->booking_id }}')">
            ยกเลิกการชำระเงิน
        </button>
    </div>
</form>

<script>
    const stripe = Stripe('{{ env('
        STRIPE_KEY ') }}');
    let timer;

    document.getElementById('pay-button').addEventListener('click', async function() {
        const bookingId = document.getElementById('booking_id').value;

        // เริ่มนับเวลาถอยหลัง
        let countdown = 60;
        timer = setInterval(updateTimer, 1000);

        function updateTimer() {
            countdown--;
            const minutes = Math.floor(countdown / 60);
            const seconds = countdown % 60;
            document.getElementById('countdown').textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;

            if (countdown <= 0) {
                clearInterval(timer);
                document.getElementById('countdown').textContent = 'หมดเวลา';
                document.getElementById('pay-button').style.display = 'none';
            }
        }

        try {
            const response = await fetch('/create-payment-intent', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
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

            // สร้าง QR Code
            new QRCode(document.getElementById('qrcode'), {
                text: data.client_secret,
                width: 128,
                height: 128
            });

            document.getElementById('pay-button').style.display = 'none';

            // ยืนยันการชำระเงิน
            stripe.confirmPromptPayPayment(data.client_secret).then((result) => {
                if (result.error) {
                    console.error(result.error.message);
                } else {
                    document.getElementById("qrcode").innerHTML = '<p>ชำระเงินสำเร็จแล้ว</p>';
                }
            });

        } catch (error) {
            console.error('Error:', error);
        }
    });

    function cancelBooking(bookingId) {
        fetch('/cancel-booking', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                booking_id: bookingId
            })
        }).then(response => response.json()).then(data => {
            if (data.success) {
                window.location.href = '/';
            } else {
                alert('ยกเลิกการจองไม่สำเร็จ');
            }
        }).catch(error => {
            console.error('Error:', error);
        });
    }
</script>