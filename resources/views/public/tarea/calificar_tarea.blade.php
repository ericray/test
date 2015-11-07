@extends('layouts.app_public')
@section('title',$title)
@section('content')
    <h1 class="page-header">
        Calificar tarea &quot;{{ $tarea->nombre }}&quot;
        <small>Alumno: {{ $alumno->name }} {{ $alumno->lastname }}</small>
    </h1>

    <div class="col-md-offset-2 col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Calificar</h3>
            </div>
            {!! Form::open(['url' => 'tarea/calificar']) !!}
                {!! Form::hidden('alumno_id',$alumno->id) !!}
                {!! Form::hidden('tarea_id',$tarea->id) !!}
                {!! Form::hidden('periodo_id',0) !!}
                <div class="panel-body">
                    @include('errors.error_request')
                    <div class="form-group">
                        {!! Form::label('evaluacion','Calificación') !!}
                        {!! Form::number('evaluacion',null,['class' => 'form-control','max' => 10, 'min' => 0,'step' => 0.1]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('observaciones','Observaciones') !!}
                        {!! Form::textarea('observaciones',null,['class' => 'form-control','rows' => 3]) !!}
                    </div>
                </div>
                <div class="panel-footer" style="text-align: right">
                    <a href="{{ url('alumno',$alumno->id) }}/tareas" class="btn btn-default">
                        <i class="fa fa-times"></i> Cancelar
                    </a>
                    <button class="btn btn-primary" type="submit">
                        <i class="fa fa-send"></i> Enviar
                    </button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@stop