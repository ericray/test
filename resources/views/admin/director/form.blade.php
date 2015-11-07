@extends('layouts.app')
@section('title',$title)
@section('content')
    <h2 class="page-header">{{ $title }}</h2>

    @include('errors.error_request')
    <div class="col-md-offset-1 col-md-10 col-md-offset-1">
        <div class="panel panel-default">

                <div class="panel-heading">
                    <h2 class="panel-title">{{ $title }}</h2>
                </div>
            {!! Form::model($director,$form_data) !!}
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::label('name','Nombre') !!}
                        {!! Form::text('name',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('lastname','Apellido paterno') !!}
                        {!! Form::text('lastname',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('lastname2','Apellido materno') !!}
                        {!! Form::text('lastname2',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email','Correo') !!}
                        {!! Form::email('email',null,['class' => 'form-control']) !!}
                    </div>
                    @if(isset($accion) && $accion == 'store')
                        <div class="form-group">
                            {!! Form::label('password','Contraseña') !!}
                            {!! Form::password('password',['class' => 'form-control']) !!}
                        </div>
                    @endif
                    <div class="form-group">
                        {!! Form::label('sexo_id','Género') !!}
                        {!! Form::select('sexo_id',$sexos,null,['class' => 'form-control','placeholder' => 'Selecciona género...']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('estado_id','Estado') !!}
                        {!! Form::select('estado_id',$estados,null,['class' => 'form-control','placeholder' => 'Selecciona estado...']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('escuela_id','Escuela') !!}
                        {!! Form::select('escuela_id',$escuelas,null,['class' => 'form-control','placeholder' => 'Selecciona escuela...']) !!}
                    </div>
                </div>
                <div class="panel-footer" style="text-align: right;">
                    <a href="{{ route('admin.director.index') }}" class="btn btn-default">
                        <i class="fa fa-times"></i> Cancelar
                    </a>

                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-save"></i> Guardar
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop