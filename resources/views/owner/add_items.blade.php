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

                <form action="{{ route('additem') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="product_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ชื่อสินค้า</label>
                        <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="product_name" required>
                        @error('product_name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>

                    <div>
                        <label for="pack_qty" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">จำนวนแพ็ค</label>
                        <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="pack_qty" min="1">
                        @error('pack_qty')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>

                    <div>
                        <label for="items_per_pack" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">จำนวนของใน 1 แพ็ค</label>
                        <input type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" name="items_per_pack" min="1">
                        @error('items_per_pack')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <br>

                    <br>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">สร้างสินค้า</button>

                    <!-- ปุ่มยกเลิก -->
                    <a href="{{ route('items') }}"
                        class="inline-block mt-4 text-center text-blue-600 hover:text-blue-800">
                        <button type="button"
                            class="text-white bg-gray-400 hover:bg-gray-500 rounded-lg text-sm px-5 py-2.5">ยกเลิก</button>
                    </a>
                </form>



            </div>
        </section>

    </div>

</body>

</html>