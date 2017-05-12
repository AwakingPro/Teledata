$(document).ready(function(){

    $('#storeEgreso')[0].reset();
    $('.selectpicker').selectpicker('refresh')

    EgresoTable = $('#EgresoTable').DataTable({
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
        url: "../../includes/inventario/egresos/showMovimientos.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                fecha_movimiento = moment(array.fecha_movimiento).format('DD-MM-YYYY');

                var rowNode = EgresoTable.row.add([
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

        $('#origen_id').empty();
        $('#origen_id').append(new Option('Seleccione Opción',''));

        if($(this).val()){

            $('.origen').show();

            
            if($(this).val() == 1){

                $('#span_origen').text('Bodega');

                $.ajax({
                    type: "POST",
                    url: "../../includes/inventario/egresos/getBodega.php",
                    success: function(response){

                        $.each(response.array, function( index, array ) {
                            $('#origen_id').append(new Option(array.nombre,array.id));
                        });

                        $('#origen_id').selectpicker('refresh');
                    }
                });
            }else{
                $('#span_origen').text('Cliente');
                $('#origen_id').selectpicker('refresh');
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
                    url: "../../includes/inventario/egresos/getBodega.php",
                    success: function(response){

                        $.each(response.array, function( index, array ) {
                            $('#destino_id').append(new Option(array.nombre,array.id));
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
            url: "../../includes/inventario/egresos/getProducto.php",
            data:"&origen_tipo="+origen_tipo+"&origen_id="+origen_id,
            success: function(response){

                $.each(response.array, function( index, array ) {
                    $('#producto_id').append(new Option(array.tipo + ' ' + array.marca + ' ' + array.modelo,array.id));
                });

                $('#producto_id').selectpicker('refresh');
            }
        });
            
    });



    $('body').on('click', '#guardarEgreso', function () {

        $.postFormValues('../../includes/inventario/egresos/storeMovimiento.php', '#storeEgreso', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Producto = $('#producto_id option[value="'+response.array.producto_id+'"]').first().text();
                DestinoId = $('#destino_id option[value="'+response.array.destino_id+'"]').first().text()
                DestinoTipo = $('#destino_tipo option[value="'+response.array.destino_tipo+'"]').first().text()
                fecha_movimiento = moment(response.array.fecha_movimiento).format('DD-MM-YYYY');

                var rowNode = EgresoTable.row.add([
                    ''+response.array.numero_serie+'',
                    ''+Producto+'',
                    ''+DestinoTipo+ ' ' + DestinoId+'',
                    ''+fecha_movimiento+'',
                    ''+response.array.hora_movimiento+'',
                    ''+response.array.responsable+'',
                ]).draw(false).node();

                $(rowNode)
                    .attr('id',response.array.id)
                    .addClass('text-center')

                $('#storeEgreso')[0].reset();
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
   

    $('body').on( 'click', '.Update', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectId = ObjectTR.attr("id");
        var ObjectModel = ObjectTR.data("modelo_producto_id");
        var ObjectStore = ObjectTR.data("bodega_id");
        var ObjectProvider = ObjectTR.data("proveedor_id");
        var ObjectDateBuy = ObjectTR.find("td").eq(0).text();
        var ObjectDateEntry = ObjectTR.find("td").eq(1).text();
        var ObjectBill = ObjectTR.find("td").eq(2).text();
        var ObjectValue = ObjectTR.find("td").eq(5).text();
        var ObjectQuantity = ObjectTR.find("td").eq(6).text();
        $('#updateIngreso').find('input[name="id"]').val(ObjectId);
        $('#updateIngreso').find('select[name="modelo_producto_id"]').val(ObjectModel);
        $('#updateIngreso').find('select[name="bodega_id"]').val(ObjectStore);
        $('#updateIngreso').find('select[name="proveedor_id"]').val(ObjectProvider);
        $('#updateIngreso').find('input[name="fecha_compra"]').val(ObjectDateBuy);
        $('#updateIngreso').find('input[name="fecha_ingreso"]').val(ObjectDateEntry);
        $('#updateIngreso').find('input[name="numero_factura"]').val(ObjectBill);
        $('#updateIngreso').find('input[name="valor"]').val(parseInt(ObjectValue.replace(/,/g, '')));
        $('#updateIngreso').find('input[name="cantidad"]').val(ObjectQuantity);

        $('.selectpicker').selectpicker('refresh');

        $('#IngresoFormUpdate').modal('show');
  
    });


    $('body').on('click', '#actualizarIngreso', function () {

        $.postFormValues('../../includes/inventario/ingresos/updateIngreso.php', '#updateIngreso', function(response){
                    
            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Actualizado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Modelo = $('#modelo_producto_id option[value="'+response.array.modelo_producto_id+'"]').first().text();
                Proveedor = $('#proveedor_id option[value="'+response.array.proveedor_id+'"]').first().text();
                Bodega = $('#bodega_id option[value="'+response.array.bodega_id+'"]').first().text();

                ObjectTR = $("#"+response.array.id);

                ObjectTR.data('modelo_producto_id', response.array.modelo_producto_id)
                ObjectTR.data('proveedor_id', response.array.proveedor_id)
                ObjectTR.data('bodega_id', response.array.bodega_id)
                ObjectTR.find("td").eq(0).html(response.array.fecha_compra);
                ObjectTR.find("td").eq(1).html(response.array.fecha_ingreso);
                ObjectTR.find("td").eq(2).html(response.array.numero_factura);
                ObjectTR.find("td").eq(3).html(Modelo);
                ObjectTR.find("td").eq(4).html(Proveedor);
                ObjectTR.find("td").eq(5).html($.number(response.array.valor));
                ObjectTR.find("td").eq(6).html(response.array.cantidad);
                ObjectTR.find("td").eq(7).html(Bodega);

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