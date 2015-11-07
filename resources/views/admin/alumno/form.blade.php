@extends('layouts.app')
@section('title',$title)
@section('content')
    <div class="col-md-offset-2 col-md-8 col-md-offset-2">
        @include('errors.error_request')
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $title }}</h3>
            </div>
            {!! Form::model($alumno,$form_data) !!}
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::label('name','Nombre') !!}
                        {!! Form::text('name',null,['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('lastname','Apelldo paterno') !!}
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
                    @if(isset($action) && $action == 'create')
                        <div class="form-group">
                            {!! Form::label('password','Contraseña') !!}
                            {!! Form::password('password',['class' => 'form-control']) !!}
                        </div>
                    @endif
                    <div class="form-group">
                        {!! Form::label('estado_id','Estado') !!}
                        {!! Form::select('estado_id',$estados,null,['class' => 'form-control','placeholder' => 'Seleccione estado...']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('escuela_id','Escuela') !!}
                        {!! Form::select('escuela_id',$escuelas,null,['class' => 'form-control', 'placeholder' => 'Selecciione escuela...']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('grupo_id','Grupo') !!}
                        {!! Form::select('grupo_id',$grupos,null,['class' => 'form-control', 'placeholder' => 'Selecciione grupo...']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('sexo_id','Género') !!} <br>
                        <div class="btn-group" data-toggle="buttons">
                            @foreach($generos as $genero)
                                <div class="btn btn-primary @if($genero->id == $alumno->sexo_id) {{ " active " }} @endif">
                                    {!! Form::radio('sexo_id',$genero->id,null) !!} {{ $genero->descripcion }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="panel-footer" style="text-align: right">
                    <a href="{{ route('admin.alumno.index') }}" class="btn btn-default">
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
@section('styles')
    {!! Html::style(asset('vendor/bootstrap-select/css/bootstrap-select.min.css')) !!}
@stop
@section('scripts')
    {!! Html::script(asset('vendor/bootstrap-select/js/bootstrap-select.min.js')) !!}
    <script>
        $(function(){

                    @unless(isset($action) && $action == 'edit')
                        var value = $('#estado_id').find('option:first-child');
            value.attr('selected','selected');
            @endunless


            $('#estado_id').change(function(){
                        var estado_id = $(this).val();
                        var url = '{{ url('escuelas') }}';
                        var lista = [];
                        $('#escuela_id').attr('disabled','disabled');
                        $.get(url,{ id : estado_id})
                                .success(function (result) {

                                    $('#escuela_id').removeAttr('disabled');


                                    $('#escuela_id').html('<option selected>Seleccione escuela...</option>');
                                    $.each(result, function (key,val) {
                                        lista.push('<option value="' + val.id + '">' + val.nombre + '</option>');
                                    })
                                    $('#escuela_id').append(lista.join(""));
                                });
                    });

            $('#escuela_id').change(function(){
                var escuela_id = $(this).val();
                var url = '{{ url('grupos') }}';
                var lista = [];
                $('#grupo_id').attr('disabled','disabled');
                $.get(url,{ id : escuela_id })
                        .success(function (result) {
                            $('#grupo_id').removeAttr('disabled');
                            $('#grupo_id').html('<option>Seleccione grupo...</option>');

                            $.each(result, function (key,val) {
                                lista.push('<option value="' + val.id + '">' + val.descripcion + '</option>');
                            });

                            $('#grupo_id').append(lista.join(""));
                        });
            });

            $('#estado_id').selectpicker({
                liveSearch : true
            });
        });
    </script>
@stop