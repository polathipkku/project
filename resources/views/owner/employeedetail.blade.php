<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">

    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <title>Tunthree</title>
</head>

<body>
    <div style="display: flex; background-color: #F5F3FF;">


        <section class="sticky bg-white rounded-2xl p-2" id="nav-content" style="height: 100vh; width: 180px; display: flex; flex-direction: column; align-items: center; justify-content: flex-start; margin-left: 2%; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);">
            <div class="w-full lg:w-auto flex-grow lg:flex lg:flex-col bg-white lg:bg-transparent text-black">

                <div style="display: grid; place-items: center; margin-bottom: 30px;">
                    <img src="images/Logo.jpg" alt="Logo" style="width: 80px; height: auto; margin-bottom: -10px;">
                    <div class="text-black text-lg ">Tunthree</div>
                </div>


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

                <a class="inline-block py-2 px-3 text-blue-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="Employee.html" id="Employee">
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

                <a class="inline-block py-2 px-3 text-gray-500 no-underline lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="#" id="Promotion">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-solid fa-rectangle-ad mr-1"></i>Promotion
                    </div>
                </a>

                <a class="inline-block py-2 px-3 text-gray-500 lg:flex lg:flex-col items-start justify-start mb-1 transition duration-300 ease-in-out hover:bg-transparent hover:text-blue-700 hover:text-sm" href="#" id="Review">
                    <div class="mr-2 text-base flex items-center">
                        <i class="fa-regular fa-envelope mr-1"></i>Review
                    </div>
                </a>

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
        <!-- --------------------------------------------------------------------------------------------------------------------- -->

        <section class="ml-10 bg-white" id="room-table" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%;">
            <div class="max-w-screen-xl mx-auto py-10">
                <div class="px-2 p-2  flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">รายละเอียดพนักงาน</h1>
                    <button class="relative pr-12 mb-4 group" onclick="window.location.href ='/employee'">
                        <i class="fa-solid fa-circle-xmark text-4xl text-red-500 group-hover:text-red-900"></i>
                    </button>
                </div>
                <table class="w-full border-collapse ">
                    <thead>
                        <tr class="text-base bg-gray-300">
                            <th class="px-4 py-2">ลำดับ</th>
                            <th class="px-4 py-2">รูปพนักงาน</th>
                            <th class="px-4 py-2">ชื่อพนักงาน</th>
                            <th class="px-4 py-2">เบอร์โทรพนักงาน</th>
                            <th class="px-4 py-2">ที่อยู่พนักงาน</th>
                            <th class="px-4 py-2">วันเกิดพนักงาน</th>
                            <th class="px-4 py-2">วันที่เริ่มทำงาน</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach($employeedetail as $employeedetail)
                        <tr>
                            <td class="px-4 py-2">{{ $loop->index + 1 }}</td>
                            <td class="px-4 py-2 " id="ชื่อพนักงาน">{{ $employeedetail->name }}</td>
                            <td class="px-4 py-2 flex justify-center" id="รูป"><img src="{{ asset('images/' . $employeedetail->image) }}" alt="" width="100" height="100"></td>
                            <td class="px-4 py-2 " id="เบอร์โทร">{{ $employeedetail->tel }}</td>
                            <td class="px-4 py-2 " id="วันเริ่มงาน">{{ $employeedetail->address }}</td>
                            <td class="px-4 py-2 " id="วันเกิด">{{ $employeedetail->birthday }}</td>
                            <td class="px-4 py-2 " id="ที่อยู่">{{ $employeedetail->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>


    </div>

</body>

</html>