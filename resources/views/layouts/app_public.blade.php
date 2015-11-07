<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Bienvenido')</title>
    {!! Html::favicon(asset('favicon.ico')) !!}
    {!! Html::style(asset('vendor/bootstrap/css/bootstrap.min.css')) !!}
    {!! Html::style(asset('vendor/font-awesome/css/font-awesome.min.css')) !!}
            <!-- Custom theme -->
    {!! Html::style(asset('vendor/sb-admin/sb-admin.css')) !!}
    {!! Html::style(asset('vendor/bootgrid/jquery.bootgrid.min.css')) !!}
    @yield('styles')
</head>
<body>
<div id="wrapper">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ url('/') }}">Administración</a>
        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                @if(Auth::user())
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i> {{ Auth::user()->name }} <b class="caret"></b>
                    </a>
                @endif
                <ul class="dropdown-menu">
                    <li>
                        <a href="#" data-toggle="modal" data-target="#cambiarclave">
                            <i class="fa fa-fw fa-unlock-alt"></i> Cambiar clave
                        </a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ url('/logout') }}"><i class="fa fa-fw fa-power-off"></i> Cerrar sesión</a>
                    </li>
                </ul>
            </li>
        </ul>

        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                @if(isset($current) && $current == 'home')
                    <li class="active">
                @else
                    <li>
                        @endif
                        <a href="{{ url('/') }}">
                            <i class="fa fa-fw fa-home"></i> Inicio
                        </a>
                    </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
    <div id="page-wrapper" style="min-height: 603px">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
</div>
{!! Html::script('vendor/jquery/jquery.min.js') !!}
{!! Html::script('vendor/bootstrap/js/bootstrap.min.js') !!}
@yield('scripts')
</body>
</html>