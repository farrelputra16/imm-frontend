document.addEventListener("DOMContentLoaded", function () {
    let secondsRemaining = 60;
    let countdownInterval;

    const startCountdown = () => {
        countdownInterval = setInterval(() => {
            if (secondsRemaining > 0) {
                secondsRemaining--;
                document.getElementById("seconds-remaining").innerText =
                    secondsRemaining;
            } else {
                clearInterval(countdownInterval);
            }
        }, 1000);
    };

    startCountdown();

    const otpInputs = document.querySelectorAll('input[name="otp_code[]"]');
    otpInputs.forEach((input, index) => {
        input.addEventListener("input", (e) => {
            if (isNaN(input.value)) {
                input.value = "";
                return;
            }
            if (input.nextElementSibling) {
                input.nextElementSibling.focus();
            }
        });
    });

    // Ambil parameter email dari URL
    const urlParams = new URLSearchParams(window.location.search);
    const email = urlParams.get("email");
    const telepon = urlParams.get("telepon");

    console.log(email);

    // Setel nilai email pada input tersembunyi
    // document.getElementById('email').value = email;

    document
        .getElementById("otp-form")
        .addEventListener("submit", function (e) {
            e.preventDefault();

            // Mengambil nilai dari input OTP
            const otpCode = Array.from(otpInputs)
                .map((input) => input.value)
                .join("");

            // Melakukan permintaan ke /verify-code untuk verifikasi OTP
            fetch("/verify-code", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    email: email, // pastikan 'email' didefinisikan
                    otp_code: otpCode,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    // Jika verifikasi berhasil, arahkan ke route pendaftaranperusahaan
                    if (data.success) {
                        window.location.href = `/pendaftaranperusahaan?email=${email}&telepon=${telepon}`;
                    } else {
                        // Jika gagal, tampilkan pesan kesalahan
                        document.getElementById("error-message").innerText =
                            data.message || "Verification failed";
                    }
                })
                .catch((error) => {
                    // Tangani error fetch
                    document.getElementById("error-message").innerText =
                        error.message;
                });
        });

    document
        .getElementById("resend-otp")
        .addEventListener("click", function () {
            fetch("/send-otp", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    email: email,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        document.getElementById("error-message").innerText =
                            "Kode OTP berhasil dikirim ulang";
                        secondsRemaining = 60;
                        clearInterval(countdownInterval);
                        startCountdown();
                    } else {
                        document.getElementById("error-message").innerText =
                            data.message || "Failed to resend OTP";
                    }
                })
                .catch((error) => {
                    document.getElementById("error-message").innerText =
                        error.message;
                });
        });
});
