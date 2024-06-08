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

    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .scroll-button {
            cursor: pointer;
        }
    </style>
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

                        <a href="{{ route('reservation') }}" class="text-black hover:text-blue-400">ประวัติการจอง<i class="fa-solid fa-clock-rotate-left ml-2"></i></a>
                        <a href="#" class="text-black hover:text-blue-400">รีวิว<i class="fa-solid fa-star ml-2"></i></a>
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
    <div class="mx-auto pt-4 pb-4 bg-gray-100">
        <p class="text-gray-600 text-lg max-xl:px-4 pt-8" style="margin-left: 7%;">
            <a href="{{route('home')}}" class="text-black hover:text-blue-400">Home</a>
            <i class="fa-solid fa-chevron-right ml-2 mr-2"></i>
            <a href="contact.html" class="text-blue-600 hover:text-black">ติดต่อเรา</a>

        </p>
    </div>
    <!-- contact section -->
    <section class="contact_section p-5" style="height: 800px;">

        <div class="row">
            <div class="col-lg-4 col-md-5 offset-md-1 h-full">
                <div class="heading_container">
                    <h2>
                        Contact Us
                    </h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-5 offset-md-1 h-full">
                <div class="mt-5 ">
                    <a href="" class="text-black hover:text-blue-400 text-xl"><i class="fa-solid fa-phone mr-4"></i>0940028212</a>
                </div>
                <div class="mt-5">
                    <a href="" class="text-black hover:text-blue-400 text-xl"><i class="fa-solid fa-envelope mr-4"></i>polathip.b@kkumail.com</a>
                </div>
                <div class="mt-5">
                    <a href="" class="text-black hover:text-blue-400 text-xl"><i class="fa-brands fa-facebook mr-4"></i>ธันย์ทรี
                        รีสอร์ท</a>
                </div>
                <div class="mt-5 flex items-center">
                    <a href="" class="text-black hover:text-blue-400 flex items-center text-xl">
                        <i class="fa-solid fa-location-dot mr-4"></i>
                        <div>
                            86 หมู่15 ถนนสมเด็จ–มุกดาหาร ต.บัวขาว
                            <div>อำเภอ กุฉินารายณ์ กาฬสินธุ์ 46110</div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 bg-cover bg-center bg-no-repeat " style="background-image: url(/images/map_2.png); height: 470px;">
            </div>
        </div>

    </section>
    <!-- end contact section -->

    <!-- info section -->

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
                            <i class="fa fa-facebook" aria-hidden="true"></i>
                        </a>

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



    <!-- jQery -->
    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <!-- popper js -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <!-- bootstrap js -->
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <!-- owl slider -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
    </script>
    <!-- custom js -->
    <script type="text/javascript" src="js/custom.js"></script>
    <!-- Google Map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
    </script>
    <!-- End Google Map -->

</body>

</html>