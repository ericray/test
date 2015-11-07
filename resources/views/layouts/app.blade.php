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
                <a class="navbar-brand" href="{{ url('/admin') }}">
                    <i class="fa fa-"></i> Escolar
                </a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    @if(Auth::user())
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            {{ Auth::user()->name }}
                            <b class="caret"></b>
                        </a>
                    @endif
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ url('admin/administrador/'.Auth::user()->id.'/edit/password') }}">
                                <i class="fa fa-fw fa-unlock-alt"></i> Cambiar clave
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ url('admin/logout') }}"><i class="fa fa-fw fa-power-off"></i> Cerrar sesión</a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li @if(isset($current) && $current == 'admin') class="active" @endif>
                        <a href="{{ url('/admin') }}">
                            <i class="fa fa-fw fa-home"></i> Inicio
                        </a>
                    </li>
                    <li id="dropdown">
                        <a href="javascript:;" data-toggle="collapse" data-target="#demo" class="collapsed" aria-expanded="false">
                            <i class="fa fa-table"></i> Catálogos
                            <i class="fa fa-fw fa-caret-down"></i>
                        </a>
                        <ul id="demo" class="collapse" aria-expanded="false" style="height: 0px;">
                        @if(Auth::user()->can('ver_catalogos'))
                            <li @if(isset($current) && $current == 'administrador') class="active" @endif>
                                <a href="{{ url('/admin/administrador') }}">
                                    <i class="fa fa-fw fa-male"></i> Administradores
                                </a>
                            </li>
                            <li @if(isset($current) && $current == 'director') class="active" @endif>
                                <a href="{{ url('/admin/director') }}">
                                    <i class="fa fa-fw fa-users"></i> Directores
                                </a>
                            </li>
                            <li @if(isset($current) && $current == 'escuela') class="active" @endif>
                                <a href="{{ url('/admin/escuela') }}">
                                    <i class="fa fa-fw fa-building"></i> Escuelas
                                </a>
                            </li>
                            <li @if(isset($current) && $current == 'estado') class="active" @endif>
                                <a href="{{ url('/admin/estado') }}">
                                    <i class="fa fa-fw fa-flag"></i> Estados
                                </a>
                            </li>
                            <li @if(isset($current) && $current == 'tabla') class="active" @endif>
                                <a href="{{ url('/admin/tabla') }}">
                                    <i class="fa fa-fw fa-list-alt"></i> Tablas
                                </a>
                            </li>
                            <li @if(isset($current) && $current == 'estatus') class="active" @endif>
                                <a href="{{ url('/admin/estatus') }}">
                                    <i class="fa fa-fw fa-flag"></i> Estatus
                                </a>
                            </li>
                        @endif
                            <li @if(isset($current) && $current == 'maestro') class="active" @endif>
                                <a href="{{ url('/admin/maestro') }}"><i class="fa fa-user"></i> Maestros</a>
                            </li>
                            <li @if(isset($current) && $current == 'alumno') class="active" @endif>
                                <a href="{{ url('/admin/alumno') }}"><i class="fa fa-user"></i> Alumnos</a>
                            </li>
                        </ul>
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
    <script>
        $(function () {
            var dropdown = $('#dropdown');
            var link_dropdown = dropdown.children('a');
            var ul = dropdown.children('ul');
            var subli = dropdown.children('ul').children('li.active');

            if(subli.length){
                link_dropdown.removeClass('collapsed');
                link_dropdown.attr('aria-expanded',true);
                ul.removeClass('collapse');
                ul.addClass('collapse in');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>