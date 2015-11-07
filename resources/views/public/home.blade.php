@extends('layouts.app_public')
@section('title','Inicio')
@section('content')
    <h1 class="page-header">
        <i class="fa fa-dashboard"></i> Inicio
    </h1>

    <div class="modal fade" id="nuevo_periodo" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Agregar periodo</h4>
                </div>
                {!! Form::open(['route' => 'periodo.store','class' => 'form-horizontal', 'id' => 'form-periodo']) !!}
                    {!! Form::hidden('escuela_id',$escuela_id) !!}
                    <div class="modal-body">
                        <div class="form-group">
                            {!! Form::label('descripcion','Descripción',['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-8">
                                {!! Form::text('descripcion',null,['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('ano_inicio','Inicio del periodo',['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-8">
                                {!! Form::text('ano_inicio',null,['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('ano_fin','Fin del periodo',['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-8">
                                {!! Form::text('ano_fin',null,['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <i class="fa fa-times"></i> Cerrar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Guardar
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <div class="row">
        @foreach($grupos as $grupo)
            <div class="col-md-3">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>

                            <div class="col-xs-9 text-right">
                                <div class="huge">
                                    Grupo {{ $grupo->descripcion }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="{{ url('/grupo/' . $grupo->id . '/alumnos') }}">
                        <div class="panel-footer">
                            <span class="pull-left">Ver alumnos</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Periodos escolares
                        <button data-target="#nuevo_periodo" data-toggle="modal" class="btn btn-xs btn-default">
                            <i class="fa fa-plus-circle"></i>
                        </button>
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed table-hover table-striped" id="grid-periodo">
                            <thead>
                            <tr>
                                <th data-column-id="descripcion">Periodo</th>
                                <th data-column-id="id" data-formatter="id" data-sortable="false"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    {!! Html::script(asset('vendor/bootgrid/jquery.bootgrid.min.js')) !!}
    <script>
        $(function () {
            $('#form-periodo').submit(function (e) {
               e.preventDefault();

               $('#nuevo_periodo').modal('hide');

               var url = $(this).attr('action');
               var data = $(this).serialize();

               $.post(url,data)
                   .success(function (result) {

                       if(result.redirectTo){
                           //window.location.href = result.redirectTo;
                           $('#grid-periodo').bootgrid('reload');
                       }
                       if(result.message){
                           console.log(result.message);
                       }
                   })
                   .error(function (result) {
                        if(result.status && result.status == 422){

                            console.log(result.responseJSON);
                        }

                   });
           });


            var grid = $('#grid-periodo').bootgrid({
                labels:{
                    all: "Todo",
                    refresh: "refrescar",
                    loading: "Cargando...",
                    noResults: "No se encontraron resultados",
                    search: "Buscar",
                    infos: "Mostrando @{{ctx.start}} a @{{ctx.end}} de @{{ctx.total}} registros"
                },
                ajax : true,
                post : function () {
                  return {
                      id : "b0df282a-0d67-40e5-8558-c9e93b7befed",
                      '_token' : "{{ csrf_token() }}"
                  }
                },
                url : "{{ url('periodos') }}",
                formatters : {
                    id : function (column,row) {
                        return "<button data-row-id='" + row.id + "' class='btn btn-default btn-xs btn-show' title='Ingresar a este periodo'><i class='fa fa-eye'></i></button>";
                    }
                }
            })
                    .on('loaded.rs.jquery.bootgrid', function () {
                        grid.find('.btn-show').click(function () {
                            var id = $(this).data('row-id');
                            window.location.href = "{{ url('periodo') }}/" + id;
                        });
                    });
        });
    </script>
@stop