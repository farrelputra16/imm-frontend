function showNotification() {
    // Tampilkan notifikasi setelah tombol Masuk diklik
    var notification = document.getElementById("notification");
    notification.style.display = "block";

    // Sembunyikan notifikasi setelah beberapa detik
    setTimeout(function() {
        notification.style.display = "none";
    }, 5000); // Notifikasi akan disembunyikan setelah 5 detik (5000 milidetik)
}

// Menambahkan event listener untuk tombol "Masuk"
document.getElementById("loginBtn").addEventListener("click", showNotification);

function showNotification() {
    // Tampilkan notifikasi setelah tombol Masuk diklik
    var notification = document.getElementById("notification");
    notification.style.display = "block";

    // Sembunyikan notifikasi setelah beberapa detik
    setTimeout(function() {
        notification.style.display = "none";

        // Arahkan ke halaman baru setelah notifikasi disembunyikan
        window.location.href = "kodeotp"; // Ganti "halaman-baru.html" dengan URL tujuan Anda
    }, 5000); // Notifikasi akan disembunyikan setelah 5 detik (5000 milidetik)
}

// Menambahkan event listener untuk tombol "Masuk"
document.getElementById("loginBtn").addEventListener("click", showNotification);

document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        var loading = document.getElementById("loading");
        loading.style.display = "none"; // Menghilangkan efek loading setelah waktu tunggu
    }, 2000); // 3000 milidetik = 3 detik
});
