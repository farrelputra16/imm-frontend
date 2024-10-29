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
        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 0;
            background-color: #5940CB;
            color: #ffffff; /* Ubah warna teks menjadi putih untuk kontras yang lebih baik */
            text-decoration: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #4836a1;
            color: #ffffff;
        }
    </style>
    <title>Update Pengeluaran Proyek</title>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Update Pengeluaran Proyek</h1>
        </div>
        <div class="content">
            <p>Yth. Investor,</p>
            <p>Kami ingin menginformasikan bahwa ada pembaruan pengeluaran pada proyek yang Anda investasikan, yaitu <strong>{{ $projectName }}</strong>.</p>
            <p>Berikut adalah detail pengeluaran terbaru:</p>
            <ul>
                <li><strong>Tanggal Pengeluaran:</strong> {{ \Carbon\Carbon::parse($date)->format('d M Y') }}</li>
                <li><strong>Jumlah Biaya:</strong> Rp {{ number_format($amount, 0, ',', '.') }}</li>
            </ul>
            <p>Terima kasih atas dukungan dan kepercayaan Anda terhadap proyek kami. Kami akan terus berupaya untuk memberikan yang terbaik.</p>
            <p>Untuk informasi lebih lanjut, Anda dapat mengunjungi platform kami dengan mengklik tombol di bawah ini:</p>
            <a href="{{ url('https://impactmate.tbnindonesia.org') }}" class="btn">Kunjungi Platform</a>
            <p>Salam hangat,</p>
            <p><strong>Tim Impact Management Measurement</strong></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Platform IMM(Impact Management Measurement). Semua hak dilindungi.</p>
            <p>Impact Hub, Lippo Thamrin Building lt5 Jln MH Thamrin Kav 20, Menteng Jakarta Pusat</p>
        </div>
    </div>
</body>
</html>
