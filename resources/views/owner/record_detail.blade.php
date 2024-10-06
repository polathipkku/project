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
            <h1 class="text-3xl font-bold mb-8 text-center text-gray-800 ">Booking Details</h1>
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
                            @if ($booking->bookingDetails->isNotEmpty())
                            @foreach ($booking->bookingDetails as $detail)
                            <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                                <p class="mb-2"><span class="font-semibold">Booking ID:</span>
                                    {{ $booking->id }}
                                </p>
                                <p class="mb-1"><span class="font-semibold">ชื่อผู้จอง:</span>
                                    {{ $detail->booking_name }}
                                </p>
                                <p class="mb-1"><span class="font-semibold">โทรศัพท์:</span>
                                    {{ $detail->phone }}
                                </p>
                                <p class="mb-1"><span class="font-semibold">สถานะการจอง:</span>
                                    <span
                                        class="px-2 py-1 rounded-full text-xs {{ $detail->booking_status == 'Confirmed' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                        {{ $detail->booking_status }}
                                    </span>
                                </p>
                                <p class="mb-1"><span class="font-semibold">ห้องที่จอง:</span>
                                    {{ $detail->room_type }}
                                </p>
                            </div>
                            @endforeach
                            @else
                            <p>ไม่มีข้อมูลการจอง</p>
                            @endif
                        </div>
                        <div class="pl-4">
                            @if ($booking->bookingDetails->isNotEmpty())
                            @foreach ($booking->bookingDetails as $detail)
                            <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                                <div class="flex gap-5">
                                    <p class="mb-1"><span class="font-semibold">วันที่เลือกเช็คอิน:</span>
                                        {{ $detail->checkin_date }}
                                    </p>
                                    <p class="mb-1"><span class="font-semibold">วันที่เลือกเช็คเอาท์:</span>
                                        {{ $detail->checkout_date }}
                                    </p>
                                </div>

                                <p class="mb-1"><span class="font-semibold">จำนวนผู้เข้าพัก:</span>
                                    {{ $detail->occupancy_person }} คน
                                </p>
                                <p class="mb-1">
                                    <span class="font-semibold">จำนวนเด็ก:</span>
                                    {{ $detail->occupancy_child ?? 0 }} คน
                                </p>
                                <p class="mb-1">
                                    <span class="font-semibold">จำนวนทารก:</span>
                                    {{ $detail->occupancy_baby ?? 0 }} คน
                                </p>
                                <p class="mb-1"><span class="font-semibold">จำนวนห้อง:</span>
                                    {{ $detail->room_quantity }} ห้อง
                                </p>
                                <p class="mb-1"><span class="font-semibold">ราคารวม:</span>
                                    {{ number_format($detail->total_cost, 2) }} บาท
                                </p>
                            </div>
                            @endforeach
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
                    @if ($booking->promotion)
                    <div class="p-3 bg-purple-50 rounded-lg">
                        <p class="mb-1"><span class="font-semibold">ชื่อแคมเปญ:</span>
                            {{ $booking->promotion->campaign_name }}
                        </p>
                        <p class="mb-1"><span class="font-semibold">รหัสโปรโมชั่น:</span>
                            {{ $booking->promotion->promo_code }}
                        </p>
                        <p class="mb-1"><span class="font-semibold">ส่วนลด:</span>
                            {{ $booking->promotion->discount_percentage }}%
                        </p>
                    </div>
                    @else
                    <p class="p-3 bg-gray-50 rounded-lg">ไม่มีโปรโมชั่นสำหรับการจองนี้</p>
                    @endif
                </div>
            </div>

            <!-- Check-in Information Dropdown -->
            @if ($booking->checkin)
            <div class="bg-white rounded-lg shadow-md p-6 w-full">
                <div class="dropdown-header">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-700 border-b pb-2 cursor-pointer">
                        <i class="fas fa-door-open mr-2 text-indigo-500"></i>Check-in Information
                    </h2>
                </div>
                <div class="dropdown-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="border-r border-gray-200 pr-4">
                            <div class="p-3 bg-indigo-50 rounded-lg">
                                <p class="mb-1"><span class="font-semibold">เช็คอินโดย:</span>
                                    {{ $booking->checkin->user->name ?? 'ไม่ระบุ' }}
                                </p>

                                <p class="mb-1"><span class="font-semibold">ชื่อผู้เข้าพัก:</span>
                                    {{ $booking->checkin->name }}
                                </p>
                                <p class="mb-1"><span class="font-semibold">เวลาที่เช็คอิน:</span>
                                    {{ $booking->checkin->checkin }}
                                </p>
                                <p class="mb-1"><span class="font-semibold">บัตรประชาชน:</span>
                                    {{ $booking->checkin->id_card }}
                                </p>
                                <p class="mb-1"><span class="font-semibold">ที่อยู่:</span>
                                    {{ $booking->checkin->address }},
                                    {{ $booking->checkin->province }},
                                    {{ $booking->checkin->district }},
                                    {{ $booking->checkin->sub_district }},
                                    {{ $booking->checkin->postcode }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif


            <!-- Check-out Information Dropdown -->
            @if ($booking->checkout)
            <div class="bg-white rounded-lg shadow-md p-6 w-full">
                <div class="dropdown-header">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-700 border-b pb-2 cursor-pointer">
                        <i class="fas fa-door-closed mr-2 text-red-500"></i>Check-out Information
                    </h2>
                </div>
                <div class="dropdown-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-3 bg-red-50 rounded-lg">
                            <p class="mb-1"><span class="font-semibold">เช็คเอาท์โดย:</span>
                                {{ $booking->checkout->user->name ?? 'ไม่ระบุ' }}
                            </p>
                            <p class="mb-1"><span class="font-semibold">เวลาที่เช็คเอาท์:</span>
                                {{ $booking->checkout->checkout }}
                            </p>
                            <p><strong>Damages Charge:</strong>
                                {{ number_format($booking->checkout->total_damages, 2) }} บาท
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <!-- Charge Details Dropdown -->
            @if ($booking->checkoutDetails->isNotEmpty())
            <div class="bg-white rounded-lg shadow-md p-6 w-full">
                <div class="dropdown-header">
                    <h2 class="text-2xl font-semibold mb-4 text-gray-700 border-b pb-2 cursor-pointer">
                        <i class="fas fa-money-bill-wave mr-2 text-green-500"></i>Charge Details
                    </h2>
                </div>
                <div class="dropdown-content">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <table class="min-w-full table-auto border-collapse">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="px-4 py-2 border">ชื่อสินค้า</th>
                                    <th class="px-4 py-2 border">ราคาสินค้า</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($booking->checkoutDetails as $checkoutDetail)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-4 py-2 border">
                                        {{ $checkoutDetail->productRoom->productroom_name }}
                                    </td>
                                    <td class="px-4 py-2 border">
                                        {{ number_format($checkoutDetail->totalpriceroom, 2) }} บาท
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @else
            <p class="text-center">ไม่มีข้อมูลเช็คบิล</p>
            @endif




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