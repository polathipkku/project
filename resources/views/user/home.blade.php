<!DOCTYPE html>
<html>


<head>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/TTbell.png" type="image/png">
  <link href="src/output.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="css/responsive.css" rel="stylesheet" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
  <!-- Owl Carousel JavaScript -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
  <!-- <link href="css/font-awesome.min.css" rel="stylesheet" /> -->
  <!-- <link rel="stylesheet" href="/css/hero.css"> -->
  <link href="css/style.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <title> Tunthree </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

  <!--owl slider stylesheet -->

  <link rel="stylesheet" href="css/style-head.css">
  <!-- Magnific Popup CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- Magnific Popup JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

  <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>


  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

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

            <a href="{{ route('reservation') }}" class="text-black hover:text-blue-400">ประวัติการจอง<i class="fa-solid fa-clock-rotate-left ml-2"></i></a>
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
      </div>
    </header>
  </div>




  <section class="hero">
    <div class="hero-content flex justify-center items-center flex-col mt-7" style="background-image: url(images/TT1.png); height: 500px; background-size: cover; background-repeat: no-repeat; background-position: center center;">

      <h1 class="text-white text-5xl mb-8 ">เริ่มต้นการจอง</h1>
      <form action="" class="grid grid-cols-5  justify-items-stretch items-center  bg-white border-1 rounded-2xl">
        <div class="relative">

        </div>
        <div class="flex justify-center items-center my-3 col-span-2 max-md:col-span-3 xl:mx-0">
          <div class="relative">
            <p class="pb-2">Check in</p>
            <input type="date" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-l-lg focus:ring-blue-500 focus:border-blue-500 block w-64 ps-5 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          </div>
          <div class="relative">
            <p class="pb-2">Check out</p>
            <input type="date" id="" class="bg-gray-50 border border-gray-300 text-gray-900 text-xl rounded-r-lg focus:ring-blue-500 focus:border-blue-500 block w-64 ps-5 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
          </div>
        </div>
        <div class="relative">
          <p class="pb-3 invisible"> </p>
          <a href="{{route('userbooking') }}" style="color: azure;">
            <div class="w-full bg-blue-500 hover:bg-blue-600 text-xl rounded-lg px-10 py-2.5 text-center" style="margin-left:20% ;">
              จอง
            </div>
          </a>
        </div>
      </form>
      <div class='flex justify-center ' style="margin-top:10% ;">
        <i class="fa-solid fa-angles-down fa-bounce" style="color: #ffffff; font-size: 3em;"></i>
      </div>
    </div>


  </section>

  </div>
  <div class="max-w-screen-xl mx-auto py-10">
    <section class="service_section layout_padding b p-4 mx-auto max-w-screen-xl">
      <div style="display: flex; justify-content: center; ">
        <h3>พักผ่อนอย่างมีความสุขในรีสอร์ทของเรา</h3>
      </div>
    </section>
  </div>
  <section id="contentcontent" class=" h-full">




    <div id="default-carousel" class="relative w-full" data-carousel="slide">
      <!-- Carousel wrapper -->
      <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
        <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="/images/tb1.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 2 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="/images/tb2.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 3 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="/images/tb3.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 4 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="images/br1.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 5 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
          <img src="images/br2.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
      </div>
      <!-- Slider indicators -->
      <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
        <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
        <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
      </div>
      <!-- Slider controls -->
      <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4" />
          </svg>
          <span class="sr-only">Previous</span>
        </span>
      </button>
      <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
        <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
          <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
          </svg>
          <span class="sr-only">Next</span>
        </span>
      </button>
    </div>


    <div class="max-w-screen-xl mx-auto py-10">
      <h3 class="text-5xl">จองห้องกับเรา</h3>
      <p class="text-ml my-5 text-black">CHECK-IN 3:00 PM | CHECK-OUT 12:00 PM </p>
      <div class="grid grid-cols-2 sm:grid-cols-2 md:grid-cols-4 justify-items-center my-10 max-md:flex-col">
        <div class="flex flex-col justify-center items-center max-md:py-3 transition-transform transform hover:scale-110">
          <i class="fa-solid fa-wifi text-4xl text-green-500"></i>
          <p class="text-2xl font-bold my-3">ฟรี WIFI</p>
          <p class="text-xl">มีให้ในห้อง</p>
        </div>
        <div class="flex flex-col justify-center items-center max-md:py-3 transition-transform transform hover:scale-110">
          <i class="fa-solid fa-bell-concierge text-4xl text-yellow-500"></i>
          <p class="text-2xl font-bold my-3">บริการดีเยี่ยม</p>
          <p class="text-xl">มีพนักงานค่อยให้บริการ</p>
        </div>
        <div class="flex flex-col justify-center items-center max-md:py-3 transition-transform transform hover:scale-110">
          <i class="fa-solid fa-money-bill-wave text-4xl text-blue-500"></i>
          <p class="text-2xl font-bold my-3">เจ้าหน้าที่ดูแล</p>
          <p class="text-xl">มีเจ้าหน้าที่ดูแลตลอดการจอง</p>
        </div>
        <div class="flex flex-col justify-center items-center max-md:py-3 transition-transform transform hover:scale-110">
          <i class="fas fa-check-circle text-4xl text-green-500"></i>
          <p class="text-2xl font-bold my-3">จองได้ทุกที่</p>
          <p class="text-xl">จองได้ทุกที่ ทุกเวลา</p>
        </div>
      </div>
    </div>
    </div>

  </section>

  <section class="about_section layout_padding-bottom" style="margin-top: 5%;">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                บรรยากาศ
              </h2>
            </div>
            <p>
              รีสอร์ทของเราตั้งอยู่ท่ามกลางธรรมชาติอันอุดมสมบูรณ์
              คุณจะได้สัมผัสกับอากาศบริสุทธิ์ วิวทิวทัศน์ที่สวยงาม
              และกิจกรรมต่างๆมากมายที่จะสร้างความสนุกสนานและ
              ผ่อนคลายให้กับคุณ
            </p>

          </div>
        </div>
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="images/TT11.png" alt="">
          </div>
        </div>
      </div>
    </div>

  </section>
  <section class="about_section layout_padding-bottom">
    <div class="container  ">
      <div class="row">
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                ห้อง <span>พัก</span>
              </h2>
            </div>
            <p>
              มีห้องพักให้พักมีสิ่งอำนวยความสะดวกสะอาดปลอดภัย
            </p>

          </div>
        </div>
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="images/TT12.png" alt="">
          </div>
        </div>

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
            </div>
          </div>
          <div class="info_social">
            <a href="https://www.facebook.com/profile.php?id=100063483881013">
              <i class="fa fa-facebook" aria-hidden="true">
                <span>
                  Tunthree
                </span>
              </i>
            </a>

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
    $(document).ready(function() {
      $('.owl-carousel').owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        autoplayTimeout: 1300,
        autoplayHoverPause: true
      });
    });
    // เมื่อคลิกที่เมนูหรือพื้นหลังเว็บ
    document.addEventListener("click", function(event) {
      var profileButton = document.getElementById("profileButton");
      var profileDropdown = document.getElementById("profileDropdown");
      ก
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>

</html>