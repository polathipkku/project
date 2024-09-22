<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.28/dist/fancybox.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/th.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="{{ asset('css/output.css') }}" rel="stylesheet">
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
    <link rel="shortcut icon" href="/images/Logo_2.jpg" type="image/png">
    <link rel="stylesheet" href="/css/hero.css">
    {{-- <link href="src/output.css" rel="stylesheet"> --}}
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
                    <a href="{{ route('review.index') }}" class="text-black hover:text-blue-400">รีวิว<i
                            class="fa-solid fa-star ml-2"></i></a>
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

    <div id="backdrop"
        class="fixed inset-0 bg-black opacity-0 z-40 pointer-events-none transition-opacity duration-300">
    </div>

    <div id="sidebar" class="sidebar-hidden fixed top-0 right-0 w-1/4 h-full bg-white p-5 shadow-lg z-50">
        <h2 class="text-2xl font-bold mb-5">จองห้องพัก</h2>
        <form>
            <div class="mb-4">
                <label for="checkin_date" class="block text-gray-700">เช็คอิน</label>
                <input type="text" id="checkin_date" name="checkin" class="w-full border p-2 rounded">
            </div>
            <div class="mb-4">
                <label for="checkout_date" class="block text-gray-700">เช็คเอาท์</label>
                <input type="text" id="checkout_date" name="checkout" class="w-full border p-2 rounded">
            </div>
            <div class="mb-4">
                <label for="rooms" class="block text-gray-700">จำนวนห้อง</label>
                <input type="number" id="rooms" name="rooms" class="w-full border p-2 rounded" min="1">
            </div>
            <input type="hidden" id="startDate">
            <input type="hidden" id="endDate">
            <input type="hidden" id="totalDay">
            <button id="reserve-button" type="button"
                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-700 text-center inline-block">
                เช็คห้องว่าง
            </button>

            <script>
                document.getElementById('reserve-button').addEventListener('click', function() {
                    var checkinDate = encodeURIComponent(document.getElementById('checkin_date').value);
                    var checkoutDate = encodeURIComponent(document.getElementById('checkout_date').value);
                    var numberOfRooms = encodeURIComponent(document.getElementById('rooms').value);

                    var url =
                        `{{ route('userbooking') }}?checkin_date=${checkinDate}&checkout_date=${checkoutDate}&number_of_rooms=${numberOfRooms}`;
                    window.location.href = url;
                });
            </script>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var valuestartdate = document.getElementById('startDate');
            var valueenddate = document.getElementById('endDate');
            var totalDay = document.getElementById('totalDay');
            var checkinInput = document.getElementById('checkin_date');
            var checkoutDateInput = document.getElementById('checkout_date');

            flatpickr(checkinInput, {
                dateFormat: 'Y-m-d',
                locale: 'th',
                minDate: 'today',
                mode: 'range',
                onChange: function(array, str, instance) {
                    if (array.length === 2) {
                        var startDate = array[0];
                        var endDate = array[1];
                        var strStartDate = instance.formatDate(startDate, 'Y-m-d');
                        var strEndDate = instance.formatDate(endDate, 'Y-m-d');
                        valuestartdate.value = strStartDate;
                        valueenddate.value = strEndDate;
                        checkinInput.value = strStartDate;
                        checkoutDateInput.value = strEndDate;
                        var timeDiff = endDate - startDate;
                        var totalDays = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
                        totalDay.value = totalDays;
                        document.getElementById('totalDay').textContent = totalDays + " วัน";
                    }
                }
            });
            reserveButton.addEventListener('click', function() {
                alert("Check-in: " + valuestartdate.value + "\nCheck-out: " + valueenddate.value +
                    "\nจำนวนวันเข้าพัก: " + totalDay.value);
            });
        });
    </script>
    <div class="container my-8">
        <h1 class="mb-8 text-center text-3xl font-bold text-gray-800 z-20">รีวิวทั้งหมด</h1>

        @if ($reviews->isEmpty())
        <p class="text-center text-gray-500 text-xl">ยังไม่มีรีวิวในตอนนี้</p>
        @else
        <div class="flex flex-wrap justify-center">
            @foreach ($reviews as $review)
            <div class="w-full sm:w-1/2 lg:w-1/3 p-4">
                <div
                    class="bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 h-full flex flex-col justify-between">
                    <div class="p-6">
                        <h5 class="text-xl font-semibold text-gray-700 mb-4">ให้คะแนน:</h5>
                        <p class="text-lg text-gray-700">
                            @for ($i = 0; $i < 5; $i++)
                                @if ($i < $review->rating)
                                <span class="text-yellow-400">&#9733;</span> <!-- filled star -->
                                @else
                                <span class="text-gray-300">&#9734;</span> <!-- empty star -->
                                @endif
                                @endfor
                                ({{ $review->rating }}/5)
                        </p>
                        <p class="mt-4 text-gray-600"><strong>ความคิดเห็น:</strong> {{ $review->comment }}</p>
                    </div>
                    <div class="bg-gray-100 p-4 rounded-b-lg text-sm text-gray-500">
                        <small>โดย: {{ $review->booking->user->name }}</small><br>
                        <small>วันที่: {{ $review->created_at->format('d/m/Y') }}</small>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>


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

    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.28/dist/fancybox.umd.js"></script>
    <script src="/js/hero.js"></script>
</body>

</html>