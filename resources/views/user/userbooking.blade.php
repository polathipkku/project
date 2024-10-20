<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="dist\output.css">
    <link rel="shortcut icon" href="images/TTbell.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/hero.css">


    <title>Thunthree</title>

    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    {{-- <style>
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
    </style> --}}
</head>

<body class="bg-gray-100">

    <div class="flex items-center justify-between h-5  text-white" style="background-color: #042a48" id="mail">
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

            <div class="mx-auto" id="logo">
                <a href="home" class="">Thunthree</a>
            </div>

            <div class="flex items-center space-x-4">
                @auth
                <nav class="flex items-center space-x-10 text-base">
                    <a href="{{ route('reservation') }}" class="text-black hover:text-blue-400">ประวัติการจอง<i
                            class="fa-solid fa-clock-rotate-left ml-2"></i></a>
                    {{-- <a href="{{ route('review.index') }}" class="text-black hover:text-blue-400">รีวิว<i
                        class="fa-solid fa-star ml-2"></i></a> --}}
                    <div class="relative">
                        <button id="profileButton" type="button"
                            class="text-black hover:text-blue-400 focus:outline-none">
                            <i class="fa-solid fa-user"></i>
                            <span class="sr-only">User Menu</span>
                        </button>
                        <div id="profileDropdown"
                            class="absolute hidden right-0 mt-2 w-24 bg-white rounded-md shadow-lg">
                            <div class="py-1">
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Profile</a>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Settings</a>
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Logout</a>
                            </div>
                        </div>
                        <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </nav>
                @endauth

                <div class="flex flex-col items-end space-y-2 mb-4">
                    <nav class="flex items-center space-x-2">
                        @guest
                        <a href="#" onclick="showLoginForm()"
                            class="flex items-center space-x-1 hover:text-blue-400 text-sm">
                            <i class="fa-solid fa-right-to-bracket"></i>
                            <span>เข้าสู่ระบบ</span>
                        </a>
                        <a href="#" onclick="showRegisterForm()"
                            class="flex items-center space-x-1 hover:text-blue-400 text-sm">
                            <i class="fa-solid fa-user"></i>
                            <span>สมัครสมาชิก</span>
                        </a>
                        @endguest
                    </nav>
                    <a class="bg-blue-500 text-white px-8 py-3 border border-blue-500 rounded hover:bg-white hover:border-blue-500 hover:text-blue-500 text-sm w-full text-center transition duration-300 ease-in-out"
                        href="{{ route('userbooking') }}" id="userbooking">
                        เช็คห้องว่าง
                    </a>

                </div>
            </div>
        </div>
    </header>
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
                    <input type="text" id="checkin_date" class="border border-gray-400 rounded-md px-2 py-1 pr-10" readonly>
                    <i class="fa-regular fa-calendar absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none"></i>
                </div>
                <input type="hidden" id="startDate" name="startDate">
            </div>
            <div class="flex flex-col items-start mr-4">
                <span class="font-semibold text-white mb-1">Check-out</span>
                <div class="relative">
                    <input type="text" id="checkout_date" class="border border-gray-400 rounded-md px-2 py-1 pr-10" readonly>
                    <i class="fa-regular fa-calendar absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-500 pointer-events-none"></i>
                </div>
                <input type="hidden" id="endDate" name="endDate">
                <input type="hidden" id="totalDay" name="totalDay">
            </div>

            <!-- Dropdown for Room, Adults, and Children -->
            <div class="relative">
                <div class="flex flex-col items-start">
                    <span class="font-semibold text-white mb-1">จำนวนห้องและผู้เข้าพัก</span>
                    <button id="guest-room-button"
                        class="flex items-center bg-white px-4 py-2 rounded-md hover:bg-gray-200 focus:outline-none">
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
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-700">เด็ก<br><span
                                class="text-gray-500 text-xs">(อายุ6-15 ปี)</span></span>
                        <div class="flex items-center space-x-2">
                            <button
                                class="decrement-child bg-gray-200 w-8 h-8 rounded hover:bg-gray-300 focus:outline-none">-</button>
                            <span id="child-count" class="font-semibold text-gray-700 text-center w-6">0</span>
                            <button
                                class="increment-child bg-gray-200 w-8 h-8 rounded hover:bg-gray-300 focus:outline-none">+</button>
                        </div>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-700">เด็กเล็ก<br><span
                                class="text-gray-500 text-xs">(อายุ 0- 5 ปี)</span></span>
                        <div class="flex items-center space-x-2">
                            <button
                                class="decrement-baby bg-gray-200 w-8 h-8 rounded hover:bg-gray-300 focus:outline-none">-</button>
                            <span id="baby-count" class="font-semibold text-gray-700 text-center w-6">0</span>
                            <button
                                class="increment-baby bg-gray-200 w-8 h-8 rounded hover:bg-gray-300 focus:outline-none">+</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col items-start ml-3">
                <span class="font-semibold text-white mb-1">จำนวนวันเข้าพัก</span>
                <div id="stay-days" class="border border-gray-400 rounded-md px-2 py-1 ml-4 text-white">1 วัน</div>
            </div>

            <div class="mt-4 ml-4">
                <button id="search-button" type="button"
                    class="flex items-center justify-center  bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-800"
                    onclick="getAvailableRooms()">
                    ค้นหา
                </button>
            </div>
        </div>
    </section>

    <script>
        // Set default dates to today and tomorrow
        document.addEventListener('DOMContentLoaded', () => {
            let today = new Date();
            let tomorrow = new Date(today);
            tomorrow.setDate(today.getDate() + 1);

            let formatDate = date => {
                return date.toISOString().split('T')[0];
            };

            let todayFormatted = formatDate(today);
            let tomorrowFormatted = formatDate(tomorrow);

            document.getElementById('checkin_date').value = todayFormatted;
            document.getElementById('checkout_date').value = tomorrowFormatted;
            document.getElementById('startDate').value = todayFormatted;
            document.getElementById('endDate').value = tomorrowFormatted;

            getAvailableRooms();
        });
        document.getElementById('guest-room-button').addEventListener('click', function() {
            document.getElementById('guest-room-popup').classList.toggle('hidden');
        });

        // Handle increment and decrement for room, adult, child, and baby counts
        function setupIncrementDecrement(incrementSelector, decrementSelector, countElementId, minCount, updateFunction) {
            document.querySelector(incrementSelector).addEventListener('click', function() {
                let countElement = document.getElementById(countElementId);
                let currentValue = parseInt(countElement.innerText);
                countElement.innerText = currentValue + 1;
                updateFunction();
            });

            document.querySelector(decrementSelector).addEventListener('click', function() {
                let countElement = document.getElementById(countElementId);
                let currentValue = parseInt(countElement.innerText);
                countElement.innerText = Math.max(minCount, currentValue - 1);
                updateFunction();
            });
        }

        setupIncrementDecrement('.increment-room', '.decrement-room', 'number-of-rooms', 1, updateGuestSummary);
        setupIncrementDecrement('.increment-adult', '.decrement-adult', 'adult-count', 1, updateGuestSummary);
        setupIncrementDecrement('.increment-child', '.decrement-child', 'child-count', 0, updateGuestSummary);
        setupIncrementDecrement('.increment-baby', '.decrement-baby', 'baby-count', 0, updateGuestSummary);


        // Update guest summary text
        function updateGuestSummary() {
            let roomCount = document.getElementById('number-of-rooms').innerText;
            let adultCount = document.getElementById('adult-count').innerText;
            let childCount = document.getElementById('child-count').innerText;
            let babyCount = document.getElementById('baby-count').innerText;
            let summaryText = `${adultCount} ผู้ใหญ่, ${childCount} เด็ก, ${babyCount} เด็กเล็ก, ${roomCount} ห้อง`;

            if (parseInt(childCount) === 0 && parseInt(babyCount) === 0) {
                summaryText = `${adultCount} ผู้ใหญ่, ${roomCount} ห้อง`;
            } else if (parseInt(babyCount) === 0) {
                summaryText = `${adultCount} ผู้ใหญ่, ${childCount} เด็ก, ${roomCount} ห้อง`;
            }

            document.getElementById('guest-summary').innerText = summaryText;
        }

        // Calculate stay days
        function calculateStayDays() {
            let checkinDate = new Date(document.getElementById('startDate').value);
            let checkoutDate = new Date(document.getElementById('endDate').value);
            let diffTime = checkoutDate - checkinDate;
            let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            document.getElementById('totalDay').value = diffDays;
            document.getElementById('stay-days').innerText = `${diffDays} วัน`;
        }

        // Function to fetch available rooms
        function getAvailableRooms() {
            calculateStayDays();
            let checkinDate = document.getElementById('startDate').value;
            let checkoutDate = document.getElementById('endDate').value;
            let numberOfRooms = document.getElementById('number-of-rooms').innerText;
            let adultCount = document.getElementById('adult-count').innerText;
            let childCount = document.getElementById('child-count').innerText;

            fetch('/search-rooms', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        checkin_date: checkinDate,
                        checkout_date: checkoutDate,
                        number_of_rooms: numberOfRooms,
                        adult_count: adultCount,
                        child_count: childCount
                    })
                })
                .then(response => response.json())
                .then(data => {
                    // Handle response data
                    console.log(data);
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

    <section id="room-availability" class="mt-12 gap-8 mx-auto"
        style="padding-bottom: 10%; background-color: white; border: 1px solid #ddd; max-width: 1300px; height: 500px;">
        <div class="w-full text-white py-2" style="background-color: #04233B; margin: -1px;">
            <!-- Added margin to counteract border -->
            <h2 class="text-xl font-semibold ml-2">Thunthree Room</h2>
        </div>
        <div class="grid grid-cols-12 gap-4 mt-1 p-4"> <!-- Use grid-cols-12 to define 12 columns -->
            <!-- Image Section: Occupying 5/12 of the space -->
            <div class="col-span-5">
                <div id="default-carousel" class="relative w-full" data-carousel="slide">
                    <div class="relative h-60 overflow-hidden">
                        <!-- Item 1 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="/images/S__13500429.jpg" class="absolute block w-full h-full object-cover"
                                alt="...">
                        </div>
                        <!-- Item 2 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="/images/i-8.png" class="absolute block w-full h-full object-cover"
                                alt="...">
                        </div>
                        <!-- Item 3 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="/images/i-11.png" class="absolute block w-full h-full object-cover"
                                alt="...">
                        </div>
                        <!-- Item 4 -->
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="/images/S__13500428.jpg" class="absolute block w-full h-full object-cover"
                                alt="...">
                        </div>
                    </div>
                    <!-- Slider indicators -->
                    <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false"
                            aria-label="Slide 2" data-carousel-slide-to="1"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false"
                            aria-label="Slide 3" data-carousel-slide-to="2"></button>
                        <button type="button" class="w-3 h-3 rounded-full" aria-current="false"
                            aria-label="Slide 4" data-carousel-slide-to="3"></button>
                    </div>
                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
                <div class="text-gray-700 flex flex-col items-center justify-center mt-2">
                    <span class="flex items-center space-x-2 text-sm text-align: center">
                        <span>ภาพถ่าย</span>
                    </span>
                </div>
                <div class="border-t-2 border-gray-300 mt-2"></div>
                <div class="text-gray-700 flex flex-col items-start space-y-2 mt-2"
                    style="max-width: 100%; padding: 1rem;">
                    <span class="flex items-center space-x-2 text-sm">
                        <i class="fas fa-wifi text-black"></i>
                        <span>ฟรี WiFi</span>
                    </span>
                    <span class="flex items-center space-x-2 text-sm">
                        <i class="fas fa-bed text-black"></i>
                        <span>เตียงคิงไซต์</span>
                    </span>
                    <span class="flex items-center space-x-2 text-sm">
                        <i class="fas fa-users text-black"></i>
                        <span>จำนวนสูงสุด ผู้ใหญ่ 2 คน</span>
                    </span>
                </div>
            </div>

            <div class="col-span-4 ml-10 ">
                <h4 class="text-lg font-semibold">นโยบายการเข้าพัก</h4>
                <p>เช็คอิน: <span class="font-semibold">13:00</span> | เช็คเอาท์: <span
                        class="font-semibold">12:00</span></p>
                <ul class="list-disc pl-4 space-y-2 text-gray-700">
                    <li style="white-space: nowrap;">เช็คเอ้าท์หลัง 12.00 น. คิดชั่วโมงละ 500 บาท</li>
                    <li style="white-space: nowrap;">ห้ามนำบุคคลภายนอกเข้าพัก (ปรับ 2000 บาท)</li>
                    <li style="white-space: nowrap;">ห้องพักปลอดบุหรี่ (ปรับ 2000 บาท)</li>
                    <li style="white-space: nowrap;">ไม่อนุญาตสัตว์เลี้ยง (ปรับ 2000 บาท)</li>
                    <li style="white-space: nowrap;">งดใช้เสียงดังหลัง 22.00 น.</li>
                    <li style="white-space: nowrap;">ไม่อนุญาตให้ประกอบอาหารในที่พัก</li>
                    <li style="white-space: nowrap;">ทางรีสอร์ทไม่รับผิดชอบทรัพย์สินที่สูญหาย</li>
                    <li style="white-space: nowrap;">ชำระค่าปรับสำหรับทรัพย์สินของรีสอร์ทที่เสียหาย</li>
                    <li style="white-space: nowrap;">ไม่สามารถยกเลิก แก้ไข หรือเปลี่ยนแปลงวันเข้าพักได้</li>
                </ul>
            </div>

            <div id="flex-1" class="flex-1 flex items-center mb-36"></div>
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

    <x-footer />

    <script src="/js/hero.js"></script>


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
            window.onload = function() {
                // ตรวจสอบว่ามีค่า startDate และ endDate หรือไม่
                var startDate = document.getElementById('startDate').value;
                var endDate = document.getElementById('endDate').value;

                if (startDate && endDate) {
                    getAvailableRooms();
                }
            };
            window.getAvailableRooms = function() {
                var startDate = document.getElementById('startDate').value;
                var endDate = document.getElementById('endDate').value;
                var adultCount = parseInt(document.getElementById('adult-count').innerText, 10);
                var childCount = parseInt(document.getElementById('child-count').innerText, 10);
                var babyCount = parseInt(document.getElementById('baby-count').innerText, 10);
                var numberOfRooms = parseInt(document.getElementById('number-of-rooms').innerText, 10);

                if (startDate && endDate) {
                    fetch(`/check-availability?startDate=${startDate}&endDate=${endDate}&adultCount=${adultCount}&childCount=${childCount}&babyCount=${babyCount}&numberOfRooms=${numberOfRooms}`)
                        .then(response => response.json())
                        .then(data => {
                            var roomAvailabilityDiv = document.querySelector('#room-availability .flex-1');
                            roomAvailabilityDiv.innerHTML = '';

                            var totalRooms = data.availableRooms.length;
                            var extraBedPrice = parseFloat(data.extraBedPrice);
                            var availableExtraBeds = data.availableExtraBeds;

                            var roomOptionsContainer = document.createElement('div');
                            roomOptionsContainer.className = 'flex flex-col items-center gap-4';

                            // Create room options
                            data.roomOptions.forEach((option, index) => {
                                if (option.type === 'with_extra_bed' && availableExtraBeds <= 0) {
                                    return; // Skip this option if no extra beds are available
                                }
                                var roomCard = createRoomCard(option, data, startDate, endDate, childCount, babyCount, index + 1);
                                roomOptionsContainer.appendChild(roomCard);
                            });

                            roomAvailabilityDiv.appendChild(roomOptionsContainer);

                            // Display no availability message if needed
                            if (totalRooms === 0 || (data.roomOptions.length > 0 && totalRooms < data.roomOptions[0].rooms)) {
                                document.getElementById('room-availability').style.display = 'none';
                                document.getElementById('no-availability').style.display = 'flex';
                                document.getElementById('no-availability').innerHTML = `
                        <div class="text-center">
                            <h2 class="text-2xl font-semibold text-red-600">ห้องว่างไม่เพียงพอต่อความต้องการของลูกค้า</h2>
                        </div>
                    `;
                            } else {
                                document.getElementById('room-availability').style.display = '';
                                document.getElementById('no-availability').style.display = 'none';
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching available rooms:', error);
                        });
                }
            };

            function createRoomCard(option, data, startDate, endDate, childCount, babyCount, optionNumber) {
                var card = document.createElement('div');
                card.className = 'w-44 text-center shadow-lg hover:shadow-xl flex flex-col justify-between transition duration-300';

                card.style.height = '150px';
                card.style.width = '300px';
                card.style.backgroundColor = '#f3f4f6';
                card.style.marginTop = '10px';

                var content = `
    <div class="flex-grow">
        <div class="w-full font-semibold py-1 text-white" style="background-color: #04233B; font-size: 16px;">
            ตัวเลือกที่${optionNumber}
        </div>
        <div class="mt-3">
            <h3 class="text-m font-bold">จำนวนห้องพัก <span class="font-semibold">${option.rooms}</span> ห้องพัก</h3>
            ${option.extraBeds > 0 ? `<h3 class="text-sm font-bold">จำนวนเตียงเสริม: <span class="font-semibold">${option.extraBeds}</span> เตียงเสริม</h3>` : ''}
            <p class="text-sm">ราคารวม: <span class="font-semibold">${option.price} บาท</span></p>
        </div>
    </div>
    <div class="flex justify-center mt-2">
        <a id="reserve-button-${option.type}" 
           href="#" 
           class="inline-block bg-blue-500 text-white font-semibold rounded-lg border-2 border-blue-500 hover:bg-blue-600 hover:text-black hover:border-blue-500 transition-colors text-xs w-24 py-1 mb-2">           
           เลือก
        </a>
    </div>
    `;

                card.innerHTML = content;
                var adultCount = parseInt(document.getElementById('adult-count').textContent, 10);
                var childCount = parseInt(document.getElementById('child-count').textContent, 10);
                var babyCount = parseInt(document.getElementById('baby-count').textContent, 10);
                var reserveUrl = `/reserve?checkin_date=${encodeURIComponent(startDate)}&checkout_date=${encodeURIComponent(endDate)}&number_of_rooms=${encodeURIComponent(option.rooms)}&extra_bed_count=${option.extraBeds}&number_of_guests=${encodeURIComponent(data.equivalentAdultCount)}&occupancy_child=${encodeURIComponent(childCount)}&occupancy_baby=${encodeURIComponent(babyCount)}`;
                card.querySelector(`#reserve-button-${option.type}`).href = reserveUrl;

                return card;
            }
        });
    </script>
    <script>
        function getAvailableRooms() {
            // Get the values from the form fields
            const checkinDate = document.getElementById('checkin_date').value;
            const checkoutDate = document.getElementById('checkout_date').value;
            const numberOfRooms = document.getElementById('number-of-rooms').innerText;
            const adultCount = document.getElementById('adult-count').innerText;
            const childCount = document.getElementById('child-count').innerText;
            const babyCount = document.getElementById('baby-count').innerText;

            // Update the summary display
            document.getElementById('summary-dates').innerText = `Check-in: ${checkinDate}, Check-out: ${checkoutDate}`;
            document.getElementById('summary-guest-room').innerText = `จำนวนห้อง: ${numberOfRooms}, ผู้ใหญ่: ${adultCount} คน, เด็ก: ${childCount} คน, เด็กเล็ก: ${babyCount} คน`;

            // Perform room availability search logic (not implemented here)
        }
    </script>
</body>

</html>