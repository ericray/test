@extends('layouts.basic')
@section('content')
    <div class="container">
        @include('errors.error_request')
        <div class="col-md-offset-4 col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Reestablecer contraseña</h1>
                </div>
                {!! Form::open(['url' => '/password/reset']) !!}
                    {!! Form::hidden('token',$token) !!}
                    <div class="panel-body">
                        <div class="form-group">
                            {!! Form::label('email','Correo') !!}
                            {!! Form::email('email',old('email'),['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('password','Contraseña') !!}
                            {!! Form::password('password',['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('password_confirmation','Confirmar contraseña') !!}
                            {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Reset Password
                            </button>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop