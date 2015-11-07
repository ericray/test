@extends('layouts.app_public')
@section('title',$title)
@section('content')
    <h1 class="page-header">Tareas de alumno {{ $alumno->name }}</h1>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                Lista de tareas <span class="badge">{{ $tareas->count() }}</span>
            </h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-condensed table-striped" id="grid-tarea">
                    <thead>
                        <tr>
                            <td data-column-id="nombre">Tarea</td>
                            <td data-column-id="estatus">Estatus</td>
                            <td data-column-id="id" data-formatter="id" data-sortable="false">Acciones</td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@stop
@section('scripts')
    {!! Html::script(asset('vendor/bootgrid/jquery.bootgrid.min.js')) !!}
    <script>
        $(function (e) {
            var grid = $('#grid-tarea').bootgrid({
                labels:{
                    all : 'Todo',
                    search : 'Buscar',
                    infos  : '@{{ctx.start}}-@{{ctx.end}} de @{{ctx.total}}',
                    noResults : 'No se encontraron resultados',
                    loading : 'Cargando'
                },
                ajax: true,
                url: "{{ url('alumno/tareas') }}",
                post:{
                    id : "b0df282a-0d67-40e5-8558-c9e93b7befed",
                    "_token" : "{{ csrf_token() }}",
                    "alumno_id" : "{{ $alumno->id }}"
                },
                "formatters": {
                    "id" : function (column,row) {
                        return "<button class='btn btn-xs btn-primary btn-calificar' data-id='" + row.id + "'>" +
                                "<i class='fa fa-edit'></i>" +
                                "</button>";
                    }
                }
            }).on('loaded.rs.jquery.bootgrid', function () {
                grid.find('.btn-calificar').click(function(){
                    var id = $(this).data('id');
                    window.location.href = "{{ url('alumno',$alumno->id) }}/tarea/" + id + "/calificar";
                });
            });
        });
    </script>
@stop