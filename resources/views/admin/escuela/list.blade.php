@extends('layouts.app')
@section('title','Escuelas')
@section('content')
    <h2 class="page-header">
        Escuelas
        <a href="{{ route('admin.escuela.create') }}" class="btn btn-success btn-sm">
            <i class="fa fa-plus-circle"></i> Agregar
        </a>
    </h2>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Lista de escuelas <span class="badge">{{ $escuelas->count() }}</span></h2>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-stripped table-condensed" id="grid-escuela">
                <thead>
                    <tr>
                        <th data-column-id="nombre">Nombre</th>
                        <th data-column-id="id" data-formatter="id" data-sorteable="false">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($escuelas as $escuela)
                        <tr>
                            <td>{{ $escuela->nombre }}</td>
                            <td>{{ $escuela->id }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {!! Form::open(['route' => ['admin.escuela.destroy',':ESCUELA_ID'],'method' => 'DELETE','class' => 'form-delete']) !!} {!! Form::close() !!}
@stop
@section('styles')
    {!! Html::style(asset('vendor/bootgrid/jquery.bootgrid.min.css')) !!}
@stop
@section('scripts')
    @include('partials.script_delete',['id' => 'grid-escuela','resource' => 'escuela','placeholder' => ':ESCUELA_ID'])
@stop