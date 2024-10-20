<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.28/dist/fancybox.css">
    <link href="src/output.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="/images/Logo_2.jpg" type="image/png">
    <link rel="stylesheet" href="/css/hero.css">

    <title>Thunthree Gallery</title>

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

    <div id="backdrop"
        class="fixed inset-0 bg-black opacity-0 z-40 pointer-events-none transition-opacity duration-300">
    </div>

    <div id="sidebar" class=" sidebar-hidden fixed top-0 right-0 w-1/4 h-full bg-white p-5 shadow-lg z-50">
        <h2 class="text-2xl font-bold mb-5">จองห้องพัก</h2>
        <form>
            <div class="mb-4">
                <label for="checkin" class="block text-gray-700">เช็คอิน</label>
                <input type="date" id="checkin" name="checkin" class="w-full border p-2 rounded">
            </div>
            <div class="mb-4">
                <label for="checkout" class="block text-gray-700">เช็คเอาท์</label>
                <input type="date" id="checkout" name="checkout" class="w-full border p-2 rounded">
            </div>
            <div class="mb-4">
                <label for="rooms" class="block text-gray-700">จำนวนห้อง</label>
                <input type="number" id="rooms" name="rooms" class="w-full border p-2 rounded" min="1">
            </div>
            <div class="mb-4">
                <label for="guests" class="block text-gray-700">จำนวนผู้เข้าพัก</label>
                <input type="number" id="guests" name="guests" class="w-full border p-2 rounded" min="1">
            </div>
            <button type="submit"
                class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-700">เช็คห้องว่าง</button>
        </form>
    </div>

    <!-- Gallery Content -->
    <main class="container mx-auto mt-10">
        <div class="text-center mb-10 mr-12">
            <h1 class="text-4xl font-bold">แกลเลอรี่</h1>
            <p class="text-xl mt-4">ภาพบรรยากาศที่สวยงามของเรา</p>
        </div>
        <div class="gallery-grid grid-cols-2">
            <div class="gallery-item">
                <a href="/images/tb1.png" data-fancybox="gallery">
                    <img src="/images/tb1.png" alt="Gallery Image 1">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 1</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/S__13500422.jpg" data-fancybox="gallery">
                    <img src="/images/S__13500422.jpg" alt="Gallery Image 2">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 2</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/S__13500424.jpg" data-fancybox="gallery">
                    <img src="/images/S__13500424.jpg" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 3</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/S__13500425.jpg" data-fancybox="gallery">
                    <img src="/images/S__13500425.jpg" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 4</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/S__13500426.jpg" data-fancybox="gallery">
                    <img src="/images/S__13500426.jpg" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 5</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/S__13500433.jpg" data-fancybox="gallery">
                    <img src="/images/S__13500433.jpg" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 6</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/S__13500435.jpg" data-fancybox="gallery">
                    <img src="/images/S__13500435.jpg" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 7</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/i-3.png" data-fancybox="gallery">
                    <img src="/images/i-3.png" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 8</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/i-6.jpeg" data-fancybox="gallery">
                    <img src="/images/i-6.jpeg" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 9</h3>
                        </div>
                    </div>
                </a>
            </div>
            <div class="gallery-item">
                <a href="/images/TT11.png" data-fancybox="gallery">
                    <img src="/images/TT11.png" alt="Gallery Image 3">
                    <div class="overlay">
                        <div class="overlay-content">
                            <h3>Gallery Image 10</h3>
                        </div>
                    </div>
                </a>
            </div>

        </div>
    </main>

    <x-footer />


    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.28/dist/fancybox.umd.js"></script>
    <script src="/js/hero.js"></script>
    <script>
        document.addEventListener('scroll', function() {
            var header = document.querySelector('header');
            var mail = document.getElementById('mail');
            var scrollPosition = window.scrollY;

            if (scrollPosition > 100) { // เลื่อนลงเท่าไหร่ถึงจะปิด
                header.style.top = mail.offsetHeight + 'px'; // ปรับ header เลื่อนขึ้นปิด mail
            } else {
                header.style.top = '20px'; // ปรับ header 
            }
        });
    </script>
</body>

</html>