$(document).ready(function(){

    var neto = 0
    var exencion = 0
    var iva = 0
    var total = 0
    var importe_neto = 0;

    ServicioTable = $('#ServicioTable').DataTable({
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

    $('#showCliente')[0].reset();
    $('#addServicio')[0].reset();

    //CONFIGURACION DEL SELECTPICKER, DATETIMEPICKER Y DATA-MASK

    $('.selectpicker').selectpicker();
    $('.date').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY'
    });
    $(".number").mask("000.000.000.000",{reverse: true});
    $("#cantidad").mask("000000");
    $("#impuesto").mask("00");

    $.ajax({
        type: "POST",
        url: "../includes/nota_venta/showPersonaEmpresa.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('#personaempresa_id').append('<option value="'+array.rut+'" data-content="'+array.nombre+'"></option>');
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
        
        }
    });

    $('#personaempresa_id').on('change', function () {

        ServicioTable
            .clear()
            .draw();

        $('#codigo').empty();
        $('#codigo').append(new Option('Seleccione Código',''));
        datos = $('#showCliente').serialize();

        $.ajax({
            type: "POST",
            url: "../includes/nota_venta/showCliente.php",
            data: datos,
            success: function(response){
                $('#giro').val(response.array[0].giro);
                $('#direccion').val(response.array[0].direccion);
                $('#contacto').val(response.array[0].contacto);
                $('#rut').val(response.array[0].rut);
            }
        });

        $.ajax({
            type: "POST",
            url: "../includes/nota_venta/showCodigos.php",
            data: datos,
            success: function(response){
                $.each(response.array, function( index, array ) {
                    $('#codigo').append('<option value="'+array.Codigo+'" data-content="'+array.Codigo+'"></option>');
                });
            }
        })


        setTimeout(function() {       
            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
        }, 1000);  


    });

    $('#codigo').on('change', function () {
        if($(this).val()){
            datos = $('#addServicio').serialize();
            $.ajax({
                type: "POST",
                url: "../includes/nota_venta/showServicio.php",
                data: datos,
                success: function(response){
                    $.each(response.array, function( index, array ) {
                        $('#servicio').val(response.array[0].servicio);
                        $('#precio').val($.number(parseFloat(response.array[0].precio)));
                        $('#total').val($.number(parseFloat(response.array[0].precio)));
                        importe_neto = parseFloat(response.array[0].precio)
                    });
                }
            });
        }else{
            $('#servicio').val('')
            $('#precio').val('')
            $('#total').val('')
            importe_neto = 0
        }

        $('#cantidad').val(1)

    });

    $('#cantidad').on('change', function () {
        if($('#codigo')){
            cantidad = parseInt($('#cantidad').val())
            total_nota = importe_neto * cantidad
            $('#total').val(parseFloat(total_nota))
        }
    });

    $('body').on('click', '#guardarServicio', function () {

        $.postFormValues('../includes/nota_venta/guardarServicio.php', '#addServicio', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                cantidad = parseInt(response.array.cantidad)
                neto_tmp = parseFloat(response.array.precio)
                neto_tmp = neto_tmp * cantidad
                impuesto = neto_tmp * 0.19
                neto_tmp = neto_tmp - impuesto
                neto = neto + neto_tmp

                if(response.array.exencion == 1){
                    imp_exencion = 'Afecto'
                    exencion = exencion + impuesto;
                }else{
                    imp_exencion = 'No Afecto'
                    iva = iva + impuesto;
                }

                precio = parseFloat(response.array.total)
                total = total + precio

                $('#neto').text($.number(neto))
                $('#iva').text($.number(iva))
                $('#exencion_nota').text($.number(exencion))
                $('#total_nota').text($.number(total))

                var rowNode = ServicioTable.row.add([
                    ''+response.array.codigo+'',
                    ''+response.array.servicio+'',
                    ''+response.array.cantidad+'',
                    ''+$.number(precio)+'',
                    ''+imp_exencion+'',
                    ''+$.number(response.array.total)+'',
                    ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $(rowNode)
                    .attr('id',response.array.id)
                    .addClass('text-center')

                $('#addServicio')[0].reset();
                $('.selectpicker').selectpicker('render');
                $('.selectpicker').selectpicker('refresh');

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
                    url: "../includes/nota_venta/deleteServicio.php",
                    type: 'POST',
                    data:"&id="+ObjectId,
                    success:function(response){
                        setTimeout(function() {
                            if(response.status == 1){

                                cantidad = parseInt(response.array[0].cantidad)
                                neto_tmp = parseFloat(response.array[0].precio)
                                neto_tmp = neto_tmp * cantidad
                                impuesto = neto_tmp * 0.19
                                neto_tmp = neto_tmp - impuesto
                                neto = neto - neto_tmp

                                if(response.array[0].exencion == 1){
                                    exencion = exencion - impuesto;
                                }else{
                                    iva = iva - impuesto;
                                }

                                precio = parseFloat(response.array[0].total)
                                total = total - precio

                                $('#neto').text($.number(neto))
                                $('#iva').text($.number(iva))
                                $('#exencion_nota').text($.number(exencion))
                                $('#total_nota').text($.number(total))

                                swal("Exito!","El registro ha sido eliminado!","success");
                                ServicioTable.row($(ObjectTR))
                                    .remove()
                                    .draw();
                            }else if(response.status == 3){
                                swal('Solicitud no procesada','Este registro no puede ser eliminado porque ha sido eliminado de la base de datos','error');
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

    $('body').on('click', '#guardar', function () {

        $.postFormValues('../includes/nota_venta/guardarNotaVenta.php', '#showCliente', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                $('#cancelar').click()

            }else if(response.status == 2){

                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Debe llenar todos los campos',
                    container : 'floating',
                    timer : 3000
                });

            }else if(response.status == 3){

                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Debes agregar un servicio',
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

    $('#cancelar').on('click', function () {

        var neto = 0
        var exencion = 0
        var iva = 0
        var total = 0

        $('#neto').text(neto)
        $('#iva').text(iva)
        $('#exencion_nota').text(exencion)
        $('#total_nota').text(total)

        $('#showCliente')[0].reset();
        $('#addServicio')[0].reset();

        $('#personaempresa_id').empty();
        $('#personaempresa_id').append(new Option('Seleccione Cliente',''));

        ServicioTable
            .clear()
            .draw();

        $.ajax({
            type: "POST",
            url: "../includes/nota_venta/showPersonaEmpresa.php",
            success: function(response){

                $.each(response.array, function( index, array ) {
                    $('#personaempresa_id').append('<option value="'+array.rut+'" data-content="'+array.nombre+'"></option>');
                });
            
            }
        });

        setTimeout(function() {       
            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
        }, 1000); 

        $('html,body').animate({
            scrollTop: 0
        }, 1500);
    })
});