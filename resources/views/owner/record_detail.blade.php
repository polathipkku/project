<div class="container mx-auto py-8">
    <h1 class="text-3xl font-bold mb-8 text-center">Booking Detail</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Booking Information -->
        <div class="border border-gray-300 rounded-lg p-6 shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Booking Information</h2>
            <p><strong>Booking ID:</strong> {{ $booking->id }}</p>
        </div>

        <!-- Booking Details -->
        <div class="border border-gray-300 rounded-lg p-6 shadow-md">
            <h2 class="text-2xl font-semibold mb-4">รายละเอียดการจอง</h2>

            @if($booking->bookingDetails->isNotEmpty())
            <h3 class="text-xl font-semibold mb-2">ข้อมูลการจอง</h3>
            @foreach($booking->bookingDetails as $detail)
            <div class="border-b border-gray-200 py-2">
                <p><strong>ชื่อผู้จอง:</strong> {{ $detail->booking_name }}</p>
                <p><strong>โทรศัพท์:</strong> {{ $detail->phone }}</p>
                <p><strong>สถานะการจอง:</strong> {{ $detail->booking_status }}</p>
                <p><strong>ห้องที่จอง:</strong> {{ $detail->room_type }}</p>
                <p><strong>วันที่เช็คอิน:</strong> {{ $detail->checkin_date }}</p>
                <p><strong>วันที่เช็คเอาท์:</strong> {{ $detail->checkout_date }}</p>
                <p><strong>จำนวนผู้เข้าพัก:</strong> {{ $detail->occupancy_person }} คน</p>
                <p><strong>จำนวนเด็ก:</strong> {{ $detail->occupancy_child }} คน</p>
                <p><strong>จำนวนทารก:</strong> {{ $detail->occupancy_baby }} คน</p>
                <p><strong>จำนวนห้อง:</strong> {{ $detail->room_quantity }} ห้อง</p>
                <p><strong>ต้นทุนรวม:</strong> {{ number_format($detail->total_cost, 2) }} บาท</p>

                <!-- Checkout Extend Information -->
                <h3 class="text-xl font-semibold mb-2">ข้อมูลการเลื่อนเวลาเช็คเอาท์</h3>
                @if($detail->checkoutExtends->isNotEmpty())
                @foreach($detail->checkoutExtends as $extend)
                <div class="border-b border-gray-200 py-2">
                    <p><strong>จำนวนวันที่เลื่อน:</strong> {{ $extend->extended_days }} วัน</p>
                    <p><strong>ค่าใช้จ่ายเพิ่มเติม:</strong> {{ number_format($extend->extra_charge, 2) }} บาท</p>
                </div>
                @endforeach
                @else
                <p>ไม่มีข้อมูลการเลื่อนเวลาเช็คเอาท์</p>
                @endif

                <!-- Calculate Discount -->
                @if($booking->promotion)
                @php
                $discount = ($booking->promotion->discount_percentage / 100) * $detail->total_cost;
                $final_cost = $detail->total_cost - $discount;
                @endphp
                <p><strong>ส่วนลด:</strong> {{ number_format($discount, 2) }} บาท</p>
                <p><strong>ราคาสุทธิ:</strong> {{ number_format($final_cost, 2) }} บาท</p>
                @else
                <p><strong>ไม่มีส่วนลด</strong></p>
                @endif
            </div>
            @endforeach
            @else
            <p>ไม่มีข้อมูลการจอง</p>
            @endif
        </div>

        <!-- Promotion Information -->
        @if($booking->promotion)
        <div class="border border-gray-300 rounded-lg p-6 shadow-md">
            <h2 class="text-2xl font-semibold mb-4">โปรโมชั่น</h2>
            <p><strong>ชื่อแคมเปญ:</strong> {{ $booking->promotion->campaign_name }}</p>
            <p><strong>รหัสโปรโมชั่น:</strong> {{ $booking->promotion->promo_code }}</p>
            <p><strong>ส่วนลด:</strong> {{ $booking->promotion->discount_percentage }}%</p>
        </div>
        @else
        <div class="border border-gray-300 rounded-lg p-6 shadow-md">
            <p>ไม่มีโปรโมชั่นสำหรับการจองนี้</p>
        </div>
        @endif

        <!-- Check-in Information -->
        @if($booking->checkin)
        <div class="border border-gray-300 rounded-lg p-6 shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Check-in Information</h2>
            <p><strong>Checked In By:</strong> {{ $booking->checkin->name }}</p>
            <p><strong>Check-in Date:</strong> {{ $booking->checkin->checkin }}</p>
            <p><strong>ID Card:</strong> {{ $booking->checkin->id_card }}</p>
            <p><strong>Address:</strong> {{ $booking->checkin->address }}</p>
            <p><strong>Phone:</strong> {{ $booking->checkin->phone }}</p>
            <p><strong>Province:</strong> {{ $booking->checkin->province }}</p>
            <p><strong>District:</strong> {{ $booking->checkin->district }}</p>
            <p><strong>Sub District:</strong> {{ $booking->checkin->sub_district }}</p>
            <p><strong>Postcode:</strong> {{ $booking->checkin->postcode }}</p>
        </div>
        @endif

        <!-- Checkout Information -->
        @if($booking->checkout)
        <div class="border border-gray-300 rounded-lg p-6 shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Checkout Information</h2>
            <p><strong>Checked Out By:</strong> {{ $booking->checkout->checked_out_by }}</p>
            <p><strong>Checkout Date:</strong> {{ $booking->checkout->checkout }}</p>
            <p><strong>Total Damages:</strong> {{ number_format($booking->checkout->total_damages, 2) }} บาท</p>
        </div>
        @endif

        <!-- Checkout Details -->
        @if($booking->checkoutDetails->isNotEmpty())
        <div class="border border-gray-300 rounded-lg p-6 shadow-md">
            <h2 class="text-2xl font-semibold mb-4">Checkout Details</h2>
            <table class="min-w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 border">Product Room ID</th>
                        <th class="px-4 py-2 border">Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($booking->checkoutDetails as $checkoutDetail)
                    <tr class="hover:bg-gray-100">
                        <td class="px-4 py-2 border">{{ $checkoutDetail->product_room_id }}</td>
                        <td class="px-4 py-2 border">{{ number_format($checkoutDetail->total_price, 2) }} บาท</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p>ไม่มีข้อมูลการเช็คเอาท์</p>
        @endif
    </div>
</div>