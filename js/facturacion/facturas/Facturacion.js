$(document).ready(function(){

    LoteTable = $('#LoteTable').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,
        bInfo:false,
        bFilter:false,
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

    IndividualTable = $('#IndividualTable').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,
        bInfo:false,
        bFilter:false,
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

    InstalacionTable = $('#InstalacionTable').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,
        bInfo:false,
        bFilter:false,
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

    //CONFIGURACION DEL SELECTPICKER, DATETIMEPICKER Y DATA-MASK

    $('.selectpicker').selectpicker();
    $('.date').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY',
        defaultDate: new Date()
    });

    $(".number").mask("000.000.000.000",{reverse: true});
    $("#cantidad").mask("000000");
    $("#impuesto").mask("00");

    function formatcurrency(n) {
        return n.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    }

    $.ajax({
        type: "POST",
        url: "../includes/facturacion/facturas/showServicios.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                if(array.EstatusFacturacion == 1){
                    Estatus = 'Pagada'
                    Icono = '<a href="'+array.UrlPdfBsale+'" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>'
                }else{
                    Estatus = 'Por pagar'
                    Icono = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-files-o Facturar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Facturar" title="" data-container="body"></i>'
                }

                var rowNode = InstalacionTable.row.add([
                    ''+Estatus+'',
                    ''+array.Cliente+'',
                    ''+array.Rut+'',
                    ''+array.Grupo+'',
                    ''+array.Valor+'',
                    ''+Icono+''
                ]).draw(false).node();

                $( rowNode )
                    .attr('id',array.Id)
                    .addClass('text-center')
               
            });

            $('[data-toggle="popover"]').popover();
        }
    });

    $('body').on('click', '.Facturar', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("id");

        swal({   
            title: "Deseas facturar este registro?",   
            text: "Confirmar facturación!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Facturar!",  
            cancelButtonText: "Cancelar", 
            showLoaderOnConfirm: true,        
            closeOnConfirm: false 
        },function(isConfirm){   
            if (isConfirm) {

                $.ajax({
                    type: "POST",
                    url: "../includes/facturacion/facturas/storeFactura.php",
                    data: "id="+ObjectId,
                    success: function(response){

                        if(response.status == 1){

                            $(ObjectMe).after('<a href="'+response.UrlPdf+'" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>');
                            $(ObjectMe).remove();

                            ObjectTR.find("td").eq(0).text('Pagada');

                            swal("Éxito!","La factura ha sido generada!","success");

                        }else if(response.status == 2){
                            swal('Solicitud no procesada','Debes ingresar el valor UF del mes en curso','error');
                        }else if(response.status == 3){
                            swal('Solicitud no procesada','El servicio no existe, por favor actualizar la pagina','error');
                        }else if(response.status == 4){
                            swal('Solicitud no procesada','El cliente no existe, por favor actualizar la pagina','error');
                        }else if(response.status == 99){
                            swal('Solicitud no procesada','El servicio cUrl no esta disponible en el servidor, por favor contactar al administrador','error');
                        }else{
                            swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
                        }
                    },
                    error: function(xhr, status, error){
                        setTimeout(function(){ 
                            var err = JSON.parse(xhr.responseText);
                            swal('Solicitud no procesada',err.Message,'error');
                        }, 1000);
                    }
                });
            }
        });
    });
});