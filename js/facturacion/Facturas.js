$(document).ready(function() {

    var ModalTable

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

    $('select[name="rutCliente"]').load('../ajax/servicios/selectClientes.php', function() {
        $('select[name="rutCliente"]').selectpicker();
    });

    $('.number').number(true, 0, ',', '.');
    $('.date').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY'
    });

    $('#FacturasTableCliente').DataTable();
    $('#FacturasTableFechas').DataTable();
    $('#FacturasTableNDocumento').DataTable();

    $('.input-daterange').datepicker({
        format: "dd-mm-yyyy",
        weekStart: 1,
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true,
        language: 'es'
    });

    $('.row-por-fechas').hide();
    $('.row-por-clientes').hide();
    $('.row-por-NFactura').hide();

    $(document).on('click', '.select-por-fecha', function() {
        $('.TotalSaldoDoc').text(0);
        $(".select_all").prop('checked', false);
       
        $('.row-por-clientes').slideUp('slow');
        $('.row-por-NFactura').slideUp('slow');
        $('.row-por-fechas').slideDown('slow');
    });

    $(document).on('click', '.select-por-cliente', function() {
        $('.TotalSaldoDoc').text(0);
        $(".select_all").prop('checked', false);
        $('.row-por-fechas').slideUp('slow');
        $('.row-por-NFactura').slideUp('slow');
        $('.row-por-clientes').slideDown('slow');
    });

    $(document).on('click', '.select-por-NFactura', function() {
        $('.TotalSaldoDoc').text(0);
        $(".select_all").prop('checked', false);
        $('.row-por-fechas').slideUp('slow');
        $('.row-por-clientes').slideUp('slow');
        $('.row-por-NFactura').slideDown('slow');
    });

    $(document).on('change', 'select[name="rutCliente"]', function() {
        getFacturasCliente();
        $('.TotalSaldoDoc').text(0);
        $("#select_all").prop('checked', false);
    });

    function getChecked(idtabla) {
        var checked = [];
        $(idtabla+' tr').each(function(i, row) {
            var actualrow = $(row);
            checkbox = actualrow.find('input:checked').val();
            if (checkbox == 'on') {
                var id = $(actualrow).attr('id');
                var TotalFactura = $(actualrow).attr('totalsaldo');
                checked[i] = TotalFactura;
            }
        });

        return checked;
    }

    function sumarSaldoDoc(SaldoDoc) {
        var TotalSaldoDoc = 0;
        $(SaldoDoc).each(function(i, row) {
            if(row != undefined){   
                TotalSaldoDoc += parseInt(row);
            }
        });
        return TotalSaldoDoc;
    }

    $('#select_all').on('click', function() {
        var rows = FacturasTableCliente.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
        values = getChecked('#FacturasTableCliente');
        if(values.length) {
            $('.TotalSaldoDoc').text(formatcurrency(sumarSaldoDoc(values)));
        }else{
            $('.TotalSaldoDoc').text(0);
        }
    });

    $('#FacturasTableCliente tbody').on('click', 'input[type="checkbox"]', function() {
        values = getChecked('#FacturasTableCliente');
        if(values.length) {
            $('.TotalSaldoDoc').text(formatcurrency(sumarSaldoDoc(values)));
        }else{
            $('.TotalSaldoDoc').text(0);
        }
    });
    $('#FacturasTableFechas tbody').on('click', 'input[type="checkbox"]', function() {
        values = getChecked('#FacturasTableFechas');
        if(values.length) {
            $('.TotalSaldoDoc').text(formatcurrency(sumarSaldoDoc(values)));
        }else{
            $('.TotalSaldoDoc').text(0);
        }
    });
    $('#FacturasTableNDocumento tbody').on('click', 'input[type="checkbox"]', function() {
        values = getChecked('#FacturasTableNDocumento');
        if(values.length) {
            $('.TotalSaldoDoc').text(formatcurrency(sumarSaldoDoc(values)));
        }else{
            $('.TotalSaldoDoc').text(0);
        }
    });

    function getFacturasCliente() {
        $.post('../includes/facturacion/facturas/filtrarFacturas.php', { Rut: $('select[name="rutCliente"]').selectpicker('val') }, function(data) {
            FacturasTableCliente = $('#FacturasTableCliente').DataTable({
                order: [
                    [2, 'asc']
                ],
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false
                }],
                data: data,
                columns: [
                    { data: 'Id' },
                    { data: 'NumeroDocumento' },
                    { data: 'TipoDocumento' },
                    { data: 'FechaFacturacion' },
                    { data: 'FechaVencimiento' },
                    { data: 'Detalle' },
                    { data: 'TotalFactura' },
                    { data: 'TotalSaldo' },
                    { data: 'SaldoFavor'},
                    { data: 'DocumentoId' }
                ],
                destroy: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row)
                        .attr('id', data.Id)
                        .attr('TotalSaldo', data.TotalSaldo)
                        .attr('DocumentoId', data.DocumentoId)
                        .attr('UrlPdfBsale', data.UrlPdfBsale)
                        .attr('NumeroDocumento', data.NumeroDocumento)
                        .addClass('text-center')
                },
                "columnDefs": [
                    {
                        "targets": 0,
                        "render": function(data, type, row) {
                            Check = '<input name="select_check" id="select_check_' + data + '" type="checkbox" />'
                            return "<div style='text-align: center'>" + Check + "</div>";
                        }
                    },
                    {
                        "targets": 6,
                        "render": function(data, type, row) {
                            value = formatcurrency(data)
                            return "<div style='text-align: center'>" + value + "</div>";
                        }
                    },
                    {
                        "targets": 7,
                        "render": function(data, type, row) {
                            value = formatcurrency(data)
                            if (row.TipoDocumento == 'Nota de crédito') {
                                Div = "<div style='text-align: center;color:red'>-"
                            } else if (row.TipoDocumento == 'Nota de debito') {
                                Div = "<div style='text-align: center;color:blue'>+"
                            } else {
                                Div = "<div style='text-align: center'>";
                            }
                            return Div + value + "</div>";
                        }
                    },
                    {
                        "targets": 8,
                        "render": function(data, type, row) {
                            value = formatcurrency(data)
                            return "<div style='text-align: center'>" + value + "</div>";
                        }
                    },
                    {
                        "targets": 9,
                        "render": function(data, type, row) {
                            if (row.EstatusFacturacion == '1') {
                                Folder = 'facturas';
                                if (row.Acciones == 1) {
                                    Devolucion = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-undo Devolucion" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Generar Nota de Crédito" title="" data-container="body"></i>'
                                    if (row.TotalSaldo != '0') {
                                        Abonar = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-plus Abonar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Abonar" title="" data-container="body"></i>'
                                    } else {
                                        Abonar = ''
                                    }
                                    if (row.TotalFactura != row.TotalSaldo) {
                                        Pagos = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-copy mostrarPagos" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Ver Pagos" title="" data-container="body"></i>'
                                    } else {
                                        Pagos = ''
                                    }
                                } else {
                                    Devolucion = ''
                                    Abonar = ''
                                    Pagos = ''
                                    //Acciones 2, es por nota de credito parcial
                                    if(row.Acciones == 2){
                                        if(row.TotalSaldo != '0') {
                                            Abonar = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-plus Abonar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Abonar" title="" data-container="body"></i>'   
                                        }
                                        if(row.SaldoConNotaCredito != row.TotalSaldo) {
                                            Pagos = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-copy mostrarPagos" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Ver Pagos" title="" data-container="body"></i>'
                                        }
                                        
                                    }
                                }
                                Anulacion = '';
                                //descomentar y borrar el Enviar arriba
                                Enviar = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-envelope enviarDocumento" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Reenviar Documento" title="" data-container="body"></i>'
                            } else if (row.EstatusFacturacion == 2) {
                                Folder = 'notas_credito';
                                Devolucion = ''
                                Abonar = ''
                                Pagos = ''
                                Enviar = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-envelope enviarNotaCredito" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Reenviar Documento" title="" data-container="body"></i>'
                                if (row.Acciones == 1) {
                                    Anulacion = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times-circle Anulacion" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Generar Nota de Debito" title="" data-container="body"></i>'
                                } else {
                                    Anulacion = ''
                                }
                            } else {
                                Folder = 'notas_debito';
                                Devolucion = ''
                                Abonar = ''
                                Pagos = ''
                                Anulacion = ''
                                Enviar = ''
                            }
                            if (data != '') {
                                Pdf = row.UrlPdfBsale;
                                Pdf = '<a href="'+Pdf+'" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>';
                                // Pdf = '<a href="../facturacion/' + Folder + '/' + data + '.pdf" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>';
                            } else {
                                Pdf = '';
                            }
                            
                            return "<div style='text-align: center'>" + Devolucion + " " + Anulacion + " " + Abonar + " " + Pagos + " " + Pdf + " " + Enviar +"</div>";
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
            filtrarPorDocumentoCliente();
        });
    }

    $(document).on('click', '#filtrarNDocumento', function() {

        $('[name="NumeroDocumento"]').mask("000000");
        var NumeroDocumento = $('[name="NumeroDocumento"]').val();
        if (NumeroDocumento != '') {
            getFacturasNDocumento();
        } else {
            bootbox.alert('Debe Ingresar un Número de Documento')
            return false;
        }
    });

    $(document).on('click', '#filtrar', function() {
        var startDate = $("#date-range .input-daterange input[name='start']").val();
        var endDate = $("#date-range .input-daterange input[name='end']").val();

        if (startDate != '' & endDate != '') {
            getFacturas();
        } else {
            bootbox.alert('Debe Seleccionar un rango de fecha')
            return false;
        }
    });
    function filtrarPorDocumentoFecha() {
        var documentType = $('#documentTypeFecha').val();
        if (documentType) {
            if (documentType == 1) {
                documentType = 'Boleta'
            } else if (documentType == 2) {
                documentType = 'Factura'
            } else {
                documentType = 'Nota de crédito'
            }
        } else {
            documentType = '';
        }
        FacturasTableFechas
            .columns(2)
            .search(documentType)
            .draw();
    }
    $(document).on('change', '#documentTypeFecha', function() {
        filtrarPorDocumentoFecha();
        $('.TotalSaldoDoc').text(0);
    });
    function filtrarPorDocumentoCliente(){
        var documentType = $('#documentTypeRut').val();
        if (documentType) {
            if (documentType == 1) {
                documentType = 'Boleta'
            } else if (documentType == 2) {
                documentType = 'Factura'
            } else {
                documentType = 'Nota de crédito'
            }
        } else {
            documentType = '';
        }
        FacturasTableCliente
            .columns(2)
            .search(documentType)
            .draw();
    }
    $(document).on('change', '#documentTypeRut', function () {
        filtrarPorDocumentoCliente();
    });
    function filtrarPorDocumentoNDocumento() {
        var documentType = $('#documentTypeNDocumento').val();
        if (documentType) {
            if (documentType == 1) {
                documentType = 'Boleta'
            } else if (documentType == 2) {
                documentType = 'Factura'
            } else {
                documentType = 'Nota de crédito'
            }
        } else {
            documentType = '';
        }
        FacturasTableNDocumento
            .columns(2)
            .search(documentType)
            .draw();
    }

    $(document).on('change', '#documentTypeNDocumento', function () {
        filtrarPorDocumentoNDocumento();
    });
    // filtrar por N Documento
    function getFacturasNDocumento() {

        var NumeroDocumento = $('[name="NumeroDocumento"]').val();
        $.post('../includes/facturacion/facturas/filtrarFacturas.php', { NumeroDocumento: NumeroDocumento }, function(data) {
            FacturasTableNDocumento = $('#FacturasTableNDocumento').DataTable({
                order: [
                    [8, 'asc']
                ],
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false
                }],
                data: data,
                columns: [
                    { data: 'Id' },
                    { data: 'NumeroDocumento' },
                    { data: 'TipoDocumento' },
                    { data: 'FechaFacturacion' },
                    { data: 'FechaVencimiento' },
                    { data: 'Detalle' },
                    { data: 'TotalFactura' },
                    { data: 'TotalSaldo' },
                    { data: 'SaldoFavor'},
                    { data: 'Cliente' },
                    { data: 'DocumentoId' }
                ],
                destroy: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row)
                        .attr('id', data.Id)
                        .attr('TotalSaldo', data.TotalSaldo)
                        .attr('DocumentoId', data.DocumentoId)
                        .attr('UrlPdfBsale', data.UrlPdfBsale)
                        .attr('NumeroDocumento', data.NumeroDocumento)
                        .addClass('text-center')
                },
                "columnDefs": [{
                    "targets": 0,
                    "render": function(data, type, row) {
                        Check = '<input name="select_check" id="select_check_' + data + '" type="checkbox" />'
                        return "<div style='text-align: center'>" + Check + "</div>";
                        }
                    },
                    {
                        "targets": 6,
                        "render": function(data, type, row) {
                            value = formatcurrency(data)
                            return "<div style='text-align: center'>" + value + "</div>";
                        }
                    },
                    {
                        "targets": 7,
                        "render": function(data, type, row) {
                            value = formatcurrency(data)
                            if (row.TipoDocumento == 'Nota de crédito') {
                                Div = "<div style='text-align: center;color:red'>-"
                            } else if (row.TipoDocumento == 'Nota de debito') {
                                Div = "<div style='text-align: center;color:blue'>+"
                            } else {
                                Div = "<div style='text-align: center'>";
                            }
                            return Div + value + "</div>";
                        }
                    },
                    {
                        "targets": 8,
                        "render": function(data, type, row) {
                            value = formatcurrency(data)
                            return "<div style='text-align: center'>" + value + "</div>";
                        }
                    },
                    {
                        "targets": 10,
                        "render": function(data, type, row) {
                            if (row.EstatusFacturacion == '1') {
                                Folder = 'facturas';
                                if (row.Acciones == 1) {
                                    Devolucion = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-undo Devolucion" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Generar Nota de Crédito" title="" data-container="body"></i>'
                                    if (row.TotalSaldo != '0') {
                                        Abonar = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-plus Abonar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Abonar" title="" data-container="body"></i>'
                                    } else {
                                        Abonar = ''
                                    }
                                    if (row.TotalFactura != row.TotalSaldo) {
                                        Pagos = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-copy mostrarPagos" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Ver Pagos" title="" data-container="body"></i>'
                                    } else {
                                        Pagos = ''
                                    }
                                } else {
                                    Devolucion = ''
                                    Abonar = ''
                                    Pagos = ''
                                    //Acciones 2, es por nota de credito parcial
                                    if(row.Acciones == 2){
                                        if(row.TotalSaldo != '0') {
                                            Abonar = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-plus Abonar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Abonar" title="" data-container="body"></i>'   
                                        }
                                        if(row.SaldoConNotaCredito != row.TotalSaldo) {
                                            Pagos = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-copy mostrarPagos" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Ver Pagos" title="" data-container="body"></i>'
                                        }
                                        
                                    }
                                }
                                Anulacion = '';
                                //descomentar y borrar el Enviar arriba
                                Enviar = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-envelope enviarDocumento" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Reenviar Documento" title="" data-container="body"></i>'
                            } else if (row.EstatusFacturacion == 2) {
                                Folder = 'notas_credito';
                                Devolucion = ''
                                Abonar = ''
                                Pagos = ''
                                Enviar = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-envelope enviarNotaCredito" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Reenviar Documento" title="" data-container="body"></i>'
                                if (row.Acciones == 1) {
                                    Anulacion = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times-circle Anulacion" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Generar Nota de Debito" title="" data-container="body"></i>'
                                } else {
                                    Anulacion = ''
                                }
                            } else {
                                Folder = 'notas_debito';
                                Devolucion = ''
                                Abonar = ''
                                Pagos = ''
                                Anulacion = ''
                                Enviar = '';
                            }
                            if (data != '') {
                                Pdf = row.UrlPdfBsale;
                                Pdf = '<a href="'+Pdf+'" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>';
                                // Pdf = '<a href="../facturacion/' + Folder + '/' + data + '.pdf" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>';
                            } else {
                                Pdf = '';
                            }
                            return "<div style='text-align: center'>" + Devolucion + " " + Anulacion + " " + Abonar + " " + Pagos + " " + Pdf + " " + Enviar + "</div>";
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
            filtrarPorDocumentoNDocumento();
        });
    }
    //para seleccionar todos los docs de la tabla por fechas
    $('#select_all_docs').on('click', function() {
        var rows = FacturasTableNDocumento.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
        values = getChecked('#FacturasTableNDocumento');
        if(values.length) {
            $('.TotalSaldoDoc').text(formatcurrency(sumarSaldoDoc(values)));
        }else{
            $('.TotalSaldoDoc').text(0);
        }
    });


    //por fechas
    function getFacturas() {
        var startDate = $("#date-range .input-daterange input[name='start']").val();
        var endDate = $("#date-range .input-daterange input[name='end']").val();
        var documentType = $("#documentType").val();

        $.post('../includes/facturacion/facturas/filtrarFacturas.php', { startDate: startDate, endDate: endDate, documentType: documentType }, function(data) {
            FacturasTableFechas = $('#FacturasTableFechas').DataTable({
                order: [
                    [8, 'asc']
                ],
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false
                }],
                data: data,
                columns: [
                    { data: 'Id' },
                    { data: 'NumeroDocumento' },
                    { data: 'TipoDocumento' },
                    { data: 'FechaFacturacion' },
                    { data: 'FechaVencimiento' },
                    { data: 'Detalle' },
                    { data: 'TotalFactura' },
                    { data: 'TotalSaldo' },
                    { data: 'SaldoFavor'},
                    { data: 'Cliente' },
                    { data: 'DocumentoId' }
                ]
                ,
                destroy: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row)
                        .attr('id', data.Id)
                        .attr('TotalSaldo', data.TotalSaldo)
                        .attr('DocumentoId', data.DocumentoId)
                        .attr('UrlPdfBsale', data.UrlPdfBsale)
                        .attr('NumeroDocumento', data.NumeroDocumento)
                        .addClass('text-center')
                },
                "columnDefs": [{
                    "targets": 0,
                    "render": function(data, type, row) {
                        Check = '<input name="select_check" id="select_check_' + data + '" type="checkbox" />'
                        return "<div style='text-align: center'>" + Check + "</div>";
                        }
                    },
                    {
                        "targets": 6,
                        "render": function(data, type, row) {
                            value = formatcurrency(data)
                            return "<div style='text-align: center'>" + value + "</div>";
                        }
                    },
                    {
                        "targets": 7,
                        "render": function(data, type, row) {
                            value = formatcurrency(data)
                            if (row.TipoDocumento == 'Nota de crédito') {
                                Div = "<div style='text-align: center;color:red'>-"
                            } else if (row.TipoDocumento == 'Nota de debito') {
                                Div = "<div style='text-align: center;color:blue'>+"
                            } else {
                                Div = "<div style='text-align: center'>";
                            }
                            return Div + value + "</div>";
                        }
                    },
                    {
                        "targets": 8,
                        "render": function(data, type, row) {
                            value = formatcurrency(data)
                            return "<div style='text-align: center'>" + value + "</div>";
                        }
                    },
                    {
                        "targets": 10,
                        "render": function(data, type, row) {
                            if (row.EstatusFacturacion == '1') {
                                Folder = 'facturas';
                                if (row.Acciones == 1) {
                                    Devolucion = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-undo Devolucion" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Generar Nota de Crédito" title="" data-container="body"></i>'
                                    if (row.TotalSaldo != '0') {
                                        Abonar = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-plus Abonar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Abonar" title="" data-container="body"></i>'
                                    } else {
                                        Abonar = ''
                                    }
                                    if (row.TotalFactura != row.TotalSaldo) {
                                        Pagos = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-copy mostrarPagos" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Ver Pagos" title="" data-container="body"></i>'
                                    } else {
                                        Pagos = ''
                                    }
                                } else {
                                    Devolucion = ''
                                    Abonar = ''
                                    Pagos = ''
                                     //Acciones 2, es por nota de credito parcial
                                     if(row.Acciones == 2){
                                        if(row.TotalSaldo != '0') {
                                            Abonar = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-plus Abonar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Abonar" title="" data-container="body"></i>'   
                                        }
                                        if(row.SaldoConNotaCredito != row.TotalSaldo) {
                                            Pagos = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-copy mostrarPagos" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Ver Pagos" title="" data-container="body"></i>'
                                        }
                                        
                                    }
                                }
                                Anulacion = '';
                                Enviar = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-envelope enviarDocumento" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Reenviar Documento" title="" data-container="body"></i>'
                            } else if (row.EstatusFacturacion == 2) {
                                Folder = 'notas_credito';
                                Devolucion = ''
                                Abonar = ''
                                Pagos = ''
                                Enviar = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-envelope enviarNotaCredito" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Reenviar Documento" title="" data-container="body"></i>'
                                if (row.Acciones == 1) {
                                    Anulacion = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times-circle Anulacion" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Generar Nota de Debito" title="" data-container="body"></i>'
                                } else {
                                    Anulacion = ''
                                }
                            } else {
                                Folder = 'notas_debito';
                                Devolucion = ''
                                Abonar = ''
                                Pagos = ''
                                Anulacion = ''
                                Enviar = '';
                            }
                            if (data != '') {
                                Pdf = row.UrlPdfBsale;
                                Pdf = '<a href="'+Pdf+'" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>';
                                // Pdf = '<a href="../facturacion/' + Folder + '/' + data + '.pdf" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>';
                            } else {
                                Pdf = '';
                            }
                            return "<div style='text-align: center'>" + Devolucion + " " + Anulacion + " " + Abonar + " " + Pagos + " " + Pdf + " " + Enviar + "</div>";
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
            filtrarPorDocumentoFecha();
        });
    }

    //para seleccionar todos los docs de la tabla por fechas
    $('#select_all_fechas').on('click', function() {
        var rows = FacturasTableFechas.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);
        values = getChecked('#FacturasTableFechas');
        if(values.length) {
            $('.TotalSaldoDoc').text(formatcurrency(sumarSaldoDoc(values)));
        }else{
            $('.TotalSaldoDoc').text(0);
        }
    });
    

    $(document).on('click', '.descargar', function() {
        Tipo = $('#select-por').val();
        if(Tipo == 1){
            var startDate = $("#date-range .input-daterange input[name='start']").val();
            var endDate = $("#date-range .input-daterange input[name='end']").val();
            if (startDate != '' & endDate != '') {
                var documentType = $("#documentTypeFecha").val();
                data = "startDate=" + startDate + "&endDate=" + endDate
                if(documentType){
                    data += "&documentType=" + documentType
                }
                downloadFacturas(data);
            } else {
                bootbox.alert('Debe Seleccionar un rango de fecha')
                return false;
            }
        } else if (Tipo == 2) {
            Rut = $('#rutCliente').val()
            if (Rut) {
                var documentType = $("#documentTypeRut").val();
                data = "Rut=" + Rut
                if (documentType) {
                    data += "&documentType=" + documentType
                }
                downloadFacturas(data);
            } else {
                bootbox.alert('Debe Seleccionar un Rut')
                return false;
            }
        } else{
            NumeroDocumento = $('#NumeroDocumento').val()
            if (NumeroDocumento != '') {
                var documentType = $("#documentTypeNDocumento").val();
                data = "NumeroDocumento=" + NumeroDocumento
                if (documentType) {
                    data += "&documentType=" + documentType
                }
                downloadFacturas(data);
            } else {
                bootbox.alert('Debe ingresar un numero de documento')
                return false;
            }
        }
    });

    function downloadFacturas(data) {
        url = 'facturas/descargarFacturas.php?' + data;
        window.open(url, '_blank');
    }
    $('body').on('click', '.Abonar', function() {
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        Monto = $(ObjectTR).find("td").eq(6).text();
        Monto = Monto.split();
        //formatea el monto hasta miles de mollones
        Monto = Monto[0].replace(".", "");
        Monto = Monto.replace(".", "");
        Monto = Monto.replace(".", "");
        
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
        $('#guardarPago').attr('disabled', 'disabled');
        $.postFormValues('../includes/facturacion/facturas/storePago.php', '#storePago', {}, function(response) {

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
                getFacturasNDocumento();
                getFacturasCliente();

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
        $('#guardarPago').attr('disabled', false);
    });
    $('body').on('click', '.mostrarPagos', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var id = ObjectTR.attr("id");

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/getPagos.php",
            data: "id=" + id,
            success: function(response) {
                ModalTable = $('#ModalTable').DataTable({
                    order: [
                        [0, 'desc']
                    ],
                    "columnDefs": [{
                        "targets": [0],
                        "orderable": false
                    }],
                    data: response,
                    columns: [
                        { data: 'Id' },
                        { data: 'FechaPago' },
                        { data: 'Monto' },
                        { data: 'TipoPago' },
                        { data: 'Detalle' },
                        { data: 'FechaEmisionCheque' },
                        { data: 'FechaVencimientoCheque' },
                        { data: 'Usuario' },
                        { data: 'Id' }
                    ],
                    destroy: true,
                    'createdRow': function(row, data, dataIndex) {
                        $(row)
                            .attr('id', data.Id)
                            .addClass('text-center')
                    },
                    "columnDefs": [{
                        "targets": 2,
                        "render": function(data, type, row) {
                            value = formatcurrency(data)
                            return "<div style='text-align: center'>" + value + "</div>";
                        }
                    }, {
                        "targets": 8,
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
                    url: "../includes/facturacion/facturas/deletePago.php",
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
                                getFacturasNDocumento();
                                getFacturasCliente();
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

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/showIndividual.php",
            data: "id=" + id,
            success: function(response) {
                TablaFacturaDetalle.clear().draw()

                $.each(response.array, function(index, array) {
                    var rowNode = TablaFacturaDetalle.row.add([
                        '' + '<div><input class="select-checkbox" name="select_check" id="select_check_' + array.documentDetailIdBsale + '" type="checkbox" /></div>' +'',
                        
                        '' + array.Codigo + '',
                        '' + array.Concepto + '',
                        '' + formatcurrency(array.Valor) + '',
                    ]).draw(false).node();

                    $(rowNode)
                        .attr('documentDetailIdBsale', array.documentDetailIdBsale)
                        .addClass('text-center')
                });
            },
            error: function(xhr, status, error) {
                setTimeout(function() {
                    var err = JSON.parse(xhr.responseText);
                    swal('Solicitud no procesada', err.Message, 'error');
                }, 1000);
            }
        });
    });

    $('#componenteNotaCreditoParcial').hide();
    $('.div-modal-motivo').hide();
    TablaFacturaDetalle = $('#TablaFacturaDetalle').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,
        bInfo: false,
        bFilter: false,
        order: [
            [0, 'asc']
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
    $(document).on('change', '#SelectNotaCredito', function() {
        TipoNotaCredito = $(this).find('option:selected').val()
        if (TipoNotaCredito == 1) {
            $('.div-modal-motivo').slideDown('slow');
            $('#componenteNotaCreditoParcial').slideUp('slow');
            $('#tipoNotaCredito').val(TipoNotaCredito);
            console.log(' es nota credito normal ')
        }else if(TipoNotaCredito == 2){
            $('.div-modal-motivo').slideDown('slow');
            $('#tipoNotaCredito').val(TipoNotaCredito);
            $('#componenteNotaCreditoParcial').slideDown('slow');
            console.log(' es nota credito parcial ')
        }else if(TipoNotaCredito == 3){
            $('.div-modal-motivo').slideDown('slow');
            $('#tipoNotaCredito').val(TipoNotaCredito);
            $('#componenteNotaCreditoParcial').slideUp('slow');
            console.log(' es nota credito por correcion de texto ')
        }else if(TipoNotaCredito == ''){
            $('#tipoNotaCredito').val(TipoNotaCredito);
            console.log(' es vacio ...')
            $('#Motivo').val('').blur();
            $('.div-modal-motivo').slideUp('slow');
            $('#componenteNotaCreditoParcial').slideUp('slow');

        }
    });

    function getCheckedDetalles(idtabla) {
        var checked = [];
        $(idtabla+' tr ').each(function(i, row) {
            var actualrow = $(row);
            checkbox = actualrow.find('input:checked').val();
            if (checkbox == 'on') {
                var id = $(actualrow).attr('documentDetailIdBsale');
                checked[i] = id;
            }
        });

        return checked;
    }

    $(document).on('change', 'select[name="rutCliente"]', function() {
        getFacturasCliente();
        $('.TotalSaldoDoc').text(0);
        $("#select_all").prop('checked', false);
    });
    $('body').on('click', '#guardarDevolucion', function() {
        if(TipoNotaCredito == 2){
            FacturaDetalle = getCheckedDetalles('#TablaFacturaDetalle');
            $('#DetallesSeleccionados').val(FacturaDetalle);
            if (!FacturaDetalle.length > 0) {
                alertas('danger', '<h5>Debe Seleccionar un Detalle de la factura</h5>');
                return;
            }
        }
        $('#guardarDevolucion').prop('disabled', true);
        $.postFormValues('../includes/facturacion/facturas/storeDevolucion.php', '#storeDevolucion', {}, function(response) {

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
        setTimeout(function() {
            $('#guardarDevolucion').prop('disabled', false);
        }, 3000);
    });

    $('#modalDevolucion').on('hidden.bs.modal', function() {

        $('#storeDevolucion')[0].reset();

    });
    $(document).on('click', '.Anulacion', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("id");

        swal({
            title: "Desea generar la nota de debito?",
            text: "Confirmar anulación!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Anular!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true
        }, function(isConfirm) {
            if (isConfirm) {

                $.ajax({
                    url: "../includes/facturacion/facturas/anularDevolucion.php",
                    type: 'POST',
                    data: "&id=" + ObjectId,
                    success: function(response) {
                        setTimeout(function() {
                            if (response == 1) {
                                swal("Éxito!", "La nota de crédito ha sido anulada!", "success");
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

    $(document).on('click', '.enviarDocumento', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("id");

        swal({
            title: "Desea reenviar el documento?",
            text: "Confirmar reenvio!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Enviar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true
        }, function (isConfirm) {
            if (isConfirm) {

                $.ajax({
                    url: "../includes/facturacion/facturas/enviarDocumento.php",
                    type: 'POST',
                    data: "&id=" + ObjectId,
                    success: function (response) {
                        setTimeout(function () {
                            if (response == 1) {
                                swal("Éxito!", "El documento ha sido reenviado!", "success");
                            } else if (response == 2) {
                                swal('Solicitud no procesada', 'Este documento no puede ser enviado, por favor contactar al administrador', 'error');
                            } else if (response == 3) {
                                swal('Solicitud no procesada', 'Este cliente no posee contacto de facturación', 'error');
                            }else {
                                swal('Solicitud no procesada', 'Ha ocurrido un error, intente nuevamente por favor', 'error');
                            }
                        }, 1000);
                    },
                    error: function () {
                        swal('Solicitud no procesada', 'Ha ocurrido un error, intente nuevamente por favor', 'error');
                    }
                });
            }
        });
    });
    $(document).on('click', '.enviarNotaCredito', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("documentoid");
        var ObjectUrlPdfBsale = ObjectTR.attr("UrlPdfBsale");
        var ObjectNumeroDocumento = ObjectTR.attr("NumeroDocumento");

        swal({
            title: "Desea reenviar el documento?",
            text: "Confirmar reenvio!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Enviar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true
        }, function (isConfirm) {
            if (isConfirm) {

                $.ajax({
                    url: "../includes/facturacion/facturas/enviarDocumento.php",
                    type: 'POST',
                    data: "&notacreditoid=" + ObjectId+"&UrlPdfBsale="+ObjectUrlPdfBsale + "&NumeroDocumento="+ObjectNumeroDocumento,
                    success: function (response) {
                        setTimeout(function () {
                            if (response == 1) {
                                swal("Éxito!", "El documento ha sido reenviado!", "success");
                            } else if (response == 2) {
                                swal('Solicitud no procesada', 'Este documento no puede ser enviado, por favor contactar al administrador', 'error');
                            } else if (response == 3) {
                                swal('Solicitud no procesada', 'Este cliente no posee contacto de facturación', 'error');
                            }else {
                                swal('Solicitud no procesada', 'Ha ocurrido un error, intente nuevamente por favor', 'error');
                            }
                        }, 1000);
                    },
                    error: function () {
                        swal('Solicitud no procesada', 'Ha ocurrido un error, intente nuevamente por favor', 'error');
                    }
                });
            }
        });
    });
});