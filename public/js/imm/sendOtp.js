document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById("verificationForm");
    const emailInput = document.getElementById("email");
    const teleponInput = document.getElementById("telepon");
    const notification = document.getElementById("notification");

    form.addEventListener("submit", function(e) {
        e.preventDefault();
        notification.style.display = "none";

        const email = emailInput.value;
        const telepon = teleponInput.value;

        fetch("/send-otp", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                },
                body: JSON.stringify({ email: email, telepon: telepon }),
            })
            .then((response) => {
                // Cek apakah respons adalah HTML
                const contentType = response.headers.get("content-type");
                if (contentType && contentType.includes("text/html")) {
                    throw new Error("Unexpected response format: HTML received instead of JSON");
                }
                return response.json();
            })
            .then((data) => {
                if (data.success) {
                    notification.textContent = "Kode OTP telah dikirim ke email Anda.";
                    notification.style.color = "green";
                    notification.style.display = "block";
                    setTimeout(function() {
                        notification.style.display = "none";
                        // Arahkan ke halaman baru setelah notifikasi disembunyikan
                        window.location.href = `/kodeotp?email=${encodeURIComponent(email)}&telepon=${encodeURIComponent(telepon)}`;
                    }, 5000); // Notifikasi akan disembunyikan setelah 5 detik (5000 milidetik)
                } else {
                    notification.textContent = "Verifikasi gagal.";
                    notification.style.color = "red";
                    notification.style.display = "block";
                }
            })
            .catch((error) => {
                notification.textContent = error.message;
                notification.style.color = "red";
                notification.style.display = "block";
            });
    });
});