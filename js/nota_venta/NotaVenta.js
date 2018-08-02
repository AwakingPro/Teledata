$(document).ready(function(){

    var neto_nota = 0
    var iva_nota = 0
    var total_nota = 0

    DetalleTable = $('#DetalleTable').DataTable({
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

    getProductos()
    getNotaVentas();

    function getProductos(){
        $('#concepto').empty();
        $('#concepto').append(new Option('Seleccione Concepto', ''));
        $.ajax({
            type: "POST",
            url: "../includes/nota_venta/getProductos.php",
            success: function (response) {
                $.each(response.array, function (index, array) {
                    $('#concepto').append("<option value='" + array.producto + "'>" + array.producto +"</option>");
                });
            }
        })
        setTimeout(function () {
            $('#concepto').selectpicker('render');
            $('#concepto').selectpicker('refresh');
        }, 1000);
    }

    $('#formCliente')[0].reset();
    $('#formDetalle')[0].reset();
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
        url: "../includes/nota_venta/getClientes.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('#personaempresa_id').append('<option value="' + array.rut + '">' + array.rut + ' ' + array.nombre + ' - ' + array.tipo_cliente +'</option>');
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');

        }
    });

    deleteDetalles();

    function getNotaVentas(){
        $.ajax({
            type: "POST",
            url: "../includes/nota_venta/getNotaVentas.php",
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

    $('input[name=switch_tipo]').on('change', function () {
        value = $("input[name='switch_tipo']:checked").val()
        $('#concepto_container').empty();
        if(value == 1){
            $('#label_manual').removeClass('active')
            $('#label_automatico').addClass('active')
            append = '<select class="selectpicker form-control" name="concepto" id="concepto"  data-live-search="true" data-container="body" validation="not_null" data-nombre="Concepto"></select>'
            $('#concepto_container').append(append)
            getProductos()
        }else{
            $('#label_automatico').removeClass('active')
            $('#label_manual').addClass('active')
            append = '<input id="concepto" name="concepto" class="form-control input-sm" validation="not_null" data-nombre="Concepto">'
            $('#concepto_container').append(append)
        }

        $('#precio').val('')
        $('#total').val('')

        $('.selectpicker').selectpicker('refresh')

    });

    $('#personaempresa_id').on('change', function () {

        DetalleTable
            .clear()
            .draw();

        if($(this).val()){

            datos = $('#formCliente').serialize();

            $.ajax({
                type: "POST",
                url: "../includes/nota_venta/getCliente.php",
                data: datos,
                success: function(response){

                    $('#giro').val(response.array[0].giro);
                    $('#direccion').val(response.array[0].direccion);
                    $('#contacto').val(response.array[0].contacto);
                    $('#rut').val(response.array[0].rut+'-'+response.array[0].dv);
                }
            });
        }else{
            $('#precio').val('')
            $('#total').val('')
        }

        $('#cantidad').val(1)
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
        valor = precio * cantidad
        concepto = $('#concepto').val()
        if (valor > 0 && concepto) {
            $('#insertDetalle').prop('disabled', false);
        } else {
            $('#insertDetalle').prop('disabled', true);
        }
        $('#total').val(formatcurrency(valor))
    }

    $('body').on('click', '#insertDetalle', function () {

        $('#rut_tmp').val($('#personaempresa_id').val())
        $('#rut_tmp').selectpicker('refresh')

        $.postFormValues('../includes/nota_venta/insertDetalle.php', '#formDetalle', function(response){

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

                var rowNode = DetalleTable.row.add([
                    ''+response.array.concepto+'',
                    ''+formatcurrency(precio)+'',
                    ''+response.array.cantidad+'',
                    '' + formatcurrency(total)+'',
                    ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times deleteDetalle"></i>'+'',
                ]).draw(false).node();

                $(rowNode)
                    .attr('id',response.array.id)
                    .addClass('text-center')

                $('#formDetalle')[0].reset();
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

    $('body').on('click', '.deleteDetalle', function () {

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
                    url: "../includes/nota_venta/deleteDetalle.php",
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

                                DetalleTable.row($(ObjectTR))
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

    $('body').on('click', '#insertNotaVenta', function () {

        $.postFormValues('../includes/nota_venta/insertNotaVenta.php', '#formCliente', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });
                getNotaVentas();
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
                    message : 'Debes agregar un detalle',
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
        $('#formCliente')[0].reset();
        $('#personaempresa_id').selectpicker('refresh');

        $('html,body').animate({
            scrollTop: 0
        }, 1500);
    })

    function deleteDetalles() {
        $('#neto_nota').text(0)
        $('#iva_nota').text(0)
        $('#total_nota').text(0)
        $('#formDetalle')[0].reset();

        neto_nota = 0
        iva_nota = 0
        total_nota = 0

        $('#concepto').selectpicker('refresh');

        DetalleTable
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
                                getNotaVentas();
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
                            getNotaVentas();
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