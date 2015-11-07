<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Bienvenido')</title>
    {!! Html::style(asset('vendor/bootstrap/css/bootstrap.min.css')) !!}
    {!! Html::style(asset('vendor/font-awesome/css/font-awesome.min.css')) !!}
</head>
<body>
    @yield('content')
</body>
</html>