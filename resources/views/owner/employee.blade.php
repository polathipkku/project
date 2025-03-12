<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">

    <title>Tunthree - employee Management</title>

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
        @include('components.admin_sidebar')


        <!-- Promotion Management Table -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-8">
                <div class="flex justify-between items-center mb-6">
                    {{-- <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none lg:hidden">
                        <i class="fas fa-bars"></i>
                    </button> --}}
                    <h3 class="text-3xl font-medium text-gray-700">จัดการพนักงาน</h3>
                </div>

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                            <form action="#" method="GET" class="w-full md:w-auto mb-4 md:mb-0">
                                @csrf
                                <div class="relative">
                                    <input type="text" name="search" placeholder="ค้นหาพนักงาน" 
                                        class="w-full md:w-80 pl-10 pr-4 py-2 rounded-lg border focus:border-blue-300 focus:outline-none focus:shadow-outline">
                                
                                    <div class="absolute inset-y-0 left-3 flex items-center">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                                
                            </form>
                            <button onclick="window.location.href='{{ route('add_employee') }}'" class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                                <i class="fas fa-plus mr-2"></i>เพิ่มพนักงาน
                            </button>
                        </div>

                        <!-- Promotion Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full border border-gray-200">
                                <thead>
                                    <tr class="bg-gradient-to-r from-blue-100 to-indigo-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-center">ลำดับ</th>
                                        <th class="py-3 px-6 text-center">ชื่อ</th>
                                        <th class="py-3 px-6 text-center">วันสมัคร</th>
                                        <th class="py-3 px-6 text-center">รายละเอียด</th>
                                        <th class="py-3 px-6 text-center">ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm">
                                    @foreach($employee as $employee)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-300 ease-in-out">
                                        <td class="py-3 px-6 text-center whitespace-nowrap">{{ $loop->index + 1 }}</td>
                                        <td class="py-3 px-6 text-center">{{ $employee->name }}</td>
                                        <td class="py-3 px-6 text-center">{{ $employee->created_at->format('d-m-Y') }}</td>
                                        <td class="py-3 px-6 text-blue-500 hover:text-blue-700 text-center">
                                            <a href="{{ url('/employeedetail/'.$employee->id) }}">รายละเอียด</a>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center">
                                                <a href="{{ url('/employee/edit/'.$employee->id) }}" class="mr-3">
                                                    <button class="text-yellow-500 hover:text-yellow-600">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <button class="text-red-500 hover:text-red-600" type="button" 
                                                onclick="confirmDelete({{ $employee->id }})">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(employeeId) {
            Swal.fire({
                title: "ยืนยันการลบพนักงาน?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "bg-blue-500", // สีแดง
                cancelButtonColor: "#ffffff", // ปุ่มยกเลิกสีขาว
                cancelButtonText: "<span style='color: black;'>ยกเลิก</span>", // ตัวหนังสือสีดำ
                confirmButtonText: "ลบเลย!",
                reverseButtons: true // ปรับให้ปุ่มยืนยันอยู่ด้านขวา
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/employee/delete/" + employeeId;
                }
            });
        }
    </script>

</body>

</html>