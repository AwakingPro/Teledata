$(document).ready(function() {


    // $('#TableDocEmitidos').DataTable();
    // $('#TableDocPagados').DataTable();

    getDocEmitidos();
    // getDocPagados();

    function getDocEmitidos() {
        console.log($('input[name="rutCliente"]').val());
        $.post('../includes/facturacion/facturas/filtrarResumenCliente.php', { Rut: $('input[name="rutCliente"]').val() }, function(data) {
            TableDocEmitidos = $('#TableDocEmitidos').DataTable({
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
                    { data: 'deuda' },
                    { data: 'pagos' },
                    // { data: 'FechaVencimiento' },
                    // { data: 'TotalFactura' },
                    // { data: 'TotalSaldo' },
                    // { data: 'DocumentoId' }
                ],
                destroy: true,
                'createdRow': function(row, data, dataIndex) {
                    $(row)
                        .attr('id', data.id_factura)
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
    }

    function getDocPagados() {
        $.post('../includes/facturacion/facturas/filtrarResumenCliente.php', { Rut: $('input[name="rutCliente"]').val() }, function(data) {
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
                    { data: 'TotalFactura' },
                    { data: 'TotalSaldo' },
                    // { data: 'DocumentoId' }
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
                    // {
                    //     "targets": 6,
                    //     "render": function(data, type, row) {
                    //         if (row.EstatusFacturacion == '1') {
                    //             Folder = 'facturas';
                    //             if (row.Acciones == 1) {
                    //                 Devolucion = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-undo Devolucion" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Generar Nota de Crédito" title="" data-container="body"></i>'
                    //                 if (row.TotalSaldo != '0') {
                    //                     Abonar = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-plus Abonar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Abonar" title="" data-container="body"></i>'
                    //                 } else {
                    //                     Abonar = ''
                    //                 }
                    //                 if (row.TotalFactura != row.TotalSaldo) {
                    //                     Pagos = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-copy mostrarPagos" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Ver Pagos" title="" data-container="body"></i>'
                    //                 } else {
                    //                     Pagos = ''
                    //                 }
                    //             } else {
                    //                 Devolucion = ''
                    //                 Abonar = ''
                    //                 Pagos = ''
                    //             }
                    //             Anulacion = '';
                    //         } else if (row.EstatusFacturacion == 2) {
                    //             Folder = 'notas_credito';
                    //             Devolucion = ''
                    //             Abonar = ''
                    //             Pagos = ''
                    //             if (row.Acciones == 1) {
                    //                 Anulacion = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times-circle Anulacion" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Generar Nota de Debito" title="" data-container="body"></i>'
                    //             } else {
                    //                 Anulacion = ''
                    //             }
                    //         } else {
                    //             Folder = 'notas_debito';
                    //             Devolucion = ''
                    //             Abonar = ''
                    //             Pagos = ''
                    //             Anulacion = ''
                    //         }
                    //         if (data != '') {
                    //             Pdf = '<a href="../facturacion/' + Folder + '/' + data + '.pdf" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>';
                    //         } else {
                    //             Pdf = '';
                    //         }
                    //         return "<div style='text-align: center'>" + Devolucion + " " + Anulacion + " " + Abonar + " " + Pagos + " " + Pdf + "</div>";
                    //     }
                    // },
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

    function formatcurrency(n) {
        return n.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    }

});