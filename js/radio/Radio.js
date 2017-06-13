$(document).ready(function(){

    EstacionTable = $('#EstacionTable').DataTable({
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
        url: "../includes/radio/showEstaciones.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                var rowNode = EstacionTable.row.add([
                  ''+array.nombre+'',
                  ''+array.direccion+'',
                  ''+array.telefono+'',
                  ''+array.personal+'',
                  ''+array.correo+'',
                  ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-search Find"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id','estacion_'+array.id)
                    .data('personal_id',array.personal_id)
                    .addClass('text-center');
            });
        
            
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/radio/showPersonal.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.personal_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
        
        }
    });

    $('body').on('click', '#guardarEstacion', function () {


        $.postFormValues('../includes/radio/storeEstacion.php', '#storeEstacion', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Personal = $('#personal_id option[value="'+response.array.personal_id+'"]').first().data('content');

                var rowNode = EstacionTable.row.add([
                  ''+response.array.nombre+'',
                  ''+response.array.direccion+'',
                  ''+response.array.telefono+'',
                  ''+Personal+'',
                  ''+response.array.correo+'',
                  ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-search Find"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id','estacion_'+response.array.id)
                    .data('personal_id',response.array.personal_id)
                    .addClass('text-center');

                $('#storeEstacion')[0].reset();
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
             
        });
    });

    $('#EstacionTable tbody').on( 'click', 'i.fa', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectRow = ObjectTR.attr("id");
        var RowSplit = ObjectRow.split('_');
        var ObjectId = RowSplit[1];
        var ObjectName = ObjectTR.find("td").eq(0).text();
        var ObjectAddress = ObjectTR.find("td").eq(1).text();
        var ObjectTelephone = ObjectTR.find("td").eq(2).text();
        var ObjectPersonal = ObjectTR.data("personal_id");
        var ObjectEmail = ObjectTR.find("td").eq(4).text();
        $('#updateEstacion').find('input[name="id"]').val(ObjectId);
        $('#updateEstacion').find('input[name="nombre"]').val(ObjectName);
        $('#updateEstacion').find('textarea[name="direccion"]').text(ObjectAddress);
        $('#updateEstacion').find('input[name="telefono"]').val(ObjectTelephone);
        $('#updateEstacion').find('select[name="personal_id"]').val(ObjectPersonal);
        $('#updateEstacion').find('input[name="correo"]').val(ObjectEmail);

        if($(this).hasClass('fa-search')){
            $("#EstacionFormUpdate :input").attr("readonly", true);
            $('#span_estacion').text('Ver');
            $('#actualizarEstacion').hide()
            $('#EstacionFormUpdate').modal('show');
        }else if($(this).hasClass('fa-pencil')){
            $("#EstacionFormUpdate :input").attr("readonly", false);
            $('#span_estacion').text('Actualizar');
            $('#actualizarEstacion').show()
            $('#EstacionFormUpdate').modal('show');
        }

        $('.selectpicker').selectpicker('render');
        $('.selectpicker').selectpicker('refresh');
  
    });

    $('body').on('click', '#actualizarEstacion', function () {

        var data = $('#updateEstacion').serialize();
        var array = $('#updateEstacion').serializeArray();

        $.postFormValues('../includes/radio/updateEstacion.php', '#updateEstacion', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Actualizado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Personal = $('#personal_id option[value="'+response.array.personal_id+'"]').first().data('content');

                ObjectTR = $("#estacion_"+response.array.id);
                ObjectTR.data('personal_id', response.array.personal_id)
                ObjectTR.find("td").eq(0).html(response.array.nombre);
                ObjectTR.find("td").eq(1).html(response.array.direccion);
                ObjectTR.find("td").eq(2).html(response.array.telefono);
                ObjectTR.find("td").eq(3).html(Personal);
                ObjectTR.find("td").eq(4).html(response.array.correo);
                
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
        });
    });

    $('#EstacionTable tbody').on( 'click', '.Remove', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectRow = ObjectTR.attr("id");
        var RowSplit = ObjectRow.split('_');
        var ObjectId = RowSplit[1];

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
                    url: "../includes/radio/deleteEstacion.php",
                    type: 'POST',
                    data:"&id="+ObjectId,
                    success:function(response){
                        setTimeout(function() {
                            if(response.status == 1){
                                swal("Exito!","El registro ha sido eliminado!","success");
                                EstacionTable.row($(ObjectTR))
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