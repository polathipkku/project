<script>
    document.querySelector('meta[name="csrf-token"]').content;


    let currentBookingId;
    let totalAmount = 0;
    let customDamageIndex = 0;


    document.addEventListener("DOMContentLoaded", function() {
        window.customDamageIndex = 0;
        const damagedItemsForm = document.getElementById('damagedItemsForm');
        if (damagedItemsForm) {
            damagedItemsForm.addEventListener('submit', function(e) {
                e.preventDefault(); // ป้องกันการ submit form แบบปกติ
                updateTotalAmount(); // คำนวณยอดรวมก่อนแสดง popup ชำระเงิน
                document.getElementById('damagedItemsPopup').classList.add('hidden');
                const paymentMethodPopup = document.getElementById('paymentMethodPopup');
                if (paymentMethodPopup) {
                    paymentMethodPopup.classList.remove('hidden');
                    const paymentExtraCharge = document.getElementById('paymentExtraCharge');
                    if (paymentExtraCharge) {
                        paymentExtraCharge.innerHTML = `
                        <span class="text-xl font-bold text-gray-800">ยอดชำระทั้งหมด:</span> 
                        <span class="text-2xl font-extrabold text-red-600">฿${totalAmount.toFixed(2)}</span>
                    `;
                    }
                }
                return false;
            });
        }

        function addCustomDamageField() {
            const listContainer = document.getElementById('customDamagesList');
            if (!listContainer) {
                console.error("❌ ไม่พบ customDamagesList ใน DOM");
                return;
            }

            const container = document.createElement('div');
            container.className = 'bg-white p-4 rounded-lg shadow-sm hover:shadow-md transition';
            container.innerHTML = `
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">ชื่อรายการ</label>
                    <input type="text" 
                        name="custom_damages[${customDamageIndex}][name]"
                        class="w-full p-3 bg-gray-50 border border-gray-300 rounded-lg"
                        placeholder="ระบุชื่อรายการ" required>
                </div>
                <div class="w-32">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">ราคา</label>
                    <input type="number" 
                        name="custom_damages[${customDamageIndex}][price]"
                        class="w-full p-3 bg-gray-50 border border-gray-300 rounded-lg"
                        placeholder="ราคา" 
                        step="0.01" 
                        min="0"
                        required
                        onchange="updateTotalAmount()">
                </div>
                <div class="flex items-end">
                    <button type="button" 
                        class="p-3 text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors"
                        onclick="removeCustomDamage(this)">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        `;
            listContainer.appendChild(container);
            customDamageIndex++;
        }

        window.addCustomDamageField = addCustomDamageField;
    });

    // ลบรายการค่าเสียหายที่เพิ่มเอง
    function removeCustomDamage(button) {
        button.closest('.bg-white').remove();
        updateTotalAmount();
    }

    function updateTotalAmount() {
        totalAmount = 0;
        const selectedItems = document.querySelectorAll('input[name="damaged_items[]"]:checked');
        selectedItems.forEach(item => {
            const price = parseFloat(item.getAttribute('data-price'));
            if (!isNaN(price)) {
                totalAmount += price;
            }
        });
        // Update display of total amount
        const totalAmountDisplay = document.getElementById('totalAmountDisplay');
        if (totalAmountDisplay) {
            totalAmountDisplay.textContent = `ยอดรวม: ฿${totalAmount.toFixed(2)}`;
        }
    }

    // Handle Checkout flow
    function showCheckoutPopup(bookingId) {
        currentBookingId = bookingId;
        toggleModal('checkoutPopup', true);
    }

    function handleNotDamaged() {
        fetch('/checkout-user', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    booking_id: currentBookingId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('เช็คเอาท์สำเร็จ');
                    window.location.reload();
                } else {
                    alert(data.error || 'เกิดข้อผิดพลาด');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('เกิดข้อผิดพลาดในการเช็คเอาท์');
            });
        closeAllModals();
    }

    function closePopup() {
        document.getElementById('checkoutPopup').classList.add('hidden');
    }

    function closePopup2() {
        document.getElementById('damagedItemsPopup').classList.add('hidden');
    }

    function closePopup3() {
        document.getElementById('paymentMethodPopup').classList.add('hidden');
    }

    function showDamagedItemsPopup() {
        document.getElementById('damagedBookingId').value = currentBookingId;
        toggleModal('checkoutPopup', false);
        toggleModal('damagedItemsPopup', true);
    }

    function showPaymentMethodPopup() {
        updateTotalAmount(); // Ensure total is calculated
        toggleModal('damagedItemsPopup', false);
        toggleModal('paymentMethodPopup', true);

        // Update payment display
        const paymentExtraCharge = document.getElementById('paymentExtraCharge');
        if (paymentExtraCharge) {
            paymentExtraCharge.innerHTML =
                `<span class="text-xl font-bold text-gray-800">ยอดชำระทั้งหมด:</span> <span class="text-2xl font-extrabold text-red-600">฿${totalAmount.toFixed(2)}</span>`;
        }
    }

    function calculateChange() {
        const amountPaid = parseFloat(document.getElementById('amountPaid').value || 0);
        const warningMessage = document.getElementById('paymentWarning');
        const cashRefund = document.getElementById('cashRefund');

        if (!isNaN(amountPaid)) {
            const change = amountPaid - totalAmount;
            cashRefund.value = change > 0 ? change.toFixed(2) : '0.00';

            // Show or hide warning based on payment validation
            if (amountPaid < totalAmount) {
                warningMessage.classList.remove('hidden');
            } else {
                warningMessage.classList.add('hidden');
            }
        }
    }

    function toggleModal(modalId, show) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.toggle('hidden', !show);
        }
    }

    function confirmPayment() {
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
        const amountPaid = document.getElementById('amountPaid')?.value;
        const damagedItems = Array.from(document.querySelectorAll('input[name="damaged_items[]"]:checked'))
            .map(item => item.value);

        if (!paymentMethod) {
            alert('กรุณาเลือกวิธีการชำระเงิน');
            return;
        }

        if (paymentMethod === '2' && (!amountPaid || parseFloat(amountPaid) < totalAmount)) {
            alert('กรุณาระบุจำนวนเงินที่ได้รับให้ถูกต้อง');
            return;
        }

        const formData = {
            booking_id: currentBookingId,
            damaged_items: damagedItems,
            payment_method: paymentMethod === '1' ? 'transfer' : 'cash',
            amount_paid: amountPaid || 0,
            total_price: totalAmount
        };

        fetch('/submit-damaged-items', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('บันทึกข้อมูลเรียบร้อยแล้ว');
                    window.location.reload();
                } else {
                    alert(data.error || 'เกิดข้อผิดพลาด');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');
            });
    }

    // Utility functions
    function toggleModal(modalId, show = true) {
        document.getElementById(modalId).classList.toggle('hidden', !show);
    }

    function closeAllModals() {
        ['checkoutPopup', 'damagedItemsPopup', 'paymentMethodPopup'].forEach(modalId => {
            toggleModal(modalId, false);
        });
    }


    // Event listeners
    document.addEventListener('DOMContentLoaded', function() {
        // Damaged/Not damaged buttons
        document.getElementById('damagedButton')?.addEventListener('click', showDamagedItemsPopup);
        document.getElementById('notDamagedButton')?.addEventListener('click', handleNotDamaged);

        // Payment method selection
        document.getElementById('payment_cash')?.addEventListener('change', () => {
            document.getElementById('cashPaymentFields').classList.remove('hidden');
            document.getElementById('transferPaymentFields').classList.add('hidden');
        });

        document.getElementById('payment_transfer')?.addEventListener('change', () => {
            document.getElementById('cashPaymentFields').classList.add('hidden');
            document.getElementById('transferPaymentFields').classList.remove('hidden');
        });

        // Amount paid input
        document.getElementById('amountPaid')?.addEventListener('input', calculateChange);
    });
</script>