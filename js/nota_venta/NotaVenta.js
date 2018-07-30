$(document).ready(function(){

    $('#servicio').prop('disabled', true)
    $('#precio').prop('disabled', true)

    var neto_nota = 0
    var iva_nota = 0
    var total_nota = 0

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

    showNotaVenta();

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

    $('.number').number(true, 0, ',', '.');
    $("#cantidad").mask("000000");
    $("#impuesto").mask("00");

    $.ajax({
        type: "POST",
        url: "../includes/nota_venta/showPersonaEmpresa.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('#personaempresa_id').append('<option value="' + array.rut + '">' + array.rut + ' ' + array.nombre + ' - ' + array.tipo_cliente +'</option>');
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');

        }
    });

    deleteDetalles();

    function showNotaVenta(){
        $.ajax({
            type: "POST",
            url: "../includes/nota_venta/showNotaVenta.php",
            success: function(response){
                NotaVentaTable = $('#NotaVentaTable').DataTable({
                    order: [[0, 'asc']],
                    data: response,
                    columns: [
                        { data: 'rut' },
                        { data: 'cliente' },
                        { data: 'fecha' },
                        { data: 'numero_oc' },
                        { data: 'solicitado_por' },
                        { data: 'total' },
                        { data: 'id' }
                    ],
                    destroy: true,
                    'createdRow': function (row, data, dataIndex) {
                        $(row)
                            .attr('id', data.id)
                            .addClass('text-center')
                    },
                    "columnDefs": [
                        {
                            "targets": 2,
                            "render": function (data, type, row) {
                                fecha = moment(data).format('DD-MM-YYYY');
                                return "<div style='text-align: center'>" + fecha + "</div>";
                            }
                        },
                        {
                            "targets": 5,
                            "render": function (data, type, row) {
                                total = formatcurrency(data)
                                return "<div style='text-align: center'>" + total + "</div>";
                            }
                        },
                        {
                            "targets": 6,
                            "render": function (data, type, row) {
                                Ver = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye View"></i>';
                                if(row.estatus_facturacion == 0){
                                    Editar = ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Edit"></i>' 
                                    Generar = ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-file-excel-o Generate"></i>'  
                                }else{
                                    Editar = '';
                                    Generar = ''  
                                }
                                Remove = ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times RemoveNota"></i>'
                                return "<div style='text-align: center'>" + Ver + " " + Editar + " " + Generar + " " + Remove + "</div>";
                            }
                        },
                    ],
                    language: {
                        processing: "Procesando ...",
                        search: 'Buscar',
                        lengthMenu: "Mostrar _MENU_ Registros",
                        info: "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                        infoEmpty: "Mostrando 0 a 0 de 0 Registros",
                        infoFiltered: "(filtrada de _MAX_ registros en total)",
                        infoPostFix: "",
                        loadingRecords: "...",
                        zeroRecords: "No se encontraron registros coincidentes",
                        emptyTable: "No hay datos disponibles en la tabla",
                        paginate: {
                            first: "Primero",
                            previous: "Anterior",
                            next: "Siguiente",
                            last: "Ultimo"
                        },
                        aria: {
                            sortAscending: ": habilitado para ordenar la columna en orden ascendente",
                            sortDescending: ": habilitado para ordenar la columna en orden descendente"
                        }
                    }
                });
                $('table').css('width', '100%');
            }
        });
    }

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
                    // $('#rut').val(response.array[0].rut+'-'+response.array[0].dv);
                    $('#rut').val(response.array[0].rut);
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
                $('#servicio').val(response.array[0].Servicio);
                $('#precio').val(precio);
                $('#cantidad').val(1)
                calcularDetalle();
            }
        });
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
        calcularDetalle()
    });

    $('#precio').on('input', function () {
        calcularDetalle()
    });

    function calcularDetalle() {
        cantidad = parseInt($('#cantidad').val())
        if (!cantidad) {
            cantidad = 0;
        }
        precio = $('#precio').val()
        if (precio) {
            precio = precio.replace(',00', '')
            precio = precio.replace('.', '')
            precio = parseFloat(precio)
        } else {
            precio = 0;
        }
        precio = precio.replace(',00', '')
        precio = precio.replace('.', '')
        precio = parseFloat(precio)
        valor = precio * cantidad
        servicio = $('#servicio').val()
        if (valor > 0 && servicio > 0) {
            $('#guardarServicio').prop('disabled', false);
        } else {
            $('#guardarServicio').prop('disabled', true);
        }
        $('#total').val(formatcurrency(valor))
    }

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

                precio = parseFloat(response.array.precio)
                cantidad = response.array.cantidad
                neto = precio * cantidad
                iva = neto * 0.19
                neto_nota = neto_nota + neto
                iva_nota = iva_nota + iva;
                total = parseFloat(response.array.total)
                total_nota = total_nota + total

                $('#neto_nota').text(formatcurrency(neto_nota))
                $('#iva_nota').text(formatcurrency(iva_nota))
                $('#total_nota').text(formatcurrency(total_nota))

                var rowNode = ServicioTable.row.add([
                    ''+response.array.codigo+'',
                    ''+response.array.servicio+'',
                    ''+formatcurrency(precio)+'',
                    ''+response.array.cantidad+'',
                    '' + formatcurrency(total)+'',
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
                                precio = parseFloat(response.array[0].precio)
                                neto = precio * cantidad
                                iva = neto * 0.19

                                neto_nota = neto_nota - neto
                                iva_nota = iva_nota - iva;
                                
                                total = parseFloat(response.array[0].total)
                                total_nota = total_nota - total

                                $('#neto_nota').text(formatcurrency(neto_nota))
                                $('#iva_nota').text(formatcurrency(iva_nota))
                                $('#total_nota').text(formatcurrency(total_nota))

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
                showNotaVenta();
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
        deleteDetalles();
        $('#showCliente')[0].reset();
        $('#personaempresa_id').selectpicker('refresh');

        $('html,body').animate({
            scrollTop: 0
        }, 1500);
    })

    function deleteDetalles() {
        $('#neto_nota').text(0)
        $('#iva_nota').text(0)
        $('#total_nota').text(0)
        $('#addServicio')[0].reset();

        neto_nota = 0
        iva_nota = 0
        total_nota = 0

        $('#codigo').selectpicker('refresh');

        ServicioTable
            .clear()
            .draw();

        $.post('../includes/nota_venta/deleteDetalles.php');
    }

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
                                showNotaVenta();
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

    $('body').on('click', '.View', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("id");

        window.open("../ajax/nota_venta/generarNotaVenta.php?id="+ObjectId, '_blank');
    });

    $('body').on('click', '.Generate', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("id");

        swal({
            title: "Deseas generar la factura?",
            text: "Confirmar facturación!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Generar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: "../includes/nota_venta/generarFactura.php",
                    data: {
                        id: ObjectId
                    },
                    success: function (response) {

                        if (response.status == 1) {
                            showNotaVenta();
                            swal("Éxito!", "La factura ha sido generada!", "success");

                        } else if (response.status == 2) {
                            swal('Solicitud no procesada', 'Debes ingresar el valor UF del mes en curso', 'error');
                        } else if (response.status == 3) {
                            swal('Solicitud no procesada', 'El servicio no existe, por favor actualizar la pagina', 'error');
                        } else if (response.status == 4) {
                            swal('Solicitud no procesada', 'El cliente no existe, por favor actualizar la pagina', 'error');
                        } else if (response.status == 99) {
                            swal('Solicitud no procesada', 'El servicio cUrl no esta disponible en el servidor, por favor contactar al administrador', 'error');
                        } else {
                            swal('Solicitud no procesada', response.Message, 'error');
                        }
                    },
                    error: function (xhr, status, error) {
                        setTimeout(function () {
                            var err = JSON.parse(xhr.responseText);
                            swal('Solicitud no procesada', err.Message, 'error');
                        }, 1000);
                    }
                });
            }
        });
    });

    function formatcurrency(n) {
        return n.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    }
});