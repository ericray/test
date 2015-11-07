@extends('layouts.app')
@section('title','Administradores')
@section('content')
    <h1 class="page-header">
        Administradores
        <a href="{{ route('admin.administrador.create') }}" class="btn btn-success btn-sm">
           <i class="fa fa-plus-circle"></i> Agregar
        </a>
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">
                Lista de administradores
                <span class="badge">{{ $admins->count() }}</span>
            </h2>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-condensed" id="grid-admin">
                    <thead>
                        <tr>
                            <th data-column-id="nombre">Nombre</th>
                            <th data-column-id="id" data-formatter="id" data-sorteable="false">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->id }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {!! Form::open(['route' => ['admin.administrador.destroy',':ADMIN_ID'],'method' => 'DELETE','class' => 'form-delete']) !!} {!! Form::close() !!}
@stop
@section('scripts')
    @include('partials.script_delete',['id' => 'grid-admin','resource' => 'administrador','placeholder' => ':ADMIN_ID','btn_pwd' => true])
@stop