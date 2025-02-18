<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>จัดการประเภทการชำระเงิน</title>
    <script src="https://kit.fontawesome.com/a7046885ac.js" crossorigin="anonymous"></script>

</head>

<body>
    <div style="display: flex; background-color: #F5F3FF;">
        @include('components.admin_sidebar')

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
            <div class="container mx-auto px-6 py-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-3xl font-medium text-gray-700">จัดการประเภทการชำระเงิน</h3>
                </div>

                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                            <form action="#" method="GET" class="w-full md:w-auto mb-4 md:mb-0">
                                @csrf
                                <div class="relative">
                                    <input type="text" name="search" placeholder="ค้นหาประเภทการชำระเงิน"
                                        class="w-full md:w-80 pl-10 pr-4 py-2 rounded-lg border focus:border-blue-300 focus:outline-none focus:shadow-outline">
                                    <div class="absolute top-1/2 left-3 transform -translate-y-1/2">
                                        <i class="fas fa-search text-gray-400"></i>
                                    </div>
                                </div>
                            </form>
                            <button onclick="openModal()"
                                class="bg-indigo-600 text-white px-6 py-2 rounded-lg hover:bg-indigo-700 focus:outline-none focus:shadow-outline transition duration-300 ease-in-out transform hover:-translate-y-1 hover:scale-110">
                                <i class="fas fa-plus mr-2"></i>เพิ่มประเภทการชำระเงิน
                            </button>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <thead>
                                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                        <th class="py-3 px-6 text-center">ลำดับ</th>
                                        <th class="py-3 px-6 text-center">ประเภทการชำระเงิน</th>
                                        <th class="py-3 px-6 text-center">QR Code</th>
                                        <th class="py-3 px-6 text-center">ดำเนินการ</th>
                                    </tr>
                                </thead>
                                <tbody class="text-gray-600 text-sm">
                                    @foreach ($payment_types as $index => $paymentType)
                                        <tr
                                            class="border-b border-gray-200 hover:bg-gray-100 transition duration-300 ease-in-out">
                                            <td class="py-3 px-6 text-center whitespace-nowrap">{{ $index + 1 }}</td>
                                            <td class="py-3 px-6 text-center">
                                                @if ($paymentType->payment_type === 'bank_transfer')
                                                    โอนเงิน
                                                @else
                                                    เงินสด
                                                @endif
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                @if ($paymentType->qr_code)
                                                    <img src="{{ asset('storage/' . $paymentType->qr_code) }}"
                                                        class="w-12 h-12 mx-auto">
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td class="py-3 px-6 text-center">
                                                <div class="flex items-center justify-center">
                                                    <button
                                                        onclick="openEditModal('{{ $paymentType->id }}', '{{ $paymentType->payment_type }}', '{{ $paymentType->qr_code ? asset('storage/' . $paymentType->qr_code) : null }}')"
                                                        class="text-black hover:text-blue-500 mr-3">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                    <form
                                                        action="{{ route('payment_types.destroy', $paymentType->id) }}"
                                                        method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-black hover:text-red-500"
                                                            onclick="return confirm('ยืนยันการลบ?')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </button>
                                                    </form>
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

    <!-- Modal เพิ่มประเภทการชำระเงิน -->
    <div id="addPaymentTypeModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-lg font-semibold mb-4">เพิ่มประเภทการชำระเงิน</h2>
            <form action="{{ route('payment_types.store') }}" method="POST" enctype="multipart/form-data"
                onsubmit="return validatePaymentType()">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700">เลือกประเภทการชำระเงิน:</label>
                    <select name="payment_type" required id="paymentTypeName"
                        class="w-full px-3 py-2 border rounded-lg">
                        <option value="bank_transfer">โอนเงิน</option>
                        <option value="cash">เงินสด</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700">QR Code (ถ้ามี):</label>
                    <input type="file" name="qr_code" accept="image/*" class="w-full border p-2 rounded-lg">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-400 text-white rounded-lg mr-2">ยกเลิก</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">เพิ่มข้อมูล</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal แก้ไขประเภทการชำระเงิน -->
    <div id="editPaymentTypeModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-96">
            <h2 class="text-lg font-semibold mb-4">แก้ไขประเภทการชำระเงิน</h2>
            <form action="{{ route('payment_types.update', '') }}" method="POST" enctype="multipart/form-data"
                id="editPaymentTypeForm">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="editPaymentTypeId">
                <div class="mb-4">
                    <label class="block text-gray-700">เลือกประเภทการชำระเงิน:</label>
                    <select name="payment_type" required id="editPaymentTypeSelect"
                        class="w-full px-3 py-2 border rounded-lg">
                        <option value="bank_transfer"
                            {{ $paymentType->payment_type == 'bank_transfer' ? 'selected' : '' }}>
                            โอนเงิน
                        </option>
                        <option value="cash" {{ $paymentType->payment_type == 'cash' ? 'selected' : '' }}>
                            เงินสด
                        </option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700">QR Code (ถ้ามี):</label>
                    <input type="file" name="qr_code" id="editPaymentTypeQRCode" accept="image/*"
                        class="w-full border p-2 rounded-lg">
                    <div id="currentQRCode" class="mt-2"></div>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-400 text-white rounded-lg mr-2">ยกเลิก</button>
                    <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg">บันทึกการเปลี่ยนแปลง</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(id, paymentType, qrCode) {
            // เปิด Modal
            document.getElementById('editPaymentTypeModal').classList.remove('hidden');

            // กำหนดค่า id
            document.getElementById('editPaymentTypeId').value = id;

            // กำหนดค่าเดิมให้กับ select dropdown
            const selectElement = document.getElementById('editPaymentTypeSelect');
            selectElement.value = paymentType;

            // อัพเดท action URL
            document.getElementById('editPaymentTypeForm').action = `/payment_types/${id}`;

            // แสดง QR Code ถ้ามี
            const currentQRCode = document.getElementById('currentQRCode');
            if (qrCode && qrCode !== 'null') {
                currentQRCode.innerHTML = `
            <div class="text-sm text-gray-600 mb-2">QR Code ปัจจุบัน:</div>
            <img src="${qrCode}" class="w-32 h-32 mx-auto mb-2">
        `;
            } else {
                currentQRCode.innerHTML = '<div class="text-sm text-gray-600">ไม่มี QR Code</div>';
            }
        }

        function closeModal() {
            document.getElementById('addPaymentTypeModal').classList.add('hidden');
            document.getElementById('editPaymentTypeModal').classList.add('hidden');
        }

        function openModal() {
            document.getElementById('addPaymentTypeModal').classList.remove('hidden');
        }

        function validatePaymentType() {
            const paymentType = document.querySelector('#addPaymentTypeModal select[name="payment_type"]').value;
            const qrCode = document.querySelector('#addPaymentTypeModal input[name="qr_code"]').files[0];

            if (paymentType === 'bank_transfer' && !qrCode) {
                alert('กรุณาอัปโหลด QR Code สำหรับการโอนเงิน');
                return false;
            }

            return true;
        }

        function validateEditForm() {
            const paymentType = document.getElementById('editPaymentTypeSelect').value;
            const qrInput = document.getElementById('editPaymentTypeQRCode');
            const currentQRCode = document.getElementById('currentQRCode');

            if (paymentType === 'bank_transfer' && !qrInput.files[0] && !currentQRCode.querySelector('img')) {
                alert('กรุณาอัปโหลด QR Code สำหรับการโอนเงิน');
                return false;
            }
            return true;
        }
    </script>

</body>

</html>
