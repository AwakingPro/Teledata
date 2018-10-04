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

    $('body').on('click', '#filtrarReporte', function () {

        $.postFormValues('../includes/inventario/ingresos/showReporte.php', '#showReporte', {}, function(response){

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

            var pieData1 = ''
            pieData1 += '[';
            $.each(response.pie, function( i, array ) {
                var nombre = array.nombre;
                var cantidad = array.cantidad;
                pieData1 += '{"data":"'+cantidad+'","label":"'+nombre+'"},';
            });
            pieData1 = pieData1.substring(0, pieData1.length -1);
            pieData1 += ']';

            $.plot('#pie-chart', $.parseJSON(pieData1), {
                series: {
                    pie: {
                        show: true,
                        stroke: { 
                            width: 2,
                        },
                    },
                },
                legend: {
                    container: '#flc-pie',
                    backgroundOpacity: 0.5,
                    noColumns: 0,
                    backgroundColor: "white",
                    lineWidth: 0
                },
                grid: {
                    hoverable: true,
                    clickable: true
                },
                tooltip: true,
                tooltipOpts: {
                    content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                    shifts: {
                        x: 20,
                        y: 0
                    },
                    defaultTheme: false,
                    cssClass: 'flot-tooltip'
                },
            });

            $('.reporte').show()
            $('#showReporte')[0].reset();
            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');

        });
    });

    $('#bodega_tipo').on('change', function () {

        $('#bodega_id').empty();
        $('#bodega_id').append(new Option('Todas',''));

        if($(this).val()){

            $('.tipo').show()

            if($(this).val() == 1){

                $('#span_tipo').text('Bodega');

                $.ajax({
                    type: "POST",
                    url: "../includes/inventario/egresos/getBodega.php",
                    success: function(response){
                        $.each(response.array, function( index, array ) {
                            $('#bodega_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
                        });
                    }
                });
            }else if($(this).val() == 2){
                $('#span_tipo').text('Cliente');

                 $.ajax({
                    type: "POST",
                    url: "../includes/inventario/egresos/showPersonaEmpresa.php",
                    success: function(response){
                        $.each(response.array, function( index, array ) {
                            $('#bodega_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
                        });
                    }
                });
                
            }else{
                $('#span_tipo').text('Estación');

                 $.ajax({
                    type: "POST",
                    url: "../includes/inventario/egresos/showEstaciones.php",
                    success: function(response){
                        $.each(response.array, function( index, array ) {
                            $('#bodega_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
                        });
                    }
                });
            }

            setTimeout(function() {       
                $('#bodega_id').selectpicker('render');
                $('#bodega_id').selectpicker('refresh');
            }, 1000);

        }else{
            $('.tipo').hide()
            $('#span_tipo').text('Tipo');
        }
    });
});