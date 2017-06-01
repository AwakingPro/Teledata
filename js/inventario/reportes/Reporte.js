var json = []

$(document).ready(function(){

    //CONFIGURACION DEL SELECTPICKER, DATETIMEPICKER Y DATA-MASK

    $('.selectpicker').selectpicker();

    Table = $('#ReporteTable').DataTable({
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
        url: "../includes/inventario/ingresos/showModelo.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('#modelo_producto_id').append('<option value="'+array.id+'" data-content="'+array.tipo + ' ' + array.marca + ' ' + array.nombre+'"></option>');
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
        
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/inventario/ingresos/showBodega.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('#bodega_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
        }
    });

    $('body').on('click', '#filtrarReporte', function () {

        $.postFormValues('../includes/inventario/ingresos/showReporte.php', '#showReporte', function(response){

            Table.clear().draw();

            $.niftyNoty({
                type: 'success',
                icon : 'fa fa-check',
                message : 'Reporte Generado Exitosamente',
                container : 'floating',
                timer : 3000
            });

            $.each(response.array, function( index, array ) {

                if(array.estado == 1){
                    estado = 'Nuevo';
                }else{
                    estado = 'Reacondicionado';
                }

                fecha_compra = moment(array.fecha_compra).format('DD-MM-YYYY');
                fecha_ingreso = moment(array.fecha_ingreso).format('DD-MM-YYYY');

                var rowNode = Table.row.add([
                    ''+fecha_compra+'',
                    ''+fecha_ingreso+'',
                    ''+array.proveedor+'',
                    ''+array.numero_factura+'',
                    ''+array.tipo + ' ' + array.marca + ' ' + array.modelo+'',
                    ''+array.cantidad+'',
                    ''+array.numero_serie+'',
                    ''+array.mac_address+'',
                    ''+estado+'',
                    ''+array.valor+'',
                    ''+array.bodega+'',
                ]).draw(false).node();

                $(rowNode)
                    .attr('id',array.id)
                    .addClass('text-center')
            });


            $('#showReporte')[0].reset();
            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');

        });
    });
});