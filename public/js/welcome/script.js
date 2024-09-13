document.addEventListener("DOMContentLoaded", function () {
    const notificationSection = document.querySelector(".notification-section");
    const dropdownContent = document.getElementById("dropdownContent");

    notificationSection.addEventListener("click", function () {
        this.classList.toggle("active");
    });

    window.addEventListener("click", function (event) {
        if (!notificationSection.contains(event.target)) {
            notificationSection.classList.remove("active");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const calendar = document.getElementById("calendar");
    const currentDate = new Date();
    const currentMonth = currentDate.getMonth();
    const currentYear = currentDate.getFullYear();
    const currentDay = currentDate.getDate(); // Mendapatkan tanggal saat ini

    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

    let calendarHTML = `<div class="calendar-header">${getMonthName(
        currentMonth
    )} ${currentYear}</div>`;
    calendarHTML += "<table class='calendar-table'><tr>";

    for (let i = 1; i <= daysInMonth; i++) {
        if (i % 7 === 1 && i !== 1) {
            calendarHTML += "</tr><tr>";
        }
        calendarHTML += `<td class="calendar-day${
            i === currentDay ? " current-day" : ""
        }">${i}</td>`;
    }
    calendarHTML += "</tr></table>";

    calendar.innerHTML = calendarHTML;
});

function getMonthName(monthIndex) {
    const monthNames = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December",
    ];
    return monthNames[monthIndex];
}
document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        var loading = document.getElementById("loading");
        loading.style.display = "none"; // Menghilangkan efek loading setelah waktu tunggu
    }, 2000); // 3000 milidetik = 3 detik
});
