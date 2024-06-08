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

</head>

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
                    <a href="contact.html" class="text-black hover:text-blue-400">ติดต่อเรา<i class="fa-solid fa-comments ml-2"></i></a>
                    <!-- User Menu Dropdown -->
                    <button id="profileButton" type="button" class="text-black hover:text-blue-400 focus:outline-none">
                        <i class="fa-solid fa-user"></i>
                        <span class="sr-only">User Menu</span>
                    </button>
                    <div id="profileDropdown" class="absolute hidden right-0 ml-2 mt-2 w-38 bg-white rounded-md shadow-lg">
                        <div class="py-1">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
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

<section>
    <div class="w-full h-24 flex items-center justify-center  px-4 " style="background-color: #04233B;">

        <div class="flex items-center mt-4">
            <div class="mr-4 ">
                <span class="font-semibold text-white">Check-in Date</span>
                <input type="date" id="checkin_date" name="checkin_date" class="ml-2 border border-gray-400 rounded-md px-2 py-1">
            </div>
        </div>

        <div class="flex items-center mt-4">
            <div class="mr-4 ">
                <span class="font-semibold text-white">Check-out Date</span>
                <input type="date" id="checkout_date" name="checkout_date" class="ml-2 border border-gray-400 rounded-md px-2 py-1">
            </div>
        </div>
        <div class="mt-4">
            <button id="search-button" type="button" class=" flex items-center justify-center text-white px-4 py-2 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-600 " style="background-color: #0A97B0;" onclick="getAvailableRooms()">
                ค้นหา
            </button>
        </div>
    </div>
</section>
<section class="container mx-auto mt-12 flex" style="padding-bottom: 10%;">
    <div class="grid gap-4" style="height: 400px; width: 600px; margin-left: -10%;">
        <div>
            <img class="h-auto max-w-full rounded-lg border border-gray-300" src="/images/tb1.png" alt="">
        </div>
        <div class="grid grid-cols-5 gap-4">
            <div>
                <img class="h-auto max-w-full rounded-lg border border-gray-300" src="/images/S__13500422.jpg" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg border border-gray-300" src="/images/S__13500432.jpg" alt="Price">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg border border-gray-300" src="/images/S__13500425.jpg" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg border border-gray-300" src="/images/S__13500426.jpg" alt="">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg border border-gray-300" src="/images/S__13500433.jpg" alt="">
            </div>
        </div>
    </div>
    <div class="ml-8">
        <h2 class="text-2xl font-semibold">ห้องพัก</h2>
        <h5 class="text-gray-600">ราคาเริ่มต้นที่ </h5>
        <h4 class="text-gray-600">500 บาท/คืน </h4>
        <p class="text-gray-600">ห้องพัก เตียงนุ่ม อยู่สบาย</p>
        <p class="text-gray-600">ฟรี WIFI แต่ไม่ฟรี breakfast naka</p>
        <p class="text-gray-600">ประเภทห้อง: หนึ่งเตียง</p>
        <button class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-200 focus:outline-none focus:bg-blue-600" onclick="redirectToReservePage()">
            จองห้องพัก!
        </button>
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

<script>

</script>