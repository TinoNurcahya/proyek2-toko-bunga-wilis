<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reset Password Toko Bunga Wilis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding: 20px;
            background-color: #00bc23;
            color: #fff;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
        }

        .content {
            padding: 30px 30px 20px 30px;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            background-color: #00bc23;
            color: white !important;
            font-weight: bold;
            padding: 12px 25px;
            margin: 20px 0;
            text-decoration: none;
            border-radius: 5px;
            transition: background 0.3s;
        }

        .button:hover {
            background-color: #019e1b;
        }

        .footer {
            font-size: 12px;
            color: #999;
            padding: 10px;
            text-align: center;
            border-top: 1px solid #eaeaea;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>Toko Bunga Wilis</h1>
        </div>
        <!-- Content -->
        <div class="content">
            <p>Halo <strong>{{ $user->nama }}</strong>,</p>
            <p>Anda menerima email ini karena kami menerima permintaan reset password untuk akun anda.</p>
            <p style="text-align:center;">
                <a href="{{ $resetUrl }}" class="button">Reset Password</a>
            </p>
            <p>Jika anda tidak meminta reset password, silakan abaikan email ini.</p>
        </div>
        <!-- Footer -->
        <div class="footer">
            &copy; {{ date('Y') }} Toko Bunga Wilis. Semua hak cipta dilindungi.
        </div>
    </div>
</body>

</html>
