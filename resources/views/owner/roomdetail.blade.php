<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>
    <title>Tunthree - รายละเอียดห้องพัก</title>
    <style>
        /* เพิ่ม Custom CSS */
        .image-container {
            position: relative;
            overflow: hidden;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .image-container:hover {
            transform: scale(1.03);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }
        
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(59, 130, 246, 0.1);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .image-container:hover .image-overlay {
            opacity: 1;
        }
        
        .table-row-hover:hover {
            background-color: #f8fafc;
        }

        .shimmer {
            position: relative;
            background: #f6f7f8;
            background-image: linear-gradient(to right, #f6f7f8 0%, #edeef1 20%, #f6f7f8 40%, #f6f7f8 100%);
            background-repeat: no-repeat;
            background-size: 800px 100%;
            animation-duration: 1.5s;
            animation-fill-mode: forwards;
            animation-iteration-count: infinite;
            animation-name: shimmer;
            animation-timing-function: linear;
        }

        @keyframes shimmer {
            0% {
                background-position: -468px 0;
            }
            100% {
                background-position: 468px 0;
            }
        }
    </style>
</head>

<body class="bg-gray-50 font-sans min-h-screen">
    <div class="flex min-h-screen">
        @include('components.admin_sidebar')

        <!-- Main Content -->
        <section class="flex-1 p-4 md:p-8 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <!-- Header with breadcrumb -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 pb-4 border-b border-gray-200">
                    <div>
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">รายละเอียดห้องพัก</h1>
                        <div class="text-sm text-gray-500 mt-1 flex items-center space-x-2">
                            <a href="/dashboard" class="hover:text-blue-600 transition">หน้าหลัก</a> 
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <a href="/room" class="hover:text-blue-600 transition">ห้องพัก</a> 
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                            <span class="text-blue-600 font-medium">รายละเอียด</span>
                        </div>
                    </div>
                    <button onclick="window.location.href ='/room'" class="mt-3 md:mt-0 flex items-center bg-white hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg shadow-sm transition duration-300 border border-gray-200 font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        กลับไปยังรายการห้องพัก
                    </button>
                </div>

                <!-- Room details card -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8 border border-gray-100">
                    <div class="p-6 bg-gradient-to-r from-blue-50 to-blue-100 border-b border-blue-200">
                        <div class="flex items-center">
                            <div class="rounded-full bg-blue-100 p-2 flex items-center justify-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">ข้อมูลห้องพักทั้งหมด</h2>
                                <p class="text-sm text-gray-600 mt-1">แสดงรายละเอียดห้องพักทั้งหมดในระบบ</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">หมายเลขห้อง</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">รูปภาพ</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">ความจุ</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">เตียง</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">ห้องน้ำ</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">ราคาค้างคืน</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">ราคาชั่วคราว</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">สถานะ</th>
                                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">รายละเอียด</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($rooms as $room)
                                    <tr class="table-row-hover transition duration-300 justify-center">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 text-center">{{ $room->room_name }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="image-container w-24 h-24">
                                                <!-- ใช้ onerror เพื่อแสดงภาพสำรองเมื่อโหลดภาพไม่สำเร็จ -->
                                                <img 
                                                    src="{{ asset('images/' . $room->room_image) }}" 
                                                    alt="ภาพห้อง {{ $loop->index + 1 }}" 
                                                    class="w-full h-full object-cover rounded-lg"
                                                    onerror="this.onerror=null; this.src='/images/room-placeholder.jpg'; this.classList.add('border', 'border-red-200');"
                                                    onclick="openImagePreview('{{ asset('images/' . $room->room_image) }}', '{{ $room->room_image }}')"
                                                    id="room-image-{{ $loop->index }}"
                                                >
                                              
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex items-center">
                                                <div class="bg-blue-100 p-1.5 rounded-md mr-2">
                                                    <i class="fa-solid fa-user text-blue-600"></i>
                                                </div>
                                                <span class="text-sm text-gray-900 font-medium">{{ $room->room_occupancy }} คน</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex items-center">
                                                <div class="bg-indigo-100 p-1.5 rounded-md mr-2">
                                                    <i class="fa-solid fa-bed text-indigo-600"></i>
                                                </div>
                                                <span class="text-sm text-gray-900 font-medium">{{ $room->room_bed }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex items-center">
                                                <div class="bg-purple-100 p-1.5 rounded-md mr-2">
                                                    <i class="fa-solid fa-bath text-purple-600"></i>
                                                </div>
                                                <span class="text-sm text-gray-900 font-medium">{{ $room->room_bathroom }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="text-sm font-semibold text-green-600">฿{{ number_format($room->price_night) }}</span>
                                            <span class="text-xs text-gray-500 block">ต่อคืน</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="text-sm font-semibold text-blue-600">฿{{ number_format($room->price_temporary) }}</span>
                                            <span class="text-xs text-gray-500 block">ชั่วคราว</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-3 py-1.5 text-xs font-medium rounded-full inline-flex items-center
                                                {{ $room->room_status == 'พร้อมให้บริการ' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                <span class="w-2 h-2 rounded-full mr-1.5 
                                                    {{ $room->room_status == 'พร้อมให้บริการ' ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                                {{ $room->room_status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-700 max-w-xs text-center">
                                            <div class="line-clamp-2 hover:line-clamp-none transition-all duration-300 cursor-pointer" onclick="showDescription('{{ htmlspecialchars(json_encode($room->room_description), ENT_QUOTES, 'UTF-8') }}')">
                                                {{ $room->room_description }}
                                                <span class="text-blue-500 text-xs ml-1">(คลิกเพื่ออ่านเพิ่มเติม)</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination (ถ้ามี) -->
                <div class="mt-4 flex justify-center">
                    {{-- เพิ่ม pagination ตรงนี้ (ถ้ามี) --}}
                </div>
            </div>
        </section>
    </div>

    <!-- Modal สำหรับดูรูปภาพขนาดใหญ่ -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-80 z-50 hidden flex items-center justify-center p-4 transition-all duration-300 opacity-0">
        <div class="relative bg-white rounded-lg max-w-4xl mx-auto shadow-2xl">
            <div class="absolute top-0 right-0 p-4">
                <button onclick="closeImagePreview()" class="bg-white rounded-full p-2 text-gray-800 hover:text-red-600 transition-colors duration-300 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-2 pt-10">
                <div id="imageLoader" class="shimmer h-96 w-full rounded-lg"></div>
                <img id="previewImage" src="" alt="ภาพขยาย" class="max-h-[80vh] mx-auto hidden">
            </div>
            <div class="bg-gray-50 px-4 py-3 rounded-b-lg border-t">
                <p id="imageCaption" class="text-gray-700 text-center"></p>
            </div>
        </div>
    </div>

    <!-- Modal สำหรับแสดงรายละเอียดเพิ่มเติม -->
    <div id="descriptionModal" class="fixed inset-0 bg-black bg-opacity-80 z-50 hidden flex items-center justify-center p-4 transition-all duration-300 opacity-0">
        <div class="relative bg-white rounded-lg max-w-2xl mx-auto shadow-2xl w-full">
            <div class="absolute top-0 right-0 p-4">
                <button onclick="closeDescriptionModal()" class="bg-white rounded-full p-2 text-gray-800 hover:text-red-600 transition-colors duration-300 shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6 pt-10">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">รายละเอียดห้องพัก</h3>
                <div id="descriptionContent" class="text-gray-700 leading-relaxed max-h-80 overflow-y-auto"></div>
            </div>
            <div class="bg-gray-50 px-4 py-3 rounded-b-lg border-t text-right">
                <button onclick="closeDescriptionModal()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-300">
                    ปิด
                </button>
            </div>
        </div>
    </div>

    <script>
        // เปิดดูรูปภาพขนาดใหญ่
        function openImagePreview(imageSrc, imageName) {
            const modal = document.getElementById('imageModal');
            const previewImage = document.getElementById('previewImage');
            const imageLoader = document.getElementById('imageLoader');
            const imageCaption = document.getElementById('imageCaption');
            
            // แสดง loading placeholder
            imageLoader.classList.remove('hidden');
            previewImage.classList.add('hidden');
            
            // แสดง modal
            modal.classList.remove('hidden');
            modal.classList.remove('opacity-0');
            document.body.style.overflow = 'hidden';
            
            // ตั้งค่า caption
            imageCaption.textContent = 'รูปภาพ: ' + imageName;
            
            // โหลดรูปภาพ
            previewImage.src = imageSrc;
            previewImage.onload = function() {
                // ซ่อน loader และแสดงรูปภาพ
                imageLoader.classList.add('hidden');
                previewImage.classList.remove('hidden');
            };
            
            // กรณีรูปภาพโหลดไม่สำเร็จ
            previewImage.onerror = function() {
                imageLoader.classList.add('hidden');
                previewImage.classList.remove('hidden');
                previewImage.src = '/images/room-placeholder.jpg';
                imageCaption.textContent = 'ไม่สามารถโหลดรูปภาพได้';
            };
        }

        // ปิดการดูรูปภาพขนาดใหญ่
        function closeImagePreview() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }

        // แสดงรายละเอียดเพิ่มเติม
        function showDescription(description) {
            const modal = document.getElementById('descriptionModal');
            const content = document.getElementById('descriptionContent');
            
            // แปลง JSON escaped string กลับเป็นข้อความปกติ
            const decodedDescription = JSON.parse(description);
            content.textContent = decodedDescription;
            
            // แสดง modal
            modal.classList.remove('hidden');
            modal.classList.remove('opacity-0');
            document.body.style.overflow = 'hidden';
        }

        // ปิด modal รายละเอียด
        function closeDescriptionModal() {
            const modal = document.getElementById('descriptionModal');
            modal.classList.add('opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }, 300);
        }

        // ปิด Modal เมื่อคลิกนอกกรอบ
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImagePreview();
            }
        });

        document.getElementById('descriptionModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDescriptionModal();
            }
        });

        // ตรวจสอบรูปภาพเมื่อโหลดเสร็จ
        window.addEventListener('DOMContentLoaded', (event) => {
            // จัดการกับรูปภาพที่โหลดไม่สำเร็จ
            const images = document.querySelectorAll('img[id^="room-image-"]');
            images.forEach(img => {
                if (img.complete) {
                    if (img.naturalHeight === 0) {
                        img.src = '/images/room-placeholder.jpg';
                        img.classList.add('border', 'border-red-200');
                    }
                }
            });
        });
    </script>
</body>

</html>