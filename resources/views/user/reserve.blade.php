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
        <form action="{{ url('/reserve/'.$rooms->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-4">

                <!-- ส่วนของชื่อ -->
                <div class="flex flex-col">
                    <label for="booking_name" class="text-sm font-medium">ชื่อผู้จอง</label>
                    <input type="text" id="booking_name" name="booking_name" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required>
                </div>

                <!-- ส่วนของเบอร์โทรศัพท์ และ จำนวนผู้เข้าพัก -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label for="phone" class="text-sm font-medium">เบอร์โทรศัพท์</label>
                        <input type="tel" id="phone" name="phone" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required>
                    </div>
                    <div class="flex flex-col">
                        <label for="number_of_guests" class="text-sm font-medium">จำนวนผู้เข้าพัก</label>
                        <input type="number" id="number_of_guests" name="number_of_guests" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required>
                    </div>
                </div>

                <!-- ส่วนของวันที่เข้าพัก และ วันที่ออกพัก -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="flex flex-col">
                        <label for="checkin_date" class="text-sm font-medium">วันที่เข้าพัก</label>
                        <input type="date" id="checkin_date" name="checkin_date" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" value="${checkinDate}" required>
                    </div>
                    <div class="flex flex-col">
                        <label for="checkout_date" class="text-sm font-medium">วันที่ออก</label>
                        <input type="date" id="checkout_date" name="checkout_date" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" value="${checkoutDate}" required>
                    </div>
                </div>

                <!-- ส่วนของประเภทห้องพัก -->
                <div class="flex flex-col">
                    <label for="room_type" class="text-sm font-medium">ประเภทห้องพัก</label>
                    <select id="room_type" name="room_type" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" required>
                        <option value="ห้องพักค้างคืน" data-price="{{ $rooms->price_night }}">ห้องพักค้างคืน</option>
                        <option value="ห้องพักชั่วคราว" data-price="{{ $rooms->price_temporary }}">ห้องพักชั่วคราว</option>
                    </select>
                </div>

                <div class="flex flex-col">
                    <label for="room_price" class="text-sm font-medium">ราคาห้อง</label>
                    <input type="text" id="room_price" name="room_price" class="bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block w-full" readonly>
                </div>
                <input type="hidden" id="booking_status" name="booking_status" value="ทำการจอง">

                <script>
                    document.getElementById('room_type').addEventListener('change', function() {
                        var roomType = this.value;
                        var roomPrice = this.options[this.selectedIndex].getAttribute('data-price');

                        // แสดงราคาห้อง
                        document.getElementById('room_price').value = roomPrice;
                    });
                </script>


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
    </script>

</body>

</html>