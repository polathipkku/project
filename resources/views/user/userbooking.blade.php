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

            <div class="w-full flex flex-wrap items-center justify-between mx-auto py-4 max-xl:p-4 shadow-md fixed top-10 left-0  z-40 bg-white"
                style="padding: 5%;">
                <a href="{{ route('home') }}" class="text-black text-4xl font-bold">Tunthree Resort</a>
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
            <a href="{{ route('home') }}" class="text-black hover:text-blue-400">Home</a>
            <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
            <a href="reserve.html" class="text-black hover:text-blue-400">จองห้อง</a>
            <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
            <a href="#" class="text-blue-600 hover:text-black">เลือกดูห้อง</a>
        </p>
    </div>
    <section>
        <div class="w-full h-24 flex items-center justify-center px-4" style="background-color: #04233B;">
            <div class="flex flex-col items-start mr-4">
                <span class="font-semibold text-white mb-1">Check-in</span>
                <div class="relative">
                    <input type="text" id="checkin_date" class="border border-gray-400 rounded-md px-2 py-1 pr-10">
                    <i
                        class="fa-regular fa-calendar absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none"></i>
                </div>
                <input type="hidden" id="startDate" name="startDate">
            </div>
            <div class="flex flex-col items-start mr-4">
                <span class="font-semibold text-white mb-1">Check-out</span>
                <div class="relative">
                    <input type="text" id="checkout_date" class="border border-gray-400 rounded-md px-2 py-1 pr-10"
                        readonly>
                    <i
                        class="fa-regular fa-calendar absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none"></i>
                </div>
                <input type="hidden" id="endDate" name="endDate">
                <input type="hidden" id="totalDay" name="totalDay">
            </div>

            <!-- Dropdown for Room, Adults, and Children -->
            <div class="relative">
                <div class="flex flex-col items-start">
                    <span class="font-semibold text-white mb-1">จำนวนห้องและผู้เข้าพัก</span>
                    <button id="guest-room-button"
                        class="flex items-center bg-white px-4 py-2 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-800">
                        <i class="fa fa-user mr-2"></i> <span id="guest-summary">ผู้ใหญ่ 2 คน, 1 ห้อง</span>
                        <i class="fa fa-caret-down ml-2"></i>
                    </button>
                </div>
                <div id="guest-room-popup"
                    class="hidden absolute top-full left-0 mt-2 w-64 bg-white rounded-md shadow-lg p-4 z-10">
                    <!-- Room Selection -->
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold text-gray-700">ห้อง</span>
                        <div class="flex items-center space-x-2">
                            <button
                                class="decrement-room bg-gray-200 w-8 h-8 rounded hover:bg-gray-300 focus:outline-none">-</button>
                            <span id="number-of-rooms" class="font-semibold text-gray-700 text-center w-6">1</span>
                            <button
                                class="increment-room bg-gray-200 w-8 h-8 rounded hover:bg-gray-300 focus:outline-none">+</button>
                        </div>
                    </div>
                    <!-- Adult Selection -->
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold text-gray-700">ผู้ใหญ่</span>
                        <div class="flex items-center space-x-2">
                            <button class="decrement-adult bg-gray-200 w-8 h-8 rounded hover:bg-gray-300 focus:outline-none">-</button>
                            <span id="adult-count" class="font-semibold text-gray-700 text-center w-6">2</span>
                            <button class="increment-adult bg-gray-200 w-8 h-8 rounded hover:bg-gray-300 focus:outline-none">+</button>
                        </div>
                    </div>
                    <!-- Child Selection -->
                    <div class="flex justify-between items-center mb-2">
                        <span class="font-semibold text-gray-700">เด็ก<br><span class="text-gray-500 text-xs">(อายุ 6-15 ปี)</span></span>
                        <div class="flex items-center space-x-2">
                            <button class="decrement-child bg-gray-200 w-8 h-8 rounded hover:bg-gray-300 focus:outline-none">-</button>
                            <span id="child-count" class="font-semibold text-gray-700 text-center w-6">0</span>
                            <button class="increment-child bg-gray-200 w-8 h-8 rounded hover:bg-gray-300 focus:outline-none">+</button>
                        </div>
                    </div>

                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-700">เด็กเล็ก<br><span class="text-gray-500 text-xs">(อายุ 0- 5 ปี)</span></span>
                        <div class="flex items-center space-x-2">
                            <button
                                class="decrement-child bg-gray-200 w-8 h-8 rounded hover:bg-gray-300 focus:outline-none">-</button>
                            <span id="child-count" class="font-semibold text-gray-700 text-center w-6">0</span>
                            <button
                                class="increment-child bg-gray-200 w-8 h-8 rounded hover:bg-gray-300 focus:outline-none">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-start ml-3">
                <span class="font-semibold text-white mb-1">จำนวนวันเข้าพัก</span>
                <div id="stay-days" class="border border-gray-400 rounded-md px-2 py-1 ml-4 text-white">0 วัน</div>
            </div>

            <div class="mt-4 ml-4">
                <button id="search-button" type="button"
                    class="flex items-center justify-center text-white px-4 py-2 rounded-md hover:bg-blue-500 focus:outline-none focus:bg-blue-600"
                    style="background-color: #0A97B0;" onclick="getAvailableRooms()">
                    ค้นหา
                </button>
            </div>
        </div>
    </section>

    <script>
        // Toggle guest-room popup
        document.getElementById('guest-room-button').addEventListener('click', function() {
            document.getElementById('guest-room-popup').classList.toggle('hidden');
        });

        // Handle increment and decrement for room, adult, and child counts
        document.querySelectorAll('.increment-room, .decrement-room').forEach(button => {
            button.addEventListener('click', function() {
                let roomCount = document.getElementById('number-of-rooms');
                let increment = button.classList.contains('increment-room');
                let currentValue = parseInt(roomCount.innerText);
                roomCount.innerText = increment ? currentValue + 1 : Math.max(1, currentValue - 1);
                updateGuestSummary();
            });
        });

        document.querySelectorAll('.increment-adult, .decrement-adult').forEach(button => {
            button.addEventListener('click', function() {
                let adultCount = document.getElementById('adult-count');
                let increment = button.classList.contains('increment-adult');
                let currentValue = parseInt(adultCount.innerText);
                adultCount.innerText = increment ? currentValue + 1 : Math.max(1, currentValue - 1);
                updateGuestSummary();
            });
        });

        document.querySelectorAll('.increment-child, .decrement-child').forEach(button => {
            button.addEventListener('click', function() {
                let childCount = document.getElementById('child-count');
                let increment = button.classList.contains('increment-child');
                let currentValue = parseInt(childCount.innerText);
                childCount.innerText = increment ? currentValue + 1 : Math.max(0, currentValue - 1);
                updateGuestSummary();
            });
        });

        // Update guest summary text
        function updateGuestSummary() {
            let roomCount = document.getElementById('number-of-rooms').innerText;
            let adultCount = document.getElementById('adult-count').innerText;
            let childCount = document.getElementById('child-count').innerText;
            let guestSummary = `${adultCount} ผู้ใหญ่, ${childCount} เด็ก, ${roomCount} ห้อง`;
            document.getElementById('guest-summary').innerText = guestSummary;
        }
    </script>



    <section id="room-availability" class="container mx-auto mt-12 flex gap-8" style="padding-bottom: 10%; display: none;">
        <div class="grid gap-4" style="height: 400px; width: 600px;">
            <div>
            </div>
            <a data-fancybox="gallery" href="/images/tb1.png">
                <img class="max-w-full rounded-lg border border-gray-300" src="/images/tb1.png" alt="">
            </a>
            <div class="grid grid-cols-5 gap-2">
                <div>
                    <a data-fancybox="gallery" href="/images/S__13500429.jpg">
                        <img class="h-40 object-cover rounded-lg border border-gray-300" src="/images/S__13500429.jpg" alt="">
                    </a>
                </div>
                <div>
                    <a data-fancybox="gallery" href="/images/i-8.png">
                        <img class="h-40 object-cover rounded-lg border border-gray-300" src="/images/i-8.png" alt="">
                    </a>
                </div>
                <div>
                    <a data-fancybox="gallery" href="/images/i-11.png">
                        <img class="h-40 object-cover rounded-lg border border-gray-300" src="/images/i-11.png" alt="">
                    </a>
                </div>
                <div>
                    <a data-fancybox="gallery" href="/images/S__13500428.jpg">
                        <img class="h-40 object-cover rounded-lg border border-gray-300" src="/images/S__13500428.jpg" alt="">
                    </a>
                </div>
                <div>
                    <a data-fancybox="gallery" href="/images/S__13500430.jpg">
                        <img class="h-40 object-cover rounded-lg border border-gray-300" src="/images/S__13500430.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
        <div class="flex-1">
        </div>
    </section>

    <!-- No Availability Section -->
    <section id="no-availability" class="container mx-auto mt-12 flex items-center justify-center" style="display: none;">
        <div class="text-center">
            <h2 class="text-2xl font-semibold text-red-600">ไม่มีห้องว่างในช่วงเวลาที่เลือก</h2>
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
                            <a class="active" href="{{ route('home')}}">
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
        document.addEventListener('DOMContentLoaded', function() {
            var valuestartdate = document.getElementById('startDate');
            var valueenddate = document.getElementById('endDate');
            var totalDay = document.getElementById('totalDay');
            var checkinInput = document.getElementById('checkin_date');
            var checkoutDateInput = document.getElementById('checkout_date');
            var reserveButton = document.getElementById('reserve-button');

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
                        document.getElementById('stay-days').textContent = totalDays + " วัน";
                    }
                }
            });

            window.getAvailableRooms = function() {
                var startDate = document.getElementById('startDate').value;
                var endDate = document.getElementById('endDate').value;
                var adultCount = parseInt(document.getElementById('adult-count').innerText, 10);
                var childCount = parseInt(document.getElementById('child-count').innerText, 10);

                var numberOfRooms = Math.ceil(adultCount / 2);
                var extraBedCount = (adultCount % 2 === 0) ? 0 : 1;

                document.getElementById('number-of-rooms').innerText = numberOfRooms;

                if (startDate && endDate) {
                    fetch(`/check-availability?startDate=${startDate}&endDate=${endDate}&numberOfRooms=${numberOfRooms}&adultCount=${adultCount}&childCount=${childCount}`)
                        .then(response => response.json())
                        .then(data => {
                            var roomAvailabilityDiv = document.querySelector('#room-availability .flex-1');
                            roomAvailabilityDiv.innerHTML = '';

                            var totalRooms = data.availableRooms.length;
                            var extraBedPrice = parseFloat(data.extraBedPrice);
                            var roomPrice = numberOfRooms * 500;
                            var numberOfRoombed = numberOfRooms - 1;
                            var roomPricebed = (numberOfRoombed * 500) + (extraBedCount * extraBedPrice);

                            var roomSummary = `
                    <h3>ห้องพักที่ว่าง</h3>
                    <p class="text-lg">จำนวนห้องที่ว่าง: ${totalRooms} ห้อง</p>
                    <p>จำนวนห้องที่คุณเลือก: ${numberOfRooms} ห้อง</p>
                    <p>ราคา: ${roomPrice} บาท/คืน</p>
                    <p>รายละเอียด: ห้องพัก เตียงนุ่ม อยู่สบาย</p>
                    <p>ฟรี WIFI แอร์เย็นสบาย</p>
                    <p>ประเภทห้อง: เตียงคิงไซต์</p>
                    <a id="reserve-button-normal" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-400 focus:outline-none focus:bg-yellow-600">
                        จองห้องพัก!
                    </a>
                `;

                            // ตรวจสอบเตียงเสริม
                            if (data.extraBedOptions.length > 0) {
                                roomSummary += `
                        <div class="mt-4 border-t border-gray-300 pt-4">
                            <h3>ห้องพักพร้อมเตียงเสริม</h3>
                            <p class="text-lg">จำนวนห้องที่ว่าง: ${totalRooms} ห้อง</p>
                            <p>จำนวนห้องที่คุณเลือก: ${numberOfRoombed} ห้อง</p>
                            <p>ราคา: ${roomPricebed} บาท/คืน</p>
                            <p>เตียงเสริม: ${extraBedCount}</p>
                            <p>รายละเอียด: ห้องพัก เตียงนุ่ม พร้อมเตียงเสริมเพิ่มความสะดวกสบาย</p>
                            <p>ฟรี WIFI แอร์เย็นสบาย</p>
                            <p>ประเภทห้อง: เตียงคิงไซต์</p>
                            <a id="reserve-button-extra" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-400 focus:outline-none focus:bg-blue-600">
                                จองห้องพัก + เตียงเสริม
                            </a>
                        </div>
                    `;
                            }

                            roomAvailabilityDiv.innerHTML = roomSummary;

                            // Set the URLs for the reserve buttons
                            var reserveUrl = `/reserve?checkin_date=${encodeURIComponent(startDate)}&checkout_date=${encodeURIComponent(endDate)}&number_of_rooms=${encodeURIComponent(numberOfRooms)}&extra_bed_count=0&number_of_guests=${encodeURIComponent(adultCount)}&occupancy_child=${encodeURIComponent(childCount)}`;
                            document.getElementById('reserve-button-normal').href = reserveUrl;

                            if (document.getElementById('reserve-button-extra')) {
                                var reserveUrlExtra = `/reserve?checkin_date=${encodeURIComponent(startDate)}&checkout_date=${encodeURIComponent(endDate)}&number_of_rooms=${encodeURIComponent(numberOfRoombed)}&extra_bed_count=${extraBedCount}&number_of_guests=${encodeURIComponent(adultCount)}&occupancy_child=${encodeURIComponent(childCount)}`;
                                document.getElementById('reserve-button-extra').href = reserveUrlExtra;
                            }

                            if (totalRooms < numberOfRooms) {
                                document.getElementById('room-availability').style.display = 'none';
                                document.getElementById('no-availability').style.display = 'flex';
                                document.getElementById('no-availability').innerHTML = `
                        <div class="text-center">
                            <h2 class="text-2xl font-semibold text-red-600">ห้องว่างไม่เพียงพอต่อความต้องการของลูกค้า</h2>
                            <p class="text-lg">จำนวนห้องที่ว่าง: ${totalRooms} ห้อง</p>
                        </div>
                    `;
                            } else {
                                document.getElementById('room-availability').style.display = 'flex';
                                document.getElementById('no-availability').style.display = 'none';
                            }
                        })
                        .catch(error => console.error('Error fetching available rooms:', error));
                }
            }


        });
    </script>



</body>

</html>