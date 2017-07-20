$(document).ready(function(){

    Table = $('#ModeloProductoTable').DataTable({
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
        url: "../includes/inventario/modelo_producto/showModeloProducto.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                var rowNode = Table.row.add([
                    ''+array.marca+'',
                    ''+array.nombre+'',
                    ''+array.descripcion+'',
                    ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $( rowNode ).attr('id',array.id).data('marca_producto_id',array.marca_producto_id).addClass('text-center');
            });
        
            
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/inventario/modelo_producto/showMarcaProducto.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.marca_producto_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
        
        }
    });

    $('body').on('click', '#guardarModeloProducto', function () {

        var data = $('#storeModeloProducto').serialize();
        var array = $('#storeModeloProducto').serializeArray();
        console.log(array);

        if(ValidarString(array[0].value, 'Marca') && ValidarString(array[1].value, 'Nombre') && ValidarString(array[2].value, 'Descripción')){

            $.ajax({
                type: "POST",
                url: "../includes/inventario/modelo_producto/storeModeloProducto.php",
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

                        MarcaProducto = $('#marca_producto_id option[value="'+response.array.marca_producto_id+'"]').first().data('content');

                        var rowNode = Table.row.add([
                            ''+MarcaProducto+'',
                            ''+response.array.nombre+'',
                            ''+response.array.descripcion+'',
                            ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                        ]).draw(false).node();

                        $( rowNode ).attr('id',response.array.id).data('marca_producto_id',response.array.marca_producto_id).addClass('text-center')
                        
                        $('#storeModeloProducto')[0].reset();
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
                            message : 'Ocurrió un error en el Proceso',
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
        var ObjectBrand = ObjectTR.data("marca_producto_id");
        var ObjectName = ObjectTR.find("td").eq(1).text();
        var ObjectDescription = ObjectTR.find("td").eq(2).text();
        $('#updateModeloProducto').find('input[name="id"]').val(ObjectId);
        $('#updateModeloProducto').find('select[name="marca_producto_id"]').val(ObjectBrand);
        $('#updateModeloProducto').find('input[name="nombre"]').val(ObjectName);
        $('#updateModeloProducto').find('textarea[name="descripcion"]').text(ObjectDescription);

        $('.selectpicker').selectpicker('render');
        $('.selectpicker').selectpicker('refresh');

        $('#ModeloProductoFormUpdate').modal('show');
  
    });


    $('body').on('click', '#actualizarModeloProducto', function () {

        var data = $('#updateModeloProducto').serialize();
        var array = $('#updateModeloProducto').serializeArray();

        if(ValidarString(array[1].value, 'Marca') && ValidarString(array[2].value, 'Nombre') && ValidarString(array[3].value, 'Descripción')){
                        
            $.ajax({
                type: "POST",
                url: "../includes/inventario/modelo_producto/updateModeloProducto.php",
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

                        MarcaProducto = $('#marca_producto_id option[value="'+response.array.marca_producto_id+'"]').first().data('content');

                        ObjectTR = $("#"+response.array.id);
                        ObjectTR.data('marca_producto_id', response.array.marca_producto_id)
                        ObjectTR.find("td").eq(0).html(MarcaProducto);
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
                            message : 'Ocurrió un error en el Proceso',
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
                    url: "../includes/inventario/modelo_producto/deleteModeloProducto.php",
                    type: 'POST',
                    data:"&id="+ObjectId,
                    success:function(response){
                        setTimeout(function() {
                            if(response.status == 1){
                                swal("Éxito!","El registro ha sido eliminado!","success");
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