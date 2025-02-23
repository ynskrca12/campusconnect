<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Başarılı</title>
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
            max-width: 120px;
            height: auto;
        }
        .email-header img.banner {
            width: 100%;
            max-height: 200px;
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
            color: #007bff;
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
            <img src="https://campusconnect.com.tr/public/assets/images/banner_cover.png" alt="campus connect" class="banner">
        </div>
        <div class="email-body">
            <h2>Hoşgeldin</h2>
            <p>Merhaba {{ $user->username }},</p>>
            <p>Hesabınızı doğrulamak için aşağıdaki bağlantıya tıklayın:</p>
     
            <p style="margin-top: 20px;">
                <a href="{{ route('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]) }}" 
                    style="background-color: #144579;
                    color: white;
                    padding: 10px 40px;
                    border-radius: 5px;
                    text-decoration: none;
                    font-size: 14px;">E-posta doğrulama bağlantısı
                </a>
            </p>
        </div>
        <div class="email-footer">
            <p>Bu e-posta yalnızca hesabınızı oluşturduğunuzda gönderildi. Bu işlemi siz başlatmadıysanız lütfen bizimle iletişime geçin.</p>
            <p>© 2025 campusconnect | Tüm hakları saklıdır</p>
            <div>
                <div>
                    <p><a href="http://campusconnect.com.tr/">Websitemizi Ziyaret Et</a></p>
                </div>
                <div>
                    <img src="https://iceri.net/assets/images/cc.png" alt="campusconnect" class="imgLogo">
                </div>
            </div>
        </div>
    </div>
</body>
</html>

