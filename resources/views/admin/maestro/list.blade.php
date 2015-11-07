@extends('layouts.app')
@section('title','Maestros')
@section('content')
    <h1 class="page-header">
        Maestros
        <a href="{{ route('admin.maestro.create') }}" class="btn btn-sm btn-success">
            <i class="fa fa-plus-circle"></i> Agregar
        </a>
    </h1>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Lista de maestros <span class="badge">{{ $maestros->count() }}</span></h2>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-striped table-condensed" id="grid-maestro">
                <thead>
                    <tr>
                        <th data-column-id="nombre">Nombre</th>
                        <th data-column-id="escuela">Escuela</th>
                        <th data-column-id="id" data-formatter="id" data-sorteable="false">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($maestros as $maestro)
                        <tr>
                            <td>{{ $maestro->name }}</td>
                            <td>{{ $maestro->escuela }}</td>
                            <td>{{ $maestro->id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {!! Form::open(['route' => ['admin.maestro.destroy','::MAESTRO_ID'],'method' => 'DELETE','class' => 'form-delete']) !!}{!! Form::close() !!}
@stop
@section('scripts')
    @include('partials.script_delete',['placeholder' => '::MAESTRO_ID','resource' => 'maestro','id' => 'grid-maestro'])
@stop