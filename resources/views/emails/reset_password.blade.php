<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password SAPURAN</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 30px;
            color: #333333;
            line-height: 1.6;
        }
        h2 {
            font-size: 20px;
            font-weight: bold;
            color: #222222;
            margin-top: 0;
            margin-bottom: 20px;
        }
        p {
            font-size: 15px;
            color: #555555;
            margin-bottom: 20px;
        }
        .btn-wrapper {
            text-align: center;
            margin: 30px 0;
        }
        .btn-reset {
            display: inline-block;
            background-color: #d32f2f;
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 28px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
        }
        .notice-box {
            background-color: #fff8c4;
            color: #856404;
            padding: 15px;
            border-radius: 6px;
            font-size: 14px;
            text-align: center;
            margin-bottom: 20px;
            border: 1px solid #ffeeba;
        }
        .fallback-box {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            font-size: 13px;
            color: #666666;
            margin-top: 30px;
            word-break: break-all;
            border: 1px solid #eeeeee;
        }
        .fallback-box a {
            color: #0056b3;
            text-decoration: none;
        }
        .icon-key {
            margin-right: 8px;
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Halo, {{ $user->name }}!</h2>
        
        <p>Kami menerima permintaan untuk mereset kata sandi akun Anda di <strong>SAPURAN (Sistem Administrasi Kelurahan Penurunan)</strong>.</p>
        
        <p>Klik tombol di bawah ini untuk membuat kata sandi baru Anda:</p>
        
        <div class="btn-wrapper">
            <a href="{{ $url }}" class="btn-reset">
                <span class="icon-key">🔑</span> Reset Kata Sandi Sekarang
            </a>
        </div>
        
        <div class="notice-box">
            Link ini hanya berlaku selama <strong>60 menit</strong>. Setelah itu, Anda perlu meminta link baru.
        </div>
        
        <p>Jika Anda tidak merasa meminta reset kata sandi, abaikan email ini. Akun Anda tetap aman dan tidak ada perubahan yang terjadi.</p>
        
        <div class="fallback-box">
            Jika tombol di atas tidak berfungsi, salin dan tempel URL berikut di browser Anda:<br>
            <a href="{{ $url }}">{{ $url }}</a>
        </div>
    </div>
</body>
</html>
