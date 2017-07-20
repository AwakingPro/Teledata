var json = []

$(document).ready(function(){

    //FUNCION NECESARIA PARA MOSTRAR 2 MODALES AL MISMO TIEMPO

    $(document).on({
        'show.bs.modal': function () {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        },
        'hidden.bs.modal': function() {
            if ($('.modal:visible').length > 0) {
              if($('.modal').hasClass('in')) {
                $('body').addClass('modal-open');
              }    

            }
        }
    }, '.modal');

    //CONFIGURACION DEL SELECTPICKER, DATETIMEPICKER Y DATA-MASK

    $('.selectpicker').selectpicker();
    $('.date').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY'
    });

    $(".number").mask("0000000000");
    $(".valor").mask("000.000.000.000",{reverse: true});

    Table = $('#IngresoTable').DataTable({
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

                if(array.fecha_compra && array.fecha_compra != '0000-00-00'){
                    fecha_compra = moment(array.fecha_compra).format('DD-MM-YYYY');
                }else{
                    fecha_compra = ''
                }
                
                fecha_ingreso = moment(array.fecha_ingreso).format('DD-MM-YYYY');

                if(array.estado == 1){
                    estado = 'Nuevo';
                }else{
                    estado = 'Reacondicionado';
                }

                if(array.proveedor){
                    proveedor = array.proveedor
                }else{
                    proveedor = ''
                }

                var rowNode = Table.row.add([

                    ''+fecha_compra+'',
                    ''+fecha_ingreso+'',
                    ''+proveedor+'',
                    ''+array.numero_factura+'',
                    ''+array.tipo + ' ' + array.marca + ' ' + array.modelo+'',
                    ''+array.cantidad+'',
                    ''+array.numero_serie+'',
                    ''+array.mac_address+'',
                    ''+estado+'',
                    ''+array.valor+'',
                    ''+array.bodega+'',
                    ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-search Find"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id',array.id)
                    .data('modelo_producto_id',array.modelo_producto_id)
                    .data('proveedor_id',array.proveedor_id)
                    .data('bodega_id',array.bodega_id)
                    .data('estado',array.estado)
                    .addClass('text-center')
            });
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/inventario/ingresos/showModelo.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.modelo_producto_id').append('<option value="'+array.id+'" data-content="'+array.tipo + ' ' + array.marca + ' ' + array.nombre+'"></option>');
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
                $('.proveedor_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
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
                $('.bodega_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/inventario/bodegas/showPersonal.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.personal_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
        
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/inventario/modelo_producto/showMarcaProducto.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.marca_producto_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
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

                $.each(response.array, function( index, array ) {

                    Modelo = $('#modelo_producto_id option[value="'+array.modelo_producto_id+'"]').first().data('content');
                    if(array.proveedor_id){
                        Proveedor = $('#proveedor_id option[value="'+array.proveedor_id+'"]').first().data('content');
                    }else{
                        Proveedor = ''
                    }
                    
                    Bodega = $('#bodega_id option[value="'+array.bodega_id+'"]').first().data('content');

                    if(array.estado == 1){
                        estado = 'Nuevo';
                    }else{
                        estado = 'Reacondicionado';
                    }

                    var rowNode = Table.row.add([
                        ''+array.fecha_compra+'',
                        ''+array.fecha_ingreso+'',
                        ''+Proveedor+'',
                        ''+array.numero_factura+'',
                        ''+Modelo+'',
                        ''+array.cantidad+'',
                        ''+array.numero_serie+'',
                        ''+array.mac_address+'',
                        ''+estado+'',
                        ''+array.valor+'',
                        ''+Bodega+'',
                        ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-search Find"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                    ]).draw(false).node();

                    $(rowNode)
                        .attr('id',array.id)
                        .data('modelo_producto_id',array.modelo_producto_id)
                        .data('proveedor_id',array.proveedor_id)
                        .data('bodega_id',array.bodega_id)
                        .data('estado',array.estado)
                        .addClass('text-center')
                });


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

            }else if(response.status == 99){

                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Debe llenar los datos de los productos',
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
   

    $('body').on( 'click', 'i.fa', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectId = ObjectTR.attr("id");
        var ObjectModel = ObjectTR.data("modelo_producto_id");
        var ObjectStore = ObjectTR.data("bodega_id");
        var ObjectState = ObjectTR.data("estado");
        var ObjectProvider = ObjectTR.data("proveedor_id");
        var ObjectDateBuy = ObjectTR.find("td").eq(0).text();
        var ObjectDateEntry = ObjectTR.find("td").eq(1).text();
        var ObjectBill = ObjectTR.find("td").eq(3).text();
        var ObjectQuantity = ObjectTR.find("td").eq(5).text();
        var ObjectSerial = ObjectTR.find("td").eq(6).text();
        var ObjectMacAddress = ObjectTR.find("td").eq(7).text();
        var ObjectValue = ObjectTR.find("td").eq(9).text();
        $('#updateIngreso').find('input[name="id"]').val(ObjectId);
        $('#updateIngreso').find('select[name="modelo_producto_id"]').val(ObjectModel);
        $('#updateIngreso').find('select[name="bodega_id"]').val(ObjectStore);
        $('#updateIngreso').find('select[name="proveedor_id"]').val(ObjectProvider);
        $('#updateIngreso').find('input[name="fecha_compra"]').val(ObjectDateBuy);
        $('#updateIngreso').find('input[name="fecha_ingreso"]').val(ObjectDateEntry);
        $('#updateIngreso').find('input[name="numero_factura"]').val(ObjectBill);
        $('#updateIngreso').find('input[name="numero_serie"]').val(ObjectSerial);
        $('#updateIngreso').find('input[name="mac_address"]').val(ObjectMacAddress);
        $('#updateIngreso').find('input[name="valor"]').val(ObjectValue);
        $('#updateIngreso').find('input[name="cantidad"]').val(ObjectQuantity);

        if(ObjectState == 1){
            $('.label_estado').removeClass('active')
            $('.label_nuevo').addClass('active')
            $('#updateIngreso').find('.input_nuevo').prop('checked',true);
            $('.estado').val(1)
            $('.nuevo').show()
            $(".fecha_compra").attr('validation','not_null');
            $('.numero_factura').attr('validation','not_null');
            $('.proveedor_id').attr('validation','not_null');
            $('.valor').attr('validation','not_null');
        }else{
            $('.label_estado').removeClass('active')
            $('.label_reacondicionado').addClass('active')
            $('#updateIngreso').find('.input_reacondicionado').prop('checked',true);
            $('.estado').val(2)
            $(".fecha_compra").removeAttr('validation');
            $('.numero_factura').removeAttr('validation');
            $('.proveedor_id').removeAttr('validation');
            $('.valor').removeAttr('validation');
            $('.nuevo').hide() 
        }

        if($(this).hasClass('fa-search')){
            $("#IngresoFormUpdate :input").attr("readonly", true);
            $('#span_ingreso').text('Ver');
            $('#actualizarIngreso').hide()
            $('#IngresoFormUpdate').modal('show');
        }else if($(this).hasClass('fa-pencil')){
            $("#IngresoFormUpdate :input").attr("readonly", false);
            $('#span_ingreso').text('Actualizar');
            $('#actualizarIngreso').show()
            $('#IngresoFormUpdate').modal('show');
        }

        $('.selectpicker').selectpicker('render');
        $('.selectpicker').selectpicker('refresh');
  
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

                Modelo = $('#modelo_producto_id option[value="'+response.array.modelo_producto_id+'"]').first().data('content');
                Proveedor = $('#proveedor_id option[value="'+response.array.proveedor_id+'"]').first().data('content');
                Bodega = $('#bodega_id option[value="'+response.array.bodega_id+'"]').first().data('content');

                if(response.array.estado == 1){
                    estado = 'Nuevo';
                }else{
                    estado = 'Reacondicionado';
                }

                ObjectTR = $("#"+response.array.id);

                ObjectTR.data('modelo_producto_id',response.array.modelo_producto_id)
                ObjectTR.data('proveedor_id', response.array.proveedor_id)
                ObjectTR.data('bodega_id', response.array.bodega_id)
                ObjectTR.data('estado', response.array.estado)
                ObjectTR.find("td").eq(0).html(response.array.fecha_compra);
                ObjectTR.find("td").eq(1).html(response.array.fecha_ingreso);
                ObjectTR.find("td").eq(2).html(Proveedor);
                ObjectTR.find("td").eq(3).html(response.array.numero_factura);
                ObjectTR.find("td").eq(4).html(Modelo);
                ObjectTR.find("td").eq(5).html(response.array.cantidad);
                ObjectTR.find("td").eq(6).html(response.array.numero_serie);
                ObjectTR.find("td").eq(7).html(response.array.mac_address);
                ObjectTR.find("td").eq(8).html(estado);
                ObjectTR.find("td").eq(9).html($.number(response.array.valor));
                ObjectTR.find("td").eq(10).html(Bodega);

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
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Eliminar!",  
            cancelButtonText: "Cancelar",         
            showLoaderOnConfirm: true
        },function(isConfirm){   
            if (isConfirm) {
    
                $.ajax({
                    url: "../includes/inventario/ingresos/deleteIngreso.php",
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

    $('input[name=tmp_ingreso]').on('change', function () {

        $('#storeIngreso').find('input[name="cantidad"]').val('');
        $('#storeIngreso').find('input[name="mac_address"]').val('');
        $('#storeIngreso').find('input[name="numero_serie"]').val('');

        if($(this).val() == 1){
            $('.unico').show()
            $('#storeIngreso').find('input[name="mac_address"]').attr('validation','not_null');
            $('#storeIngreso').find('input[name="numero_serie"]').attr('validation','not_null');
        }else{
            $('#storeIngreso').find('input[name="mac_address"]').removeAttr('validation');
            $('#storeIngreso').find('input[name="numero_serie"]').removeAttr('validation');
            $('.unico').hide() 
        }
    });


    $('#storeIngreso input[name="cantidad"]').on('input', function () {

        $('#json').val('')
        tipo_ingreso = $('input[name=tipo_ingreso]').val();
        cantidad = parseInt($(this).val()) + 1

        if(tipo_ingreso == 2){
            if($(this).val()){

                $('#updateCantidad').empty()
                contenido = ''

                for (var i = 1; i < cantidad; i++) {

                    contenido += '<div class="cantidad">'

                    contenido += '<p style="font-size:15px"><b>Producto '+i+'</b></p>'

                    contenido += '<div class="col-md-12">'

                    contenido += '<div class="clearfix m-b-10"></div>'

                    contenido += '<div class="col-md-12"><div class="form-group">'
                    contenido += '<label class="control-label" for="name">Mac Address</label>'
                    contenido += '<input id="mac_address" name="mac_address" validation="not_null" placeholder="Ingrese la mac address '+i+'" class="form-control input-sm" data-nombre="Mac Address '+i+'">'
                    contenido += '</div></div></div>'

                    contenido += '</div>'

                    contenido += '<div class="clearfix m-b-20"></div>'

                }

                $('#updateCantidad').append(contenido)
                $('#CantidadForm').modal('show')

            }
        }
        
    });

    $('body').on('click', '#guardarCantidad', function () {

        i = 0;
        exit = false
        var countObjs = 0;
        var countValidates = 0;
        var json = "["
        divs = $('#updateCantidad').find(".cantidad");
        
        divs.each(function(index, div) {

            if(exit){
                return false;
            }
            json += "{"

            objs = $(div).find("input,input[type='checkbox']:checked,input[type='radio']:checked,textarea,select");
            objs.each(function(index, obj) {
                if (obj.hasAttribute('name')) {
                    countObjs++;
                    if ($.validation(obj)) {
                        countValidates++;
                        name = $(obj).attr('name')
                        val = $(obj).val()

                        var is_last_item = (index == (objs.length - 1));
                        
                        if(!is_last_item){
                            json += '"'+name+'":'+val+','
                        }else{
                            json += '"'+name+'":'+val
                        }
                    }else{
                        exit = true;
                        return false;
                    }
                }
            })

            var is_last_item = (index == (divs.length - 1));

            if(!is_last_item){
                json += "},"
            }else{
                json += "}"
            }

            
        })

        json += "]"

        if (countObjs == countValidates) {
            $('#json').val(json)
            $.niftyNoty({
                type: 'success',
                icon : 'fa fa-check',
                message : 'Registro Guardado Exitosamente',
                container : 'floating',
                timer : 3000
            });
            $('#CantidadForm').modal('hide')
        }else{
            json = []
            return false
        }

    });

    $('#CantidadForm').on('hidden.bs.modal', function () {

        if(!$('#json').val()){
            $('#storeIngreso').find('input[name="cantidad"]').val('');
        }

    });

    $('#IngresoForm').on('show.bs.modal', function () {
        $('#storeIngreso').find('.input_nuevo').prop('checked',true);
        $('.label_estado').removeClass('active')
        $('.label_nuevo').addClass('active')
        $('.estado').val(1)
        $('.nuevo').show()
        $(".fecha_compra").attr('validation','not_null');
        $('.numero_factura').attr('validation','not_null');
        $('.proveedor_id').attr('validation','not_null');
        $('.valor').attr('validation','not_null');

    });

    $('input[name=tmp_estado]').on('change', function () {

        $('input[name="fecha_compra"]').val('');
        $('input[name="numero_factura"]').val('');
        $('select[name="proveedor_id"]').val('');
        $('input[name="valor"]').val('');

        if($(this).attr('id') == 'nuevo'){
            $('.label_estado').removeClass('active')
            $('.label_nuevo').addClass('active')
            $('.estado').val(1)
            $('.nuevo').show()
            $(".fecha_compra").attr('validation','not_null');
            $('.numero_factura').attr('validation','not_null');
            $('.proveedor_id').attr('validation','not_null');
            $('.valor').attr('validation','not_null');
        }else{
            $('.label_estado').removeClass('active')
            $('.label_reacondicionado').addClass('active')
            $('.estado').val(2)
            $(".fecha_compra").removeAttr('validation');
            $('.numero_factura').removeAttr('validation');
            $('.proveedor_id').removeAttr('validation');
            $('.valor').removeAttr('validation');
            $('.nuevo').hide() 
        }

        $('.selectpicker').selectpicker('render');
        $('.selectpicker').selectpicker('refresh');
    });

    $('input[name=tmp_ingreso]').on('change', function () {

        if($(this).attr('id') == 'unico'){
            $('input[name=tipo_ingreso]').val(1)
        }else{
            $('input[name=tipo_ingreso]').val(2)
        }
    });

    $('body').on('click', '#guardarProveedor', function () {

        $.postFormValues('../includes/inventario/proveedores/storeProveedor.php', '#storeProveedor', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                $('.proveedor_id').append('<option value="'+response.array.id+'" data-content="'+response.array.nombre+'"></option>');
                $('.proveedor_id').val(response.array.id);
                
                $('.selectpicker').selectpicker('render');
                $('.selectpicker').selectpicker('refresh')

                $('#storeProveedor')[0].reset();
                $('#modalProveedor').modal('hide');

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

    $('body').on('click', '#guardarBodega', function () {

        $.postFormValues('../includes/inventario/bodegas/storeBodega.php', '#storeBodega', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                $('.bodega_id').append('<option value="'+response.array.id+'" data-content="'+response.array.nombre+'"></option>');
                $('.bodega_id').val(response.array.id);
                
                $('.selectpicker').selectpicker('render');
                $('.selectpicker').selectpicker('refresh')

                $('#storeBodega')[0].reset();
                $('#modalBodega').modal('hide');

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

    $('body').on('click', '#guardarModelo', function () {

        $.postFormValues('../includes/inventario/modelo_producto/storeModeloProducto.php', '#storeModelo', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                $('.modelo_producto_id').append('<option value="'+response.array.id+'" data-content="'+response.array.nombre+'"></option>');
                $('.modelo_producto_id').val(response.array.id);
                
                $('.selectpicker').selectpicker('render');
                $('.selectpicker').selectpicker('refresh')

                $('#storeModelo')[0].reset();
                $('#modalModelo').modal('hide');

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
});