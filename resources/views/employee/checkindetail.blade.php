<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">

    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <title>Tunthree - รายละเอียดการจอง</title>
</head>

<body class="bg-gray-100">

    <div class="flex bg-indigo-50 min-h-screen">
        <!-- Sidebar -->
        @include('components.em_sidebar')

        <section class="ml-10 bg-white w-full p-8 rounded-lg shadow-lg" id="booking-details">
            <div class="max-w-screen-xl mx-auto py-6">
                <div class="flex justify-between items-center mb-8">
                    <h1 class="text-3xl font-semibold text-indigo-800">รายละเอียดการจอง</h1>
                    <button class="text-red-500 text-xl" onclick="window.location.href = '/checkin'">
                        <i class="fa-solid fa-circle-xmark mr-1"></i>ย้อนกลับ
                    </button>
                </div>

                <!-- แสดงรายละเอียดการจอง -->
                @foreach ($booking->bookingDetails as $bookingDetail)
                    <div class="space-y-6">
                        <!-- Booking Info -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div class="bg-indigo-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold text-indigo-700">ข้อมูลการจอง</h3>
                                <p><strong>ชื่อการจอง:</strong> {{ $bookingDetail->booking_name }}</p>
                                <p><strong>เบอร์โทร:</strong> {{ $bookingDetail->phone }}</p>
                                <p><strong>วันที่เช็คอิน:</strong> {{ $bookingDetail->checkin_date }}</p>
                                <p><strong>วันที่เช็คเอาท์:</strong> {{ $bookingDetail->checkout_date }}</p>
                                <p><strong>สถานะการจอง:</strong> {{ $bookingDetail->booking_detail_status }}</p>
                            </div>

                            <!-- Room Info -->
                            <div class="bg-indigo-50 p-4 rounded-lg">
                                <h3 class="text-lg font-semibold text-indigo-700">ข้อมูลห้องพัก</h3>
                                <p><strong>ประเภทห้อง:</strong> {{ $bookingDetail->room_type }}</p>
                                <p><strong>จำนวนผู้เข้าพัก:</strong> {{ $bookingDetail->occupancy_person }} คน</p>

                                <!-- เช็คจำนวนเด็ก ถ้ามีจะให้แสดง -->
                                @if ($bookingDetail->occupancy_child > 0)
                                    <p><strong>เด็ก:</strong> {{ $bookingDetail->occupancy_child }} คน</p>
                                @endif

                                <!-- เช็คจำนวนเด็กทารก ถ้ามีจะให้แสดง -->
                                @if ($bookingDetail->occupancy_baby > 0)
                                    <p><strong>เด็กทารก:</strong> {{ $bookingDetail->occupancy_baby }} คน</p>
                                @endif

                                <p><strong>จำนวนเตียงเสริม:</strong> {{ $bookingDetail->extra_bed_count }}</p>
                            </div>

                        </div>

                        <!-- Payment Info -->
                        <div class="bg-indigo-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-indigo-700">ข้อมูลการชำระเงิน</h3>
                            <p><strong>สถานะการชำระเงิน:</strong>
                                {{ $bookingDetail->payment ? $bookingDetail->payment->payment_status : 'ยังไม่ได้ชำระ' }}
                            </p>
                            <p><strong>จำนวนเงิน:</strong> ฿
                                @if ($bookingDetail->payment)
                                    @if ($bookingDetail->payment->total_price > 0)
                                        {{ number_format($bookingDetail->payment->total_price, 2) }}
                                    @else
                                        {{ number_format($bookingDetail->payment->amount, 2) }}
                                    @endif
                                @else
                                    0
                                @endif
                            </p>

                        </div>

                        <!-- Promotion Info -->
                        <div class="bg-indigo-50 p-4 rounded-lg">
                            <h3 class="text-lg font-semibold text-indigo-700">ข้อมูลโปรโมชั่น</h3>
                            <p><strong>โปรโมชั่น:</strong>
                                {{ $bookingDetail->promotion ? $bookingDetail->promotion->name : 'ไม่มีโปรโมชั่น' }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

    </div>

    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
</body>

</html>
