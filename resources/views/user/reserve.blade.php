<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.28/dist/fancybox.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
    <link rel="shortcut icon" href="/images/Logo_2.jpg" type="image/png">
    <link rel="stylesheet" href="/css/hero.css">
    <link href="src/output.css" rel="stylesheet">
    <title>Thunthree</title>
</head>

<body class="bg-gray-100">
    <div class="flex items-center justify-between h-5  text-white" style="background-color: #042a48" id="mail">
        {{-- <a href="" class="mx-5"><i class="fa-solid fa-envelope"></i> supanat.d@kkumail.com</a>
        <a href="" class="mx-5"><i class="fa-solid fa-phone"></i>0961826631</a> --}}
    </div>

    <header class="bg-white shadow-lg pt-3">
        <div class="container mx-auto flex items-center justify-between h-24 px-5">
            <nav class="text-base">
                <div class="container mx-auto flex justify-center space-x-10 py-3">
                    <a href="gallery" class="hover:text-blue-400">แกลเลอรี่</a>
                    <a href="travel" class="hover:text-blue-400">สถานที่ท่องเที่ยว</a>
                    <a href="contactus" class="hover:text-blue-400">ติดต่อ</a>
                </div>
            </nav>
            <div class="logo" id="logo">
                <a href="welcome_2" class="pl-24">Thunthree</a>
            </div>
            <div class="flex items-center space-x-4 text-gray-800 text-base">
                <nav class="space-x-10">
                    <a href="{{ route('reservation') }}" class="text-black hover:text-blue-400">ประวัติการจอง<i class="fa-solid fa-clock-rotate-left ml-2"></i></a>
                    <a href="about.html" class="text-black hover:text-blue-400">รีวิว<i class="fa-solid fa-star ml-2"></i></a>
                    <button id="profileButton" type="button" class="text-black hover:text-blue-400 focus:outline-none">
                        <i class="fa-solid fa-user"></i>
                        <span class="sr-only">User Menu</span>
                    </button>
                    <div id="profileDropdown" class="absolute hidden right-40 ml-2 mt-1 w-38 bg-white rounded-md shadow-lg box-shadow-md">
                        <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Settings</a>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <span class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">
                                    Logout
                                </span>
                            </a>
                            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <!-- End  User Menu Dropdown -->
                </nav>
                <button id="booking-btn" class="bg-blue-500 text-white px-8 py-4 rounded-lg border-2 border-blue-500 hover:bg-white hover:text-blue-500 hover:border-blue-500 transition-colors">
                    จองตอนนี้
                </button>
            </div>
        </div>
    </header>
    </div>
    <!--------------------------End Topbar-------------------------------------->
    <div class="mx-auto pt-4 pb-4 bg-gray-100  shadow-lg">
        <p class="text-gray-600 text-lg max-xl:px-4 pt-8" style="margin-left: 7%;">
            <a href="{{ route('home') }}" class="text-black hover:text-blue-400">Home</a>
            <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
            <a href="#" class="text-blue-600 hover:text-black">จองห้อง</a>
        </p>
    </div>
    <main class="bg-gray-200 shadow-lg">
        <div class="max-w-screen-xl mx-auto pt-8 pb-16 ">
            <div class="max-w-screen-xl mx-auto pt-8 pb-16">
                <div class="bg-white max-w-5xl mx-auto">
                    <div class="mx-auto h-16 mb-8" style="background-color: #042a48">
                        <div class="text-white text-2xl ml-2 pt-4">
                            จองห้อง
                        </div>
                    </div>
                    <div class="flex justify-center text-center space-x-1 ">
                        <button id="selfBookingBtn" class="inline-block px-8 py-4 bg-blue-500 text-white rounded border-2 font-semibold border-blue-500 hover:bg-blue-500 hover:text-white hover:border-blue-500 transition-colors w-80">
                            จองให้ตัวเอง
                        </button>
                        <button id="otherBookingBtn" class="inline-block px-8 py-4 bg-white text-blue-500 rounded font-semibold border-2 border-blue-500 hover:bg-blue-500 hover:text-white hover:border-blue-500 transition-colors w-80">
                            จองให้ผู้อื่น
                        </button>
                    </div>
                </div>
                <form method="POST" id="selfBookingForm" action="{{ route('bookings.reserve') }}">
                    @csrf
                    <div class="max-w-5xl mx-auto ">
                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ">
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold mb-2">ข้อมูลผู้จอง</h3>
                                <div class="mb-4">
                                    <label for="booking_name" class="block text-gray-700 text-sm font-bold mb-2">ชื่อผู้จอง:</label>
                                    <input type="text" name="booking_name" id="booking_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="mb-4">
                                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">เบอร์โทรศัพท์:</label>
                                    <input type="text" name="phone" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                </div>
                                <div class="mb-4">
                                    <label for="number_of_guests" class="block text-gray-700 text-sm font-bold mb-2">
                                        จำนวนผู้เข้าพัก (ผู้ใหญ่): <span class="text-gray-500 text-xs">(เข้าพักได้สูงสุด 2 คน)</span>
                                    </label>
                                    <input type="number" name="number_of_guests" id="number_of_guests" value="{{ old('number_of_guests', $number_of_guests) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
                                </div>

                                <div class="mb-4">
                                    <label for="occupancy_child" class="block text-gray-700 text-sm font-bold mb-2">
                                        จำนวนผู้เข้าพัก (เด็ก): <span class="text-gray-500 text-xs">(เข้าพักได้สูงสุด 1 คน อายุไม่เกิน 12 ปี)</span>
                                    </label>
                                    <input type="number" name="occupancy_child" id="occupancy_child" value="{{ old('occupancy_child', $occupancy_child) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" readonly>
                                </div>

                                <div class="mb-4">
                                    <label for="number_of_rooms" class="block text-gray-700 text-sm font-bold mb-2">จำนวนห้องที่ต้องการ:</label>
                                    <input type="text" name="number_of_rooms" id="number_of_rooms" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $number_of_rooms }}" readonly>
                                </div>
                                <div class="mb-4">
                                    <label for="extra_bed_count" class="block text-gray-700 text-sm font-bold mb-2">จำนวนเตียงเสริม:</label>
                                    <input type="text" name="extra_bed_count" id="extra_bed_count" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $extra_bed_count }}" readonly>
                                    <input type="hidden" name="extra_bed_count_hidden" id="extra_bed_count_hidden" value="{{ $extra_bed_count }}">
                                </div>

                                <div class="mb-4">
                                    <label for="checkin_date" class="block text-gray-700 text-sm font-bold mb-2">วันที่เช็คอิน:</label>
                                    <input type="date" name="checkin_date" id="checkin_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $checkin_date }}" readonly>
                                </div>
                                <div class="mb-4">
                                    <label for="checkout_date" class="block text-gray-700 text-sm font-bold mb-2">วันที่เช็คเอาท์:</label>
                                    <input type="date" name="checkout_date" id="checkout_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $checkout_date }}" readonly>
                                </div>
                                <div class="flex items-center justify-between">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                                        บันทึกการจอง
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <form id="otherBookingForm" action="{{ route('bookings.reserves') }}" method="post" enctype="multipart/form-data" style="display:none;">
                    @csrf
                    <div class="max-w-5xl mx-auto">
                        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                            <h2 class="text-lg font-bold mb-4">กรุณากรอกข้อมูลการจองสำหรับผู้อื่น</h2>
                            <div class="mb-4">
                                <h3 class="text-lg font-semibold mb-2">ข้อมูลผู้จอง</h3>
                                <div class="mb-4">
                                    <label for="booking_name" class="block text-gray-700 text-sm font-bold mb-2">ชื่อผู้จอง:</label>
                                    <input type="text" name="booking_name" id="booking_name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                </div>
                                <div class="mb-4">
                                    <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">เบอร์โทรศัพท์:</label>
                                    <input type="text" name="phone" id="phone" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                </div>
                                <hr class="border-t-2 border-gray-300 my-4">
                                <div class="mb-4">
                                    <h3 class="text-lg font-semibold mb-2">ข้อมูลผู้ที่จองให้</h3>
                                    <label for="bookingto_username" class="block text-gray-700 text-sm font-bold mb-2">ชื่อผู้เข้าพัก:</label>
                                    <input type="text" name="bookingto_username" id="bookingto_username" class="shadow mb-2 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <label for="bookingto_phone" class="block text-gray-700 text-sm font-bold mb-2">เบอร์โทรศัพท์ผู้เข้าพัก:</label>
                                    <input type="text" name="bookingto_phone" id="bookingto_phone" class="shadow mb-2 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    <div class="mb-4">
                                        <label for="number_of_guests" class="block text-gray-700 text-sm font-bold mb-2">จำนวนผู้เข้าพัก (ผู้ใหญ่): <span class="text-gray-500 text-xs">(เข้าพักได้สูงสุด 2 คน)</span></label>
                                        <input type="number" name="number_of_guests" id="number_of_guests" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="occupancy_child" class="block text-gray-700 text-sm font-bold mb-2">จำนวนผู้เข้าพัก (เด็ก): <span class="text-gray-500 text-xs">(เข้าพักได้สูงสุด 1 คน อายุไม่เกิน 12 ปี)</span></label>
                                        <input type="number" name="occupancy_child" id="occupancy_child" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                                    </div>
                                    <div class="mb-4">
                                        <label for="number_of_rooms" class="block text-gray-700 text-sm font-bold mb-2">จำนวนห้องที่ต้องการ:</label>
                                        <input type="text" name="number_of_rooms" id="number_of_rooms" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $number_of_rooms }}" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="extra_bed_count" class="block text-gray-700 text-sm font-bold mb-2">จำนวนเตียงเสริม:</label>
                                        <input type="text" name="extra_bed_count" id="extra_bed_count" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $extra_bed_count }}" readonly>
                                        <input type="hidden" name="extra_bed_count_hidden" id="extra_bed_count_hidden" value="{{ $extra_bed_count }}">
                                    </div>
                                    <div class="mb-4">
                                        <label for="checkin_date" class="block text-gray-700 text-sm font-bold mb-2">วันที่เช็คอิน:</label>
                                        <input type="date" name="checkin_date" id="checkin_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $checkin_date }}" readonly>
                                    </div>
                                    <div class="mb-4">
                                        <label for="checkout_date" class="block text-gray-700 text-sm font-bold mb-2">วันที่เช็คเอาท์:</label>
                                        <input type="date" name="checkout_date" id="checkout_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="{{ $checkout_date }}" readonly>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between">
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">บันทึกการจอง</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <footer class="bg-gray-800 mt-10 text-white">
                    <div class="container mx-auto p-5">
                        <div class="flex flex-wrap">
                            <!-- ข้อมูลการติดต่อ -->
                            <div class="w-full md:w-1/3 mb-6">
                                <h4 class="text-xl font-bold">Tunthree Resort</h4>
                                <div class="mt-4">
                                    <a href="https://maps.app.goo.gl/DvK7VftrFYtfJbAS7" class="flex items-center mb-2">
                                        <i class="fa fa-map-marker mr-2"></i>
                                        <span>Location</span>
                                    </a>
                                    <a href="tel:0940028212" class="flex items-center mb-2">
                                        <i class="fa fa-phone mr-2"></i>
                                        <span>Call 0940028212</span>
                                    </a>
                                    <a href="mailto:polathip.b@kkumail.com" class="flex items-center mb-2">
                                        <i class="fa fa-envelope mr-2"></i>
                                        <span>polathip.b@kkumail.com</span>
                                    </a>
                                </div>

                            </div>
                            <!-- ลิงก์หลัก -->
                            <div class="w-full md:w-1/3 mb-6">
                                <h4 class="text-xl font-bold">Quick Links</h4>
                                <div class="mt-4">
                                    <a href="index.html" class="block mb-2">Home</a>
                                    <a href="service.html" class="block mb-2">Services</a>
                                    <a href="contact.html" class="block mb-2">Contact Us</a>
                                </div>
                            </div>
                            <!-- ฟอร์มสมัครสมาชิก -->
                            <div class="w-full md:w-1/3 mb-6">
                                <h4 class="text-xl font-bold">Subscribe</h4>
                                <form action="#" class="mt-4">
                                    <input type="email" placeholder="Enter email" class="p-2 w-full mb-2" />
                                    <button type="submit" class="bg-blue-500 p-2 w-full text-white">Subscribe</button>
                                </form>
                            </div>
                        </div>
                        <div class="text-center ">
                            <small>
                                &copy; 2024 Tunthree Resort. All rights reserved.
                                <a href="#" class="hover:underline">Privacy Policy</a> •
                                <a href="#" class="hover:underline">Terms of Service</a>
                            </small>
                        </div>
                    </div>
                </footer>
                <script src="/js/hero.js"></script>

</body>

</html>