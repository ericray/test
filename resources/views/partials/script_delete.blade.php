<?php $btn_delete = true; ?>
@if(isset($id) || isset($resource) || isset($placeholder))
    {!! Html::script(asset('vendor/bootgrid/jquery.bootgrid.min.js')) !!}
    {!! Html::script(asset('vendor/bootgrid/jquery.bootgrid.fa.js')) !!}
    <script>
        $(document).ready(function(e){
            var idGrid = "{{ $id }}";
            var btn_pwd = "";
            var btn_delete = "";

            var grid = $("#" + idGrid).bootgrid({
                labels:{
                    all: "Todo",
                    refresh: "refrescar",
                    loading: "Cargando...",
                    noResults: "No se encontraron resultados",
                    search: "Buscar",
                    infos: "Mostrando @{{ctx.start}} a @{{ctx.end}} de @{{ctx.total}} registros"
                },
                "formatters" : {
                    "id" : function(column, row){
                        @if(isset($btn_pwd) && $btn_pwd)
                             btn_pwd = " <a href='{{ url('admin/'.$resource) }}/" + row.id +"/edit/password' class='btn btn-default btn-xs btn-pwd'><i class='fa fa-key'><i></a>";
                        @endif
                        @if(isset($btn_delete) && $btn_delete)
                            btn_delete = " <button class='btn btn-default btn-xs btn-delete' data-id='" + row.id + "'><i class='fa fa-trash'></i></button>";
                        @endif

                        return "<button class='btn btn-default btn-xs btn-edit' data-id='" + row.id + "'><i class='fa fa-edit'></i></button> "
                                + btn_delete
                                + btn_pwd;
                    }
                }
            }).on('loaded.rs.jquery.bootgrid',function(){
                grid.find('.btn-edit').on('click',function(){
                    window.location.href = "{{ url('admin/'.$resource) }}/" + $(this).data('id') + "/edit";
                });

                grid.find('.btn-delete').on('click',function(){
                    var id = $(this).data('id');
                    var form = $('.form-delete');
                    var data = form.serialize();
                    var row = $(this).parents('tr');
                    var url = form.attr('action').replace("{{ $placeholder }}",id);

                    row.hide(2000);
                    $.post(url,data)
                            .success(function(result){
                                if($('.badge').length){
                                    $('.badge').html(result.num);
                                }

                                alert(result.message);
                            })
                            .fail(function(result){
                                console.log(result);
                                row.show();
                            });
                });
            });
        });
    </script>
@endif