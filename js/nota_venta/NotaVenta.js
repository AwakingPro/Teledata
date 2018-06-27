$(document).ready(function(){

    $('#servicio').prop('disabled', true)
    $('#precio').prop('disabled', true)

    var neto = 0
    var iva = 0
    var total = 0

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

    NotaVentaTable = $('#NotaVentaTable').DataTable({
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
    $('#automatico').prop('checked',true);
    $('#label_automatico').addClass('active')

    //CONFIGURACION DEL SELECTPICKER, DATETIMEPICKER Y DATA-MASK

    $('.selectpicker').selectpicker();
    $('.date').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY',
        defaultDate: new Date()
    });

    $('.number').number(true, 2, ',', '.');
    $("#cantidad").mask("000000");
    $("#impuesto").mask("00");

    $.ajax({
        type: "POST",
        url: "../includes/nota_venta/showPersonaEmpresa.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('#personaempresa_id').append('<option value="'+array.rut+'" data-content="'+array.rut+ ' ' +array.nombre+ ' - ' +array.tipo_cliente+'"></option>');
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');

        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/inventario/ingresos/showBodega.php",
        success: function (response) {

            $.each(response.array, function (index, array) {
                $('#retiro').append('<option value="' + array.nombre + '" data-content="' + array.nombre + '"></option>');
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');

        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/nota_venta/showNotaVenta.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                fecha = moment(array.fecha).format('DD-MM-YYYY');

                var rowNode = NotaVentaTable.row.add([
                    ''+fecha+'',
                    ''+array.rut+'',
                    ''+array.numero_oc+'',
                    ''+array.solicitado_por+'',
                    ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-file-excel-o Generate"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times RemoveNota"></i>'+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id',array.id)
                    .addClass('text-center')
            });
        }
    });

    $('input[name=switch_codigo]').on('change', function () {
        value = $("input[name='switch_codigo']:checked").val()
        $('#codigo_container').empty();
        if(value == 1){
            $('#label_manual').removeClass('active')
            $('#label_automatico').addClass('active')
            $('#servicio').prop('disabled', true)
            $('#precio').prop('disabled', true)
            append = '<select class="selectpicker form-control" name="codigo" id="codigo"  data-live-search="true" data-container="body" validation="not_null" data-nombre="Código"></select>'
            $('#codigo_container').append(append)

            datos = $('#showCliente').serialize();

            $('#codigo').append(new Option('Seleccione Código',''));

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

            $('#codigo').selectpicker()

            setTimeout(function() {
                $('.selectpicker').selectpicker('render');
                $('.selectpicker').selectpicker('refresh');
            }, 1000);

        }else{
            $('#label_automatico').removeClass('active')
            $('#label_manual').addClass('active')
            append = '<input id="codigo" name="codigo" class="form-control input-sm" validation="not_null" data-nombre="Código">'
            $('#codigo_container').append(append)
            $('#servicio').prop('disabled', false)
            $('#precio').prop('disabled', false)
        }

        $('#codigo').val('')
        $('#servicio').val('')
        $('#precio').val('')
        $('#total').val('')

        $('.selectpicker').selectpicker('refresh')

    });

    $('#personaempresa_id').on('change', function () {

        ServicioTable
            .clear()
            .draw();

        if($(this).val()){

            datos = $('#showCliente').serialize();

            $.ajax({
                type: "POST",
                url: "../includes/nota_venta/showCliente.php",
                data: datos,
                success: function(response){

                    $('#giro').val(response.array[0].giro);
                    $('#direccion').val(response.array[0].direccion);
                    $('#contacto').val(response.array[0].contacto);
                    $('#rut').val(response.array[0].rut+'-'+response.array[0].dv);

                }
            });

            $('#codigo').empty();
            $('#codigo').append(new Option('Seleccione Código',''));

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

        }else{
            $('#servicio').val('')

            $('#precio').val('')
            $('#total').val('')
        }

        $('#cantidad').val(1)
    });

    $('body').on('change', 'select[name="codigo"]', function (){

        $('#servicio').prop('disabled', true)
        $('#precio').prop('disabled', true)

        $('#servicio').val('')
        $('#precio').val('')
        $('#total').val('')

        datos = $('#addServicio').serialize();

        $.ajax({
            type: "POST",
            url: "../includes/nota_venta/showServicio.php",
            data: datos,
            success: function(response){

                precio = parseFloat(response.array[0].Precio)

                if(!precio || precio < 0){
                    precio = 0
                }

                $('#servicio').val(response.array[0].Servicio);
                $('#precio').val(formatcurrency(precio));

                impuesto = precio * 0.19
                precio = precio + impuesto
                

                $('#total').val(formatcurrency(precio));


            }
        });
    
        $('#cantidad').val(1)

    });

    $('body').on('blur', 'input[name="codigo"]', function (){

        datos = $('#addServicio').serialize();
        input = $(this)
        codigo = $(this).val()

        if(codigo){
            $.ajax({
                type: "POST",
                url: "../includes/nota_venta/showServicio.php",
                data: datos,
                success: function(response){
                    if(response.array.length){
                        $.niftyNoty({
                            type: 'danger',
                            icon : 'fa fa-check',
                            message : 'Ya este codigo esta registrado',
                            container : 'floating',
                            timer : 3000
                        });
                        $(input).val('')
                    }
                }
            });
        }
    });

    $('#cantidad').on('change', function () {
        if($('#codigo') && $('#precio')){
            cantidad = parseInt($('#cantidad').val())
            precio = $('#precio').val()
            precio = precio.replace('.', '')
            precio = parseFloat(precio)
            total_nota = precio * cantidad


            impuesto = total_nota * 0.19
            total_nota = total_nota + impuesto
            

            if(!total_nota || isNaN(total_nota)){
                total_nota = 0;
            }

            $('#total').val(formatcurrency(total_nota))
        }
    });

    $('#precio').on('input', function () {

        if($('#codigo') && $('#cantidad')){
            cantidad = parseInt($('#cantidad').val())
            precio = $('#precio').val()
            precio = precio.replace('.', '')
            precio = parseFloat(precio)
            total_nota = precio * cantidad

            
            impuesto = total_nota * 0.19
            total_nota = total_nota + impuesto
            

            if(!total_nota || isNaN(total_nota)){
                total_nota = 0;
            }

            $('#total').val(formatcurrency(total_nota))
        }
    });

    $('body').on('click', '#guardarServicio', function () {

        $('#rut_tmp').val($('#personaempresa_id').val())
        $('#rut_tmp').selectpicker('refresh')

        $.postFormValues('../includes/nota_venta/GuardarServicio.php', '#addServicio', function(response){

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
                neto = neto + neto_tmp
                iva = iva + impuesto;
                

                precio = parseFloat(response.array.precio)
                total_tmp = parseFloat(response.array.total)
                total = total + total_tmp

                $('#neto').text(formatcurrency(neto))
                $('#iva').text(formatcurrency(iva))
                $('#total_nota').text(formatcurrency(total))

                var rowNode = ServicioTable.row.add([
                    ''+response.array.codigo+'',
                    ''+response.array.servicio+'',
                    ''+formatcurrency(precio)+'',
                    ''+response.array.cantidad+'',
                    ''+formatcurrency(total_tmp)+'',
                    ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times RemoveServicio"></i>'+'',
                ]).draw(false).node();

                $(rowNode)
                    .attr('id',response.array.id)
                    .addClass('text-center')

                $('#addServicio')[0].reset();
                $('#cantidad').val(1)
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
                    message : 'Ocurrió un error en el Proceso',
                    container : 'floating',
                    timer : 3000
                });

            }
        });
    });

    $('body').on('click', '.RemoveServicio', function () {

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

                                neto = neto - neto_tmp
                                iva = iva - impuesto;
                                

                                precio = parseFloat(response.array[0].total)
                                total = total - precio

                                $('#neto').text(formatcurrency(neto))
                                $('#iva').text(formatcurrency(iva))
                                $('#total_nota').text(formatcurrency(total))

                                swal("Éxito!","El registro ha sido eliminado!","success");

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

        $.postFormValues('../includes/nota_venta/GuardarNotaVenta.php', '#showCliente', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                var rowNode = NotaVentaTable.row.add([
                    ''+response.array.fecha+'',
                    ''+response.array.rut+'',
                    ''+response.array.numero_oc+'',
                    ''+response.array.solicitado_por+'',
                    ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-file-excel-o Generate"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times RemoveNota"></i>'+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id',response.array.id)
                    .addClass('text-center')

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
                    message : 'Ocurrió un error en el Proceso',
                    container : 'floating',
                    timer : 3000
                });

            }
        });
    });

    $('#cancelar').on('click', function () {

        var neto = 0
        var iva = 0
        var total = 0

        $('#neto').text(neto)
        $('#iva').text(iva)
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

    $('body').on('click', '.RemoveNota', function () {

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
                    url: "../includes/nota_venta/deleteNotaVenta.php",
                    type: 'POST',
                    data:"&id="+ObjectId,
                    success:function(response){
                        setTimeout(function() {
                            if(response.status == 1){
                                swal("Éxito!","El registro ha sido eliminado!","success");
                                NotaVentaTable.row($(ObjectTR))
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

    $('body').on('click', '.Generate', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("id");

        window.open("../ajax/nota_venta/generarNotaVenta.php?id="+ObjectId, '_blank');
    });

    function formatcurrency(n) {
        return n.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    }
});