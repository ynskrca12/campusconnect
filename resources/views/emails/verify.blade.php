<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>
<body>
    <p>Merhaba {{ $user->name }},</p>
    <p>Hesabınızı doğrulamak için lütfen aşağıdaki bağlantıya tıklayın:</p>
    {{-- <a href="{{ url('verify-email/'.$user->email_verified_token) }}">Hesabı Doğrula</a> --}}
</body>
</html>
