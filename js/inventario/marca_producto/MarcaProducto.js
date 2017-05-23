$(document).ready(function(){

    Table = $('#MarcaProductoTable').DataTable({
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
        url: "../includes/inventario/marca_producto/showMarcaProducto.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                var rowNode = Table.row.add([
                    ''+array.tipo+'',
                    ''+array.nombre+'',
                    ''+array.descripcion+'',
                    ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $( rowNode ).attr('id',array.id).data('tipo_producto_id',array.tipo_producto_id).addClass('text-center');
            });
        
            
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/inventario/marca_producto/showTipoProducto.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.tipo_producto_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
        
        }
    });

    $('body').on('click', '#guardarMarcaProducto', function () {

        var data = $('#storeMarcaProducto').serialize();
        var array = $('#storeMarcaProducto').serializeArray();

        if(ValidarString(array[0].value, 'Tipo') && ValidarString(array[1].value, 'Nombre') && ValidarString(array[1].value, 'Descripción')){

            $.ajax({
                type: "POST",
                url: "../includes/inventario/marca_producto/storeMarcaProducto.php",
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

                        TipoProducto = $('#tipo_producto_id option[value="'+response.array.tipo_producto_id+'"]').first().data('content');

                        var rowNode = Table.row.add([
                            ''+TipoProducto+'',
                            ''+response.array.nombre+'',
                            ''+response.array.descripcion+'',
                            ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                        ]).draw(false).node();

                        $( rowNode ).attr('id',response.array.id).data('tipo_producto_id',response.array.tipo_producto_id).addClass('text-center')
                        
                        $('#storeMarcaProducto')[0].reset();
                        $('.selectpicker').selectpicker('render');
                        $('.selectpicker').selectpicker('refresh');
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
        var ObjectType = ObjectTR.data("tipo_producto_id");
        var ObjectName = ObjectTR.find("td").eq(1).text();
        var ObjectDescription = ObjectTR.find("td").eq(2).text();
        $('#updateMarcaProducto').find('input[name="id"]').val(ObjectId);
        $('#updateMarcaProducto').find('select[name="tipo_producto_id"]').val(ObjectType);
        $('#updateMarcaProducto').find('input[name="nombre"]').val(ObjectName);
        $('#updateMarcaProducto').find('textarea[name="descripcion"]').text(ObjectDescription);

        $('.selectpicker').selectpicker('render');
        $('.selectpicker').selectpicker('refresh');

        $('#MarcaProductoFormUpdate').modal('show');
  
    });


    $('body').on('click', '#actualizarMarcaProducto', function () {

        var data = $('#updateMarcaProducto').serialize();
        var array = $('#updateMarcaProducto').serializeArray();

        if(ValidarString(array[1].value, 'Tipo') && ValidarString(array[2].value, 'Nombre') && ValidarString(array[3].value, 'Descripción')){
                        
            $.ajax({
                type: "POST",
                url: "../includes/inventario/marca_producto/updateMarcaProducto.php",
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

                        TipoProducto = $('#tipo_producto_id option[value="'+response.array.tipo_producto_id+'"]').first().data('content');

                        ObjectTR = $("#"+response.array.id);
                        ObjectTR.data('tipo_producto_id', response.array.tipo_producto_id)
                        ObjectTR.find("td").eq(0).html(TipoProducto);
                        ObjectTR.find("td").eq(1).html(response.array.nombre);
                        ObjectTR.find("td").eq(2).html(response.array.descripcion);
                        
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

    $('body').on('click', '.Remove', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("id");

        swal({   
            title: "Desea eliminar este registro?",   
            text: "Confirmar eliminación!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Eliminar!",  
            cancelButtonText: "Cancelar",         
            closeOnConfirm: true 
        },function(isConfirm){   
            if (isConfirm) {
    
                $.ajax({
                    url: "../includes/inventario/marca_producto/deleteMarcaProducto.php",
                    type: 'POST',
                    data:"&id="+ObjectId,
                    success:function(response){
                        setTimeout(function() {
                            if(response.status == 1){
                                swal("Exito!","El registro ha sido eliminado!","success");
                                Table.row($(ObjectTR))
                                    .remove()
                                    .draw();
                            }else if(response.status == 3){
                                swal('Solicitud no procesada','Este registro no puede ser eliminado porque posee otros registros asociados','error');
                            }else{
                                swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
                            }
                        }, 1000);  
                    },
                    error:function(){
                        swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
                    }
                });
            }
        });
    });
});