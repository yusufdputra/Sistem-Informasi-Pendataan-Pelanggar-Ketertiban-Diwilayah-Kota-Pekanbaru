<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ubah Kata Sandi</title>
</head>
<body>
  <p>Halo, Silahkan klik tautan dibawah untuk mengubah kata sandi anda</p>
  
  <p><a href="{{route('password.forgot', ['email'=>$detail['email'],'token'=>$detail['token'] ] )}}">Ubah Kata Sandi</a></p>
  
</body>
</html>