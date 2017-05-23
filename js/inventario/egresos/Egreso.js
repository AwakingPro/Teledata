$(document).ready(function(){

    $('#storeEgreso')[0].reset();
    $('.selectpicker').selectpicker('refresh')

    Table = $('#EgresoTable').DataTable({
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
        url: "../includes/inventario/egresos/showMovimientos.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                fecha_movimiento = moment(array.fecha_movimiento).format('DD-MM-YYYY');

                var rowNode = Table.row.add([
                    ''+array.numero_serie+'',
                    ''+array.tipo + ' ' + array.marca + ' ' + array.modelo+'',
                    ''+array.destino_tipo+ ' ' +array.destino_nombre+'',
                    ''+fecha_movimiento+'',
                    ''+array.hora_movimiento+'',
                    ''+array.responsable+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id',array.id)
                    .addClass('text-center')
            });

        }
    });

    $('#origen_tipo').on('change', function () {

        $('#producto_id').empty();
        $('#producto_id').append(new Option('Seleccione Opción',''));

        $('#producto_id').selectpicker('refresh');

        $('#origen_id').empty();
        $('#origen_id').append(new Option('Seleccione Opción',''));

        if($(this).val()){

            $('.origen').show();

            
            if($(this).val() == 1){

                $('#span_origen').text('Bodega');

                $.ajax({
                    type: "POST",
                    url: "../includes/inventario/egresos/getBodega.php",
                    success: function(response){

                        $.each(response.array, function( index, array ) {
                            $('#origen_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
                        });

                        $('.selectpicker').selectpicker('render');
                        $('.selectpicker').selectpicker('refresh');
                    }
                });
            }else{
                $('#span_origen').text('Cliente');
                $('.selectpicker').selectpicker('render');
                $('.selectpicker').selectpicker('refresh');
            }
        }else{
            $('.origen').hide();
        }

    });


    $('#destino_tipo').on('change', function () {

        $('#destino_id').empty();
        $('#destino_id').append(new Option('Seleccione Opción',''));

        if($(this).val()){

            $('.destino').show();

            if($(this).val() == 1){

                $('#span_destino').text('Bodega');

                $.ajax({
                    type: "POST",
                    url: "../includes/inventario/egresos/getBodega.php",
                    success: function(response){

                        $.each(response.array, function( index, array ) {
                            $('#destino_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
                        });

                        $('#destino_id').selectpicker('refresh');
                    }
                });
            }else{
                $('#span_destino').text('Cliente');
                $('#destino_id').selectpicker('refresh');
            }
        }else{
            $('.destino').hide();
        }
    });

    $('#origen_id').on('change', function () {

        $('#producto_id').empty();
        $('#producto_id').append(new Option('Seleccione Opción',''));

        origen_tipo = $('#origen_tipo').val();
        origen_id = $('#origen_id').val();

        $.ajax({
            type: "POST",
            url: "../includes/inventario/egresos/getProducto.php",
            data:"&origen_tipo="+origen_tipo+"&origen_id="+origen_id,
            success: function(response){

                $.each(response.array, function( index, array ) {
                    $('#producto_id').append('<option value="'+array.id+'" data-content="'+array.tipo + ' ' + array.marca + ' ' + array.modelo+ ' - ' + array.numero_serie+'"></option>');
                });

                $('.selectpicker').selectpicker('render');
                $('.selectpicker').selectpicker('refresh');
            }
        });
            
    });



    $('body').on('click', '#guardarEgreso', function () {

        $.postFormValues('../includes/inventario/egresos/storeMovimiento.php', '#storeEgreso', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                fecha_movimiento = moment(response.array.fecha_movimiento).format('DD-MM-YYYY');

                var rowNode = Table.row.add([
                    ''+response.array.numero_serie+'',
                    ''+response.array.producto+'',
                    ''+response.array.destino+'',
                    ''+fecha_movimiento+'',
                    ''+response.array.hora_movimiento+'',
                    ''+response.array.responsable+'',
                ]).draw(false).node();

                $(rowNode)
                    .attr('id',response.array.id)
                    .addClass('text-center')

                $('#storeEgreso')[0].reset();
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
});