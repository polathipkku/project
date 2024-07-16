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
    <!--owl slider stylesheet -->
    <!-- <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" /> -->
    <!-- <link rel="stylesheet" href="css/style-head.css"> -->
    <!-- Magnific Popup CSS -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css"> -->
    <!-- jQuery -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <!-- Magnific Popup JS -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script> -->
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
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
                <a href="{{route('emroom')}}" class="text-black text-4xl font-bold">Tunthree Resort</a>
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
    <!--------------------------End Topbar-------------------------------------->
    <div class="mx-auto pt-4 pb-4 bg-gray-100">
        <p class="text-gray-600 text-lg max-xl:px-4 pt-8" style="margin-left: 7%;">
            <a href="{{route('emroom')}}" class="text-black hover:text-blue-400">Home</a>
            <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
            <a href="#" class="text-blue-600 hover:text-black">แจ้งซ่อมห้อง</a>
        </p>
    </div>
    <div class="max-w-screen-xl mx-auto pt-8 pb-16 ">
        <div class="flex justify-between items-start">
            <h1 class="text-5xl mb-10 max-xl:px-4">แจ้งซ่อมห้อง</h1>
            <button class="relative pr-12 mb-4 group" onclick="window.location.href ='/maintenanceroom'">
                <i class="fa-solid fa-circle-xmark text-4xl text-red-500 group-hover:text-red-900"></i>
            </button>
        </div>

        <form action="{{ route('submit_maintenance') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="room_id" class="block text-sm font-medium text-gray-700">หมายเลขห้อง</label>
                <input type="text" id="room_id" name="room_id" value="{{ $room->id }}" readonly class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm">
            </div>

            <div>
                <label for="Problem_detail" class="block text-sm font-medium text-gray-700">รายละเอียดปัญหา</label>
                <textarea id="Problem_detail" name="Problem_detail" rows="4" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required></textarea>
            </div>
            <div>
                <label for="Maintenance_StartDate" class="block text-sm font-medium text-gray-700">วันที่เริ่มซ่อม</label>
                <input type="date" id="Maintenance_StartDate" name="Maintenance_StartDate" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>
            </div>
            <div>
                <label for="problemType" class="block text-sm font-medium text-gray-700">ประเภทของปัญหา</label>
                <select id="problemType" name="problemType" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>
                    <option value="" disabled selected>เลือกประเภทของปัญหา</option>
                    <option value="ไฟฟ้า">ไฟฟ้า</option>
                    <option value="ประปา">ประปา</option>
                    <option value="เครื่องใช้ไฟฟ้า">เครื่องใช้ไฟฟ้า</option>
                    <option value="อื่นๆ">อื่นๆ</option>
                </select>
            </div>
            <div>
                <label for="room_status" class="block text-sm font-medium text-gray-700">สถานะห้อง</label>
                <select id="room_status" name="room_status" class="mt-1 block w-full p-2 border border-gray-300 rounded-md shadow-sm" required>
                    <option value="พร้อมให้บริการ" {{ $room->room_status == 'พร้อมให้บริการ' ? 'selected' : '' }}>พร้อมให้บริการ</option>
                    <option value="แจ้งซ่อมห้อง" {{ $room->room_status == 'แจ้งซ่อมห้อง' ? 'selected' : '' }}>แจ้งซ่อมห้อง</option>
                    <option value="ไม่พร้อมให้บริการ" {{ $room->room_status == 'ไม่พร้อมให้บริการ' ? 'selected' : '' }}>ไม่พร้อมให้บริการ</option>
                </select>
            </div>
            <div>
                <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">ส่งรายงาน</button>
            </div>
        </form>
    </div>


    </div>
    <section class="info_section layout_padding2">
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
                            <a class="active" href="{{route('emroom')}}">
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
</body>

</html>