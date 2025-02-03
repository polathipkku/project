<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>

    {{-- <style>
        .dropdown-content {
            max-height: 0;
            /* เริ่มต้นด้วยความสูงเป็น 0 */
            overflow: hidden;
            /* ป้องกันการแสดงเนื้อหาที่เกิน */
            transition: max-height 0.5s ease-in-out;
            /* การเคลื่อนไหวของ max-height */
        }

        .dropdown-content.show {
            max-height: 1000px;
            /* ตั้งค่า max-height สูงสุดให้มีขนาดที่เพียงพอ */
        }
    </style> --}}
</head>

<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="flex justify-center gap-10 relative">
            <a href="{{ route('record') }}"
                class="absolute left-5 top-0 text-blue-600 hover:text-blue-800 transition duration-300 mr-4 flex items-center">
                <i class="fas fa-arrow-left text-4xl mr-2"></i>
                <span>Back</span>
            </a>
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-800 ">รายละเอียดการจอง</h1>
        </div>

        <div class="space-y-6">
            <!-- Booking Information Dropdown -->
            <div class="bg-white rounded-lg shadow-md p-6 w-full">
                <div class="dropdown-header">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-700 border-b pb-2 cursor-pointer">
                        <i class="fas fa-calendar-alt mr-2 text-green-500"></i>รายละเอียดการจอง
                    </h2>
                </div>
                <div class="dropdown-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="border-r border-gray-200 pr-4">
                            @if ($bookingDetail->booking && $bookingDetail->booking->bookingDetails->isNotEmpty())
                            <!-- แสดงข้อมูลการจองเพียงครั้งเดียว -->
                            <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                                <p class="mb-2"><span class="font-semibold">Booking ID:</span>
                                    {{ $bookingDetail->booking->id ?? 'ไม่มีข้อมูล' }}
                                </p>
                                <p class="mb-1"><span class="font-semibold">ชื่อผู้จอง:</span>
                                    {{ $bookingDetail->booking->bookingDetails->first()->booking_name ?? 'ไม่มีข้อมูล' }}
                                </p>
                                <p class="mb-1"><span class="font-semibold">โทรศัพท์:</span>
                                    {{ $bookingDetail->booking->bookingDetails->first()->phone ?? 'ไม่มีข้อมูล' }}
                                </p>
                                <p class="mb-1"><span class="font-semibold">สถานะการจอง:</span>
                                    <span
                                        class="px-2 py-1 rounded-full text-xs {{ $bookingDetail->booking->bookingDetails->first()->booking_detail_status == 'Confirmed' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                        {{ $bookingDetail->booking->bookingDetails->first()->booking_detail_status ?? 'ไม่มีข้อมูล' }}
                                    </span>
                                </p>
                                <p class="mb-1"><span class="font-semibold">ห้องที่จอง:</span>
                                    {{ $bookingDetail->booking->bookingDetails->first()->room_type ?? 'ไม่มีข้อมูล' }}
                                </p>
                            </div>
                            @else
                            <p>ไม่มีข้อมูลการจอง</p>
                            @endif
                        </div>

                        <div class="pl-4">
                            @if ($bookingDetail->booking && $bookingDetail->booking->bookingDetails->isNotEmpty())
                            <!-- แสดงข้อมูลการจองเพียงครั้งเดียว -->
                            <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                                <div class="flex gap-5">
                                    <p class="mb-1">
                                        <span class="font-semibold">วันที่เลือกเช็คอิน:</span>
                                        {{ \Carbon\Carbon::parse($bookingDetail->booking->bookingDetails->first()->checkin_date ?? null)->format('d-m-Y') ?? 'ไม่มีข้อมูล' }}
                                    </p>
                                    <p class="mb-1">
                                        <span class="font-semibold">วันที่เลือกเช็คเอาท์:</span>
                                        {{ \Carbon\Carbon::parse($bookingDetail->booking->bookingDetails->first()->checkout_date ?? null)->format('d-m-Y') ?? 'ไม่มีข้อมูล' }}
                                    </p>
                                </div>
                                <p class="mb-1"><span class="font-semibold">จำนวนผู้เข้าพักผู้ใหญ่:</span>
                                    {{ $bookingDetail->booking->bookingDetails->sum('occupancy_person') ?? 'ไม่มีข้อมูล' }} คน
                                </p>
                                <p class="mb-1"><span class="font-semibold">จำนวนเด็ก:</span>
                                    {{ $bookingDetail->booking->bookingDetails->sum('occupancy_child') ?? '0' }} คน
                                </p>
                                <p class="mb-1"><span class="font-semibold">จำนวนทารก:</span>
                                    {{ $bookingDetail->booking->bookingDetails->sum('occupancy_baby') ?? '0' }} คน
                                </p>
                                <p class="mb-1"><span class="font-semibold">จำนวนห้อง:</span>
                                    {{ $bookingDetail->booking->room_quantity ?? 'ไม่มีข้อมูล' }} ห้อง
                                </p>

                                <p class="mb-1"><span class="font-semibold">ราคารวม:</span>
                                    {{ number_format($bookingDetail->booking->total_cost ?? 0, 2) }} บาท
                                </p>
                            </div>

                            @else
                            <p>ไม่มีข้อมูลการจอง</p>
                            @endif
                        </div>

                    </div>
                </div>
            </div>


            <!-- Promotion Information Dropdown -->
            <div class="bg-white rounded-lg shadow-md p-6 w-full">
                <div class="dropdown-header">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-700 border-b pb-2 cursor-pointer">
                        <i class="fas fa-tag mr-2 text-purple-500"></i>โปรโมชั่น
                    </h2>
                </div>
                <div class="dropdown-content">
                    @if ($bookingDetail->booking->promotion)
                    <div class="p-3 bg-purple-50 rounded-lg">
                        <p class="mb-1"><span class="font-semibold">ชื่อแคมเปญ:</span>
                            {{ $bookingDetail->booking->promotion->campaign_name ?? 'ไม่มีข้อมูล' }}
                        </p>
                        <p class="mb-1"><span class="font-semibold">รหัสโปรโมชั่น:</span>
                            {{ $bookingDetail->booking->promotion->promo_code ?? 'ไม่มีข้อมูล' }}
                        </p>
                        <p class="mb-1"><span class="font-semibold">ส่วนลด:</span>
                            {{ $bookingDetail->booking->promotion->discount_percentage ?? 'ไม่มีข้อมูล' }}%
                        </p>
                    </div>
                    @else
                    <p class="p-3 bg-gray-50 rounded-lg">ไม่มีโปรโมชั่นสำหรับการจองนี้</p>
                    @endif
                </div>
            </div>

            <!-- Check-in Information Dropdown -->
            <div class="bg-white rounded-lg shadow-md p-6 w-full">
                <div class="dropdown-header">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-700 border-b pb-2 cursor-pointer">
                        <i class="fas fa-door-open mr-2 text-indigo-500"></i>รายละเอียดการเช็คอิน & เช็คเอาท์
                    </h2>
                </div>
                <div class="dropdown-content">
                    <div class="flex space-x-6">
                        <!-- เช็คอิน -->
                        <div class="flex-1">
                            <div class="p-3 bg-indigo-50 rounded-lg">
                                @if ($bookingDetail->booking->checkin)
                                <p class="mb-1"><span class="font-semibold">เช็คอินโดย:</span>
                                    {{ $bookingDetail->booking->checkin->user->name ?? '' }}
                                </p>
                                <p class="mb-1"><span class="font-semibold">ชื่อผู้เข้าพัก:</span>
                                    {{ $bookingDetail->booking->checkin->name ?? '' }}
                                </p>
                                <p class="mb-1"><span class="font-semibold">เวลาที่เช็คอิน:</span>
                                    {{ $bookingDetail->booking->checkin->checkin ?? '' }}
                                </p>
                                <p class="mb-1"><span class="font-semibold">บัตรประชาชน:</span>
                                    {{ $bookingDetail->booking->checkin->id_card ?? '' }}
                                </p>
                                <p class="mb-1"><span class="font-semibold">ที่อยู่:</span>
                                    {{ $bookingDetail->booking->checkin->address ?? '' }},
                                    {{ $bookingDetail->booking->checkin->province ?? '' }},
                                    {{ $bookingDetail->booking->checkin->district ?? '' }},
                                    {{ $bookingDetail->booking->checkin->sub_district ?? '' }},
                                    {{ $bookingDetail->booking->checkin->postcode ?? '' }}
                                </p>
                                @else
                                <p class="mb-1 text-center text-red-500 font-semibold">ยังไม่ได้เช็คอิน</p>
                                @endif
                            </div>
                        </div>

                        <!-- เช็คเอาท์ -->
                        <div class="flex-1">
                            <div class="p-3 bg-red-50 rounded-lg">
                                @if ($bookingDetail->booking->checkout)
                                <p class="mb-1"><span class="font-semibold">เช็คเอาท์โดย:</span>
                                    {{ $bookingDetail->booking->checkout->user->name ?? '' }}
                                </p>
                                <p class="mb-1"><span class="font-semibold">เวลาที่เช็คเอาท์:</span>
                                    {{ $bookingDetail->booking->checkout->checkout ?? '' }}
                                </p>
                                <p><strong>ค่าเสียหาย:</strong>
                                    {{ number_format($bookingDetail->booking->checkout->total_damages ?? 0, 2) }} บาท
                                </p>
                                @else
                                <p class="mb-1 text-center text-red-500 font-semibold">ยังไม่ได้เช็คเอาท์</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>



        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dropdownHeaders = document.querySelectorAll('.dropdown-header');

                dropdownHeaders.forEach(header => {
                    header.addEventListener('click', function() {
                        const content = header.nextElementSibling;

                        // สลับการแสดงผลเนื้อหา
                        content.classList.toggle('show'); // สลับ class 'show'
                    });
                });
            });
        </script>

</body>

</html>