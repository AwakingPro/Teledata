$(document).ready(function(){

    Table = $('#UfTable').DataTable({
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

    $(".number").mask("000.000.000.000",{reverse: true});

    $.ajax({
        type: "POST",
        url: "../includes/facturacion/uf/showUf.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                if(array.mes == 1){
                    mes = 'Enero'
                }else if(array.mes == 2){
                    mes = 'Febrero'
                }else if(array.mes == 3){
                    mes = 'Marzo'
                }else if(array.mes == 4){
                    mes = 'Abril'
                }else if(array.mes == 5){
                    mes = 'Mayo'
                }else if(array.mes == 6){
                    mes = 'Junio'
                }else if(array.mes == 7){
                    mes = 'Julio'
                }else if(array.mes == 8){
                    mes = 'Agosto'
                }else if(array.mes == 9){
                    mes = 'Septiembre'
                }else if(array.mes == 10){
                    mes = 'Octubre'
                }else if(array.mes == 11){
                    mes = 'Noviembre'
                }else if(array.mes == 12){
                    mes = 'Diciembre'
                }

                var rowNode = Table.row.add([
                  ''+mes+'',
                  ''+array.valor+'',
                  ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id',array.id)
                    .data('mes',array.mes)
                    .addClass('text-center');
            });
        
            
        }
    });

    $('body').on('click', '#guardarUf', function () {

        $.postFormValues('../includes/facturacion/uf/storeUf.php', '#storeUf', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Personal = $('#personal_id option[value="'+response.array.personal_id+'"]').first().data('content');

                if(response.array.mes == 1){
                    mes = 'Enero'
                }else if(response.array.mes == 2){
                    mes = 'Febrero'
                }else if(response.array.mes == 3){
                    mes = 'Marzo'
                }else if(response.array.mes == 4){
                    mes = 'Abril'
                }else if(response.array.mes == 5){
                    mes = 'Mayo'
                }else if(response.array.mes == 6){
                    mes = 'Junio'
                }else if(response.array.mes == 7){
                    mes = 'Julio'
                }else if(response.array.mes == 8){
                    mes = 'Agosto'
                }else if(response.array.mes == 9){
                    mes = 'Septiembre'
                }else if(response.array.mes == 10){
                    mes = 'Octubre'
                }else if(response.array.mes == 11){
                    mes = 'Noviembre'
                }else if(response.array.mes == 12){
                    mes = 'Diciembre'
                }

                var rowNode = Table.row.add([
                  ''+mes+'',
                  ''+response.array.valor+'',
                  ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id',response.array.id)
                    .data('mes',response.array.mes)
                    .addClass('text-center');

                $('#storeUf')[0].reset();
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
        });     
    });

    $('body').on( 'click', '.Update', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectId = ObjectTR.attr("id");
        var ObjectMonth = ObjectTR.data("mes");
        var ObjectValue = ObjectTR.find("td").eq(1).text();
        $('#updateUf').find('input[name="id"]').val(ObjectId);
        $('#updateUf').find('select[name="mes"]').val(ObjectMonth);
        $('#updateUf').find('input[name="valor"]').val(ObjectValue);

        $('.selectpicker').selectpicker('refresh');

        $('#UfFormUpdate').modal('show');
  
    });


    $('body').on('click', '#actualizarUf', function () {

        $.postFormValues('../includes/facturacion/uf/updateUf.php', '#updateUf', function(response){
       
            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Actualizado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                if(response.array.mes == 1){
                    mes = 'Enero'
                }else if(response.array.mes == 2){
                    mes = 'Febrero'
                }else if(response.array.mes == 3){
                    mes = 'Marzo'
                }else if(response.array.mes == 4){
                    mes = 'Abril'
                }else if(response.array.mes == 5){
                    mes = 'Mayo'
                }else if(response.array.mes == 6){
                    mes = 'Junio'
                }else if(response.array.mes == 7){
                    mes = 'Julio'
                }else if(response.array.mes == 8){
                    mes = 'Agosto'
                }else if(response.array.mes == 9){
                    mes = 'Septiembre'
                }else if(response.array.mes == 10){
                    mes = 'Octubre'
                }else if(response.array.mes == 11){
                    mes = 'Noviembre'
                }else if(response.array.mes == 12){
                    mes = 'Diciembre'
                }

                ObjectTR = $("#"+response.array.id);
                ObjectTR.data('mes', response.array.mes)
                ObjectTR.find("td").eq(0).html(mes);
                ObjectTR.find("td").eq(1).html(response.array.valor);
                
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
                   
      
        });  
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
                    url: "../includes/facturacion/uf/deleteUf.php",
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