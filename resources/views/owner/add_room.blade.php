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
                    <h1 class="text-4xl mb-10 max-xl:px-4">เพิ่มห้อง</h1>
                    <button class="relative pr-12 mb-4 group">
                    </button>
                </div>
                <form action="{{ route('addRoom') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <label for="หมายเลขห้อง" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">หมายเลขห้อง</label>
                            <input type="text" id="หมายเลขห้อง" name="room_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                            @error('room_name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div>
                            <label for="จำนวนที่สามารถเข้าพัก" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">จำนวนที่สามารถเข้าพัก</label>
                            <input type="text" id="จำนวนที่สามารถเข้าพัก" name="room_occupancy" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        </div>

                        <div class="room-group">
                            <label for="จำนวนเตียง" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">จำนวนเตียง</label>
                            <input type="text" id="จำนวนเตียง" name="room_bed" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        </div>

                        <div class="room-group">
                            <label for="จำนวนห้องน้ำ" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">จำนวนห้องน้ำ</label>
                            <input type="text" id="จำนวนห้องน้ำ" name="room_bathroom" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        </div>

                        <div>
                            <label for="ราคาค้างคืน" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ราคาค้างคืน</label>
                            <input type="text" id="ราคาค้างคืน" name="price_night" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        </div>

                        <div>
                            <label for="ราคาชั่วคราว" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">ราคาชั่วคราว</label>
                            <input type="text" id="ราคาชั่วคราว" name="price_temporary" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        </div>
                    </div>

                    <div class="room-group mb-6">
                        <label for="สถานะห้อง" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">เลือกสถานะห้อง</label>
                        <select id="สถานะห้อง" name="room_status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            <option selected disabled>สถานะห้อง</option>
                            <option value="พร้อมให้บริการ">พร้อมให้บริการ</option>
                            <option value="ไม่พร้อมให้บริการ">ไม่พร้อมให้บริการ</option>
                        </select>
                    </div>

                    <div class="room-group mb-6">
                        <label for="room_image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">รูปห้อง</label>
                        <input type="file" id="room_image" name="room_image[]" class="form-control" multiple required>
                    </div>
                 
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">สร้างห้อง</button>

                    <!-- ปุ่มยกเลิก -->
                    <a href="{{ route('room') }}"
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