<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            font-family: 'Roboto', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            text-align: center;
            padding: 20px;
            max-width: 600px;
        }

        h1 {
            font-size: 8rem;
            font-weight: 700;
            margin-bottom: 20px;
            animation: fadeInDown 1s;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 30px;
            animation: fadeInDown 1.2s;
        }

        p {
            font-size: 1.2rem;
            margin-bottom: 40px;
            animation: fadeInDown 1.4s;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            background-color: #fff;
            color: #764ba2;
            border-radius: 50px;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 700;
            transition: background-color 0.3s, color 0.3s;
            animation: fadeInUp 1.6s;
        }

        .btn:hover {
            background-color: #764ba2;
            color: #fff;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 6rem;
            }

            h2 {
                font-size: 1.8rem;
            }

            p {
                font-size: 1rem;
            }

            .btn {
                padding: 12px 25px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>403</h1>
        <h2>Akses Ditolak</h2>
        <p>Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.</p>
        <a href="/" class="btn">Kembali ke Beranda</a>
    </div>
</body>
</html>
