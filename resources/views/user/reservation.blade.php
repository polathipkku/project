<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.28/dist/fancybox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
    <link rel="shortcut icon" href="/images/Logo_2.jpg" type="image/png">
    <link rel="stylesheet" href="/css/hero.css">
    <link href="src/output.css" rel="stylesheet">
    <script src="/js/hero.js"></script>

    <title>Thunthree</title>
</head>

<body class="bg-gray-100">
    <div class="w-full h-5" style="background-color: #042a48" id="mail"> </div>
    <header class="bg-white shadow-lg pt-3">
        <div class="container mx-auto flex items-center justify-between h-24 px-5">
            <nav class="text-base">
                <div class="container mx-auto flex justify-center space-x-10 py-3">
                    <a href="gallery" class="hover:text-blue-400">แกลเลอรี่</a>
                    <a href="travel" class="hover:text-blue-400">สถานที่ท่องเที่ยว</a>
                    <a href="contact" class="hover:text-blue-400">ติดต่อ</a>
                </div>
            </nav>

            <div class="mx-auto" id="logo">
                <a href="home" class="">Thunthree</a>
            </div>

            <div class="flex items-center space-x-4">
                @auth
                <nav class="flex items-center space-x-10 text-base">
                    <a href="{{ route('reservation') }}" class="text-black hover:text-blue-400">ประวัติการจอง<i
                            class="fa-solid fa-clock-rotate-left ml-2"></i></a>
                    {{-- <a href="{{ route('review.index') }}" class="text-black hover:text-blue-400">รีวิว<i
                        class="fa-solid fa-star ml-2"></i></a> --}}
                    <div class="relative">
                        <button id="profileButton" type="button"
                            class="text-black hover:text-blue-400 focus:outline-none">
                            <i class="fa-solid fa-user"></i>
                            <span class="sr-only">User Menu</span>
                        </button>
                        <div id="profileDropdown"
                            class="absolute hidden right-0 mt-2 w-24 bg-white rounded-md shadow-lg">
                            <div class="py-1">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Profile</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Settings</a>
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Logout</a>
                            </div>
                        </div>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </nav>
                @endauth

                <div class="flex flex-col items-end space-y-2 mb-4">
                    <nav class="flex items-center space-x-2">
                        @guest
                        <a href="#" onclick="showLoginForm()"
                            class="flex items-center space-x-1 hover:text-blue-400 text-sm">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <span>เข้าสู่ระบบ</span>
                        </a>
                        <a href="#" onclick="showRegisterForm()"
                            class="flex items-center space-x-1 hover:text-blue-400 text-sm">
                            <i class="fa-solid fa-user"></i>
                            <span>สมัครสมาชิก</span>
                        </a>
                        @endguest
                    </nav>
                    <div class="fixed bottom-4 left-1/2 transform -translate-x-1/2 z-50">
                        <div id="bookingButton"
                            class="flex items-center bg-gray-700 text-white rounded-lg shadow-lg px-6 py-3 w-[400px] hover:bg-gray-800 transition-all duration-300 cursor-pointer">
                            <!-- Icon and Text -->
                            <div class="flex items-center">
                                <span class="mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M8 7V3m8 4V3m5 18H3c-1.11 0-2-.89-2-2V8c0-1.11.89-2 2-2h18c1.11 0 2 .89 2 2v11c0 1.11-.89 2-2 2zM3 11h18" />
                                    </svg>
                                </span>
                                <span class="font-bold">จองตอนนี้</span>
                            </div>

                            <!-- Divider -->
                            <div class="flex-grow border-l border-gray-500 mx-4"></div>

                            <!-- Right Aligned Text -->
                            <div class="text-right">
                                <span class="text-lg font-pacifico"
                                    style="font-family: 'Pacifico', cursive;">Thunthree</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </header>
    <div class="mx-auto pt-4 pb-4 bg-gray-100">
        <p class="text-gray-600 text-lg max-xl:px-4 pt-8" style="margin-left: 7%;">
            <a href="{{ route('home') }}" class="text-black hover:text-blue-400">Home</a>
            <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
            <a href="{{ route('userbooking') }}" class="text-black hover:text-blue-400">จองห้อง</a>
            <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
            <a href="#" class="text-blue-600 hover:text-black">ประวิติการจอง</a>
        </p>
    </div>

    <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
        <div class="container mx-auto px-6 py-8">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-3xl font-medium text-gray-700">ประวัติการจอง</h3>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                        <form action="#" method="GET" class="w-full md:w-auto mb-4 md:mb-0">
                            @csrf
                            <div class="relative">
                                <input type="text" name="search" placeholder="ค้นหาการจอง"
                                    class="w-full md:w-80 pl-10 pr-4 py-2 rounded-lg border focus:border-blue-300 focus:outline-none focus:shadow-outline">
                                <div class="absolute top-0 left-0 inline-flex items-center p-2">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                            </div>
                        </form>
                    </div>

                    @if (count($bookings) > 0)
                    <div class="overflow-x-auto">
                        @php
                        $groupedBookings = $bookings->groupBy('booking_id');
                        @endphp
                        <table class="w-full">
                            <thead>
                                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                    <th class="py-3 px-6 text-left">รหัสการจอง</th>
                                    <th class="py-3 px-6 text-left">ชื่อผู้จอง</th>
                                    <th class="py-3 px-6 text-center">จำนวนผู้เข้าพัก</th>
                                    <th class="py-3 px-6 text-center">วันที่เช็คอิน</th>
                                    <th class="py-3 px-6 text-center">วันที่เช็คเอาท์</th>
                                    <th class="py-3 px-6 text-center">ประเภทห้องพัก</th>
                                    <th class="py-3 px-6 text-center">สถานะการจอง</th>
                                    <th class="py-3 px-6 text-center">เวลาที่เหลือ</th>
                                    <th class="py-3 px-6 text-center">ดำเนินการ</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($groupedBookings as $bookingId => $bookings)
                                @php
                                $firstBooking = $bookings->first();
                                $hasDuplicates = $bookings->count() > 1;
                                @endphp
                                <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-300 ease-in-out">
                                    <td class="py-3 px-6 text-left">
                                        <span class="font-medium">{{ $firstBooking->booking->booking_random_id }}</span>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $firstBooking->booking_name }}
                                        @if ($hasDuplicates)
                                        <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-sm ml-2">
                                            ({{ $bookings->count() }})
                                        </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        {{ $firstBooking->booking->person_count }}
                                    </td>
                                    <td class="py-3 px-6 text-center">{{ $firstBooking->checkin_date }}</td>
                                    <td class="py-3 px-6 text-center">{{ $firstBooking->checkout_date }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="bg-purple-100 text-purple-800 py-1 px-3 rounded-full text-sm">
                                            {{ $firstBooking->room_type }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        @if ($firstBooking->booking_detail_status === 'ทำการจอง')
                                        <span class="bg-yellow-100 text-yellow-800 py-1 px-3 rounded-full text-sm">
                                            ทำการจอง
                                        </span>
                                        @elseif ($firstBooking->booking_detail_status === 'รอเลือกห้อง')
                                        <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-sm">
                                            รอเช็คอิน
                                        </span>
                                        @elseif ($firstBooking->booking_detail_status === 'เช็คเอาท์')
                                        <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-sm">
                                            เช็คเอาท์
                                        </span>
                                        @elseif ($firstBooking->booking_detail_status === 'เช็คอินแล้ว')
                                        <span class="bg-gray-100 text-gray-800 py-1 px-3 rounded-full text-sm">
                                            เช็คอินแล้ว
                                        </span>
                                        @elseif ($firstBooking->booking_detail_status === 'รอชำระเงิน')
                                        <span class="bg-orange-100 text-orange-800 py-1 px-3 rounded-full text-sm">
                                            รอชำระเงิน
                                        </span>
                                        @elseif ($firstBooking->booking_detail_status === 'ยกเลิกการจอง')
                                        <span class="bg-red-100 text-red-800 py-1 px-3 rounded-full text-sm">
                                            ยกเลิกการจอง
                                        </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <span id="countdown-{{ $bookingId }}" class="font-medium text-red-500"></span>
                                    </td>
                                    {{-- <td class="py-2 px-4 text-center">
                                                <div class="flex item-center justify-center">
                                                    <a href="{{ route('record_detail', ['id' => $bookingId]) }}"
                                    class="transform hover:text-blue-500 hover:scale-110 transition duration-300 ease-in-out">
                                    <i class="fas fa-eye"></i>
                                    </a>
                    </div>
                    </td> --}}
                    <td class="py-3 px-6 text-center">
                        @if ($firstBooking->booking_detail_status === 'รอชำระเงิน')
                        <button onclick="redirectToPayment('{{ $bookingId }}')"
                            class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            กลับไปชำระเงิน
                        </button>
                        @endif
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
                @else
                <p class="text-gray-600 text-center py-4">ไม่พบการจอง</p>
                @endif
            </div>
        </div>
        </div>
    </main>


<script>
        const countdownData = @json($countdownData);

        countdownData.forEach(item => {
            startCountdown(item.bookingId, item.expirationTime);
        });

        function startCountdown(bookingId, expirationTime) {
            const countdownElement = document.getElementById(`countdown-${bookingId}`);
            const expirationTimestamp = new Date(expirationTime).getTime();

            const interval = setInterval(() => {
                const now = new Date().getTime();
                const distance = expirationTimestamp - now;

                if (distance <= 0) {
                    cancelBooking(bookingId);
                    countdownElement.parentElement.innerHTML = ""; // ซ่อนข้อมูลเมื่อหมดเวลา
                    clearInterval(interval);
                } else {
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    countdownElement.innerHTML = `${minutes} นาที ${seconds} วินาที`;
                }
            }, 1000);
        }

        function cancelBooking(bookingId) {
            fetch(`/cancel-booking/${bookingId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        payment_status: 'cancel'
                    })
                }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log(`การจอง ${bookingId} ถูกยกเลิกแล้ว`);
                    } else {
                        console.error('ยกเลิกการจองไม่สำเร็จ');
                    }
                });
        }

        function redirectToPayment(bookingId) {
            window.location.href = `/payment/${bookingId}`;
        }
    </script>


    <script src="/js/hero.js"></script>


</body>

</html>