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

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/JQL.min.js"></script>
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dependencies/typeahead.bundle.js"></script>

    <link rel="stylesheet" href="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.css">
    <script type="text/javascript" src="https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/dist/jquery.Thailand.min.js"></script>

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
                <a href="{{route('home')}}" class="text-black text-4xl font-bold">Tunthree Resort</a>
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
            <a href="{{route('home')}}" class="text-black hover:text-blue-400">Home</a>
            <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
            <a href="#" class="text-blue-600 hover:text-black">จองห้อง</a>
        </p>
    </div>
    <div class="max-w-screen-xl mx-auto pt-8 pb-16 ">
        <h1 class="text-5xl mb-10 max-xl:px-4">จองห้อง</h1>
        <form action="{{ url('/em_reserve/'.$rooms->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-4">
                <!-- ชื่อผู้จอง -->
                <div class="flex flex-col">
                    <label for="booking_name" class="text-sm font-medium">ชื่อผู้จอง</label>
                    <input type="text" id="booking_name" name="booking_name" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required>
                </div>

                <!-- เบอร์โทรศัพท์ และ หมายเลขบัตรประชาชน -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label for="phone" class="text-sm font-medium">เบอร์โทรศัพท์</label>
                        <input type="tel" id="phone" name="phone" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required>
                    </div>
                    <div class="flex flex-col">
                        <label for="id_card" class="text-sm font-medium">หมายเลขบัตรประชาชน</label>
                        <input type="text" id="id_card" name="id_card" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required>
                    </div>
                </div>

                <div class="grid grid-cols-3 gap-4 mb-4">
                    <div class="flex flex-col">
                        <label for="occupancy_person" class="text-sm font-medium">จำนวนผู้ใหญ่</label>
                        <input type="number" id="occupancy_person" name="occupancy_person"value="1" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required min="1">
                    </div>
                    <div class="flex flex-col">
                        <label for="occupancy_child" class="text-sm font-medium">จำนวนเด็ก</label>
                        <input type="number" id="occupancy_child" name="occupancy_child"value="0" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required min="0">
                    </div>
                    <div class="flex flex-col">
                        <label for="occupancy_baby" class="text-sm font-medium">จำนวนทารก</label>
                        <input type="number" id="occupancy_baby" name="occupancy_baby"value="0" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required min="0">
                    </div>
                </div>
                <div class="flex flex-col">
                    <label for="extra_bed_count" class="text-sm font-medium">จำนวนเตียงเสริม (ถ้ามี)</label>
                    <input type="number" id="extra_bed_count" name="extra_bed_count" value="0" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" min="0">
                    <p class="text-xs text-gray-500 mt-1">สามารถเลือกเตียงเสริมได้หากจำเป็น (มีค่าใช้จ่ายเพิ่มเติม)</p>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <!-- วันที่เข้าพัก (Check-in) -->
                    <div class="flex flex-col">
                        <label for="checkin-date" class="text-sm font-medium">วันที่เข้าพัก</label>
                        <input type="text" id="checkin-date" name="checkin_date" value="{{ $checkinDate }}" readonly class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full">
                    </div>

                    <!-- วันที่ออก (Check-out) -->
                    <div class="flex flex-col">
                        <label for="checkout-date" class="text-sm font-medium">วันที่ออก</label>
                        <input type="text" id="checkout-date" name="checkout_date" value="{{ $checkoutDate }}" readonly class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full">
                    </div>
                </div>



                <!-- Address Fields -->
                <div class="flex flex-col mb-4">
                    <label for="address" class="text-sm font-medium">ที่อยู่</label>
                    <div class="flex space-x-4">
                        <input type="text" id="address" name="address" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 flex-grow" placeholder="บ้านเลขที่/หมู่" required>
                        <input type="text" id="sub_district" name="sub_district" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 flex-grow" placeholder="ตำบล" required>
                        <input type="text" id="province" name="province" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 flex-grow" placeholder="จังหวัด" required>
                        <input type="text" id="district" name="district" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 flex-grow" placeholder="อำเภอ" required>
                        <input type="text" id="postcode" name="postcode" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 flex-grow" placeholder="รหัสไปรษณีย์" required>
                    </div>
                </div>
                <!-- ประเภทห้องพัก -->
                <div class="flex flex-col">
                    <label for="room_type" class="text-sm font-medium">ประเภทห้องพัก</label>
                    <select id="room_type" name="room_type" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required>
                        <option value="ห้องพักค้างคืน" data-price="{{ $rooms->price_night }}">ห้องพักค้างคืน</option>
                        <option value="ห้องพักชั่วคราว" data-price="{{ $rooms->price_temporary }}">ห้องพักชั่วคราว</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <button type="submit" class="bg-indigo-500 text-white py-2 px-4 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">ยืนยันการจอง</button>
                </div>

            </div>
        </form>

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
        function submitForm() {
            const contactName = document.getElementById("contactName").value;
            const phoneNumber = document.getElementById("phoneNumber").value;
            const numberOfGuests = document.getElementById("numberOfGuests").value;
            const checkInDate = document.getElementById("checkInDate").value;
            const checkOutDate = document.getElementById("checkOutDate").value;
            const accommodationType = document.getElementById("accommodationType").value;

            console.log("Form submitted with:", {
                contactName,
                phoneNumber,
                numberOfGuests,
                checkInDate,
                checkOutDate,
                accommodationType,
            });
        }

        $.Thailand({
            database: 'https://earthchie.github.io/jquery.Thailand.js/jquery.Thailand.js/database/db.json', // เพิ่มลิงก์ไปยัง database
            $district: $("#sub_district"), // input ของตำบล
            $amphoe: $("#district"), // input ของอำเภอ
            $province: $("#province"), // input ของจังหวัด
            $zipcode: $("#postcode") // input ของรหัสไปรษณีย์
        });
    </script>

</body>

</html>