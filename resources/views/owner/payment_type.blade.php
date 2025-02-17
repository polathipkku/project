<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>จัดการประเภทการชำระเงิน</title>
</head>

<body class="bg-gray-100">
    <div class="flex">
        @include('components.admin_sidebar')

        <main class="flex-1 p-6">
            <h3 class="text-3xl font-medium text-gray-700 mb-6">จัดการประเภทการชำระเงิน</h3>
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <button onclick="openModal()" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                        + เพิ่มประเภทการชำระเงิน
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full border border-gray-200 text-center">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600">
                                <th class="py-3 px-6">ลำดับ</th>
                                <th class="py-3 px-6">ประเภทการชำระเงิน</th>
                                <th class="py-3 px-6">QR Code</th>
                                <th class="py-3 px-6">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @foreach ($payment_types as $index => $paymentType)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6">{{ $index + 1 }}</td>
                                    <td class="py-3 px-6">{{ $paymentType->payment_type }}</td>
                                    <td class="py-3 px-6">
                                        @if ($paymentType->qr_code)
                                            <img src="{{ asset('storage/' . $paymentType->qr_code) }}" class="w-12 h-12 mx-auto">
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="py-3 px-6">
                                        <a href="{{ url('/payment_types/edit/' . $paymentType->id) }}" class="text-yellow-500 mr-3">✏️</a>
                                        <a href="{{ url('/payment_types/delete/' . $paymentType->id) }}" class="text-red-500">🗑️</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <!-- Modal สำหรับเพิ่มประเภทการชำระเงิน -->
    <div id="addPaymentTypeModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-lg font-semibold mb-4">เพิ่มประเภทการชำระเงิน</h2>
            <form action="{{ route('payment_types.store') }}" method="POST" enctype="multipart/form-data" id="paymentForm">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">ชื่อประเภทการชำระเงิน:</label>
                    <input type="text" name="payment_type" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-300">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">QR Code (ถ้ามี):</label>
                    <input type="file" name="qr_code" accept="image/*" class="w-full border p-2 rounded-lg">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-400 text-white rounded-lg mr-2">ยกเลิก</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">เพิ่มข้อมูล</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript เปิด/ปิด Modal และแจ้งเตือน -->
    <script>

        
        function openModal() {
            document.getElementById('addPaymentTypeModal').classList.remove('hidden');
        }
        function closeModal() {
            document.getElementById('addPaymentTypeModal').classList.add('hidden');
        }
    </script>
</body>
</html>
