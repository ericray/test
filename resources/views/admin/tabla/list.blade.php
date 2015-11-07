@extends('layouts.app')
@section('title','Tablas')
@section('content')
    <h1 class="page-header">
        Tablas
        <a href="{{ route('admin.tabla.create') }}" class="btn btn-success btn-sm">
            <i class="fa fa-plus-circle"></i> Agregar
        </a>
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="panel-title">
                Lista de tablas
                <span class="badge">{{ $tablas->count() }}</span>
            </h1>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-condensed" id="grid-tabla">
                    <thead>
                        <tr>
                            <th data-column-id="nombre">Nombre</th>
                            <th data-column-id="id" data-formatter="id" data-sorteable="false">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tablas as $tabla)
                            <tr>
                                <td>{{ $tabla->descripcion }}</td>
                                <td>{{ $tabla->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {!! Form::open(['route' => ['admin.tabla.destroy',':TABLA_ID'],'method' => 'DELETE','class' => 'form-delete']) !!} {!! Form::close() !!}
@stop
@section('scripts')
    @include('partials.script_delete',['id' => 'grid-tabla','resource' => 'tabla','placeholder' => ':TABLA_ID'])
@stop