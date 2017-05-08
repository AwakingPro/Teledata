$(document).ready(function(){

    BodegaTable = $('#BodegaTable').DataTable({
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
        url: "../includes/bodegas/showBodegas.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                var rowNode = BodegaTable.row.add([
                  ''+array.nombre+'',
                  ''+array.direccion+'',
                  ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>'+'',
                ]).draw(false).node();

                $( rowNode ).attr('id',array.id).addClass('text-center');
            });
        
            
        }
    });

    $('body').on('click', '#guardarBodega', function () {

        var data = $('#storeBodega').serialize();
        var array = $('#storeBodega').serializeArray();

        if(ValidarString(array[0].value, 'Nombre') && ValidarString(array[1].value, 'Dirección')){

            $.ajax({
                type: "POST",
                url: "../includes/bodegas/storeBodega.php",
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

                        var rowNode = BodegaTable.row.add([
                          ''+response.array.nombre+'',
                          ''+response.array.direccion+'',
                          ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>'+'',
                        ]).draw(false).node();

                        $( rowNode ).attr('id',response.array.id).addClass('text-center')
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
        var ObjectAddress = ObjectTR.find("td").eq(1).text();
        $('#updateBodega').find('input[name="id"]').val(ObjectId);
        $('#updateBodega').find('input[name="nombre"]').val(ObjectName);
        $('#updateBodega').find('textarea[name="direccion"]').text(ObjectAddress);

        $('#BodegaFormUpdate').modal('show');
  
    });


    $('body').on('click', '#actualizarBodega', function () {

        var data = $('#updateBodega').serialize();
        var array = $('#updateBodega').serializeArray();

        if(ValidarString(array[1].value, 'Nombre') && ValidarString(array[2].value, 'Dirección')){
                        
            $.ajax({
                type: "POST",
                url: "../includes/bodegas/updateBodega.php",
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
                        ObjectTR.find("td").eq(1).html(response.array.direccion);
                        
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