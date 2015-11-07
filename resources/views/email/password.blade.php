<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    Haz click aquí para recuperar tu contraseña: {{ url('password/reset/'.$token) }}
</body>
</html>