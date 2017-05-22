$(document).ready(function(){

    TipoProductoTable = $('#TipoProductoTable').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,  
        bInfo:false,
        order: [[0, 'asc']],
        language: {
            processing:     "Procesando ...",
            search:         'Buscar',
            lengthMenu:     "Mostrar _MENU_ Registros",
            info:           "Mostrando _START_ a _END_ de _TOTAL_ Registros",
            infoEmpty:      "Mostrando 0 a 0 de 0 Registros",
            infoFiltered:   "(filtrada de _MAX_ registros en total)",
            infoPostFix:    "",
            loadingRecords: "...",
            zeroRecords:    "No se encontraron registros coincidentes",
            emptyTable:     "No hay datos disponibles en la tabla",
            paginate: {
                first:      "Primero",
                previous:   "Anterior",
                next:       "Siguiente",
                last:       "Ultimo"
            },
            aria: {
                sortAscending:  ": habilitado para ordenar la columna en orden ascendente",
                sortDescending: ": habilitado para ordenar la columna en orden descendente"
            }
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/inventario/tipo_producto/showTipoProducto.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                var rowNode = TipoProductoTable.row.add([
                  ''+array.nombre+'',
                  ''+array.descripcion+'',
                  ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>'+'',
                ]).draw(false).node();

                $( rowNode ).attr('id',array.id).addClass('text-center');
            });
        
            
        }
    });

    $('body').on('click', '#guardarTipoProducto', function () {

        var data = $('#storeTipoProducto').serialize();
        var array = $('#storeTipoProducto').serializeArray();

        if(ValidarString(array[0].value, 'Nombre') && ValidarString(array[1].value, 'Descripción')){

            $.ajax({
                type: "POST",
                url: "../includes/inventario/tipo_producto/storeTipoProducto.php",
                data:data,
                success: function(response){

                    if(response.status == 1){

                        $.niftyNoty({
                            type: 'success',
                            icon : 'fa fa-check',
                            message : 'Registro Guardado Exitosamente',
                            container : 'floating',
                            timer : 3000
                        });

                        var rowNode = TipoProductoTable.row.add([
                          ''+response.array.nombre+'',
                          ''+response.array.descripcion+'',
                          ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>'+'',
                        ]).draw(false).node();

                        $( rowNode ).attr('id',response.array.id).addClass('text-center')

                        $('#storeTipoProducto')[0].reset();
                        $('.modal').modal('hide');

                    }else if(response.status == 2){

                        $.niftyNoty({
                            type: 'danger',
                            icon : 'fa fa-check',
                            message : 'Debe llenar todos los campos',
                            container : 'floating',
                            timer : 3000
                        });

                    }else{

                        $.niftyNoty({
                            type: 'danger',
                            icon : 'fa fa-check',
                            message : 'Ocurrio un error en el Proceso',
                            container : 'floating',
                            timer : 3000
                        });

                    }
                }
            });
        }      
    });

    $('body').on( 'click', '.Update', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectId = ObjectTR.attr("id");
        var ObjectName = ObjectTR.find("td").eq(0).text();
        var ObjectDescription = ObjectTR.find("td").eq(1).text();
        $('#updateTipoProducto').find('input[name="id"]').val(ObjectId);
        $('#updateTipoProducto').find('input[name="nombre"]').val(ObjectName);
        $('#updateTipoProducto').find('textarea[name="descripcion"]').text(ObjectDescription);

        $('#TipoProductoFormUpdate').modal('show');
  
    });


    $('body').on('click', '#actualizarTipoProducto', function () {

        var data = $('#updateTipoProducto').serialize();
        var array = $('#updateTipoProducto').serializeArray();

        if(ValidarString(array[1].value, 'Nombre') && ValidarString(array[2].value, 'Descripción')){
                        
            $.ajax({
                type: "POST",
                url: "../includes/inventario/tipo_producto/updateTipoProducto.php",
                data:data,
                success: function(response){

                    if(response.status == 1){

                        $.niftyNoty({
                            type: 'success',
                            icon : 'fa fa-check',
                            message : 'Registro Actualizado Exitosamente',
                            container : 'floating',
                            timer : 3000
                        });

                        ObjectTR = $("#"+response.array.id);
                        ObjectTR.find("td").eq(0).html(response.array.nombre);
                        ObjectTR.find("td").eq(1).html(response.array.descripcion);
                        
                        $('.modal').modal('hide');
                        

                    }else if(response.status == 2){
                        $.niftyNoty({
                            type: 'danger',
                            icon : 'fa fa-check',
                            message : 'Debe llenar todos los campos',
                            container : 'floating',
                            timer : 3000
                        });
                    }else{
                        $.niftyNoty({
                            type: 'danger',
                            icon : 'fa fa-check',
                            message : 'Ocurrio un error en el Proceso',
                            container : 'floating',
                            timer : 3000
                        });
                    }
                   
                }
            });
        }      
    });
});