$(document).ready(function() {


    // $('#TableDocEmitidos').DataTable();
    // $('#TableDocPagados').DataTable();

    getSaldoFavor();
    getDocsVencidos();
    getFacturasExtras();
    getFacturasCliente();
    getDocPagados();
    getServicios();

    //obtiene total de saldo a favor de un cliente por rut
    function getSaldoFavor() { 
        $.post('../includes/facturacion/facturas/getSaldoFavor.php', { Rut: $('input[name="rutCliente"]').val() }, function(data) {
            $('.saldoFavor').text('$ ' + formatcurrency(data['totalSaldoFavor']))
        });
    }

    //obtiene total de documentos vencidos de un cliente por rut
    function getDocsVencidos() {
        $.post('../includes/facturacion/facturas/getDocsVencidos.php', { Rut: $('input[name="rutCliente"]').val() }, function(data) {
            $('.getDocsVencidos').text(data['totalDocumentos']);
            if(data['totalDeuda'] > 0){
                $('.montoAdeudado').css('color','red').text();
            }else{
                $('.montoAdeudado').css('color','#2ab4c0').text();
            }
            $('.montoAdeudado').text('$ '+formatcurrency(data['totalDeuda']));
        });
    }

    $(document).on('click', '.verDocVencidos', function() {
        
        $('#ModalDocVencidos').modal('show');
        
        $.post('../includes/facturacion/facturas/getDocsVencidos.php', { Rut: $('input[name="rutCliente"]').val() }, function(data) {
            data = data['datos'];
            console.log(data);
            TableDocVencidos = $('#TableDocVencidos').DataTable({
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
                    { data: 'totalDoc' },
                    { data: 'saldo_doc' }
                ],
                destroy: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row)
                        .attr('id', data.id_factura)
                        .addClass('text-center')
                },
                "columnDefs": [{
                    "targets": 4,
                    "render": function(data, type, row) {
                        value = formatcurrency(data)
                        return "<div style='text-align: center'>" + value + "</div>";
                    }
                }, {
                    "targets": 5,
                    "render": function(data, type, row) {
                        value = formatcurrency(data)
                        return "<div style='text-align: center'>" + value + "</div>";
                    }
                }],
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
    });

    $(document).on('click', '.eye-FinContrato', function() {
        $('#ModalverSercFinContrato').modal('show');
        
        $.post('../includes/facturacion/facturas/getServiciosFinContrato.php', { Rut: $('input[name="rutCliente"]').val() }, function(data) {
            TableSerFinContrato = $('#TableSerFinContrato').DataTable({
                order: [
                    [0, 'desc']
                ],
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false
                }],
                data: data,
                columns: [
                    { data: 'Codigo' },
                    { data: 'Conexion' },
                    { data: 'Valor' },
                    { data: 'FechaInstalacion' },
                    { data: 'Tipo' },
                    // { data: 'Acciones' }
                ],
                destroy: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row)
                        .attr('id', data.Id)
                        .addClass('text-center')
                },
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
    });

    $(document).on('click', '.eye-Temporal', function() {
        $('#ModalverSercTemporal').modal('show');
        
        $.post('../includes/facturacion/facturas/getServiciosTemporales.php', { Rut: $('input[name="rutCliente"]').val() }, function(data) {
            TableSerTemporal = $('#TableSerTemporal').DataTable({
                order: [
                    [0, 'desc']
                ],
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false
                }],
                data: data,
                columns: [
                    { data: 'Codigo' },
                    { data: 'Conexion' },
                    { data: 'Valor' },
                    { data: 'FechaInstalacion' },
                    { data: 'Tipo' },
                    // { data: 'Acciones' }
                ],
                destroy: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row)
                        .attr('id', data.Id)
                        .addClass('text-center')
                },
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
    });

    $(document).on('click', '.eye-cambioRazonSocial', function() {
        $('#ModalverSercCambioRazonSocial').modal('show');
        
        $.post('../includes/facturacion/facturas/getServiciosCambioRazonSocial.php', { Rut: $('input[name="rutCliente"]').val() }, function(data) {
            TableSerCambioRazonSocial = $('#TableSerCambioRazonSocial').DataTable({
                order: [
                    [0, 'desc']
                ],
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false
                }],
                data: data,
                columns: [
                    { data: 'Codigo' },
                    { data: 'Conexion' },
                    { data: 'Valor' },
                    { data: 'FechaInstalacion' },
                    { data: 'Tipo' },
                    // { data: 'Acciones' }
                ],
                destroy: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row)
                        .attr('id', data.Id)
                        .addClass('text-center')
                },
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
    });

    $(document).on('click', '.eye-corteComercial', function() {
        $('#ModalverSercCorteComercial').modal('show');
        
        $.post('../includes/facturacion/facturas/getServiciosCorteComercial.php', { Rut: $('input[name="rutCliente"]').val() }, function(data) {
            TableSerCorteComercial = $('#TableSerCorteComercial').DataTable({
                order: [
                    [0, 'desc']
                ],
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false
                }],
                data: data,
                columns: [
                    { data: 'Codigo' },
                    { data: 'Conexion' },
                    { data: 'Valor' },
                    { data: 'FechaInstalacion' },
                    { data: 'Tipo' },
                    // { data: 'Acciones' }
                ],
                destroy: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row)
                        .attr('id', data.Id)
                        .addClass('text-center')
                },
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
    });

    // ver servicios suspendidos
    $(document).on('click', '.eye-suspendidos', function() {
        $('#ModalverSercSuspendidos').modal('show');
        
        $.post('../includes/facturacion/facturas/getServiciosSuspendidos.php', { Rut: $('input[name="rutCliente"]').val() }, function(data) {
            TableSerSuspendidos = $('#TableSerSuspendidos').DataTable({
                order: [
                    [0, 'desc']
                ],
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false
                }],
                data: data,
                columns: [
                    { data: 'Codigo' },
                    { data: 'Conexion' },
                    { data: 'Valor' },
                    { data: 'FechaInstalacion' },
                    { data: 'Tipo' },
                    // { data: 'Acciones' }
                ],
                destroy: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row)
                        .attr('id', data.Id)
                        .addClass('text-center')
                },
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
    });

    $(document).on('click', '.eye-activos', function() {
        $('#ModalverSercActivos').modal('show');
       
        $.post('../includes/facturacion/facturas/getServiciosActivos.php', { Rut: $('input[name="rutCliente"]').val() }, function(data) {
            TableSerActivos = $('#TableSerActivos').DataTable({
                order: [
                    [0, 'desc']
                ],
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false
                }],
                data: data,
                columns: [
                    { data: 'Codigo' },
                    { data: 'Conexion' },
                    { data: 'Valor' },
                    { data: 'FechaInstalacion' },
                    { data: 'Tipo' },
                    // { data: 'Acciones' }
                ],
                destroy: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row)
                        .attr('id', data.Id)
                        .addClass('text-center')
                },
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
    });

    function getServicios() {
        $.post('../includes/facturacion/facturas/getServicios.php', { Rut: $('input[name="rutCliente"]').val() }, function(data) {
            console.log(data);
            $('.servicios-activos').html(data[0].activos);
            $('.servicios-suspendidos').html(data[0].suspendido);
            $('.servicios-corteComercial').html(data[0].corteComercial);
            $('.servicios-cambioRazonSocial').html(data[0].cambioRazonSocial);
            $('.servicios-Temporal').html(data[0].servicioTemporal);
            $('.servicios-FinContrato').html(data[0].finContrato);
            $('.servicios-error').html(data[0].error);
        });
    }

    //listar por clientes - rut todos sus documentos emitidos sin servicios para la tabla de ventas extras
    function getFacturasExtras() {
        
        $.post('../includes/facturacion/facturas/filtrarDocsExtras.php', { Rut: $('input[name="rutCliente"]').val() }, function(data) {
            FacturasExtrasTableCliente = $('#FacturasExtrasTableCliente').DataTable({
                order: [
                    [2, 'asc']
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
                    { data: 'TotalSaldo' },
                    { data: 'SaldoFavor'}
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
                        "targets": 6,
                        "render": function(data, type, row) {
                            value = formatcurrency(data)
                            return "<div style='text-align: center'>" + value + "</div>";
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

    //listar por clientes - rut todos sus documentos, para la tabla de ultimos docs emitidos
    function getFacturasCliente() {
        
        $.post('../includes/facturacion/facturas/filtrarFacturas.php', { Rut: $('input[name="rutCliente"]').val() }, function(data) {
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
                    { data: 'NumeroDocumento' },
                    { data: 'TipoDocumento' },
                    { data: 'FechaFacturacion' },
                    { data: 'FechaVencimiento' },
                    { data: 'TotalFactura' },
                    { data: 'TotalSaldo' },
                    { data: 'SaldoFavor'}
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
                        "targets": [2, 3],
                        "render": function(data, type, row) {
                            FechaFacturacion = moment(data).format('DD-MM-YYYY');
                            return "<td><span style='display: none;'>"+ data + "</span>"+FechaFacturacion+"</td>";
                        }
                    },
                    {
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
                        "targets": 6,
                        "render": function(data, type, row) {
                            value = formatcurrency(data)
                            return "<div style='text-align: center'>" + value + "</div>";
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

    function getDocPagados() {
        $.post('../includes/facturacion/facturas/filtrarDocPagados.php', { Rut: $('input[name="rutCliente"]').val() }, function(data) {
            TableDocPagados = $('#TableDocPagados').DataTable({
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
                    { data: 'pagos' }
                ],
                destroy: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row)
                        .attr('id', data.id_factura)
                        .addClass('text-center')
                },
                "columnDefs": [{
                    "targets": 4,
                    "render": function(data, type, row) {
                        value = formatcurrency(data)
                        return "<div style='text-align: center'>" + value + "</div>";
                    }
                }],
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

    $('.montoAdeudado').text(formatcurrency($('.montoAdeudado').text()))

    function formatcurrency(n) {
        return n.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    }
});