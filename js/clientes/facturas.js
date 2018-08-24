$(document).ready(function() {

    var ModalTable

    $('select[name="rutCliente"]').load('../ajax/servicios/selectClientes.php', function() {
        $('select[name="rutCliente"]').selectpicker();
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

    $('.number').number(true, 2, ',', '.');
    $('.date').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY'
    });


    $('#FacturasTable').DataTable({
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

    $(document).on('change', 'select[name="rutCliente"]', function() {
        getFacturas();
    });

    function getFacturas() {
        if ($(this).selectpicker('val') != '') {
            $.post('../ajax/cliente/getFacturas.php', { Rut: $('select[name="rutCliente"]').selectpicker('val') }, function(data) {
                data = JSON.parse(data);
                FacturasTable = $('#FacturasTable').DataTable({
                    order: [
                        [0, 'desc']
                    ],
                    "columnDefs": [{
                        "targets": [0],
                        "orderable": false
                    }],
                    data: data,
                    columns: [
                        { data: 'NumeroDocumento' },
                        { data: 'TipoDocumento' },
                        { data: 'FechaFacturacion' },
                        { data: 'FechaVencimiento' },
                        { data: 'TotalFactura' },
                        { data: 'TotalAbono' },
                        { data: 'Id' }
                    ],
                    destroy: true,
                    'createdRow': function(row, data, dataIndex) {
                        $(row)
                            .attr('id', data.Id)
                            .addClass('text-center')
                    },
                    "columnDefs": [{
                            "targets": 4,
                            "render": function(data, type, row) {
                                value = formatcurrency(data)
                                return "<div style='text-align: center'>" + value + "</div>";
                            }
                        },
                        {
                            "targets": 5,
                            "render": function(data, type, row) {
                                value = formatcurrency(data)
                                return "<div style='text-align: center'>" + value + "</div>";
                            }
                        }, {
                            "targets": 6,
                            "render": function(data, type, row) {
                                if (row.EstatusFacturacion == '1') {
                                    Folder = 'facturas';
                                    Devolucion = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-undo Devolucion" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Devolucion" title="" data-container="body"></i>'
                                    if (row.TotalAbono != '0') {
                                        Abonar = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-plus Abonar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Abonar" title="" data-container="body"></i>'
                                    } else {
                                        Abonar = ''
                                    }
                                    if (row.TotalFactura != row.TotalAbono) {
                                        Pagos = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye mostrarPagos" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Ver Pagos" title="" data-container="body"></i>'
                                    } else {
                                        Pagos = ''
                                    }
                                } else {
                                    Folder = 'notas_credito';
                                    Devolucion = ''
                                    Abonar = ''
                                    Pagos = ''
                                }
                                if (data != '') {
                                    Pdf = '<a href="../facturacion/' + Folder + '/' + data + '.pdf" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>';
                                } else {
                                    Pdf = '';
                                }
                                return "<div style='text-align: center'>" + Devolucion + " " + Abonar + " " + Pagos + " " + Pdf + "</div>";
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

                $('[data-toggle="popover"]').popover();
                $('table').css('width', '100%');
            });
        }
    }
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
        $('#FacturaId').val(id)
        $('#modalIngreso').modal('show')
    });

    $('#TipoPago').on('change', function() {
        TipoPago = $(this).find('option:selected').text()
        if (TipoPago == "Transferencia") {
            $('.label_Detalle').text('ID de Transferencia')
            $('.Detalle').attr('placeholder', "Ingrese el ID de Transferencia")
            $('.Detalle').data('nombre', "ID de Transferencia")
            $('.Detalle').addClass('number')
            $('.Detalle').attr('validation', 'not_null')
            $('#FechaEmisionCheque').removeAttr('validation')
            $('.Cheque').hide()
        } else if (TipoPago == "Cheque al dia") {
            $('.label_Detalle').text('N* de Cheque')
            $('.Detalle').attr('placeholder', "Ingrese el N* de Cheque")
            $('.Detalle').data('nombre', "N* de Cheque")
            $('.Detalle').addClass('number')
            $('.Detalle').attr('validation', 'not_null')
            $('#FechaEmisionCheque').attr('validation', 'not_null')
            $('.Cheque').show()
        } else {
            $('.Cheque').hide()
            $('.label_Detalle').text('Observación')
            $('.Detalle').attr('placeholder', "Ingrese la Observación")
            $('.Detalle').data('nombre', "Observación")
            $('.Detalle').removeAttr('validation')
            $('#FechaEmisionCheque').removeAttr('validation')
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

        $.postFormValues('../ajax/cliente/storePago.php', '#storePago', function(response) {

            if (response == 1) {

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
                getFacturas();

            } else if (response == 2) {

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
            url: "../ajax/cliente/getPagos.php",
            data: "id=" + id,
            success: function(response) {
                data = JSON.parse(response)
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
                    url: "../ajax/cliente/deletePago.php",
                    type: 'POST',
                    data: "&id=" + ObjectId,
                    success: function(response) {
                        setTimeout(function() {
                            if (response == 1) {
                                swal("Éxito!", "El registro ha sido eliminado!", "success");
                                ModalTable.row($(ObjectTR))
                                    .remove()
                                    .draw();
                                getFacturas();
                            } else if (response == 3) {
                                swal('Solicitud no procesada', 'Este registro no puede ser eliminado porque posee otros registros asociados', 'error');
                            } else {
                                swal('Solicitud no procesada', 'Ha ocurrido un error, intente nuevamente por favor', 'error');
                            }
                        }, 1000);
                    },
                    error: function() {
                        swal('Solicitud no procesada', 'Ha ocurrido un error, intente nuevamente por favor', 'error');
                    }
                });
            }
        });
    });

    function formatcurrency(n) {
        return n.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    }

    $('body').on('click', '.Devolucion', function() {
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var id = ObjectTR.attr("id");
        $('#FacturaIdDevolucion').val(id)
        $('#modalDevolucion').modal('show')
    });
    $('body').on('click', '#guardarDevolucion', function() {

        $.postFormValues('../includes/facturacion/facturas/storeDevolucion.php', '#storeDevolucion', function(response) {

            if (response.status == 1) {

                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Guardado Exitosamente',
                    container: 'floating',
                    timer: 3000
                });

                $('#storeDevolucion')[0].reset();
                $('.selectpicker').selectpicker('refresh');
                $('.modal').modal('hide');
                getFacturas();

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
                    message: response.Message,
                    container: 'floating',
                    timer: 3000
                });

            }
        });
    });
    $('#modalDevolucion').on('hidden.bs.modal', function() {

        $('#storeDevolucion')[0].reset();

    });
});