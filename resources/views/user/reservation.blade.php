<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist\output.css">
    <link rel="shortcut icon" href="images/TTbell.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet" />
    <!-- <link href="css/font-awesome.min.css" rel="stylesheet" /> -->
    <link href="/css/style.css" rel="stylesheet" />
    <title>Thunthree</title>

    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />

    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .scroll-button {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        <header class="header_section">
            <div class="header_top fixed top-0 left-0 w-full z-50 ">
                <div class="container-fluid ">
                    <div class="contact_nav">
                        <a href="">
                            <i class="fa-solid fa-phone"></i>
                            <span>
                                Call : 0940028212
                            </span>
                        </a>
                        <a href="">
                            <i class="fa-solid fa-envelope"></i>
                            <span>
                                Email : polathip.b@kkumail.com
                            </span>
                        </a>
                        <a href="https://maps.app.goo.gl/DvK7VftrFYtfJbAS7">
                            <i class="fa-solid fa-location-dot"></i>
                            <span>
                                Location
                            </span>
                        </a>
                    </div>
                </div>
            </div>

            <div class="w-full flex flex-wrap items-center justify-between mx-auto py-4 max-xl:p-4 shadow-md fixed top-10 left-0 w-full z-40 bg-white" style="padding: 5%;">
                <a href="home.html" class="text-black text-4xl font-bold">Tunthree Resort</a>
                <div class="relative">
                    <nav class="space-x-10 text-xl">

                        <a href="history.html" class="text-black hover:text-blue-400">ประวัติการจอง<i class="fa-solid fa-clock-rotate-left ml-2"></i></a>
                        <a href="about.html" class="text-black hover:text-blue-400">รีวิว<i class="fa-solid fa-star ml-2"></i></a>
                        <a href="{{ route('contact') }}" class="text-black hover:text-blue-400">ติดต่อเรา<i class="fa-solid fa-comments ml-2"></i></a>
                        <!-- User Menu Dropdown -->
                        <button id="profileButton" type="button" class="text-black hover:text-blue-400 focus:outline-none">
                            <i class="fa-solid fa-user"></i>
                            <span class="sr-only">User Menu</span>
                        </button>
                        <div id="profileDropdown" class="absolute hidden right-0 ml-2 mt-2 w-38 bg-white rounded-md shadow-lg">
                            <div class="py-1">
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <span class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
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

                </div>
        </header>
    </div>
    <div class="mx-auto pt-4 pb-4 bg-gray-100">
        <p class="text-gray-600 text-lg max-xl:px-4 pt-8" style="margin-left: 7%;">
            <a href="{{route('home')}}" class="text-black hover:text-blue-400">Home</a>
            <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
            <a href="{{route('userbooking') }}" class="text-black hover:text-blue-400">จองห้อง</a>
            <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
            <a href="#" class="text-blue-600 hover:text-black">ประวิติการจอง</a>
        </p>
    </div>

    <div class=" mx-4 py-10 p-5 mb-10">
        <h1 class="text-5xl mb-10 max-xl:px-4">ประวัติการจอง</h1>
        <div class="grid justify-items-stretch  max-lg:grid-cols-1 max-xl:px-4">
            <div class="grid max-lg:grid-cols-1">

                @if(count($bookings) > 0)
                <div class="content">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-3 py-3 text-center" id="หมายเลขการจอง">หมายเลขการจอง</th>
                                    <th scope="col" class="px-3 py-3 text-center" id="ชื่อผู้จอง">ชื่อผู้จอง</th>
                                    <th scope="col" class="px-3 py-3 text-center" id="จำนวนผู้เข้าพัก">จำนวนผู้เข้าพัก</th>
                                    <th scope="col" class="px-3 py-3 text-center" id="ประเภทการจอง">วันที่เช็คอิน</th>
                                    <th scope="col" class="px-3 py-3 text-center" id="ประเภทการจอง">วันที่เช็คเอาท์</th>
                                    <th scope="col" class="px-3 py-3 text-center" id="ประเภทการจอง">ประเภทห้องพัก</th>
                                    <th scope="col" class="px-3 py-3 text-center" id="สถานะ">สถานะการจอง</th>
                                    <th scope="col" class="px-3 py-3 text-center" id="รายละเอียด">รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($bookings as $index => $booking)
                                @if($booking->booking_status !== 'ยกเลิก')
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 text-center">
                                    <th scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white text-center">
                                        {{ $loop->iteration }}
                                    </th>
                                    <td class="px-3 py-4 text-center">{{ $booking->booking_name}}</td>
                                    <td class="px-3 py-4 text-center">{{ $booking->occupancy_person }}</td>
                                    <td class="px-3 py-4 text-center">{{ $booking->checkin_date }}</td>
                                    <td class="px-3 py-4 text-center">{{ $booking->checkout_date }}</td>
                                    <td class="px-3 py-4 text-center">{{ $booking->room_type }}</td>
                                    <td class="px-3 py-4 text-center">
                                        @if($booking->booking_status === 'ทำการจอง')
                                        <span class="mr-2 inline-flex items-center bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 text-center">
                                            <span class="w-2 h-2 me-1 bg-yellow-300 rounded-full"></span>
                                            {{ $booking->booking_status }}
                                        </span>
                                        @elseif($booking->booking_status === 'อยู่ในช่วงเวลาที่เข้าพัก')
                                        <span class="mr-2 inline-flex items-center bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 text-center">
                                            <span class="w-2 h-2 me-1 bg-green-300 rounded-full"></span>
                                            {{ $booking->booking_status }}
                                        </span>
                                        @elseif($booking->booking_status === 'เช็คเอาท์')
                                        <span class="mr-2 inline-flex items-center bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 text-center">
                                            <span class="w-2 h-2 me-1 bg-blue-300 rounded-full"></span>
                                            {{ $booking->booking_status }}
                                        </span>
                                        @elseif($booking->booking_status === 'เช็คอินแล้ว')
                                        <span class="mr-2 inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 text-center">
                                            <span class="w-2 h-2 me-1 bg-gray-300 rounded-full"></span>
                                            {{ $booking->booking_status }}
                                        </span>
                                        @elseif($booking->booking_status === 'รอชำระเงิน')
                                        <span class="mr-2 inline-flex items-center bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-green-900 dark:text-green-300 text-center">
                                            <span class="w-2 h-2 me-1 bg-gray-300 rounded-full"></span>
                                            {{ $booking->booking_status }}
                                        </span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-4 flex justify-center items-center col-md-12">
                                        <a href="/reserve/resultreserve/1" class="ml-1 block ">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-500 dark:text-gray-400 " viewBox="0 0 20 20" fill="currentColor">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 19l-4-4m0-7a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z" />
                                            </svg>
                                        </a>
                                    </td>

                                </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="text-gray-600">ไม่พบการจอง</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    <section class="info_section layout_padding2" style="margin-top:10%;">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 info_col">
                    <div class="info_contact">
                        <h4>

                            Tunthree Resort

                        </h4>
                        <div class="contact_link_box">
                            <a href="https://maps.app.goo.gl/DvK7VftrFYtfJbAS7">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <span>
                                    Location
                                </span>
                            </a>
                            <a href="">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <span>
                                    Call 0940028212
                                </span>
                            </a>
                            <a href="">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <span>
                                    polathip.b@kkumail.com
                                </span>
                            </a>
                            <a href="https://www.facebook.com/profile.php?id=100063483881013">
                                <i class="fa fa-facebook" aria-hidden="true">
                                    <span>
                                        Thunthree
                                    </span>
                                </i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-2 mx-auto info_col">
                    <div class="info_link_box">
                        <h4>

                        </h4>
                        <div class="info_links">
                            <a class="active" href="{{route('home')}}">
                                <img src="images/nav-bullet.png" alt="">
                                Home
                            </a>
                            <a class="" href="service.html">
                                <img src="images/nav-bullet.png" alt="">
                                Services
                            </a>
                            <a class="" href="contact.html">

                                Contact Us
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 info_col ">
                    <h4>
                        Subscribe
                    </h4>
                    <form action="#">
                        <input type="text" placeholder="Enter email" />
                        <button type="submit">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        // เมื่อคลิกที่เมนูหรือพื้นหลังเว็บ
        document.addEventListener("click", function(event) {
            var profileButton = document.getElementById("profileButton");
            var profileDropdown = document.getElementById("profileDropdown");

            // ตรวจสอบว่าคลิกที่ปุ่มโปรไฟล์หรือไม่
            var isProfileButtonClicked = profileButton.contains(event.target);

            // ตรวจสอบว่าเมนู dropdown ถูกเปิดอยู่หรือไม่
            var isDropdownOpen = !profileDropdown.classList.contains("hidden");

            // ถ้าคลิกที่อื่นๆ และเมนู dropdown ไม่ถูกเปิดอยู่ให้ปิดเมนู dropdown
            if (!isProfileButtonClicked && isDropdownOpen) {
                profileDropdown.classList.add("hidden");
            }
        });

        // เมื่อคลิกที่ปุ่มโปรไฟล์
        document.getElementById("profileButton").addEventListener("click", function(event) {
            var profileDropdown = document.getElementById("profileDropdown");
            profileDropdown.classList.toggle("hidden"); // เปิดหรือปิดเมนู dropdown
            event.stopPropagation(); // ไม่ให้การคลิกที่ปุ่มแพร่กระจายไปยังโค้ดด้านบน
        });
    </script>

</body>

</html>