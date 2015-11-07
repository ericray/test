@extends('layouts.app')
@section('title','Alumnos')
@section('content')
    <h1 class="page-header">
        Alumnos
        <a href="{{ route('admin.alumno.create') }}" class="btn btn-sm btn-success">
            <i class="fa fa-plus-circle"></i> Nuevo
        </a>
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">
                Lista de alumnos <span class="badge">{{ $num_alumnos }}</span>
            </h2>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-striped" id="grid-alumno">
                <thead>
                    <tr>
                        <th data-column-id="nombre">Nombre</th>
                        <th data-column-id="id" data-formatter="id" data-sorteable="false">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($alumnos as $alumno)
                        <tr>
                            <td>{{ $alumno->name }}</td>
                            <td>{{ $alumno->id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {!! Form::open(['route' => ['admin.alumno.destroy',':ALUMNO_ID'],'class' => 'form-delete','method' => 'DELETE']) !!}{!! Form::close() !!}
@stop
@section('styles')
    {!! Html::style(asset('vendor/bootgrid/jquery.bootgrid.min.css')) !!}
@stop
@section('scripts')
    @include('partials.script_delete',['id' => 'grid-alumno','resource' => 'alumno','placeholder' => ':ALUMNO_ID','btn_pwd' => true])
@stop