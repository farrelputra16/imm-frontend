// public/js/otp.js

document.getElementById("sendOtpBtn").addEventListener("click", function () {
    const email = document.getElementById("email").value;
    const telepon = document.getElementById("telepon").value;

    fetch("/send-otp", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify({ email: email, telepon: telepon }),
    })
    .then((response) => response.json())
    .then((data) => {
        document.getElementById("notification").innerText = data.message;
    })
    .catch((error) => console.error("Error:", error));
});

document.getElementById("verifyOtpBtn").addEventListener("click", function () {
    const email = document.getElementById("email").value;
    const otp = [
        document.getElementById("digit1").value,
        document.getElementById("digit2").value,
        document.getElementById("digit3").value,
        document.getElementById("digit4").value,
        document.getElementById("digit5").value,
    ].join("");

    fetch("/verify-otp", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        },
        body: JSON.stringify({ email: email, otp: otp }),
    })
        .then((response) => response.json())
        .then((data) => {
            alert(data.message);
        })
        .catch((error) => console.error("Error:", error));
});

document.addEventListener("DOMContentLoaded", function () {
    setTimeout(function () {
        var loading = document.getElementById("loading");
        loading.style.display = "none"; // Menghilangkan efek loading setelah waktu tunggu
    }, 1000); // 3000 milidetik = 3 detik
});
