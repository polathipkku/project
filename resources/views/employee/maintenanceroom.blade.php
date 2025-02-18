    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="/src/output.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <link rel="stylesheet" href="/src/hero.css">


        <title>Tunthree</title>


        <script>
            function showToast(toastId) {
                var toast = document.getElementById(toastId);
                toast.classList.remove('toast');
                setTimeout(function() {
                    toast.classList.add('toast');
                }, 3000); // แสดง toast นาน 3 วินาที (3000 มิลลิวินาที)
            }
        </script>

    </head>

    <body>
        <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
        <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>

        <div style="display: flex; background-color: #F5F3FF;">

            @include('components.em_sidebar')


            <section class="ml-10 bg-white" id="room-table" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%; box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); ">
                <div class="max-w-screen-xl mx-auto py-10 ">
                    <div class="px-2 p-2  flex justify-between items-center">
                        <h1 class="text-4xl mb-10 max-xl:px-4">ซ่อมบำรุง</h1>
                        <!-- <button class="relative pr-12 mb-4 group" onclick="window.location.href ='Room_add.html'">
                        <span
                            class="absolute hidden bg-gray-800 text-white px-2 py-1 rounded-md text-xs bottom-10 transition duration-300 ease-in-out opacity-0 group-hover:opacity-100">เพิ่มห้อง</span>
                        <i class="fa-solid fa-circle-plus text-4xl text-gray-500 group-hover:text-gray-900"></i>
                    </button> -->



                    </div>
                    <table class="w-full border-collapse ">
                        <thead>
                            <tr class="text-l bg-gray-300">
                                <th class=" px-4 py-2">หมายเลขห้อง</th>
                                <th class=" px-4 py-2">สถานะ</th>
                                <th class=" px-4 py-2">รายละเอียด</th>
                                <th class=" px-4 py-2 " style="padding-right: 7.5%;"><span class="hidden">sdss</span>แจ้งซ่อมสำเร็จ</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @foreach($roomsUnderMaintenance as $room)
                            <tr>
                                <!-- ชื่อห้อง -->
                                <td class="px-4 py-2">{{ $room->room_name }}</td>

                                <!-- สถานะการซ่อม -->
                                <td class="px-4 py-2">
                                    <span class="inline-flex items-center bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                        <span class="w-2 h-2 me-1 bg-red-300 rounded-full mr-1"></span>
                                        กำลังซ่อม
                                    </span>
                                </td>

                                <td class="px-4 py-2">
                                    @foreach ($room->maintenances as $maintenance)
                                    @if ($maintenance->booking_detail_id && $maintenance->maintenances_status === 'กำลังซ่อม')
                                    <a href="{{ route('maintenancedetail', ['booking_detail_id' => $maintenance->booking_detail_id]) }}"
                                        class="text-blue-500 hover:underline">
                                        ดูรายละเอียดการแจ้งซ่อม
                                    </a>
                                    @elseif (!$maintenance->booking_detail_id)
                                    <span class="text-gray-500">ไม่มีข้อมูลการจอง</span>
                                    @endif
                                    @endforeach
                                </td>

                                <td class="px-4 py-4 flex justify-center items-center">
                                    <form action="{{ route('toggleRoomStatus', $room->id) }}" method="post">
                                        @csrf
                                        @if($room->checkoutDetails->isNotEmpty() && $room->checkoutDetails->last()->thing_status === 'ซ่อมสำเร็จ')
                                        <button class="text-black hover:text-blue-500">
                                            <i class="fa-solid fa-tools"></i>
                                        </button>
                                        @else
                                        <span class="text-gray-500">ไม่สามารถกดได้</span>
                                        @endif
                                    </form>
                                </td>




                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </section>

            <section id="toast" class="hidden">
                <div id="toast-success" class=" flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                        </svg>
                        <span class="sr-only">Check icon</span>
                    </div>
                    <div class="ms-3 text-sm font-normal">Item moved successfully.</div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div id="toast-danger" class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
                        </svg>
                        <span class="sr-only">Error icon</span>
                    </div>
                    <div class="ms-3 text-sm font-normal">Item has been deleted.</div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-danger" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
                <div id="toast-warning" class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800" role="alert">
                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-orange-500 bg-orange-100 rounded-lg dark:bg-orange-700 dark:text-orange-200">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
                        </svg>
                        <span class="sr-only">Warning icon</span>
                    </div>
                    <div class="ms-3 text-sm font-normal">Improve password difficulty.</div>
                    <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-warning" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
        </div>
        </section>


        </div>
    </body>

    </html>