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

    Table = $('#IngresoTable').DataTable()
    var pagado = 0;
    var por_pagar = 0;

    $.ajax({
        type: "POST",
        url: "../includes/compras/ingresos/showIngreso.php",
        success: function(response){
            Table = $('#IngresoTable').DataTable({
                order: [[0, 'desc']],
                data: response.array,
                columns: [
                    { data: 'numero_factura' },
                    { data: 'fecha_emision_factura' },
                    { data: 'proveedor' },
                    { data: 'estado' },
                    { data: 'centro_costo' },
                    { data: 'id' }
                ],
                destroy: true,
                'createdRow': function( row, data, dataIndex ) {
                    if(data.monto > 0){
                        monto = data.monto
                    }else{
                        monto = 0
                    }
                    if(data.estado != 2){
                        pagado += parseFloat(monto)
                    }else{
                        por_pagar += parseFloat(monto)
                    }
                    $(row)
                        .attr('id',data.id)
                        .data('proveedor_id',data.proveedor_id)
                        .data('centro_costo_id',data.centro_costo_id)
                        .data('estado_id',data.estado_id)
                        .data('numero_detalle',data.numero_detalle)
                        .data('fecha_detalle',data.fecha_detalle)
                        .data('detalle_factura',data.detalle_factura)
                        .data('monto',monto)
                        .addClass('text-center')
                },
                "columnDefs": [
                    {
                        "targets": 1,
                        "render": function (data, type, row) {
                            fecha_emision_factura = moment(data).format('DD-MM-YYYY');
                            return fecha_emision_factura
                        }
                    },
                    {
                        "targets": 5,
                        "render": function (data, type, row) {
                            Icono = '<i style="cursor: pointer; margin: 0 5px; font-size:15px;" class="fa fa-search Find"></i>' + ' <i style="cursor: pointer; margin: 0 5px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 5px; font-size:15px;" class="fa fa-times Remove"></i>'
                            return Icono;
                        }
                    },
                ],
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
            $('#pagado').text(pagado)
            $('#por_pagar').text(por_pagar)
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/compras/ingresos/showProveedor.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.proveedor_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
            });

            $('.proveedor_id').selectpicker('refresh');
        
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/compras/ingresos/showEstado.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.estado_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
            });

            $('.estado_id').selectpicker('refresh');
        
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/compras/ingresos/showCentroCosto.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.centro_costo_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
            });

            $('.centro_costo_id').selectpicker('refresh');
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/compras/costos/showPersonal.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.personal_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
            });

            $('.personal_id').selectpicker('refresh');
        
        }
    });

    $('select[name=estado_id]').on('change', function () {
        estado = $(this).find('option:selected').data('content')
        if(estado == "Transferencia" || estado == "Tarjeta de Credito" || estado == "Cheque"){
            $('.detalle').show()
            $('.label_numero_detalle').text('Numero de Cuenta')
            $('.numero_detalle').attr('placeholder',"Ingrese el numero de cuenta")
            $('.numero_detalle').data('placeholder',"Numero de Cuenta")
            $('.numero_detalle').addClass('number')
        }else{
            $('.detalle').hide()
            $('.label_numero_detalle').text('Detalle')
            $('.numero_detalle').attr('placeholder',"Ingrese el detalle")
            $('.numero_detalle').data('placeholder',"Detalle")
            $('.numero_detalle').removeClass('number')
        }
    });

    $('#IngresoForm').on('hidden.bs.modal', function () {

        $('#storeIngreso')[0].reset();

        $('.selectpicker').selectpicker('render');
        $('.selectpicker').selectpicker('refresh');

    });


    $('body').on('click', '#guardarIngreso', function () {

        $.postFormValues('../includes/compras/ingresos/storeIngreso.php', '#storeIngreso', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });
     
                Proveedor = $('#proveedor_id option[value="'+response.array.proveedor_id+'"]').first().data('content');
                Estado = $('#estado_id option[value="'+response.array.estado_id+'"]').first().data('content');
                CentroCosto = $('#centro_costo_id option[value="'+response.array.centro_costo_id+'"]').first().data('content');

                var rowNode = Table.row.add([
                    ''+response.array.numero_factura+'',
                    ''+response.array.fecha_emision_factura+'',
                    ''+Proveedor+'',
                    ''+Estado+'',
                    ''+CentroCosto+'',
                    ''+'<i style="cursor: pointer; margin: 0 5px; font-size:15px;" class="fa fa-search Find"></i>' + ' <i style="cursor: pointer; margin: 0 5px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 5px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $(rowNode)
                    .attr('id',response.array.id)
                    .data('proveedor_id',response.array.proveedor_id)
                    .data('centro_costo_id',response.array.centro_costo_id)
                    .data('estado_id',response.array.estado_id)
                    .data('numero_detalle',response.array.numero_detalle)
                    .data('fecha_detalle',response.array.fecha_detalle)
                    .data('detalle_factura',response.data.detalle_factura)
                    .data('monto',response.data.monto)
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
        var ObjectBill = ObjectTR.find("td").eq(0).text();
        var ObjectDateBill = ObjectTR.find("td").eq(1).text();
        var ObjectProvider = ObjectTR.data("proveedor_id");
        var ObjectState = ObjectTR.data("estado_id");
        var ObjectCost = ObjectTR.data("centro_costo_id");
        var ObjectDetailNumber = ObjectTR.data("numero_detalle");
        var ObjectDetailDate = ObjectTR.data("fecha_detalle");
        var ObjectDetail = ObjectTR.data("detalle_factura");
        var ObjectValue = ObjectTR.data("monto");

        if(ObjectDetailDate && ObjectDetailDate != '0000-00-00' && ObjectDetailDate != '1969-01-31'){
            ObjectDetailDate = moment(ObjectDetailDate).format('DD-MM-YYYY');
        }else{
            ObjectDetailDate = ''
        }

        $('#updateIngreso').find('input[name="id"]').val(ObjectId);
        $('#updateIngreso').find('input[name="numero_factura"]').val(ObjectBill);
        $('#updateIngreso').find('input[name="fecha_emision_factura"]').val(ObjectDateBill);
        $('#updateIngreso').find('select[name="proveedor_id"]').val(ObjectProvider);
        $('#updateIngreso').find('select[name="estado_id"]').val(ObjectState);
        $('#updateIngreso').find('select[name="centro_costo_id"]').val(ObjectCost);
        $('#updateIngreso').find('input[name="numero_detalle"]').val(ObjectDetailNumber);
        $('#updateIngreso').find('input[name="fecha_detalle"]').val(ObjectDetailDate);
        $('#updateIngreso').find('input[name="detalle_factura"]').val(ObjectDetail);
        $('#updateIngreso').find('input[name="monto"]').val(ObjectValue);

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
        $('#updateIngreso').find('select[name="proveedor_id"]').selectpicker('refresh');
        $('#updateIngreso').find('select[name="estado_id"]').selectpicker('refresh');
        $('#updateIngreso').find('select[name="centro_costo_id"]').selectpicker('refresh');

        if($('#updateIngreso').find('input[name="estado_id"]').find('option:selected').data('content') != "Otros"){
            $('.detalle').show()
            $('.label_numero_detalle').text('Numero de Cuenta')
            $('.numero_detalle').attr('placeholder',"Ingrese el numero de cuenta")
            $('.numero_detalle').data('placeholder',"Numero de Cuenta")
            $('.numero_detalle').addClass('number')
        }else{
            $('.detalle').hide()
            $('.label_numero_detalle').text('Detalle')
            $('.numero_detalle').attr('placeholder',"Ingrese el detalle")
            $('.numero_detalle').data('placeholder',"Detalle")
            $('.numero_detalle').removeClass('number')
        }
  
    });


    $('body').on('click', '#actualizarIngreso', function () {

        $.postFormValues('../includes/compras/ingresos/updateIngreso.php', '#updateIngreso', function(response){
                    
            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Actualizado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Proveedor = $('#proveedor_id option[value="'+response.array.proveedor_id+'"]').first().data('content');
                Estado = $('#estado_id option[value="'+response.array.estado_id+'"]').first().data('content');
                CentroCosto = $('#centro_costo_id option[value="'+response.array.centro_costo_id+'"]').first().data('content');

                ObjectTR = $("#"+response.array.id);

                ObjectTR.data('proveedor_id', response.array.proveedor_id)
                ObjectTR.data('centro_costo_id', response.array.centro_costo_id)
                ObjectTR.data('estado_id', response.array.estado_id)
                ObjectTR.data('numero_detalle', response.array.numero_detalle)
                ObjectTR.data('fecha_detalle', response.array.fecha_detalle)
                ObjectTR.data('detalle_factura', response.array.detalle_factura)
                ObjectTR.data('monto', response.array.monto)
                ObjectTR.find("td").eq(0).html(response.array.numero_factura);
                ObjectTR.find("td").eq(1).html(response.array.fecha_emision_factura);
                ObjectTR.find("td").eq(2).html(Proveedor);
                ObjectTR.find("td").eq(3).html(Estado);
                ObjectTR.find("td").eq(4).html(CentroCosto);

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
            showLoaderOnConfirm: true
        },function(isConfirm){   
            if (isConfirm) {
    
                $.ajax({
                    url: "../includes/compras/ingresos/deleteIngreso.php",
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

                $('.proveedor_id').append('<option value="'+response.array.id+'" data-content="'+response.array.rut+ ' - '+ response.array.nombre+'"></option>');
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

    $('body').on('click', '#guardarCosto', function () {

        $.postFormValues('../includes/compras/costos/storeCosto.php', '#storeCosto', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                $('.centro_costo_id').append('<option value="'+response.array.id+'" data-content="'+response.array.nombre+'"></option>');
                $('.centro_costo_id').val(response.array.id);
                
                $('.selectpicker').selectpicker('render');
                $('.selectpicker').selectpicker('refresh')

                $('#storeCosto')[0].reset();
                $('#modalCosto').modal('hide');

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