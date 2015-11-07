@extends('layouts.app')
@section('title','Directores')
@section('content')
    <h1 class="page-header">
        <i class="fa fa-male"></i>
        Directores
        <a href="{{ route('admin.director.create') }}" class="btn btn-success btn-sm">
            <i class="fa fa-plus-circle"></i> Agregar
        </a>
    </h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title">Lista de directores <span class="badge">{{ $directores->count() }}</span></h2>
        </div>
        <div class="panel-body">
          <div class="table-responsive">
              <table class="table table-hover table-condensed table-stripped" id="grid-director">
                  <thead>
                  <tr>
                      <th data-column-id="nombre">Nombre</th>
                      <th data-column-id="escuela">Escuela</th>
                      <th data-column-id="id" data-formatter="id" data-sorteable="false">Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($directores as $director)
                      <tr>
                          <td>{{ $director->name }}</td>
                          <td>{{ $director->escuela }}</td>
                          <td>{{ $director->id }}</td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>
              {!! Form::open(['route' => ['admin.director.destroy',':DIRECTOR_ID'],'method' => 'DELETE','class' => 'form-delete']) !!} {!! Form::close() !!}
          </div>
        </div>
    </div>
@stop
@section('styles')
    {!! Html::style(asset('vendor/bootgrid/jquery.bootgrid.min.css')) !!}
@stop
@section('scripts')
    @include('partials.script_delete',['id' => 'grid-director','resource' => 'director','placeholder' => ':DIRECTOR_ID','btn_pwd' => true])
@stop