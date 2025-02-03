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


         <!-- Sidebar -->
         @include('components.admin_sidebar')
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
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($employeedetail->birthday)->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">{{ \Carbon\Carbon::parse($employeedetail->start_date)->format('d/m/Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

</body>

</html>