@extends('layouts.app_public')
@section('title',$title)
@section('content')
    <h1 class="page-header">Alumnos de {{ $grupo->descripcion }}</h1>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Lista de alumnos <span class="badge">{{ $alumnos->count() }}</span>
            </h3>
        </div>
        <div class="panel-body">
            <table class="table table-hover table-condensed table-striped" id="grid-alumno">
                <thead>
                    <tr>
                        <th data-column-id="name">Alumno</th>
                        <th data-column-id="id" data-formatter="id" data-sortable="false ">Acciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop
@section('scripts')
    {!! Html::script(asset('vendor/bootgrid/jquery.bootgrid.min.js')) !!}
    <script>
        $(document).ready(function(e){

            var grid = $("#grid-alumno").bootgrid({
                labels:{
                    all: "Todo",
                    refresh: "refrescar",
                    loading: "Cargando...",
                    noResults: "No se encontraron resultados",
                    search: "Buscar",
                    infos: "Mostrando @{{ctx.start}} a @{{ctx.end}} de @{{ctx.total}} registros"
                },
                ajax : true,
                url: "{{ url('grupo/alumnos') }}",
                post: function () {
                    return {
                        id : "b0df282a-0d67-40e5-8558-c9e93b7befed",
                        "_token" : "{{ csrf_token() }}",
                        "grupo_id" : "{{ $grupo->id }}}"
                    };
                },
                "formatters" : {
                    "id" : function(column, row){
                        return "<button class='btn btn-default btn-xs btn-edit' data-id='" + row.id + "'><i class='fa fa-clipboard'></i></button> ";
                    }
                }
            }).on('loaded.rs.jquery.bootgrid',function(){
                grid.find('.btn-edit').on('click',function(){
                    var id = $(this).data('id');
                    window.location.href = "{{ url('alumno') }}/" + id + "/tareas";
                });
            });
        });
    </script>
@stop