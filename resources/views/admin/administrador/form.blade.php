@extends('layouts.app')
@section('title',$title)
@section('content')
    @include('errors.error_request')
    <div class="col-md-offset-2 col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">{{ $title }}</h2>
            </div>
            {!! Form::model($admin,$form_data) !!}
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
                </div>
                <div class="panel-footer" style="text-align: right;">
                    <a href="{{ route('admin.administrador.index') }}" class="btn btn-default">
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