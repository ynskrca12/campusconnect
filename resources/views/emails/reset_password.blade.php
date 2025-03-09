<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Şifre Sıfırlama</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            width: 99%;
            background-color: #ffffff;
            margin: 0 auto;
            max-width: 600px;
            border: 2px solid #144579;
            border-radius: 0px 0px 10px 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            padding: 0px;
        }
        .email-header {
            background-color: #fff;
            text-align: center;

        }
        .imgLogo{
            max-width: 80px;
            height: auto;
        }
        .email-header img.banner {
            width: 100%;
            max-height: 130px;
            object-fit: cover;
            object-position: center;
            display: block;
        }
        .email-body {
            padding: 20px;
            color: #333;
            line-height: 1.6;
            margin-top: 20px;
        }
        .email-body h2 {
            color: #333;
            font-size: 24px;
        }
        .email-body p {
            font-size: 16px;
        }
        .email-footer {
            background-color: #f4f4f4;
            padding: 15px;
            text-align: center;
            border-radius: 0 0 8px 8px;
        }
        .email-footer a {
            color: #001b48;
            text-decoration: none;
        }
        .email-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <img src="https://campusconnect.com.tr/public/assets/images/logos/dark_logo2.png" alt="campus connect" class="banner">
        </div>
        <div class="email-body">
            <p>Merhaba {{ $user->name }},</p>
            <p>Şifre sıfırlama isteğiniz alındı.</p>
            <p>Şifrenizi yenilemek için aşağıdaki bağlantıya tıklayın:</p>
     
            <p style="margin-top: 20px;">
                <a href="{{ $resetUrl }}"
                    style="background-color: #001b48;
                    color: white;
                    padding: 10px 40px;
                    border-radius: 5px;
                    text-decoration: none;
                    font-size: 14px;">Şifreni sıfırlamak için tıkla
                </a>
            </p>
        </div>
        <div class="email-footer">
            <p>Bu e-posta yalnızca şifrenizi sıfırlamak istediğiniz zaman gönderilir. Bu işlemi siz başlatmadıysanız lütfen bizimle iletişime geçin.</p>
            <p>© 2025 campusconnect | Tüm hakları saklıdır</p>
            <div>
                <div>
                    <p><a href="http://campusconnect.com.tr/">Websitemizi Ziyaret Et</a></p>
                </div>
                <div>
                    <img src="https://campusconnect.com.tr/public/assets/images/logos/dark_logo2.png" alt="campusconnect" class="imgLogo">
                </div>
            </div>
        </div>
    </div>
</body>
</html>

