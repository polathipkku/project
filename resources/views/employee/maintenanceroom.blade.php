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


            <section class="min-h-screen w-full bg-gray-100 flex flex-col">
                <div class="container mx-auto py-8 px-4 flex-1 flex flex-col">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden flex-1 flex flex-col">
                        <!-- Header with improved spacing and styling -->
                        <div class="p-6 ">
                            <h1 class="text-3xl font-semibold text-gray-800">ซ่อมบำรุง</h1>
                        </div>
                        
                        <!-- Table with better spacing and responsive design -->
                        <div class="overflow-x-auto flex-1 mx-5 rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class=" font-medium uppercase tracking-wider text-gray-700 bg-gradient-to-r from-blue-100 to-indigo-200 border-b">
                                        <th class="px-6 py-3 text-center text-xm font-medium uppercase tracking-wider">หมายเลขห้อง</th>
                                        <th class="px-6 py-3  text-center text-xm font-medium  uppercase tracking-wider">สถานะ</th>
                                        <th class="px-6 py-3  text-center text-xm font-medium uppercase tracking-wider">รายละเอียด</th>
                                        <th class="px-6 py-3  text-center text-xm font-medium  uppercase tracking-wider">แจ้งซ่อมสำเร็จ</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($roomsUnderMaintenance as $room)
                                    <tr class="hover:bg-gray-50 transition-colors duration-200 ">
                                        <!-- Room number -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">
                                            {{ $room->room_name }}
                                        </td>
                                        
                                        <!-- Maintenance status -->
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                                กำลังซ่อม
                                            </span>
                                        </td>
                                        
                                        <!-- Maintenance details -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                            @foreach ($room->maintenances as $maintenance)
                                                @if ($maintenance->booking_detail_id && $maintenance->maintenances_status === 'กำลังซ่อม')
                                                    <a href="{{ route('maintenancedetail', ['booking_detail_id' => $maintenance->booking_detail_id]) }}"
                                                        class="inline-flex items-center text-blue-600 hover:text-blue-900 transition-colors duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        ดูรายละเอียดการแจ้งซ่อม
                                                    </a>
                                                @elseif (!$maintenance->booking_detail_id)
                                                    <span class="inline-flex items-center text-gray-400">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                        ไม่มีข้อมูลการจอง
                                                    </span>
                                                @endif
                                            @endforeach
                                        </td>
                                        
                                        <!-- Action buttons -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                            <form action="{{ route('toggleRoomStatus', $room->id) }}" method="post">
                                                @csrf
                                                @php
                                                    $lastStatus = $room->checkoutDetails->isNotEmpty() ? $room->checkoutDetails->last()->thing_status : null;
                                                @endphp
                                                
                                                @if ($lastStatus === 'ซ่อมสำเร็จ' || $lastStatus === 'ซื้อเปลี่ยนสำเร็จ')
                                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-md hover:bg-green-200 transition-colors duration-200">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                        {{ $lastStatus }}
                                                    </button>
                                                @else
                                                    <span class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-400 rounded-md cursor-not-allowed">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        ไม่สามารถกดได้
                                                    </span>
                                                @endif
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Empty state when no rooms are under maintenance -->
                        @if(count($roomsUnderMaintenance) === 0)
                        <div class="px-6 pb-12 mb-40 text-center flex-1 flex flex-col justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">ไม่มีห้องที่อยู่ระหว่างการซ่อมบำรุง</h3>
                            <p class="mt-2 text-sm text-gray-500">ทุกห้องอยู่ในสภาพพร้อมใช้งาน</p>
                        </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </body>

    </html>