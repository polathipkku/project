<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            รายชื่อละเอียดห้อง
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ห้องพักที่</th>
                            <th scope="col">รูปห้อง</th>
                            <th scope="col">จำนวนที่สามารถเข้าพัก</th>
                            <th scope="col">จำนวนเตียง</th>
                            <th scope="col">จำนวนห้องน้ำ</th>
                            <th scope="col">ราคาค้างคืน</th>
                            <th scope="col">ราคาชั่วคราว</th>
                            <th scope="col">รายละเอียดห้อง</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rooms as $room)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>
                                <img src="{{ asset('images/' . $room->room_image) }}" alt="Room Image" width="100px" height="100px">
                            </td>
                            <td>{{ $room->room_occupancy }}</td>
                            <td>{{ $room->room_bed }}</td>
                            <td>{{ $room->room_bathroom }}</td>
                            <td>{{ $room->price_night }}</td>
                            <td>{{ $room->price_temporary }}</td>
                            <td>{{ $room->room_description }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
