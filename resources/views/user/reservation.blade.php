<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <div class="logo" id="logo">
                <a href="home" class="pl-24">Thunthree</a>
            </div>
            <div class="flex items-center space-x-4 text-gray-800 text-base">
                <nav class="flex space-x-10">
                    @guest
                    <!-- ปุ่ม Login -->
                    <a href="#" onclick="showLoginForm()" class="flex items-center space-x-1 hover:text-blue-400">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <span>เข้าสู่ระบบ</span>
                    </a>

                    <!-- ปุ่ม Register -->
                    <a href="#" onclick="showRegisterForm()"
                        class="flex items-center space-x-1 hover:text-blue-400">
                        <i class="fa-solid fa-user"></i>
                        <span>สมัครสมาชิก</span>
                    </a>
                    @endguest
                    @auth
                    <a href="{{ route('reservation') }}" class="text-black hover:text-blue-400">ประวัติการจอง<i
                            class="fa-solid fa-clock-rotate-left ml-2"></i></a>
                    {{-- <a href="{{ route('review.index') }}" class="text-black hover:text-blue-400">รีวิว<i
                        class="fa-solid fa-star ml-2"></i></a> --}}
                    <button id="profileButton" type="button" class="text-black hover:text-blue-400 focus:outline-none">
                        <i class="fa-solid fa-user"></i>
                        <span class="sr-only">User Menu</span>
                    </button>
                    <div id="profileDropdown"
                        class="absolute hidden right-40 ml-2 mt-1 w-38 bg-white rounded-md shadow-lg box-shadow-md">
                        <div class="py-1">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Profile</a>
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Settings</a>
                            <a href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">
                                    Logout
                                </span>
                            </a>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @endauth
                    <!-- End  User Menu Dropdown -->
                </nav>
                <button id="booking-btn"
                    class="bg-blue-500 text-white px-8 py-4 rounded-lg border-2 border-blue-500 hover:bg-white hover:text-blue-500 hover:border-blue-500 transition-colors">
                    จองตอนนี้
                </button>
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
                                <input type="text" name="search" placeholder="ค้นหาการจอง" class="w-full md:w-80 pl-10 pr-4 py-2 rounded-lg border focus:border-blue-300 focus:outline-none focus:shadow-outline">
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
                                    <th class="py-3 px-6 text-center">รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm">
                                @foreach ($groupedBookings as $bookingId => $bookings)
                                @php
                                $firstBooking = $bookings->first();
                                $hasDuplicates = $bookings->count() > 1;
                                @endphp
                                <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-300 ease-in-out"
                                    data-booking-id="{{ $bookingId }}"
                                    onclick="toggleDropdown(this.dataset.bookingId);">
                                    <td class="py-3 px-6 text-left">
                                        <span class="font-medium">{{ $firstBooking->booking->booking_random_id }}</span>
                                    </td>
                                    <td class="py-3 px-6 text-left">
                                        {{ $firstBooking->booking_name }}
                                        @if ($hasDuplicates)
                                        <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-sm ml-2">({{ $bookings->count() }})</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-center">{{ $firstBooking->booking->person_count }}</td>
                                    <td class="py-3 px-6 text-center">{{ $firstBooking->checkin_date }}</td>
                                    <td class="py-3 px-6 text-center">{{ $firstBooking->checkout_date }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="bg-purple-100 text-purple-800 py-1 px-3 rounded-full text-sm">
                                            {{ $firstBooking->room_type }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        @if ($firstBooking->booking_detail_status === 'ทำการจอง')
                                        <span class="bg-yellow-100 text-yellow-800 py-1 px-3 rounded-full text-sm">ทำการจอง</span>
                                        @elseif ($firstBooking->booking_detail_status === 'รอเลือกห้อง')
                                        <span class="bg-green-100 text-green-800 py-1 px-3 rounded-full text-sm">รอเช็คอิน</span>
                                        @elseif ($firstBooking->booking_detail_status === 'เช็คเอาท์')
                                        <span class="bg-blue-100 text-blue-800 py-1 px-3 rounded-full text-sm">เช็คเอาท์</span>
                                        @elseif ($firstBooking->booking_detail_status === 'เช็คอินแล้ว')
                                        <span class="bg-gray-100 text-gray-800 py-1 px-3 rounded-full text-sm">เช็คอินแล้ว</span>
                                        @elseif ($firstBooking->booking_detail_status === 'รอชำระเงิน')
                                        <span class="bg-orange-100 text-orange-800 py-1 px-3 rounded-full text-sm">รอชำระเงิน</span>
                                        @elseif ($firstBooking->booking_detail_status === 'ยกเลิกการจอง')
                                        <span class="bg-red-100 text-red-800 py-1 px-3 rounded-full text-sm">ยกเลิกการจอง</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex item-center justify-center">
                                            <a href="{{ route('record_detail', ['id' => $firstBooking->id]) }}"
                                                class="transform hover:text-blue-500 hover:scale-110 transition duration-300 ease-in-out">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                @if ($hasDuplicates)
                                <tr id="dropdown-{{ $bookingId }}" class="hidden">
                                    <td colspan="8" class="px-6 py-4 bg-gray-50">
                                        <table class="w-full">
                                            <thead>
                                                <tr class="bg-gray-200 text-gray-600 uppercase text-xs leading-normal">
                                                    <th class="py-2 px-4 text-center">ลำดับ</th>
                                                    <th class="py-2 px-4 text-center">ชื่อผู้จอง</th>
                                                    <th class="py-2 px-4 text-center">วันที่เช็คอิน</th>
                                                    <th class="py-2 px-4 text-center">วันที่เช็คเอาท์</th>
                                                    <th class="py-2 px-4 text-center">ประเภทห้องพัก</th>
                                                    <th class="py-2 px-4 text-center">สถานะการจอง</th>
                                                    <th class="py-2 px-4 text-center">ดำเนินการ</th>
                                                </tr>
                                            </thead>
                                            <tbody class="text-gray-600 text-xs">
                                                @foreach ($bookings as $index => $booking)
                                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                                    <td class="py-2 px-4 text-center"> {{ $index + 1 }}</td>
                                                    <td class="py-2 px-4 text-center">{{ $booking->booking_name }}</td>
                                                    <td class="py-2 px-4 text-center">{{ $booking->checkin_date }}</td>
                                                    <td class="py-2 px-4 text-center">{{ $booking->checkout_date }}</td>
                                                    <td class="py-2 px-4 text-center">
                                                        <span class="bg-purple-100 text-purple-800 py-1 px-2 rounded-full text-xs">
                                                            {{ $booking->room_type }}
                                                        </span>
                                                    </td>
                                                    <td class="py-2 px-4 text-center">
                                                        <span class="bg-gray-100 text-gray-800 py-1 px-2 rounded-full text-xs">
                                                            {{ $booking->booking_detail_status }}
                                                        </span>
                                                    </td>
                                                    <td class="py-2 px-4 text-center">
                                                        <div class="flex item-center justify-center">
                                                            <a href="{{ route('record_detail', ['id' => $booking->id]) }}"
                                                                class="transform hover:text-blue-500 hover:scale-110 transition duration-300 ease-in-out">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                @endif
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


    <x-footer />

    <script>
        function toggleDropdown(bookingId) {
            var dropdown = document.getElementById('dropdown-' + bookingId);
            if (dropdown) {
                dropdown.classList.toggle('hidden');
            }
        }
    </script>



    <script src="/js/hero.js"></script>


</body>

</html>