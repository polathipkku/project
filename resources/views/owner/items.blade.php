<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/src/output.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/src/hero.css">

    <title>Tunthree - จัดการสินค้าt</title>

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
                            <button onclick="window.location.href='{{ route('add_items') }}'"
                                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 focus:outline-none transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                                <i class="fas fa-plus mr-2"></i>เพิ่มสินค้า
                            </button>
                        </div>

                        <!-- Table UI -->
                        <div class="overflow-x-auto">
                            <table class="w-full border border-gray-200">
                                <thead>
                                    <tr class="bg-gradient-to-r from-blue-100 to-indigo-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-left">ชื่อสินค้า</th>
                                        <th class="py-3 px-6 text-center">จำนวนแพ็ค</th>
                                        <th class="py-3 px-6 text-center">จำนวนสินค้า</th>
                                        <th class="py-3 px-6 text-center">ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm">
                                    @foreach($product as $productItem)
                                    <tr class="border-b border-gray-200 hover:bg-gray-100 transition duration-300 ease-in-out">
                                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $productItem->product_name }}</td>
                                        <td class="py-3 px-6 text-center">
                                            <span id="current_pack_qty-{{ $productItem->id }}">
                                                {{ $productItem->stock->stockPackages->first()->pack_qty ?? '-' }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <span id="current_stock-{{ $productItem->id }}">{{ $productItem->stock->stock_qty }}</span>
                                        </td>
                                        <td class="py-3 px-6 text-center">
                                            <div class="flex items-center justify-center gap-4">
                                                <!-- ปุ่มเพิ่ม Stock -->
                                                <button onclick="openModal({{ $productItem->id }})" class="text-green-500 hover:text-green-600 focus:outline-none">
                                                    <i class="fa-solid fa-plus-square"></i>
                                                </button>



                                                <!-- ปุ่มลบ -->
                                                <a href="{{ url('/product/delete/'.$productItem->id) }}" class="delete-link">
                                                    <button class="text-red-500 hover:text-red-600" type="button">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </a>
                                            </div>
                                        </td>

                                    </tr>

                                    <!-- Modal เพิ่ม Stock -->
                                    <div id="modal-{{ $productItem->id }}" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
                                        <div class="bg-white rounded-lg shadow-lg p-6 w-96 relative">
                                            <h2 class="text-xl font-semibold mb-4 text-center">เพิ่ม Stock</h2>
                                            <form action="{{ route('updateStock', $productItem->id) }}" method="POST" onsubmit="updateStockDisplay(event, {{ $productItem->id }})">
                                                @csrf

                                                <label class="block text-sm font-medium text-gray-700 mt-2">เลือกสินค้า</label>
                                                <select id="stockproduct_name-{{ $productItem->id }}" name="stockproduct_name" class="w-full border rounded-lg p-2" required onchange="updatePackageAndItems(this, {{ $productItem->id }})">
                                                    <option value="" selected disabled>เลือกสินค้า</option>
                                                    @php
                                                    $allStockProducts = collect($productItem->stock->stockPackages ?? [])
                                                    ->pluck('stockproduct_name')
                                                    ->unique()
                                                    ->flatMap(function ($stockproductName) {
                                                    return [
                                                        "{$stockproductName} - แพ็คใหญ่ - 12",
                                                    "{$stockproductName} - แพ็คเล็ก - 6",
                                                    ];
                                                    });
                                                    @endphp

                                                    @foreach($allStockProducts as $stockproductDisplay)
                                                    <option value="{{ $stockproductDisplay }}">{{ $stockproductDisplay }}</option>
                                                    @endforeach
                                                </select>

                                                <label class="block text-sm font-medium text-gray-700 mt-2">ประเภทแพ็ค</label>
                                                <input type="text" id="package_type-{{ $productItem->id }}" name="package_type" class="w-full border rounded-lg p-2 bg-gray-200" required readonly>

                                                <label class="block text-sm font-medium text-gray-700 mt-2">จำนวนของในแพ็ค</label>
                                                <input type="number" id="items_per_pack-{{ $productItem->id }}" name="items_per_pack" class="w-full border rounded-lg p-2 bg-gray-200" min="1" required readonly>

                                                <script>
                                                    function updatePackageAndItems(selectElement, productId) {
                                                        const packageTypeInput = document.getElementById(`package_type-${productId}`);
                                                        const itemsPerPackInput = document.getElementById(`items_per_pack-${productId}`);

                                                        if (!selectElement.value) {
                                                            packageTypeInput.value = "";
                                                            itemsPerPackInput.value = "";
                                                            return;
                                                        }

                                                        // ดึงค่าที่เลือกแล้วแยกประเภทแพ็คและจำนวนของในแพ็ค
                                                        const selectedText = selectElement.value;
                                                        const matches = selectedText.match(/แพ็ค(เล็ก|ใหญ่) - (\d+)/);

                                                        if (matches) {
                                                            packageTypeInput.value = `แพ็ค${matches[1]}`;
                                                            itemsPerPackInput.value = matches[2];
                                                        } else {
                                                            packageTypeInput.value = "";
                                                            itemsPerPackInput.value = "";
                                                        }
                                                    }
                                                </script>


                                                <label class="block text-sm font-medium text-gray-700">จำนวนแพ็ค</label>
                                                <input type="number" id="pack_qty-{{ $productItem->id }}" name="pack_qty" class="w-full border rounded-lg p-2" min="1" required>

                                                <div class="flex justify-between mt-4">
                                                    <button type="button" onclick="closeModal({{ $productItem->id }})" class="bg-gray-500 text-white py-2 px-4 rounded-lg">ยกเลิก</button>
                                                    <button type="submit" class="bg-blue-600 text-white py-2 px-4 rounded-lg">เพิ่ม Stock</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        <script>
                            function openModal(id) {
                                document.getElementById("modal-" + id).classList.remove("hidden");
                            }

                            function closeModal(id) {
                                document.getElementById("modal-" + id).classList.add("hidden");
                            }

                            function updateStockDisplay(event, id) {
                                event.preventDefault();

                                let packQty = parseInt(document.getElementById("pack_qty-" + id).value) || 0;
                                let itemsPerPack = parseInt(document.getElementById("items_per_pack-" + id).value) || 0;
                                let currentStock = parseInt(document.getElementById("current_stock-" + id).textContent) || 0;
                                let currentPackQty = parseInt(document.getElementById("current_pack_qty-" + id).textContent) || 0;

                                let additionalStock = packQty * itemsPerPack;
                                let newStock = currentStock + additionalStock;
                                let newPackQty = currentPackQty + packQty;

                                document.getElementById("current_stock-" + id).textContent = newStock;
                                document.getElementById("current_pack_qty-" + id).textContent = newPackQty;

                                closeModal(id);

                                event.target.submit();
                            }
                        </script>



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