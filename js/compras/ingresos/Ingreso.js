var json = []

$(document).ready(function() {
    // showIngresos()
    $('.input-daterange').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        language: 'es'
    });
    $(document).on('click', '#filtrar', function() {
        var startDate = $("#date-range .input-daterange input[name='start']").val();
        var endDate = $("#date-range .input-daterange input[name='end']").val();
        if (startDate != '' & endDate != '') {
            showIngresos();
        } else {
            bootbox.alert('Debe Seleccionar un rango de fecha')
            return false;
        }
    });

    //FUNCION NECESARIA PARA MOSTRAR 2 MODALES AL MISMO TIEMPO

    $(document).on({
        'show.bs.modal': function() {
            var zIndex = 1040 + (10 * $('.modal:visible').length);
            $(this).css('z-index', zIndex);
            setTimeout(function() {
                $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
            }, 0);
        },
        'hidden.bs.modal': function() {
            if ($('.modal:visible').length > 0) {
                if ($('.modal').hasClass('in')) {
                    $('body').addClass('modal-open');
                }

            }
        }
    }, '.modal');

    //CONFIGURACION DEL SELECTPICKER, DATETIMEPICKER Y DATA-MASK

    $('.selectpicker').selectpicker();
    $('.selectpicker').selectpicker('refresh');
    $('.date').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY'
    });

    $(".number").mask("0000000000");
    $('.money').number(true, 2, ',', '.');
    $('.tipo_documento_id').load('../ajax/cliente/selectTipoDocProveedor.php', function() {
        $('.tipo_documento_id').selectpicker('refresh');
    });
    $.ajax({
        type: "POST",
        url: "../includes/compras/ingresos/showEstado.php",
        success: function(response) {
            $.each(response.array, function(index, array) {
                $('#TipoPago').append('<option value="' + array.id + '">' + array.nombre + '</option>');
            });

            $('#TipoPago').selectpicker('refresh');

        }
    });

    Table = $('#IngresoTable').DataTable()
    showIngresos();
    function showIngresos() {
        var startDate = $("#date-range .input-daterange input[name='start']").val();
        var endDate = $("#date-range .input-daterange input[name='end']").val();
        $.ajax({
            type: "POST",
            url: "../includes/compras/ingresos/showIngreso.php",
            data: {
                startDate: startDate,
                endDate: endDate
            },
            success: function(response) {
                Table = $('#IngresoTable').DataTable({
                    order: [
                        [0, 'desc']
                    ],
                    data: response.array,
                    columns: [
                        { data: 'numero_documento' },
                        { data: 'tipo_documento' },
                        { data: 'fecha_emision' },
                        { data: 'fecha_vencimiento' },
                        { data: 'total_documento' },
                        { data: 'total_abono' },
                        { data: 'id' }
                    ],
                    destroy: true,
                    'createdRow': function(row, data, dataIndex) {
                        $(row)
                            .attr('id', data.id)
                            .data('tipo_documento_id', data.tipo_documento_id)
                            .data('proveedor_id', data.proveedor_id)
                            .data('centro_costo_id', data.centro_costo_id)
                            .data('detalle', data.detalle)
                            .data('total_documento', data.total_documento)
                            .addClass('text-center')
                    },
                    "columnDefs": [{
                            "targets": 2,
                            "render": function(data, type, row) {
                                fecha_emision = moment(data).format('DD-MM-YYYY');
                                return fecha_emision
                            }
                        },
                        {
                            "targets": 3,
                            "render": function(data, type, row) {
                                fecha_vencimiento = moment(data).format('DD-MM-YYYY');
                                return fecha_vencimiento
                            }
                        },
                        {
                            "targets": 6,
                            "render": function(data, type, row) {
                                Icono = ' <i style="cursor: pointer; margin: 0 5px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 5px; font-size:15px;" class="fa fa-times Remove"></i>'
                                if (row.total_abono != '0') {
                                    Abonar = '<i style="cursor: pointer; margin: 0 5px; font-size:15px;" class="fa fa-plus Abonar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Abonar" title="" data-container="body"></i>'
                                } else {
                                    Abonar = ''
                                }
                                if (row.total_documento != row.total_abono) {
                                    Pagos = '<i style="cursor: pointer; margin: 0 5px; font-size:15px;" class="fa fa-copy mostrarPagos" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Ver Pagos" title="" data-container="body"></i>'
                                } else {
                                    Pagos = ''
                                }
                                return Abonar + ' ' + Pagos + ' ' + Icono;
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
                getTotales();
            }
        });
    }

    function getTotales() {
        var startDate = $("#date-range .input-daterange input[name='start']").val();
        var endDate = $("#date-range .input-daterange input[name='end']").val();
        $.ajax({
            type: "POST",
            url: "../includes/compras/ingresos/getTotales.php",
            data: {
                startDate,
                endDate
            },
            success: function(response) {
                pagado = response.pagado
                por_pagar = response.por_pagar
                $('#pagado').text(pagado)
                $('#por_pagar').text(por_pagar)
            }
        });
    }

    $.ajax({
        type: "POST",
        url: "../includes/compras/ingresos/showProveedor.php",
        success: function(response) {

            $.each(response.array, function(index, array) {
                $('.proveedor_id').append('<option value="' + array.id + '" data-content="' + array.nombre + '"></option>');
            });

            $('.proveedor_id').selectpicker('refresh');

        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/compras/ingresos/showEstado.php",
        success: function(response) {

            $.each(response.array, function(index, array) {
                $('.tipo_pago_id').append('<option value="' + array.id + '" data-content="' + array.nombre + '"></option>');
            });

            $('.tipo_pago_id').selectpicker('refresh');

        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/compras/ingresos/showCentroCosto.php",
        success: function(response) {

            $.each(response.array, function(index, array) {
                // $('.agregar_centro_costo_id').append('<option value="' + array.id + '" data-content="' + array.codigo_cuenta +' - '+ array.nombre + '"></option>');
                $('.centro_costo_id').append('<option value="' + array.id + '" data-content="' + array.codigo_cuenta +' - '+ array.nombre + '"></option>');
            });

            // $.each(response.array, function(index, array) {
            //     $('#centro_costo_id').append('<option value="' + array.id + '" data-content="' + array.codigo_cuenta +' - '+ array.nombre + '"></option>');
            // });

            // $('#centro_costo_id').selectpicker('refresh');

            // $('.agregar_centro_costo_id').selectpicker('refresh');
            $('.centro_costo_id').selectpicker('refresh');
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/compras/costos/showPersonal.php",
        success: function(response) {

            $.each(response.array, function(index, array) {
                $('.personal_id').append('<option value="' + array.id + '" data-content="' + array.nombre + '"></option>');
            });

            $('.personal_id').selectpicker('refresh');

        }
    });

    $('select[name=tipo_pago_id]').on('change', function() {
        estado = $(this).val()
        if (estado == "1") {
            $('.detalle').show()
        } else {
            $('.detalle').hide()
        }
    });

    $('#IngresoForm').on('hidden.bs.modal', function() {

        $('#storeIngreso')[0].reset();
        $('select').selectpicker('refresh');

    });


    $('body').on('click', '#guardarIngreso', function() {

        $.postFormValues('../includes/compras/ingresos/storeIngreso.php', '#storeIngreso', {}, function(response) {

            if (response.status == 1) {

                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Guardado Exitosamente',
                    container: 'floating',
                    timer: 3000
                });

                showIngresos();
                $('#storeIngreso')[0].reset();
                $('select').selectpicker('refresh');
                $('.modal').modal('hide');

            } else if (response.status == 2) {

                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Debe llenar todos los campos',
                    container: 'floating',
                    timer: 3000
                });

            } else if (response.status == 3) {
                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'La fecha de emisión debe ser menor a la fecha de vencimiento',
                    container: 'floating',
                    timer: 3000
                });
            } else if (response.status == 99) {

                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Debe llenar los datos de los productos',
                    container: 'floating',
                    timer: 3000
                });

            } else {

                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Ocurrió un error en el Proceso',
                    container: 'floating',
                    timer: 3000
                });

            }
        });
    });


    $('body').on('click', 'i.fa', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectId = ObjectTR.attr("id");
        var ObjectBill = ObjectTR.find("td").eq(0).text();
        var ObjectDateBill = ObjectTR.find("td").eq(2).text();
        var ObjectDateVencimiento = ObjectTR.find("td").eq(3).text();
        var ObjectType = ObjectTR.data("tipo_documento_id");
        var ObjectProvider = ObjectTR.data("proveedor_id");
        var ObjectCost = ObjectTR.data("centro_costo_id");
        var ObjectDetail = ObjectTR.data("detalle");
        var ObjectValue = ObjectTR.data("total_documento");

        $('#updateIngreso').find('input[name="id"]').val(ObjectId);
        $('#updateIngreso').find('input[name="numero_documento"]').val(ObjectBill);
        $('#updateIngreso').find('input[name="fecha_emision"]').val(ObjectDateBill);
        $('#updateIngreso').find('input[name="fecha_vencimiento"]').val(ObjectDateVencimiento);
        $('#updateIngreso').find('select[name="tipo_documento_id"]').val(ObjectType);
        $('#updateIngreso').find('select[name="proveedor_id"]').val(ObjectProvider);
        $('#updateIngreso').find('select[name="centro_costo_id"]').val(ObjectCost);
        $('#updateIngreso').find('input[name="detalle"]').val(ObjectDetail);
        $('#updateIngreso').find('input[name="total_documento"]').val(ObjectValue);

        if ($(this).hasClass('fa-search')) {
            $("#IngresoFormUpdate :input").attr("readonly", true);
            $('#span_ingreso').text('Ver');
            $('#actualizarIngreso').hide()
            $('#IngresoFormUpdate').modal('show');
        } else if ($(this).hasClass('fa-pencil')) {
            $("#IngresoFormUpdate :input").attr("readonly", false);
            $('#span_ingreso').text('Actualizar');
            $('#actualizarIngreso').show()
            $('#IngresoFormUpdate').modal('show');
        }
        $('#updateIngreso').find('select').selectpicker('refresh');
    });


    $('body').on('click', '#actualizarIngreso', function() {

        $.postFormValues('../includes/compras/ingresos/updateIngreso.php', '#updateIngreso', {}, function(response) {

            if (response.status == 1) {

                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Actualizado Exitosamente',
                    container: 'floating',
                    timer: 3000
                });

                showIngresos();
                $('.modal').modal('hide');


            } else if (response.status == 2) {
                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Debe llenar todos los campos',
                    container: 'floating',
                    timer: 3000
                });
            } else if (response.status == 3) {
                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'La fecha de emisión debe ser menor a la fecha de vencimiento',
                    container: 'floating',
                    timer: 3000
                });
            } else {
                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Ocurrió un error en el Proceso',
                    container: 'floating',
                    timer: 3000
                });
            }
        });
    });

    $('body').on('click', '.Remove', function() {

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
        }, function(isConfirm) {
            if (isConfirm) {

                $.ajax({
                    url: "../includes/compras/ingresos/deleteIngreso.php",
                    type: 'POST',
                    data: "&id=" + ObjectId,
                    beforeSend: function( ) {
                        $('.IngresoTableLoader').html('<tr class="odd"><td valign="top" colspan="12" class="dataTables_empty"><div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div></td></tr>');
                      },
                    success: function(response) {
                        $('.IngresoTableLoader').html('');
                        if (response.status == 1) {
                            swal("Éxito!", "El registro ha sido eliminado!", "success");
                            showIngresos();
                        } else if (response.status == 3) {
                            swal('Solicitud no procesada', 'Este registro no puede ser eliminado porque posee otros registros asociados', 'error');
                        } else {
                            swal('Solicitud no procesada', 'Ha ocurrido un error, intente nuevamente por favor', 'error');
                        }
                    },
                    error: function() {
                        swal('Solicitud no procesada', 'Ha ocurrido un error, intente nuevamente por favor', 'error');
                    }
                });
            }
        });
    });

    $('body').on('click', '#guardarProveedor', function() {

        $.postFormValues('../includes/inventario/proveedores/storeProveedor.php', '#storeProveedor', {}, function(response) {

            if (response.status == 1) {

                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Guardado Exitosamente',
                    container: 'floating',
                    timer: 3000
                });

                $('.proveedor_id').append('<option value="' + response.array.id + '" data-content="' + response.array.rut + ' - ' + response.array.nombre + '"></option>');
                $('.proveedor_id').val(response.array.id);

                $('.proveedor_id').selectpicker('refresh');

                $('#storeProveedor')[0].reset();
                $('#modalProveedor').modal('hide');

            } else if (response.status == 2) {

                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Debe llenar todos los campos',
                    container: 'floating',
                    timer: 3000
                });

            } else {

                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Ocurrió un error en el Proceso',
                    container: 'floating',
                    timer: 3000
                });
            }
        });
    });

    $('body').on('click', '#guardarCosto', function() {

        $.postFormValues('../includes/compras/costos/storeCosto.php', '#storeCosto', {}, function(response) {

            if (response.status == 1) {

                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Guardado Exitosamente',
                    container: 'floating',
                    timer: 3000
                });

                $('.centro_costo_id').append('<option value="' + response.array.id + '" data-content="' + response.array.codigo_cuenta +' - '+ response.array.nombre + '"></option>');
                $('.centro_costo_id').val(response.array.id);

                $('.selectpicker').selectpicker('refresh');
                $('.centro_costo_id').selectpicker('refresh');
                console.log(' entro ');
                $('#storeCosto')[0].reset();
                $('#modalCosto').modal('hide');

            } else if (response.status == 2) {

                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Debe llenar todos los campos',
                    container: 'floating',
                    timer: 3000
                });

            } else {

                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Ocurrió un error en el Proceso',
                    container: 'floating',
                    timer: 3000
                });
            }
        });
    });
    $('body').on('click', '.Abonar', function() {
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        Monto = $(ObjectTR).find("td").eq(5).html();
        Explode = Monto.split(".");
        Monto = Explode[0]
        Monto = Monto.replace(",", "");
        Monto += ','
        Monto += Explode[1]
        $('#Monto').val(Monto)
        var id = ObjectTR.attr("id");
        $('#CompraId').val(id)
        $('#modalIngreso').modal('show')
    });
    $('#TipoPago').on('change', function() {
        TipoPago = $(this).find('option:selected').text()
        if (TipoPago == "Transferencia") {
            $('.label_Detalle').text('ID de Transferencia')
            $('.Detalle').attr('placeholder', "Ingrese el ID de Transferencia")
            $('.Detalle').data('nombre', "ID de Transferencia")
            $('.Detalle').addClass('number')
            $('.Detalle').attr('validate', 'not_null')
            $('#FechaEmisionCheque').removeAttr('validate')
            $('.Cheque').hide()
        } else if (TipoPago == "Cheque al dia") {
            $('.label_Detalle').text('N* de Cheque')
            $('.Detalle').attr('placeholder', "Ingrese el N* de Cheque")
            $('.Detalle').data('nombre', "N* de Cheque")
            $('.Detalle').addClass('number')
            $('.Detalle').attr('validate', 'not_null')
            $('#FechaEmisionCheque').attr('validate', 'not_null')
            $('.Cheque').show()
        } else {
            $('.Cheque').hide()
            $('.label_Detalle').text('Observación')
            $('.Detalle').attr('placeholder', "Ingrese la Observación")
            $('.Detalle').data('nombre', "Observación")
            $('.Detalle').removeAttr('validate')
            $('#FechaEmisionCheque').removeAttr('validate')
            $('.Detalle').removeClass('number')
        }
    });
    $("#FechaEmisionCheque").blur(function() {
        FechaEmision = moment($(this).val(), 'DD-MM-YYYY');
        if (FechaEmision.day() === 5) { // friday, show monday
            // set to monday
            FechaVencimiento = FechaEmision.weekday(8).format('DD-MM-YYYY');
        } else if (FechaEmision.day() === 6) { // saturday, show monday
            // set to monday
            FechaVencimiento = FechaEmision.weekday(8).format('DD-MM-YYYY');
        } else { // other days, show next day
            FechaVencimiento = FechaEmision.add('days', 1).format('DD-MM-YYYY');
        }
        $('#FechaVencimientoCheque').val(FechaVencimiento)
    });

    $('#modalIngreso').on('hidden.bs.modal', function() {

        $('#storePago')[0].reset();
        $('.selectpicker').selectpicker('refresh');

    });


    $('body').on('click', '#guardarPago', function() {

        $.postFormValues('../includes/compras/ingresos/storePago.php', '#storePago', {}, function(response) {

            if (response.status == 1) {

                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Guardado Exitosamente',
                    container: 'floating',
                    timer: 3000
                });

                $('#storePago')[0].reset();
                $('.selectpicker').selectpicker('refresh');
                $('.modal').modal('hide');
                showIngresos();

            } else if (response.status == 2) {

                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Debe llenar todos los campos',
                    container: 'floating',
                    timer: 3000
                });

            } else {

                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Ocurrió un error en el Proceso',
                    container: 'floating',
                    timer: 3000
                });

            }
        });
    });
    $('body').on('click', '.mostrarPagos', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var id = ObjectTR.attr("id");

        $.ajax({
            type: "POST",
            url: "../includes/compras/ingresos/showPagos.php",
            data: "id=" + id,
            success: function(data) {
                // data = JSON.parse(data)
                ModalTable = $('#ModalTable').DataTable({
                    order: [
                        [0, 'desc']
                    ],
                    "columnDefs": [{
                        "targets": [0],
                        "orderable": false
                    }],
                    data: data,
                    columns: [
                        { data: 'FechaPago' },
                        { data: 'Monto' },
                        { data: 'TipoPago' },
                        { data: 'Detalle' },
                        { data: 'FechaEmisionCheque' },
                        { data: 'FechaVencimientoCheque' },
                        { data: 'Id' }
                    ],
                    destroy: true,
                    'createdRow': function(row, data, dataIndex) {
                        $(row)
                            .attr('id', data.Id)
                            .addClass('text-center')
                    },
                    "columnDefs": [{
                        "targets": 6,
                        "render": function(data, type, row) {
                            Icono = '<i style="cursor: pointer; margin: 0 5px; font-size:15px;" class="fa fa-times EliminarPago"></i>'
                            return Icono;
                        }
                    }, ],
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

                $('#modalShow').modal('show')
            },
            error: function(xhr, status, error) {
                setTimeout(function() {
                    var err = JSON.parse(xhr.responseText);
                    swal('Solicitud no procesada', err.Message, 'error');
                }, 1000);
            }
        });

    });

    $(document).on('click', '.EliminarPago', function() {

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
        }, function(isConfirm) {
            if (isConfirm) {

                $.ajax({
                    url: "../includes/compras/ingresos/deletePago.php",
                    type: 'POST',
                    data: "&id=" + ObjectId,
                    beforeSend: function( ) {
                        $('.TablePagosLoader').html('<tr class="odd"><td valign="top" colspan="12" class="dataTables_empty"><div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div></td></tr>');
                      },
                    success: function(response) {
                        $('.TablePagosLoader').html('');
                        if (response == 1) {
                            swal("Éxito!", "El registro ha sido eliminado!", "success");
                            ModalTable.row($(ObjectTR))
                                .remove()
                                .draw();
                            showIngresos();
                        } else if (response == 3) {
                            swal('Solicitud no procesada', 'Este registro no puede ser eliminado porque posee otros registros asociados', 'error');
                        } else {
                            swal('Solicitud no procesada', 'Ha ocurrido un error, intente nuevamente por favor', 'error');
                        }
                    },
                    error: function() {
                        swal('Solicitud no procesada', 'Ha ocurrido un error, intente nuevamente por favor', 'error');
                    }
                });
            }
        });
    });
});