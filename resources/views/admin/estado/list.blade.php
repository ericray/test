@extends('layouts.app')
@section('title','Estados')
@section('content')
    <h1 class="page-header">
        Estados
        <a href="{{ route('admin.estado.create') }}" class="btn btn-success btn-sm">
            <i class="fa fa-plus-circle"></i> Agregar
        </a>
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">
                Lista de estados
                <span class="badge">{{ $estados->count() }}</span>
            </h2>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-condensed" id="grid-estado">
                    <thead>
                        <tr>
                            <th data-column-id="nombre">Nombre</th>
                            <th data-column-id="id" data-formatter="id" data-sorteable="false">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estados as $estado)
                            <tr>
                                <td>{{ $estado->descripcion }}</td>
                                <td>{{ $estado->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {!! Form::open(['route' => ['admin.estado.destroy',':ESTADO_ID'],'method' => 'DELETE','class' => 'form-delete']) !!}
@stop
@section('scripts')
    @include('partials.script_delete',['id' => 'grid-estado','resource' => 'estado','placeholder' => ':ESTADO_ID'])
@stop