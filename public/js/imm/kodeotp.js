document.addEventListener("DOMContentLoaded", function() {
    const inputs = document.querySelectorAll(".verification-code input");
    inputs.forEach((input, index) => {
        input.addEventListener("input", () => {
            if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        input.addEventListener("keydown", (e) => {
            if (e.key === "Backspace" && index > 0 && !input.value) {
                inputs[index - 1].focus();
            }
        });
    });

    inputs[0].focus();

    // Countdown Timer
    let timeLeft = 60;
    const countdownElement = document.getElementById("countdown");

    const countdownInterval = setInterval(() => {
        if (timeLeft <= 0) {
            clearInterval(countdownInterval);
            countdownElement.textContent = "0:00";
        } else {
            timeLeft--;
            let minutes = Math.floor(timeLeft / 60);
            let seconds = timeLeft % 60;
            countdownElement.textContent = `${minutes}:${
                seconds < 10 ? "0" : ""
            }${seconds}`;
        }
    }, 1000);

    // Function to check if all verification code inputs are filled
    function checkVerificationCode() {
        let filled = true;
        inputs.forEach((input) => {
            if (input.value === "") {
                filled = false;
            }
        });
        return filled;
    }

    // Function to handle the resend button click
    document
        .querySelector(".btn-resend")
        .addEventListener("click", function() {
            // Implement here the logic to resend the verification code
            // For now, let's just reset the countdown timer to 1 minute
            timeLeft = 60;
            countdownElement.textContent = "1:00";
            clearInterval(countdownInterval);
            countdownInterval = setInterval(() => {
                if (timeLeft <= 0) {
                    clearInterval(countdownInterval);
                    countdownElement.textContent = "0:00";
                } else {
                    timeLeft--;
                    let minutes = Math.floor(timeLeft / 60);
                    let seconds = timeLeft % 60;
                    countdownElement.textContent = `${minutes}:${
                        seconds < 10 ? "0" : ""
                    }${seconds}`;
                }
            }, 1000);
            document.getElementById("notification").textContent =
                "Kode OTP berhasil dikirim ke WhatsApp Anda!";
        });

    inputs.forEach((input) => {
        input.addEventListener("input", function() {
            if (checkVerificationCode()) {
                document.getElementById("notification").textContent =
                    "Verifikasi berhasil!";
                // Implement here the redirection to the new page
                setTimeout(() => {
                    window.location.href = "pendaftaranperusahaan";
                }, 2000);
            }
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    setTimeout(function() {
        var loading = document.getElementById("loading");
        loading.style.display = "none"; // Menghilangkan efek loading setelah waktu tunggu
    }, 1000);
});