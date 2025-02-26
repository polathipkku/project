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

        @include('components.admin_sidebar')


        <section class="ml-10 bg-white" id="room-add" style="width:1100px; padding-left: 2.5%; padding-right: 2.5%;">
            <div class="max-w-screen-xl mx-auto py-10 ">
                <div class="px-2 p-2  flex justify-between items-center">
                    <h1 class="text-4xl mb-10 max-xl:px-4">เพิ่มสินค้า</h1>
                    <button class="relative pr-12 mb-4 group">
                    </button>
                </div>

                <form action="{{ route('additem') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- ชื่อสินค้า -->
                    <div class="mb-4">
                        <label for="product_name" class="block text-sm font-medium text-gray-700">ชื่อสินค้า</label>
                        <select name="product_name" required class="w-full p-2 border rounded-lg">
                            <option value="" disabled selected>-- กรุณาเลือกสินค้า --</option>
                            <option value="สบู่">สบู่</option>
                            <option value="น้ำยาสระผม">น้ำยาสระผม</option>
                        </select>
                        @error('product_name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- จำนวนแพ็ค -->
                    <div class="mb-4">
                        <label for="pack_qty" class="block text-sm font-medium text-gray-700">จำนวนแพ็ค</label>
                        <input type="number" name="pack_qty" min="1" required class="w-full p-2 border rounded-lg">
                        @error('pack_qty') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- จำนวนของใน 1 แพ็ค -->
                    <div class="mb-4">
                        <label for="items_per_pack" class="block text-sm font-medium text-gray-700">จำนวนของใน 1 แพ็ค</label>
                        <input type="number" name="items_per_pack" min="1" required class="w-full p-2 border rounded-lg">
                        @error('items_per_pack') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- ประเภทแพ็ค -->
                    <div class="mb-4">
                        <label for="package_type" class="block text-sm font-medium text-gray-700">ประเภทแพ็ค</label>
                        <select name="package_type" required class="w-full p-2 border rounded-lg">
                            <option value="แพ็คใหญ่">แพ็คใหญ่</option>
                            <option value="แพ็คเล็ก">แพ็คเล็ก</option>
                        </select>
                        @error('package_type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- ปุ่มกด -->
                    <div class="flex items-center justify-between">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg">สร้างสินค้า</button>
                        <a href="{{ route('items') }}" class="px-4 py-2 bg-gray-400 text-white rounded-lg">ยกเลิก</a>
                    </div>
                </form>




            </div>
        </section>

    </div>

</body>

</html>