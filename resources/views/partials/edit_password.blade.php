@if(isset($resource) && isset($id))
    @extends('layouts.app')
    @section('title','Cambiar contraseña')
    @section('content')
        @include('errors.error_request')
        <div class="col-md-offset-2 col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2 class="panel-title">
                        Cambiar contraseña de {{ $resource }} &quot;{{ $user->name }}&quot;
                    </h2>
                </div>
                {!! Form::open(['url' => 'admin/'.$resource.'/'.$id.'/edit/password','class' => 'form-horizontal']) !!}
                    <div class="panel-body">
                        <div class="form-group">
                            {!! Form::label('password','Contraseña',['class' => 'col-md-4']) !!}
                            <div class="col-md-8">
                                {!! Form::password('password',['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('password_confirmation','Confirmar contraseña',['class' => 'col-md-4']) !!}
                            <div class="col-md-8">
                                {!! Form::password('password_confirmation',['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer" style="text-align: right">
                        <a href="{{ route('admin.'.$resource.'.index') }}" class="btn btn-default">
                            <i class="fa fa-times"></i> Cancelar
                        </a>
                        <button class="btn btn-primary">
                            <i class="fa fa-send"></i> Enviar
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    @stop
@endif