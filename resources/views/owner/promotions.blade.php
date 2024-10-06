<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">

    <title>Tunthree - Promotion Management</title>

    <script>
        function showToast(toastId) {
            var toast = document.getElementById(toastId);
            toast.classList.add('show');
            setTimeout(function() {
                toast.classList.remove('show');
            }, 3000); // แสดง toast นาน 3 วินาที (3000 มิลลิวินาที)
        }
    </script>
</head>

<body>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>

    <div style="display: flex; background-color: #F5F3FF;">

        <!-- Sidebar -->
        <section class="sticky bg-white rounded-2xl p-2" id="nav-content" style="height: 100vh; width: 180px; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; margin-left: 2%; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">
            <div class="w-full lg:w-auto flex-grow lg:flex lg:flex-col bg-white lg:bg-transparent text-black">

                <!-- Logo -->
                <div style="display: grid; place-items: center; margin-bottom: 30px;">
                    <img src="/images/Logo.jpg" alt="Logo" style="width: 80px; height: auto; margin-bottom: -10px;">
                    <div class="text-black text-lg ">Tunthree</div>
                </div>

                <!-- Menu Items -->
                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:text-blue-700 hover:text-sm" href="#" id="Dashboard">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-layer-group mr-1"></i>
                        Dashboard
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:text-blue-700 hover:text-sm" href="#" id="Users">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-user mr-2"></i>Users
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="Employee.html" id="Employee">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-users mr-1"></i>Employee
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('room') }}" id="Room">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-door-open mr-1"></i>Room
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="#" id="Stock">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-house-circle-check mr-1"></i>Stock
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-blue-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="{{ route('promotions') }}" id="Promotion">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-rectangle-ad mr-1"></i>Promotion
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="#" id="Review">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-regular fa-envelope mr-1"></i>Review
                    </div>
                </a>

                <!-- Logout -->
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-6 transition duration-300 ease-in-out hover:bg-transparent hover:text-red-500 hover:text-sm" style="position: absolute; bottom: 10px;" id="Logout">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-right-from-bracket mr-1"></i>Logout
                    </div>
                </a>
                <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                    @csrf
                </form>
            </div>
        </section>

        <!-- Promotion Management Table -->
        <section class="ml-10 bg-white" id="promotion-table" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%;">
            <div class="max-w-screen-xl mx-auto py-10 ">
                <div class="px-2 p-2  flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">จัดการโปรโมชั่น</h1>

                    <!-- Search Form -->
                    <form action="#" method="GET" class="flex items-center">
                        @csrf
                        <input type="text" name="search" placeholder="ค้นหา" class="border border-gray-300 p-2 rounded-lg">
                        <button type="submit" class="ml-2 p-2 bg-blue-500 text-white rounded-lg">ค้นหา</button>
                    </form>

                    <!-- Add Promotion Button -->
                    <button class="relative pr-12 mb-4 group" onclick="window.location.href ='{{ route('add_promotion') }}'">
                        <span class="absolute hidden bg-gray-800 text-white px-2 py-1 rounded-md text-xs bottom-10 transition duration-300 ease-in-out opacity-0 group-hover:opacity-100">เพิ่มโปรโมชั่น</span>
                        <i class="fa-solid fa-circle-plus text-4xl text-gray-500 group-hover:text-gray-900"></i>
                    </button>
                    
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse text-center">
                        <thead>
                            <tr class="text-l bg-gray-300">
                                <th class="px-4 py-2">ลำดับ</th>
                                <th class="px-4 py-2">ชื่อโปรโมชั่น</th>
                                <th class="px-4 py-2">โค้ดโปรโมชั่น</th>
                                <th class="px-4 py-2">วันเริ่มต้น</th>
                                <th class="px-4 py-2">วันสิ้นสุด</th>
                                <th class="px-4 py-2">จำนวนที่ใช้ / สูงสุด</th>
                                <th class="px-4 py-2">ส่วนลด (%)</th>
                                <th class="px-4 py-2">ดำเนินการ</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($promotions as $promotion)
                            <tr>
                                <td class="px-4 py-2">{{ $loop->index + 1 }}</td>
                                <td class="px-4 py-2">{{ $promotion->campaign_name }}</td>
                                <td class="px-4 py-2">{{ $promotion->promo_code }}</td>
                                <td class="px-4 py-2">{{ $promotion->start_date->format('d-m-Y') }}</td> <!-- แสดงเฉพาะวันที่ -->
                                <td class="px-4 py-2">{{ $promotion->end_date->format('d-m-Y') }}</td> <!-- แสดงเฉพาะวันที่ -->
                                <td class="px-4 py-2">{{ $promotion->usage_count }} / {{ $promotion->max_usage_per_code }}</td>
                                <td class="px-4 py-2">{{ $promotion->discount_percentage }}</td>
                                <td class="px-4 py-2">
                                    <a href="{{ route('editpromotion', $promotion->id) }}" class="edit">
                                        <button class="text-black hover:text-blue-500" type="button"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </a>
                                    <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST" onsubmit="return confirm('คุณต้องการลบโปรโมชั่นนี้หรือไม่?')" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-black hover:text-red-500 ml-4" type="submit"><i class="fa-solid fa-trash"></i></button>
                                    </form>
                                </td>                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                
                           
            </section>
        </div>
    
        <!-- Toast Notification -->
        <div id="toast" class="toast bg-green-500 text-white fixed bottom-5 right-5 px-4 py-2 rounded hidden">
            Promotion action was successful!
        </div>
    
        <style>
            .toast {
                opacity: 0;
                transition: opacity 0.5s ease;
            }
    
            .toast.show {
                opacity: 1;
            }
        </style>
    
    </body>
    
    </html>
    