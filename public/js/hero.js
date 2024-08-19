// เมื่อเอกสารถูกโหลดเสร็จสิ้น

document.addEventListener("DOMContentLoaded", function () {
  const bookingBtn = document.getElementById('booking-btn');
  const sidebar = document.getElementById('sidebar');
  const backdrop = document.getElementById('backdrop');

  // เมื่อคลิกที่ปุ่ม booking-btn ให้สลับแสดง/ซ่อน sidebar และ backdrop
  bookingBtn.addEventListener('click', function (event) {
    sidebar.classList.toggle('sidebar-hidden');
    sidebar.classList.toggle('sidebar-visible');
    backdrop.classList.toggle('backdrop-hidden');
    backdrop.classList.toggle('backdrop-visible');
    event.stopPropagation();
  });

  // ฟังก์ชันเพื่อปิด sidebar เมื่อคลิกนอก sidebar หรือปุ่ม booking-btn
  const closeSidebar = (event) => {
    if (!sidebar.contains(event.target) && !bookingBtn.contains(event.target)) {
      sidebar.classList.add('sidebar-hidden');
      sidebar.classList.remove('sidebar-visible');
      backdrop.classList.add('backdrop-hidden');
      backdrop.classList.remove('backdrop-visible');
    }
  };

  // เมื่อคลิกที่เอกสาร ให้เรียกฟังก์ชัน closeSidebar
  document.addEventListener('click', closeSidebar);
});

// เมื่อเอกสารถูกโหลดเสร็จสิ้น
document.addEventListener("DOMContentLoaded", function () {
  const header = document.querySelector('header');
  const mail = document.getElementById('mail');

  // เมื่อเลื่อนหน้าเอกสาร
  document.addEventListener('scroll', function () {
    var scrollPosition = window.scrollY;

    // ซ่อน mail ถ้าเลื่อนหน้าจอเกิน 25px
    if (scrollPosition > 25) {
      mail.style.top = `-${mail.offsetHeight}px`;
    } else {
      mail.style.top = '0';
    }

    // ปรับตำแหน่ง header ตามการเลื่อนหน้า
    if (scrollPosition > 25) {
      header.style.top = '0';
    } else {
      header.style.top = '20px'; // ปรับ header ให้เลื่อนลงมา 20px เมื่อ scroll น้อยกว่า 25
    }
  });
});

// ฟังก์ชันแสดงฟอร์มล็อกอิน
function showLoginForm() {
  var loginForm = document.getElementById("loginForm");
  loginForm.classList.remove("hidden");
  hideRegisterForm();
  window.location.href = "#";
}

// ฟังก์ชันซ่อนฟอร์มล็อกอิน
function hideLoginForm() {
  var loginForm = document.getElementById("loginForm");
  loginForm.classList.add("hidden");
}

// ฟังก์ชันแสดงฟอร์มสมัครสมาชิก
function showRegisterForm() {
  hideLoginForm();
  var registerForm = document.getElementById("registerForm");
  registerForm.classList.remove("hidden");
}

// ฟังก์ชันซ่อนฟอร์มสมัครสมาชิก
function hideRegisterForm() {
  var registerForm = document.getElementById("registerForm");
  registerForm.classList.add("hidden");
}



// เมื่อคลิกปุ่ม selfBookingBtn ให้แสดงฟอร์ม selfBookingForm และซ่อนฟอร์ม otherBookingForm
document.getElementById('selfBookingBtn').addEventListener('click', function (event) {
  event.preventDefault();
  document.getElementById('selfBookingForm').style.display = 'block';
  document.getElementById('otherBookingForm').style.display = 'none';
});

// เมื่อคลิกปุ่ม otherBookingBtn ให้แสดงฟอร์ม otherBookingForm และซ่อนฟอร์ม selfBookingForm
document.getElementById('otherBookingBtn').addEventListener('click', function (event) {
  event.preventDefault();
  document.getElementById('selfBookingForm').style.display = 'none';
  document.getElementById('otherBookingForm').style.display = 'block';
});

// ตรวจสอบคลิกนอกเมนู dropdown และปิดเมนู dropdown
// document.addEventListener("click", function (event) {
//   var profileButton = document.getElementById("profileButton");
//   var profileDropdown = document.getElementById("profileDropdown");

//   // ตรวจสอบว่าคลิกที่ปุ่มโปรไฟล์หรือไม่
//   var isProfileButtonClicked = profileButton.contains(event.target);

//   // ตรวจสอบว่าเมนู dropdown ถูกเปิดอยู่หรือไม่
//   var isDropdownOpen = !profileDropdown.classList.contains("hidden");

//   // ถ้าคลิกที่อื่นๆ และเมนู dropdown ไม่ถูกเปิดอยู่ให้ปิดเมนู dropdown
//   if (!isProfileButtonClicked && isDropdownOpen) {
//     profileDropdown.classList.add("hidden");
//   }
// });

// // เมื่อคลิกที่ปุ่มโปรไฟล์
// document.getElementById("profileButton").addEventListener("click", function (event) {
//   var profileDropdown = document.getElementById("profileDropdown");
//   profileDropdown.classList.toggle("hidden"); // เปิดหรือปิดเมนู dropdown
//   event.stopPropagation(); // ไม่ให้การคลิกที่ปุ่มแพร่กระจายไปยังโค้ดด้านบน
// });

// เมื่อเอกสารถูกโหลดเสร็จสิ้น
document.addEventListener('DOMContentLoaded', () => {
  const selfBookingBtn = document.getElementById('selfBookingBtn');
  const otherBookingBtn = document.getElementById('otherBookingBtn');
  const selfBookingForm = document.getElementById('selfBookingForm');
  const otherBookingForm = document.getElementById('otherBookingForm');

  // กำหนดสถานะเริ่มต้น
  selfBookingBtn.classList.add('bg-blue-500', 'text-white');
  otherBookingBtn.classList.add('bg-white', 'text-blue-500');
  selfBookingForm.style.display = 'block';
  otherBookingForm.style.display = 'none';

  // เมื่อคลิกปุ่ม selfBookingBtn ให้เปลี่ยนสีและแสดงฟอร์ม selfBookingForm
  selfBookingBtn.addEventListener('click', () => {
    selfBookingBtn.classList.add('bg-blue-500', 'text-white');
    selfBookingBtn.classList.remove('bg-white', 'text-blue-500');
    otherBookingBtn.classList.add('bg-white', 'text-blue-500');
    otherBookingBtn.classList.remove('bg-blue-500', 'text-white');
    selfBookingForm.style.display = 'block';
    otherBookingForm.style.display = 'none';
  });

  // เมื่อคลิกปุ่ม otherBookingBtn ให้เปลี่ยนสีและแสดงฟอร์ม otherBookingForm
  otherBookingBtn.addEventListener('click', () => {
    otherBookingBtn.classList.add('bg-blue-500', 'text-white');
    otherBookingBtn.classList.remove('bg-white', 'text-blue-500');
    selfBookingBtn.classList.add('bg-white', 'text-blue-500');
    selfBookingBtn.classList.remove('bg-blue-500', 'text-white');
    otherBookingForm.style.display = 'block';
    selfBookingForm.style.display = 'none';
  });
});
document.addEventListener('DOMContentLoaded', function () {
  var valuestartdate = document.getElementById('startDate');
  var valueenddate = document.getElementById('endDate');
  var totalDay = document.getElementById('totalDay');
  var checkinInput = document.getElementById('checkin_date');
  var checkoutDateInput = document.getElementById('checkout_date');
  var reserveButton = document.getElementById('reserve-button');

  flatpickr(checkinInput, {
    dateFormat: 'Y-m-d',
    locale: 'th',
    minDate: 'today',
    mode: 'range',
    maxDate: new Date().fp_incr(30),
    onChange: function (array, str, instance) {
      if (array.length === 2) {
        var startDate = array[0];
        var endDate = array[1];

        var strStartDate = instance.formatDate(startDate, 'Y-m-d');
        var strEndDate = instance.formatDate(endDate, 'Y-m-d');

        valuestartdate.value = strStartDate;
        valueenddate.value = strEndDate;
        checkoutDateInput.value = strEndDate;

        var timeDiff = endDate - startDate;
        var totalDays = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
        totalDay.value = totalDays;

        checkinInput.value = strStartDate;
      }
    }
  });

  window.getAvailableRooms = function () {
    var startDate = valuestartdate.value;
    var endDate = valueenddate.value;
    if (startDate && endDate) {
      fetch(`/check-availability?startDate=${startDate}&endDate=${endDate}`)
        .then(response => response.json())
        .then(data => {
          var roomAvailabilityDiv = document.querySelector('#room-availability .flex-1');
          roomAvailabilityDiv.innerHTML = ''; // Clear existing content

          if (data.availableRooms.length > 0) {
            document.getElementById('room-availability').style.display = 'flex';
            document.getElementById('no-availability').style.display = 'none';

            // Generate summary of available rooms
            var totalRooms = data.availableRooms.length;
            var roomSummary = `
                  <h3>ห้องพักที่ว่าง</h3>
                  <p>จำนวนห้องที่ว่าง: ${totalRooms} ห้อง</p>
                  <p>ราคา: 500 บาท/คืน</p>
                  <p>รายละเอียด: ห้องพัก เตียงนุ่ม อยู่สบาย</p>
                  <p>ฟรี WIFI แอร์เย็นสบาย</p>
                  <p>ประเภทห้อง: เตียงคิงไซต์</p>
                  <a id="reserve-button" href="#" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-400 focus:outline-none focus:bg-yellow-600">
                      จองห้องพัก!
                  </a>
              `;
            roomAvailabilityDiv.innerHTML = roomSummary;

            // อัปเดต URL ของปุ่มจองห้องพักด้วยค่าที่ผู้ใช้กรอก
            var reserveUrl = "{{ route('reserve') }}" + "?checkin_date=" + encodeURIComponent(startDate) + "&checkout_date=" + encodeURIComponent(endDate);
            document.getElementById('reserve-button').href = reserveUrl;
          } else {
            document.getElementById('room-availability').style.display = 'none';
            document.getElementById('no-availability').style.display = 'flex';
          }
        })
        .catch(error => console.error('Error fetching available rooms:', error));
    }
  }
});