@extends('layouts.app')
@section('title') Inicio @stop
@section('content')
    <h1 class="page-header">
        <i class="fa fa-dashboard"></i>
        Inicio
    </h1>
    @if(Auth::user()->can('ver_catalogos'))
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-user-secret fa-5x"></i>
                    </div>

                    <div class="col-xs-9 text-right">
                        <div class="huge">
                            {{ $num_admins }}
                        </div>
                        <div>Administradores</div>
                    </div>
                </div>
            </div>
            <a href="{{ url('/admin/administrador') }}">
                <div class="panel-footer">
                    <span class="pull-left">Ver administradores</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-male fa-5x"></i>
                    </div>

                    <div class="col-xs-9 text-right">
                        <div class="huge">
                            {{ $num_director }}
                        </div>
                        <div>Directores</div>
                    </div>
                </div>
            </div>
            <a href="{{ url('/admin/director') }}">
                <div class="panel-footer">
                    <span class="pull-left">Ver directores</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    @endif

    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-users fa-5x"></i>
                    </div>

                    <div class="col-xs-9 text-right">
                        <div class="huge">
                            {{ $num_maestros }}
                        </div>
                        <div>Maestros</div>
                    </div>
                </div>
            </div>
            <a href="{{ url('/admin/maestro') }}">
                <div class="panel-footer">
                    <span class="pull-left">Ver maestros</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

    @if(Auth::user()->can('ver_catalogos'))
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fa fa-university fa-5x"></i>
                    </div>

                    <div class="col-xs-9 text-right">
                        <div class="huge">
                            {{ $num_escuelas }}
                        </div>
                        <div>Escuelas</div>
                    </div>
                </div>
            </div>
            <a href="{{ url('/admin/escuela') }}">
                <div class="panel-footer">
                    <span class="pull-left">Ver escuelas</span>
                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    @endif
@stop