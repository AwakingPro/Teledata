$(document).ready(function(){

    $('.date').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY'
    });

    $(".number").mask("0000000000");

    IngresoTable = $('#IngresoTable').DataTable({
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
        url: "../includes/inventario/ingresos/showIngreso.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                fecha_compra = moment(array.fecha_compra).format('DD-MM-YYYY');
                fecha_ingreso = moment(array.fecha_ingreso).format('DD-MM-YYYY');

                var rowNode = IngresoTable.row.add([
                    ''+fecha_compra+'',
                    ''+fecha_ingreso+'',
                    ''+array.numero_factura+'',
                    ''+array.numero_serie+'',
                    ''+array.mac_address+'',
                    ''+array.tipo + ' ' + array.marca + ' ' + array.modelo+'',
                    ''+array.proveedor+'',
                    ''+$.number(array.valor)+'',
                    ''+array.cantidad+'',
                    ''+array.bodega+'',
                    ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>'+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id',array.id)
                    .data('modelo_producto_id',array.modelo_producto_id)
                    .data('proveedor_id',array.proveedor_id)
                    .data('bodega_id',array.bodega_id)
                    .addClass('text-center')
            });

        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/inventario/ingresos/showModelo.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.modelo_producto_id').append(new Option(array.tipo + ' ' + array.marca + ' ' + array.nombre,array.id));
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
        
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/inventario/ingresos/showProveedor.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.proveedor_id').append(new Option(array.nombre,array.id));
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
                $('.bodega_id').append(new Option(array.nombre,array.id));
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
        
        }
    });

    $('body').on('click', '#guardarIngreso', function () {

        $.postFormValues('../includes/inventario/ingresos/storeIngreso.php', '#storeIngreso', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Modelo = $('#modelo_producto_id option[value="'+response.array.modelo_producto_id+'"]').first().text();
                Proveedor = $('#proveedor_id option[value="'+response.array.proveedor_id+'"]').first().text();
                Bodega = $('#bodega_id option[value="'+response.array.bodega_id+'"]').first().text();

                var rowNode = IngresoTable.row.add([
                    ''+response.array.fecha_compra+'',
                    ''+response.array.fecha_ingreso+'',
                    ''+response.array.numero_factura+'',
                    ''+response.array.numero_serie+'',
                    ''+response.array.mac_address+'',
                    ''+Modelo+'',
                    ''+Proveedor+'',
                    ''+$.number(response.array.valor)+'',
                    ''+response.array.cantidad+'',
                    ''+Bodega+'',
                    ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>'+'',
                ]).draw(false).node();

                $(rowNode)
                    .attr('id',response.array.id)
                    .data('modelo_producto_id',response.array.modelo_producto_id)
                    .data('proveedor_id',response.array.proveedor_id)
                    .data('bodega_id',response.array.bodega_id)
                    .addClass('text-center')

                $('#storeIngreso')[0].reset();
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
        var ObjectSerial = ObjectTR.find("td").eq(3).text();
        var ObjectMacAddress = ObjectTR.find("td").eq(4).text();
        var ObjectValue = ObjectTR.find("td").eq(7).text();
        var ObjectQuantity = ObjectTR.find("td").eq(8).text();
        $('#updateIngreso').find('input[name="id"]').val(ObjectId);
        $('#updateIngreso').find('select[name="modelo_producto_id"]').val(ObjectModel);
        $('#updateIngreso').find('select[name="bodega_id"]').val(ObjectStore);
        $('#updateIngreso').find('select[name="proveedor_id"]').val(ObjectProvider);
        $('#updateIngreso').find('input[name="fecha_compra"]').val(ObjectDateBuy);
        $('#updateIngreso').find('input[name="fecha_ingreso"]').val(ObjectDateEntry);
        $('#updateIngreso').find('input[name="numero_factura"]').val(ObjectBill);
        $('#updateIngreso').find('input[name="numero_serie"]').val(ObjectSerial);
        $('#updateIngreso').find('input[name="mac_address"]').val(ObjectMacAddress);
        $('#updateIngreso').find('input[name="valor"]').val(parseInt(ObjectValue.replace(/,/g, '')));
        $('#updateIngreso').find('input[name="cantidad"]').val(ObjectQuantity);

        $('.selectpicker').selectpicker('render');
        $('.selectpicker').selectpicker('refresh');

        $('#IngresoFormUpdate').modal('show');
  
    });


    $('body').on('click', '#actualizarIngreso', function () {

        $.postFormValues('../includes/inventario/ingresos/updateIngreso.php', '#updateIngreso', function(response){
                    
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
                ObjectTR.find("td").eq(3).html(response.array.numero_serie);
                ObjectTR.find("td").eq(4).html(response.array.mac_address);
                ObjectTR.find("td").eq(5).html(Modelo);
                ObjectTR.find("td").eq(6).html(Proveedor);
                ObjectTR.find("td").eq(7).html($.number(response.array.valor));
                ObjectTR.find("td").eq(8).html(response.array.cantidad);
                ObjectTR.find("td").eq(9).html(Bodega);

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