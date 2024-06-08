<!-- resources/views/employee/employeehome.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            หน้าเช็คอิน
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8 p-6 bg-white rounded shadow">
        <h1 class="text-3xl font-semibold mb-6">หน้าเช็คอิน</h1>

        @if(count($bookings) > 0)
        <table class="min-w-full bg-white border rounded overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="py-2 px-4">หมายเลขการจอง</th>
                    <th class="py-2 px-4">ห้อง</th>
                    <th class="py-2 px-4">วันที่เช็คอิน</th>
                    <!-- ... เพิ่มหัวคอลัมน์ตามต้องการ ... -->
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td class="py-2 px-4">{{ $booking->id }}</td>
                    <td class="py-2 px-4">{{ $booking->room->room_name }}</td>
                    <td class="py-2 px-4">{{ $booking->checkin_date }}</td>
                    <!-- ... เพิ่มข้อมูลในแต่ละคอลัมน์ตามต้องการ ... -->
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            <form action="{{ route('checkin') }}" method="post">
                @csrf
                <label for="booking_id" class="block text-sm font-medium text-gray-600">เลือกการจอง:</label>
                <select id="booking_id" name="booking_id" class="form-select mt-1 block w-full">
                    @foreach($bookings as $booking)
                        @if($booking->booking_status !== 'ยกเลิก')
                            <option value="{{ $booking->id }}">{{ $booking->room->room_name }} - {{ $booking->checkin_date }}</option>
                        @endif
                    @endforeach
                </select>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:shadow-outline-blue active:bg-blue-800 mt-4">
                    เช็คอิน
                </button>
            </form>
        </div>

        @else
        <p class="text-gray-600">ไม่พบการจอง</p>
        @endif
    </div>
</x-app-layout>
