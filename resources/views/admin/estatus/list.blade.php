@extends('layouts.app')
@section('title','Estatus')
@section('content')
    <h1 class="page-header">
        Estatus
        <a href="{{ route('admin.estatus.create') }}" class="btn btn-success btn-sm">
            <i class="fa fa-plus-circle"></i> Agregar
        </a>
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">
                Lista de estatus
                <span class="badge">{{ $estatus->count() }}</span>
            </h2>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-condensed" id="grid-estatus">
                    <thead>
                        <tr>
                            <th data-column-id="descripción">Nombre</th>
                            <th data-column-id="id" data-formatter="id" data-sorteable="false">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($estatus as $status)
                            <tr>
                                <td>{{ $status->descripcion }}</td>
                                <td>{{ $status->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {!! Form::open(['route' => ['admin.estatus.destroy',':ESTATUS_ID'],'method' => 'DELETE','class' => 'form-delete']) !!} {!! Form::close() !!}
@stop
@section('scripts')
    @include('partials.script_delete',['id' => 'grid-estatus','resource' => 'estatus','placeholder' => ':ESTATUS_ID'])
@stop