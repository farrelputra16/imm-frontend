<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #5940CB;
            color: #ffffff;
            padding: 10px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 20px;
            color: #333333;
        }
        .footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #777777;
        }
    </style>
    <title>Laporan Keuangan Perusahaan</title>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Laporan Keuangan Perusahaan</h1>
        </div>
        <div class="content">
            <p>Yth. {{ $InvestorName }},</p> <!-- Tampilkan nama investor -->
            <p>Kami ingin menginformasikan bahwa ada pembaruan laporan keuangan untuk perusahaan <strong>{{ $Company }}</strong>.</p>
            <p>Berikut adalah detail laporan keuangan terbaru:</p>
            <ul>
                <li><strong>Kuartal:</strong> {{ $Quarter }}</li>
                <li><strong>Tahun:</strong> {{ $Year }}</li>
                <li><strong>Total Pendapatan:</strong> Rp {{ $TotalPendapatan }}</li>
                <li><strong>Laba Kotor:</strong> Rp {{ $LabaKotor }}</li>
                <li><strong>Laba Bersih:</strong> Rp {{ $LabaBersih }}</li>
            </ul>
            <p>Terima kasih atas dukungan dan kepercayaan Anda terhadap perusahaan kami. Kami akan terus berupaya untuk memberikan yang terbaik.</p>
            <p>Salam hangat,</p>
            <p><strong>Tim Impact Management Measurement</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Platform IMM (Impact Management Measurement). Semua hak dilindungi.</p>
        </div>
    </div>
</body>
</html>
