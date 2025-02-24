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
    <link href="src/output.css" rel="stylesheet">
    <title>Thunthree</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>


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

    {{-- <div id="backdrop"
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
                <input type="number" id="rooms" name="rooms" class="w-full border p-2 rounded"
                    min="1">
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
    </script> --}}

    <main class="container w-full  ">
        <div class="relative" id="card-1">
            <img src="/images/i-6.jpeg" alt="Hotel" class="cropped-image w-full object-cover rounded-lg"
                id="card-1-img">
            <div class="absolute bottom-0 left-0 bg-black bg-opacity-50 p-5 text-white rounded-br-lg">
                <h1 class="text-4xl font-bold">ยินดีต้อนรับสู่โรงแรมของเรา</h1>
                <p class="text-xl">สัมผัสธรรมชาติและความสะดวกสบาย</p>
            </div>
            <div class='flex justify-center ' style="margin-top:24% ;">
                <i class="fa-solid fa-angles-down fa-bounce" style="color: #ffffff; font-size: 2em;"></i>
            </div>
        </div>

        <div class="room-data mt-12 mb-24">
            <div class="container flex flex-col text-center mb-12">
                <h1 class="text-xl">Thunthree</h1>
                <p class="text-4xl">ห้องพัก</p>
            </div>
            <div class="flex justify-center">
                <div class="w-1/4">
                    <div class="grid grid-cols-2 gap-2">
                        <div class="col-span-1">
                            <a data-fancybox="gallery" data-src="images/i-8.png">
                                <img alt=""
                                    style="width: 100%; height: 150px; background-image: url('images/i-8.png'); background-position: center; background-size: cover;" />
                            </a>
                        </div>
                        <div class="col-span-1">
                            <a data-fancybox="gallery" data-src="images/i-9.png">
                                <img alt=""
                                    style="width: 100%; height: 150px; background-image: url('images/i-9.png'); background-position: center; background-size: cover;" />
                            </a>
                        </div>
                        <div class="col-span-2">
                            <a data-fancybox="gallery" data-src="images/i-10.png">
                                <div
                                    style="width: 100%; height: 150px; background-image: url('images/i-10.png'); background-position: center; background-size: cover;">
                                </div>
                            </a>
                        </div>
                        <div class="col-span-1">
                            <a data-fancybox="gallery" data-src="images/i-11.png">
                                <img alt=""
                                    style="width: 100%; height: 150px; background-image: url('images/i-11.png'); background-position: center; background-size: cover;" />
                            </a>
                        </div>
                        <div class="col-span-1">
                            <a data-fancybox="gallery" data-src="images/S__13500426.jpg">
                                <img alt=""
                                    style="width: 100%; height: 150px; background-image: url('images/S__13500426.jpg'); background-position: center; background-size: cover;" />
                            </a>
                        </div>
                    </div>
                </div>
                <div class="w-1/2 pl-4">
                    <div class="room-description">
                        <p class="mt-2 text-gray-700 text-lg">
                            ห้องพักสะดวกสบายเตียงนุ่ม ห้องกว้างน่าอยู่ สภาพบรรยากาศเต็มไปด้วยธรรมชาติ
                            เรามีทุกอย่างที่จำเป็นและพร้อมให้บริการเพื่อการผ่อนคลายที่สมบูรณ์แบบ
                            วันที่อยากผ่อนก็ได้พักผ่อนได้เต็มที่
                        </p>
                        <p class="mt-4 text-gray-700 text-lg">
                            เพลิดเพลินกับสิ่งอำนวยความสะดวกมากมายที่เตรียมไว้สำหรับคุณ เช่น อินเตอร์เน็ตไร้สาย,
                            เครื่องปรับอากาศ, โทรทัศน์จอแบน, ตู้เย็น, และห้องน้ำส่วนตัว
                            นอกจากนี้ยังมีพื้นที่ส่วนกลางสำหรับการพักผ่อนหย่อนใจ เช่น
                            สวนสวยและลานระเบียงให้คุณได้สัมผัสกับธรรมชาติ
                        </p>
                        {{-- <p class="mt-4 text-gray-700">
                            ไม่ว่าคุณจะมาเยือนเพียงระยะสั้นหรือพักผ่อนยาว ห้องพักของเราพร้อมต้อนรับคุณด้วยความอบอุ่นและบริการที่ยอดเยี่ยม
                            ให้คุณได้สัมผัสกับความผ่อนคลายและความสะดวกสบายตลอดการเข้าพัก
                        </p> --}}
                    </div>
                    <div class="room-info mt-4 text-gray-700">
                        <div class="flex flex-wrap justify-center gap-6">
                            <div class="flex flex-col items-center">
                                <i class="fa-solid fa-wifi text-3xl mb-2"></i>
                                <p>ฟรี Wi-Fi</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <i class="fa-solid fa-wind text-3xl mb-2"></i>
                                <p>เครื่องปรับอากาศ</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <i class="fa-solid fa-tv text-3xl mb-2"></i>
                                <p>โทรทัศน์จอแบน</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <i class="fa-solid fa-square text-3xl mb-2"></i>
                                <p>ตู้เย็น</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <i class="fa-solid fa-bath text-3xl mb-2"></i>
                                <p>ห้องน้ำส่วนตัว</p>
                            </div>
                        </div>
                    </div>
                    <div class="checkin-checkout mt-4 text-gray-700">
                        <p><strong>เวลาเช็คอิน:</strong> 14:00 น.</p>
                        <p><strong>เวลาเช็คเอาท์:</strong> 12:00 น.</p>
                    </div>
                    <div class="text-center mt-8 ">
                        <a id="reserve-button" href="{{ route('userbooking') }}"
                            class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-700 text-center inline-block">
                            เช็คห้องว่าง
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <style>
            @media (min-width: 1024px) {
                .swiper-slide:nth-child(4) {
                    opacity: 0;
                    pointer-events: none;
                }
            }
        </style>

        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <section class="my-16">
                <h2 class="text-4xl font-bold mb-10 text-center text-gray-800">โปรโมชั่นพิเศษ</h2>
                <div class="flex justify-center">
                    <div class="w-full max-w-6xl">
                        @if ($promotions->isEmpty())
                            <!-- No promotions available message -->
                            <p class="text-xl text-gray-500 text-center">ขณะนี้ยังไม่มีโปรโมชั่น</p>
                        @else
                            <div class="swiper-container">
                                <div class="swiper-wrapper">
                                    @foreach ($promotions as $promotion)
                                        <div class="swiper-slide">
                                            <div
                                                class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300 h-full">
                                                <div class="flex justify-center mb-4">
                                                    <i class="fa-solid fa-gift text-5xl text-blue-500"></i>
                                                </div>
                                                <h3 class="text-2xl font-bold mb-3 text-gray-800">
                                                    {{ $promotion->campaign_name }}
                                                </h3>

                                                <!-- Display discount information -->
                                                <p class="text-lg mb-2">
                                                    <span class="font-semibold">ส่วนลด:</span>
                                                    <span class="text-blue-500 font-bold">
                                                        @if ($promotion->type === 'percentage')
                                                            {{ $promotion->discount_value }}%
                                                        @else
                                                            {{ $promotion->discount_value }} ฿
                                                        @endif
                                                    </span>
                                                </p>

                                                <!-- Display minimum conditions, if available -->
                                                <div class="text-gray-600 mb-4">
                                                    @if ($promotion->minimum_nights || $promotion->minimum_booking_amount)
                                                        @if ($promotion->minimum_nights)
                                                            <p>เงื่อนไข: เข้าพักขั้นต่ำ {{ $promotion->minimum_nights }}
                                                                คืน</p>
                                                        @endif

                                                        @if ($promotion->minimum_booking_amount)
                                                            <p>ยอดจองขั้นต่ำ {{ $promotion->minimum_booking_amount }}
                                                                บาท</p>
                                                        @endif
                                                    @else
                                                        <p>เงื่อนไข: เข้าพักขั้นต่ำ ไม่มี</p>
                                                        <p>ยอดจองขั้นต่ำ: ไม่มี</p>
                                                    @endif
                                                </div>

                                                <!-- Display promo code -->
                                                @if ($promotion->promo_code)
                                                    <p class="mb-3">ใช้รหัสโปรโมชั่น: <strong
                                                            class="text-blue-500">{{ $promotion->promo_code }}</strong>
                                                    </p>
                                                    <button onclick="copyToClipboard('{{ $promotion->promo_code }}')"
                                                        class="w-full bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                                        คัดลอกโค้ด
                                                    </button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>

        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Swiper('.swiper-container', {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    centeredSlides: <?= $promotions->count() === 1 ? 'true' : 'false' ?>,
                    loop: <?= $promotions->count() > 3 ? 'true' : 'false' ?>,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    breakpoints: {
                        640: {
                            slidesPerView: 2,
                        },
                        1024: {
                            slidesPerView: 3,
                        },
                    },
                });
            });

            function copyToClipboard(text) {
                navigator.clipboard.writeText(text).then(function() {
                    alert('โค้ดโปรโมชั่นถูกคัดลอกแล้ว!');
                }, function() {
                    alert('เกิดข้อผิดพลาดในการคัดลอกโค้ด');
                });
            }
        </script>





        <div class="flex flex-col gap-10 mt-10" id="card-2">

            <section class="flex flex-col lg:flex-row items-center gap-5 p-5 px-24">
                <div class="flex-grow mb-5 lg:mb-0">
                    <h2 class="text-3xl font-bold mb-3">บรรยากาศ</h2>
                    <p class="text-lg mb-5">
                        รีสอร์ทของเราตั้งอยู่ท่ามกลางธรรมชาติอันอุดมสมบูรณ์ คุณจะได้สัมผัสกับอากาศบริสุทธิ์
                        วิวทิวทัศน์ที่สวยงาม และกิจกรรมต่างๆ มากมายที่จะสร้างความสนุกสนานและผ่อนคลายให้กับคุณ
                    </p>
                </div>
                <div class="w-full lg:w-1/3 h-auto flex-shrink-0">
                    <a data-fancybox="gallery_2" href="/images/tb1.png">
                        <img src="/images/tb1.png" alt="บรรยากาศ"
                            class="w-full h-full object-cover rounded-lg shadow-md">
                    </a>
                </div>
            </section>

            <section class="flex flex-col lg:flex-row items-center gap-5 p-5 px-24">
                <div class="w-full lg:w-1/3 h-auto flex-shrink-0">
                    <a data-fancybox="gallery_3" href="/images/S__13500429.jpg">
                        <img src="/images/S__13500429.jpg" alt="สิ่งอำนวยความสะดวก"
                            class="w-full h-full object-cover rounded-lg shadow-md">
                    </a>
                </div>
                <div class="flex-grow mb-5 lg:mb-0">
                    <h2 class="text-3xl font-bold mb-3">สิ่งอำนวยความสะดวก</h2>
                    <p class="text-lg mb-5">
                        เพลิดเพลินกับบริการและสิ่งอำนวยความสะดวกต่างๆ
                        ที่จะทำให้การเข้าพักของคุณผ่อนคลายและน่าจดจำ
                    </p>
                </div>
            </section>

            <section class="flex flex-col lg:flex-row items-center gap-5 p-5 px-24">
                <div class="flex-grow mb-5 lg:mb-0">
                    <h2 class="text-3xl font-bold mb-3">แหล่งท่องเที่ยวใกล้เคียง</h2>
                    <p class="text-lg mb-5">
                        รีสอร์ทของเราตั้งอยู่ใกล้กับแหล่งท่องเที่ยวที่น่าสนใจมากมาย เช่น
                        ห้างสรรพสินค้า สวนสาธารณะ และสถานที่ท่องเที่ยวทางวัฒนธรรม
                    </p>
                </div>
                <div class="w-full lg:w-1/3 h-auto flex-shrink-0">
                    <a data-fancybox="gallery_1" href="/images/t-1.jpg">
                        <img src="/images/t-1.jpg" alt="แหล่งท่องเที่ยว"
                            class="w-full h-full object-cover rounded-lg shadow-md">
                    </a>
                    <a data-fancybox="gallery_1" href="/images/t-2.jpg"></a>
                </div>
            </section>


        </div>


        <div class="bg-white mt-8 max-xl:px-8">
            <div class="max-w-screen-xl mx-auto py-10">
                <h3 class="text-5xl">จองห้องกับเรา</h3>
                <p class="text-ml my-5 text-black">CHECK-IN 14.00 น | CHECK-OUT 12.00 น </p>
                <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 justify-items-center my-10 max-md:flex-col">
                    <div
                        class="flex flex-col justify-center items-center max-md:py-3 transition-transform transform hover:scale-110">
                        <i class="fa-solid fa-wifi text-4xl text-green-500"></i>
                        <p class="text-2xl font-bold my-3">ฟรี WIFI</p>
                        <p class="text-xl">มีให้ในห้อง</p>
                    </div>
                    <div
                        class="flex flex-col justify-center items-center max-md:py-3 transition-transform transform hover:scale-110">
                        <i class="fa-solid fa-bell-concierge text-4xl text-yellow-500"></i>
                        <p class="text-2xl font-bold my-3">บริการดีเยี่ยม</p>
                        <p class="text-xl">มีพนักงานคอยให้บริการ</p>
                    </div>
                    <div
                        class="flex flex-col justify-center items-center max-md:py-3 transition-transform transform hover:scale-110">
                        <i class="fa-solid fa-road text-4xl text-blue-400"></i>
                        <p class="text-2xl font-bold my-3">สะดวกสบาย</p>
                        <p class="text-xl">อยู่ติดถนนใกล้ห้างสรรพสินค้า</p>
                    </div>
                    <div
                        class="flex flex-col justify-center items-center max-md:py-3 transition-transform transform hover:scale-110">
                        <i class="fas fa-check-circle text-4xl text-green-500"></i>
                        <p class="text-2xl font-bold my-3">จองได้ทุกที่</p>
                        <p class="text-xl">จองได้ทุกที่ ทุกเวลา</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex flex-col items-center" id="map">
            <div class="text-center mb-5">
                <h1 class="text-2xl font-normal">Location</h1>
                <p class="text-5xl font-normal">WHERE YOU NEED TO BE</p>
            </div>
            <div class="container flex flex-col md:flex-row justify-between items-start h-full">
                <div class="map-left w-full md:w-2/3 h-450 mb-5 md:mb-0">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3824.6264764287885!2d104.0397957767188!3d16.54494445360664!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313d1106b2de224b%3A0xa0b6a2d9170250bf!2z4LiY4Lix4LiZ4Lii4LmM4LiX4Lij4Li14Lij4Li14Liq4Lit4Lij4LmM4LiX!5e0!3m2!1sth!2sth!4v1722168540885!5m2!1sth!2sth"
                        width="100%" height="420" class="border border-gray-300 rounded-lg" allowfullscreen=""
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div
                    class="map-right w-full md:w-1/3 flex flex-col items-start p-10 bg-white rounded-lg shadow-md h-450">
                    <h2 class="text-xl font-bold mb-3">ธันย์ทรีรีสอร์ท</h2>
                    <p class="mb-3">ธันย์ทรีรีสอร์ท 86 หมู่15 ถนนสมเด็จ – มุกดาหาร ต.บัวขาว อ, อำเภอ กุฉินารายณ์
                        กาฬสินธุ์ 46110</p>
                    <p class="mb-3">GPS: 16.54525038459086, 104.03995924942295</p>
                    <a href="https://maps.app.goo.gl/TGK3RtsQrBcicC3R6" target="_blank"
                        class="text-blue-500 underline mb-5"> Google Map</a>
                    <h3 class="text-lg font-bold mb-2">สถานที่ใกล้เคียง</h3>
                    <ul class="list-disc pl-5">
                        <li class="mb-2">โลตัส กุฉินารายณ์</li>
                        <li class="mb-2">โกลบอลเฮ้าส์ กุฉินารายณ์</li>
                        <li class="mb-2">โฮมช็อป</li>
                        <li>อ่างเลิงซิว</li>
                    </ul>
                </div>
            </div>
        </div>
    </main>



    <x-footer />



    <div id="loginForm" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 hidden">
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md relative">
            <div class="absolute top-0 right-0 mt-4 mr-4 z-10">
                <button onclick="hideLoginForm()" class="focus:outline-none">
                    <img src="images/reject.png" alt="Reject" class="w-6 h-6">
                </button>
            </div>
            <h2 class="text-3xl font-bold mb-6 text-center">Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <input id="email"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        type="email" name="email" :value="old('email')" placeholder="Email" required
                        autofocus />
                </div>
                <div class="mb-4">
                    <input id="password"
                        class="block w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500"
                        type="password" name="password" placeholder="Password" required
                        autocomplete="current-password" />
                </div>
                <div class="flex items-center mb-6">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="h-4 w-4 text-blue-600 rounded focus:ring-blue-500 border-gray-300" />
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
                    <a href="{{ route('password.request') }}"
                        class="ml-auto text-sm text-blue-600 hover:text-blue-800">Forgot password</a>
                </div>
                <button type="submit"
                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full">Login</button>
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">Don't have an account? <a href="#"
                            class="text-blue-600 hover:text-blue-800" onclick="showRegisterForm()">Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <div id="registerForm"
        class="fixed inset-0 bg-gray-900 bg-opacity-50 flex justify-center items-center z-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm relative">
            <div class="absolute top-2 right-2">
                <button onclick="hideRegisterForm()" class="focus:outline-none">
                    <img src="images/reject.png" alt="Reject" class="w-4 h-4">
                </button>
            </div>
            <h2 class="text-2xl font-bold mb-4 text-center">Register</h2>
            <form class="space-y-4" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf


                <div class="relative">
                    <label for="name"
                        class="text-sm text-gray-600 absolute top-0 left-2 px-1 bg-white">Name</label>
                    <input id="name" name="name" type="text" autocomplete="name" required
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 mt-4">
                </div>
                <div class="relative">
                    <label for="email"
                        class="text-sm text-gray-600 absolute top-0 left-2 px-1 bg-white">Email</label>
                    <input id="email" name="email" type="email" autocomplete="email" required
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 mt-4"
                        :value="old('email')">
                </div>


                <div class="grid grid-cols-2 gap-4">
                    <div class="relative">
                        <label for="password"
                            class="text-sm text-gray-600 absolute top-0 left-2 px-1 bg-white">Password</label>
                        <input id="password" name="password" type="password" autocomplete="new-password" required
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 mt-4">
                    </div>
                    <div class="relative">
                        <label for="password_confirmation"
                            class="text-sm text-gray-600 absolute top-0 left-2 px-1 bg-white">Confirm Password</label>
                        <input id="password_confirmation" name="password_confirmation" type="password"
                            autocomplete="new-password" required
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 mt-4">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="relative">
                        <label for="tel"
                            class="text-sm text-gray-600 absolute top-0 left-2 px-1 bg-white">Telephone</label>
                        <input id="tel" name="tel" type="tel" autocomplete="tel" required
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 mt-4">
                    </div>
                    <div class="relative">
                        <label for="birthday"
                            class="text-sm text-gray-600 absolute top-0 left-2 px-1 bg-white">Birthday</label>
                        <input id="birthday" name="birthday" type="date" required
                            class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 mt-4"
                            onchange="formatDate(this)">

                    </div>
                </div>

                {{-- <div class="relative">
                    <label for="address"
                        class="text-sm text-gray-600 absolute top-0 left-2 px-1 bg-white">Address</label>
                    <input id="address" name="address" type="text"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 mt-4">
                </div> --}}

                <div class="relative">
                    <label for="image" class="text-sm text-gray-600 absolute top-0 left-2 px-1 bg-white">Profile
                        Image</label>
                    <input id="image" name="image" type="file"
                        class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 mt-4">
                </div>

                @if (config('jetstream.features.terms_and_privacy_policy'))
                    <div class="flex items-center mt-4">
                        <input id="terms" name="terms" type="checkbox"
                            class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <label for="terms" class="text-xs text-gray-900 ml-2">I agree to the
                            <a href="{{ route('terms.show') }}" class="underline">Terms of Service</a> and
                            <a href="{{ route('policy.show') }}" class="underline">Privacy Policy</a>
                        </label>
                    </div>
                @endif

                <button type="submit"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded text-sm focus:outline-none focus:shadow-outline mt-6">
                    Register
                </button>

                <div class="text-center">
                    <p class="text-xs text-gray-600">Already have an account?
                        <a href="#" class="text-blue-600 hover:text-blue-800"
                            onclick="showLoginForm()">Login</a>
                    </p>
                </div>
            </form>

        </div>
    </div>

    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.28/dist/fancybox.umd.js"></script>
    <script src="/js/hero.js"></script>
    <script>
        function formatDate(input) {
            let date = new Date(input.value);
            if (!isNaN(date.getTime())) {
                let formattedDate = date.toLocaleDateString('th-TH', {
                    day: '2-digit',
                    month: '2-digit',
                    year: 'numeric'
                });
                input.value = formattedDate.split('/').reverse().join('-'); // เก็บในรูปแบบ Y-m-d
                alert("Selected Date: " + formattedDate); // แสดงวันที่เป็น d/m/Y
            }
        }
    </script>
</body>

</html>
