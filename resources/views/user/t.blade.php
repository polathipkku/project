<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist\output.css">
    <link rel="shortcut icon" href="images/TTbell.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet" />

    <title>Thunthree</title>

    <link rel="stylesheet" type="text/css" href="/css/bootstrap.css" />
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6">
    <style>
        
        button {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        img {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        img:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="hero_area">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

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

            <div class="w-full flex flex-wrap items-center justify-between mx-auto py-4 max-xl:p-4 shadow-md fixed top-10 left-0 w-full z-40 bg-white"
                style="padding: 5%;">
                <a href="home.html" class="text-black text-4xl font-bold">Tunthree Resort</a>
                <div class="relative">
                    <nav class="space-x-10 text-xl">

                        <a href="history.html" class="text-black hover:text-blue-400">ประวัติการจอง<i
                                class="fa-solid fa-clock-rotate-left ml-2"></i></a>
                        <a href="about.html" class="text-black hover:text-blue-400">รีวิว<i
                                class="fa-solid fa-star ml-2"></i></a>
                        <a href="contact.html" class="text-black hover:text-blue-400">ติดต่อเรา<i
                                class="fa-solid fa-comments ml-2"></i></a>
                        <!-- User Menu Dropdown -->
                        <button id="profileButton" type="button"
                            class="text-black hover:text-blue-400 focus:outline-none">
                            <i class="fa-solid fa-user"></i>
                            <span class="sr-only">User Menu</span>
                        </button>
                        <div id="profileDropdown"
                            class="absolute hidden right-0 ml-2 mt-2 w-38 bg-white rounded-md shadow-lg">
                            <div class="py-1">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                            </div>
                        </div>
                    </nav>
                </div>
        </header>
    </div>
    <div class="mx-auto pt-2 pb-2 ">
        <p class="text-gray-600 text-l max-xl:px-4 pt-8" style="margin-left: 7%;">
            <a href="index.html" class="text-black hover:text-blue-400">Home</a>
            <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
            <a href="reserve.html" class="text-black hover:text-blue-400">จองห้อง</a>
            <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
            <a href="#" class="text-blue-600 hover:text-black">เลือกดูห้อง</a>
        </p>
    </div>
    

    <!-- ส่วนค้นหา -->
    <section>
        <div class="w-full h-24 flex items-center justify-center px-4" style="background-color: #04233B;">
            <div class="flex items-center mt-4 relative mr-4">
                <span class="font-semibold text-white">Check-in </span>
                <input type="date" id="checkin_date" name="checkin_date" class="ml-2 border border-gray-400 rounded-md px-2 py-1 pr-10">
                <i class="fa-regular fa-calendar absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none"></i>
            </div>
            <div class="flex items-center mt-4 relative mr-4">
                <span class="font-semibold text-white">Check-out </span>
                <input type="date" id="checkout_date" name="checkout_date" class="ml-2 border border-gray-400 rounded-md px-2 py-1 pr-10">
                <i class="fa-regular fa-calendar absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none"></i>
            </div>
            <div class="mt-4">
                <button id="search-button" type="button" class="flex items-center justify-center text-white px-4 py-2 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-600" style="background-color: #0A97B0;" onclick="getAvailableRooms()">
                    ค้นหา
                </button>
            </div>
        </div>
    </section>
    

    
    
    <!-- กริดของรูปภาพและข้อมูลห้องพัก -->
    <section class="container mx-auto mt-12 flex gap-8" style="padding-bottom: 10%;">
        <div class="grid gap-4" style="height: 400px; width: 600px;">
            <div>
                <a data-fancybox="gallery" href="/images/tb1.png">
                    <img class="max-w-full rounded-lg border border-gray-300" src="/images/tb1.png" alt="">
                </a>
            </div>
            <div class="grid grid-cols-5 gap-2">
                <div>
                    <a data-fancybox="gallery" href="/images/S__13500422.jpg">
                        <img class="max-w-full rounded-lg border border-gray-300" src="/images/S__13500422.jpg" alt="">
                    </a>
                </div>
                <div>
                    <a data-fancybox="gallery" href="/images/S__13500432.jpg">
                        <img class="max-w-full rounded-lg border border-gray-300" src="/images/S__13500432.jpg" alt="">
                    </a>
                </div>
                <div>
                    <a data-fancybox="gallery" href="/images/S__13500425.jpg">
                        <img class="max-w-full rounded-lg border border-gray-300" src="/images/S__13500425.jpg" alt="">
                    </a>
                </div>
                <div>
                    <a data-fancybox="gallery" href="/images/S__13500426.jpg">
                        <img class="max-w-full rounded-lg border border-gray-300" src="/images/S__13500426.jpg" alt="">
                    </a>
                </div>
                <div>
                    <a data-fancybox="gallery" href="/images/S__13500433.jpg">
                        <img class="max-w-full rounded-lg border border-gray-300" src="/images/S__13500433.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>

        <div class="flex-1">
            <h2 class="text-2xl font-semibold">ห้องพัก</h2>
            <h5 class="text-gray-600">ราคาเริ่มต้นที่ </h5>
            <h4 class="text-gray-600">500 บาท/คืน </h4>
            <p class="text-gray-600">ห้องพัก เตียงนุ่ม อยู่สบาย</p>
            <p class="text-gray-600">ฟรี WIFI แอร์เย็นสบาย </p>
            <p class="text-gray-600">ประเภทห้อง: เตียงคิงไซต์</p>
            <select id="room_amount" name="room_amount" class="bg-white border border-gray-300 rounded-md mb-3 shadow-sm py-2 px-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 block" required>
                <option value="" selected disabled hidden>เลือกจำนวนห้องพัก</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-400 focus:outline-none focus:bg-yellow-600" onclick="redirectToReservePage()">
                จองห้องพัก!
            </button>
        </div>
    </section>

    <section class="container mx-auto mt-12 mb-12">
        <h2 class="text-2xl font-semibold mb-4">ที่ตั้งของเรา</h2>
        <div class="w-full h-64">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d933.7442758063276!2d104.03987679285655!3d16.5454448381507!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313d1106b2de224b%3A0xa0b6a2d9170250bf!2z4LiY4Lix4LiZ4Lii4LmM4LiX4Lij4Li14Lij4Li14Liq4Lit4Lij4LmM4LiX!5e1!3m2!1sth!2sth!4v1721844367798!5m2!1sth!2sth" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        </div>
    </section>
    <!-- ส่วนรีวิวจากลูกค้า -->
    <section class="container mx-auto mt-12 mb-12">
        <h2 class="text-2xl font-semibold mb-4">รีวิวจากลูกค้า</h2>
        <div class="grid gap-4">
            <div class="p-4 border rounded-md shadow-sm">
                <p class="text-gray-600">"ห้องพักสะอาดและสะดวกสบายมาก!" - คุณสมชาย</p>
            </div>
            <div class="p-4 border rounded-md shadow-sm">
                <p class="text-gray-600">"พนักงานบริการดีเยี่ยม และอาหารเช้าอร่อย!" - คุณสมศรี</p>
            </div>
        </div>
    </section>

 

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
                            <a class="active" href="index.html">
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

     <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
     <script>
         // เรียกใช้ Flatpickr
         flatpickr("#checkin_date", {
             dateFormat: "Y-m-d",
             minDate: "today"
         });
 
         flatpickr("#checkout_date", {
             dateFormat: "Y-m-d",
             minDate: "today"
         });
 
         function getAvailableRooms() {
             // Logic สำหรับการค้นหาห้องว่าง
             alert('ค้นหาห้องพักที่ว่าง');
         }
 
         function redirectToReservePage() {
             // Logic สำหรับการเปลี่ยนไปยังหน้าจองห้องพัก
             alert('เปลี่ยนไปยังหน้าจองห้องพัก');
         }
     </script>

</body>

</html>