$(document).ready(function(){

    Table = $('#Table').DataTable({
        paging: true,
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
        url: "../includes/compras/costos/showCostos.php",
        beforeSend: function( ) {
            $('.TableLoader').html('<tr class="odd"><td valign="top" colspan="12" class="dataTables_empty"><div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div></td></tr>');
          },
        success: function(response){

            $.each(response.array, function( index, array ) {

                var rowNode = Table.row.add([
                  ''+array.nombre+'',
                  ''+array.personal+'',
                  ''+array.correo+'',
                  ''+array.direccion+'',
                  ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id',array.id)
                    .data('personal_id',array.personal_id)
                    .addClass('text-center');
            });
        
            
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/compras/costos/showPersonal.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.personal_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
            });

            $('.personal_id').selectpicker('render');
            $('.personal_id').selectpicker('refresh');
        
        }
    });

    $('body').on('click', '#guardar', function () {

        var data = $('#formStore').serialize();
        var array = $('#formStore').serializeArray();

        if(ValidarString(array[0].value, 'Nombre') && ValidarCorreo(array[2].value) && ValidarString(array[3].value, 'Comentario')){

            $.ajax({
                type: "POST",
                url: "../includes/compras/costos/storeCosto.php",
                data:data,
                beforeSend: function( ) {
                    $('.cargando').html('<tr class="odd"><td valign="top" colspan="12" class="dataTables_empty"><div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div></td></tr>');
                  },
                success: function(response){
                    $('.cargando').html('');
                    if(response.status == 1){

                        $.niftyNoty({
                            type: 'success',
                            icon : 'fa fa-check',
                            message : 'Registro Guardado Exitosamente',
                            container : 'floating',
                            timer : 3000
                        });

                        Personal = $('#personal_id option[value="'+response.array.personal_id+'"]').first().data('content');

                        var rowNode = Table.row.add([
                          ''+response.array.nombre+'',
                          ''+Personal+'',
                          ''+response.array.correo+'',
                          ''+response.array.direccion+'',
                          ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                        ]).draw(false).node();

                        $( rowNode )
                            .attr('id',response.array.id)
                            .data('personal_id',response.array.personal_id)
                            .addClass('text-center');

                        $('#formStore')[0].reset();
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
        var ObjectName = ObjectTR.find("td").eq(0).text();
        var ObjectPersonal = ObjectTR.data("personal_id");
        var ObjectEmail = ObjectTR.find("td").eq(2).text();
        var ObjectAddress = ObjectTR.find("td").eq(3).text();
        $('#formUpdate').find('input[name="id"]').val(ObjectId);
        $('#formUpdate').find('input[name="nombre"]').val(ObjectName);
        $('#formUpdate').find('select[name="personal_id"]').val(ObjectPersonal);
        $('#formUpdate').find('input[name="correo"]').val(ObjectEmail);
        $('#formUpdate').find('textarea[name="direccion"]').text(ObjectAddress);

        $('.selectpicker').selectpicker('refresh');

        $('#modalUpdate').modal('show');
  
    });


    $('body').on('click', '#update', function () {

        var data = $('#formUpdate').serialize();
        var array = $('#formUpdate').serializeArray();

        if(ValidarString(array[1].value, 'Nombre') && ValidarCorreo(array[3].value) && ValidarString(array[4].value, 'Comentario')){
       
            $.ajax({
                type: "POST",
                url: "../includes/compras/costos/updateCosto.php",
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

                        Personal = $('#personal_id option[value="'+response.array.personal_id+'"]').first().data('content');

                        ObjectTR = $("#"+response.array.id);
                        ObjectTR.data('personal_id', response.array.personal_id)
                        ObjectTR.find("td").eq(0).html(response.array.nombre);
                        ObjectTR.find("td").eq(1).html(Personal);
                        ObjectTR.find("td").eq(2).html(response.array.correo);
                        ObjectTR.find("td").eq(3).html(response.array.direccion);
                        
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
            confirmButtonColor: "#28a745",   
            confirmButtonText: "Eliminar!",  
            cancelButtonText: "Cancelar",         
            closeOnConfirm: true 
        },function(isConfirm){   
            if (isConfirm) {
    
                $.ajax({
                    url: "../includes/compras/costos/deleteCosto.php",
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