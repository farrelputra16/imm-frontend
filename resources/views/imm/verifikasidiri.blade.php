
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>IMM | Verifikasi</title>    <link rel="icon" href="/images/imm.png" type="image/png">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/imm/verifikasidiri.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>

    <div class="login-container">
        <div class="login-form">
            <h2>Verifikasi Diri Anda</h2> <div class="notification" id="notification"></div>
            <form id="verificationForm" method="POST" action="{{ route('send-otp') }}">
                @csrf
                <table>
                    <tr>
                        <td><span class="input-icon"><i class="fas fa-envelope"></i></span></td>
                        <td><input type="email" placeholder="Masukkan Email" id="email" name="email" required /></td>
                    </tr>
                    <tr>
                        <td><span class="input-icon"><i class="fas fa-phone"></i></span></td>
                        <td><input type="number" class="telepon" placeholder="Masukkan telepon" id="telepon" name="telepon" required pattern="[0-9]*" inputmode="numeric" /></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><button class="btn-login" id="loginBtn" type="submit">Verifikasi</button><p id="sending" style="display: none; margin-top:15px;">Mengirim...</p></td> </table>

                    </tr>
               
               
            </form>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
              document.getElementById('telepon').addEventListener('input', function (event) {
            // Hanya memperbolehkan angka 0-9
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        document.getElementById('telepon').addEventListener('keypress', function (event) {
            // Mencegah masukan selain angka
            if (!/\d/.test(event.key)) {
                event.preventDefault();
            }
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const form = document.getElementById("verificationForm");
            const emailInput = document.getElementById("email");
            const teleponInput = document.getElementById("telepon");
            const notification = document.getElementById("notification");
            const sendingMessage = document.getElementById("sending");

            form.addEventListener("submit", function(e) {
                e.preventDefault();
                notification.style.display = "none";
                sendingMessage.style.display = "block";

                const email = emailInput.value;
                const telepon = teleponInput.value;

                fetch("/send-otp", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
                    },
                    body: JSON.stringify({ email: email, no_hp: telepon }), // Sesuaikan nama input
                })
                .then((response) => {
                    console.log("Response:", response); // Log respons
                    const contentType = response.headers.get("content-type");
                    if (!contentType || !contentType.includes("application/json")) {
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
                            window.location.href = `/kodeotp?email=${encodeURIComponent(email)}&telepon=${encodeURIComponent(telepon)}`;
                        }, 5000);
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
    </script>

</body>

</html>
