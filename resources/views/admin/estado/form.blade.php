@extends('layouts.app')
@section('title',$title)
@section('content')
    @include('errors.error_request')
    <div class="col-md-offset-2 col-md-8 co-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">{!! $title !!}</h4>
            </div>
            {!! Form::model($estado,$form_data) !!}
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::label('descripcion','Nombre',['class' => 'col-md-2']) !!}
                        <div class="col-md-10">
                            {!! Form::text('descripcion',null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="panel-footer" style="text-align: right">
                    <a href="{{ route('admin.estado.index') }}" class="btn btn-default">
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