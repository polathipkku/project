<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">

    <title>Tunthree - จัดการสินค้า</title>

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
                    <h3 class="text-3xl font-medium text-gray-700">จัดการสินค้า</h3>
                </div>
        
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                            <form action="#" method="GET" class="w-full md:w-auto mb-4 md:mb-0">
                                @csrf
                                <div class="relative">
                                    <input type="text" name="search" placeholder="ค้นหาสินค้า" class="w-full md:w-80 pl-10 pr-4 py-2 rounded-lg border focus:border-blue-300 focus:outline-none focus:shadow-outline">
                                    <div class="absolute top-1/2 left-3 transform -translate-y-1/2">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                            </form>
                            <button onclick="window.location.href='{{ route('add_product') }}'"
                                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 focus:outline-none transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                                <i class="fas fa-plus mr-2"></i>เพิ่มสินค้า
                            </button>
                        </div>
        
                        <div class="overflow-x-auto">
                            <table class="w-full border border-gray-200">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">ลำดับ</th>
                                        <th class="py-3 px-6 text-left">รูปสินค้า</th>
                                        <th class="py-3 px-6 text-left">ชื่อสินค้า</th>
                                        <th class="py-3 px-6 text-center">ราคา</th>
                                        <th class="py-3 px-6 text-center">ประเภท</th>
                                        <th class="py-3 px-6 text-center">จำนวนในสต็อก</th>
                                        <th class="py-3 px-6 text-center">สถานะ</th>
                                        <th class="py-3 px-6 text-center">ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm">
                                    @foreach($product as $productItem)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-300 ease-in-out">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $loop->index + 1 }}</td>
                                        <td class="py-3 px-6 text-left">
                                            <img src="{{ asset('images/' . $productItem->product_img) }}" alt="{{ $productItem->product_name }}"
                                                class="w-12 h-12 object-cover rounded">
                                        </td>
                                        <td class="py-3 px-6 text-left">{{ $productItem->product_name }}</td>
                                        <td class="py-3 px-6 text-center">{{ number_format($productItem->product_price, 2) }} บาท</td>
                                        <td class="py-3 px-6 text-center">{{ $productItem->productType->product_type_name }}</td>
                                        <td class="py-3 px-6 text-center">{{ $productItem->stock->stock_qty }}</td>
                                        <td class="py-3 px-6 text-center">
                                            <span class="px-3 py-1 rounded-lg text-white {{ $productItem->product_status == 'พร้อมให้บริการ' ? 'bg-green-500' : 'bg-red-500' }}">
                                                {{ $productItem->product_status == 'พร้อมให้บริการ' ? 'พร้อมให้บริการ' : 'ไม่พร้อมให้บริการ' }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center">
                                                <a href="{{ url('/product/edit/'.$productItem->id) }}" class="mr-3">
                                                    <button class="text-black hover:text-blue-500">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </a>
                                                <a href="{{ url('/product/delete/'.$productItem->id) }}" class="delete-link">
                                                    <button class="text-black hover:text-red-500" type="button">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </a>
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

    <script>
        function showDetails(id) {
            document.getElementById('details-modal-' + id).classList.remove('hidden');
        }

        function closeDetails(id) {
            document.getElementById('details-modal-' + id).classList.add('hidden');
        }
    </script>

</body>

</html>