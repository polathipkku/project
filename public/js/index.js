const sideMenu = document.querySelector('aside');
const menuBtn = document.getElementById('menu-btn');
const closeBtn = document.getElementById('close-btn');

const darkMode = document.querySelector('.dark-mode');

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
});

darkMode.addEventListener('click', () => {
    document.body.classList.toggle('dark-mode-variables');
    darkMode.querySelector('span:nth-child(1)').classList.toggle('active');
    darkMode.querySelector('span:nth-child(2)').classList.toggle('active');
})


Orders.forEach(order => {
    const tr = document.createElement('tr');
    const trContent = `
        <td>${order.productName}</td>
        <td>${order.productNumber}</td>
        <td>${order.paymentStatus}</td>
        <td class="${order.status === 'Declined' ? 'danger' : order.status === 'Pending' ? 'warning' : 'primary'}">${order.status}</td>
        <td class="primary">Details</td>
    `;
    tr.innerHTML = trContent;
    document.querySelector('table tbody').appendChild(tr);
});

// index.js

document.addEventListener("DOMContentLoaded", function () {
    // Check if there is a hash fragment (room number) in the URL
    if (window.location.hash) {
        // Extract room number from the hash
        var roomNumber = window.location.hash.substring(1);
        // Display room details
        displayRoomDetails(roomNumber);
    }
});

function goBack() {
    window.history.back();
}
// index.js in room_detail.html

document.addEventListener("DOMContentLoaded", function () {
    // Get the room number from the query parameters
    var roomNumber = getQueryParam("roomNumber");

    // Call your API or get data from your storage based on the room number
    var roomData = getRoomDataByNumber(roomNumber);

    if (roomData) {
        displayRoomDetails(roomData);
    } else {
        console.error("Room data not available.");
    }
});

function displayRoomDetails(roomNumber) {
    // Call your API or get data from your storage based on the room number
    var roomData = getRoomDataByNumber(roomNumber);

    if (roomData) {
        document.getElementById("roomNumber").innerText = roomData.roomNumber;
        document.getElementById("roomName").innerText = roomData.roomName;
        // Update other elements with data
    } else {
        console.error("Room data not available.");
    }
}

function getRoomDataByNumber(roomNumber) {
    // Replace this with actual data retrieval logic
    // Example data:
    return {
        roomNumber: roomNumber,
        roomName: "Standard Room",
        // Add other room details
    };
}
