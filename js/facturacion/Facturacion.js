$(document).ready(function() {

    ModalTable = $('#ModalTable').DataTable({
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

    //CONFIGURACION DEL SELECTPICKER, DATETIMEPICKER Y DATA-MASK

    $('.selectpicker').selectpicker();
    $('.date').datetimepicker({
        locale: 'es',
        format: 'YYYY-MM-DD',
        defaultDate: new Date()
    });
    $(".number").mask("0000000000");

    var totalFacturas;
    var cantidadFacturas;
    var totalBoletas;
    var cantidadBoletas;
    getTotales()
    getTables()

    function formatcurrency(n) {
        return n.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    }
    $.ajax({
        type: "POST",
        url: "../includes/facturacion/uf/getValue.php",
        success: function(response) {
            $('.ValorUF').text(response)
        }
    });

    function getTotales() {
        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/getTotalesInstalacion.php",
            success: function(response) {
                totalFacturas = response.totalFacturas
                cantidadFacturas = response.cantidadFacturas
                totalBoletas = response.totalBoletas
                cantidadBoletas = response.cantidadBoletas
                $('#totalFacturasInstalacion').text(formatcurrency(totalFacturas))
                $('#cantidadFacturasInstalacion').text(cantidadFacturas)
                $('#totalBoletasInstalacion').text(formatcurrency(totalBoletas))
                $('#cantidadBoletasInstalacion').text(cantidadBoletas)
            }
        });

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/getTotalesLote.php",
            success: function(response) {
                totalFacturas = response.totalFacturas
                cantidadFacturas = response.cantidadFacturas
                totalBoletas = response.totalBoletas
                cantidadBoletas = response.cantidadBoletas
                $('#totalFacturasLote').text(formatcurrency(totalFacturas))
                $('#cantidadFacturasLote').text(cantidadFacturas)
                $('#totalBoletasLote').text(formatcurrency(totalBoletas))
                $('#cantidadBoletasLote').text(cantidadBoletas)
            }
        });

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/getTotalesIndividual.php",
            success: function(response) {
                totalFacturas = response.totalFacturas
                cantidadFacturas = response.cantidadFacturas
                totalBoletas = response.totalBoletas
                cantidadBoletas = response.cantidadBoletas
                $('#totalFacturasIndividual').text(formatcurrency(totalFacturas))
                $('#cantidadFacturasIndividual').text(cantidadFacturas)
                $('#totalBoletasIndividual').text(formatcurrency(totalBoletas))
                $('#cantidadBoletasIndividual').text(cantidadBoletas)
            }
        });
    }

    function getTables() {

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/showInstalaciones.php",
            success: function(response) {

                InstalacionTable = $('#InstalacionTable').DataTable({
                    order: [
                        [1, 'desc']
                    ],
                    data: response.array,
                    columns: [
                        { data: 'TipoDocumento' },
                        { data: 'Cliente' },
                        { data: 'Rut' },
                        { data: 'NombreGrupo' },
                        { data: 'Valor' },
                        { data: 'Tipo' },
                    ],
                    destroy: true,
                    'createdRow': function(row, data, dataIndex) {
                        $(row)
                            .attr('rutid', data.Id)
                            .attr('grupo', data.Grupo)
                            .attr('tipo', 3)
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
                                Icono = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-file-pdf-o Prefactura" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i>'
                                Icono += '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye VisualizarInstalacion" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i>'
                                Icono += '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-money Facturar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Facturar" title="" data-container="body"></i>'
                                return "<div style='text-align: center'>" + Icono + "</div>";
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
            }
        });

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/showLotes.php",
            success: function(response) {

                LoteTable = $('#LoteTable').DataTable({
                    order: [
                        [2, 'desc']
                    ],
                    "columnDefs": [{
                        "targets": [0],
                        "orderable": false
                    }],
                    data: response.array,
                    columns: [
                        { data: 'Id' },
                        { data: 'TipoDocumento' },
                        { data: 'Cliente' },
                        { data: 'Rut' },
                        { data: 'NombreGrupo' },
                        { data: 'Valor' },
                        { data: 'EstatusFacturacion' }
                    ],
                    destroy: true,
                    'createdRow': function(row, data, dataIndex) {
                        $(row)
                            .attr('rutid', data.Id)
                            .attr('grupo', data.Grupo)
                            .attr('tipo', 2)
                            .addClass('text-center')
                    },
                    "columnDefs": [{
                            "targets": 0,
                            "render": function(data, type, row) {
                                if(row.PermitirFactura == 1){
                                    Check = '<input name="select_check" id="select_check_' + data + '" type="checkbox" />'
                                }else{
                                    Check = ''
                                }
                                return "<div style='text-align: center'>" + Check + "</div>";
                            }
                        },
                        {
                            "targets": 5,
                            "render": function(data, type, row) {
                                value = formatcurrency(data)
                                return "<div style='text-align: center'>" + value + "</div>";
                            }
                        },
                        {
                            "targets": 6,
                            "render": function(data, type, row) {
                                Icono = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-file-pdf-o Prefactura" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i>'
                                Icono += '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye VisualizarLote" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i>'
                                Icono += '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-list-alt OC" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Agregar Orden de Compra" title="" data-container="body"></i>'
                                if(row.PermitirFactura == 1){
                                    Icono += '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-money Facturar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Facturar" title="" data-container="body"></i>'
                                }
                                return "<div style='text-align: center'>" + Icono + "</div>";
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
            }
        });

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/showIndividuales.php",
            success: function(response) {

                IndividualTable = $('#IndividualTable').DataTable({
                    order: [
                        [1, 'desc']
                    ],
                    "columnDefs": [{
                        "targets": [0],
                        "orderable": false
                    }],
                    data: response.array,
                    columns: [
                        { data: 'TipoDocumento' },
                        { data: 'Cliente' },
                        { data: 'Rut' },
                        { data: 'NombreGrupo' },
                        { data: 'Valor' },
                        { data: 'EstatusFacturacion' }
                    ],
                    destroy: true,
                    'createdRow': function(row, data, dataIndex) {
                        $(row)
                            .attr('rutid', data.Id)
                            .attr('grupo', data.Grupo)
                            .attr('tipo', 1)
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
                                Icono = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-file-pdf-o Prefactura" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i>'
                                Icono += '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye VisualizarIndividual" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Ver Detalles" title="" data-container="body"></i>'
                                Icono += '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-money Facturar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Facturar" title="" data-container="body"></i>'
                                return "<div style='text-align: center'>" + Icono + "</div>";
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
            }
        });
        setTimeout(() => {
            $('[data-toggle="popover"]').popover();
        }, 1000);
        $('body').addClass('loaded');
        $('table').css('width', '100%');
    }

    $('body').on('click', '.Facturar', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectRutId = ObjectTR.attr("rutid");
        var ObjectGroup = ObjectTR.attr("grupo");
        var ObjectType = ObjectTR.attr("tipo");

        swal({
            title: "Deseas facturar este registro?",
            text: "Confirmar facturación!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Facturar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: "../includes/facturacion/facturas/storeFactura.php",
                    data: "rutid=" + ObjectRutId + "&grupo=" + ObjectGroup + "&tipo=" + ObjectType,
                    success: function(response) {

                        if (response.status == 1) {
                            if (ObjectType == 1) {
                                IndividualTable.row($(ObjectTR))
                                    .remove()
                                    .draw();
                            } else if (ObjectType == 2) {
                                LoteTable.row($(ObjectTR))
                                    .remove()
                                    .draw();
                            } else {
                                InstalacionTable.row($(ObjectTR))
                                    .remove()
                                    .draw();
                            }
                            getTotales();
                            $('[data-toggle="popover"]').popover();
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
                    error: function(xhr, status, error) {
                        setTimeout(function() {
                            var err = JSON.parse(xhr.responseText);
                            swal('Solicitud no procesada', err.Message, 'error');
                        }, 1000);
                    }
                });
            }
        });
    });

    $('body').on('click', '.VisualizarInstalacion', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectRutId = ObjectTR.attr("rutid");

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/showInstalacion.php",
            data: "id=" + ObjectRutId,
            success: function(response) {

                ModalTable.clear().draw()

                $.each(response.array, function(index, array) {
                    var rowNode = ModalTable.row.add([
                        '' + array.Codigo + '',
                        '' + array.Nombre + '',
                        '' + formatcurrency(array.Valor) + '',
                    ]).draw(false).node();

                    $(rowNode)
                        .addClass('text-center')
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

    $('body').on('click', '.VisualizarLote', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectRutId = ObjectTR.attr("rutid");
        var ObjectGroup = ObjectTR.attr("grupo");

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/showLote.php",
            data: "rut=" + ObjectRutId + "&grupo=" + ObjectGroup,
            success: function(response) {

                ModalTable.clear().draw()

                $.each(response.array, function(index, array) {
                    var rowNode = ModalTable.row.add([
                        '' + array.Codigo + '',
                        '' + array.Concepto + '',
                        '' + formatcurrency(array.Valor) + '',
                    ]).draw(false).node();

                    $(rowNode)
                        .addClass('text-center')
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

    $('body').on('click', '.VisualizarIndividual', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("rutid");

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/showIndividual.php",
            data: "id=" + ObjectId,
            success: function(response) {

                ModalTable.clear().draw()

                $.each(response.array, function(index, array) {
                    var rowNode = ModalTable.row.add([
                        '' + array.Nombre + '',
                        '' + array.Concepto + '',
                        '' + formatcurrency(array.Valor) + '',
                    ]).draw(false).node();

                    $(rowNode)
                        .addClass('text-center')
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

    function getChecked() {

        var checked = [];

        $('#LoteTable tr').each(function(i, row) {
            var actualrow = $(row);
            checkbox = actualrow.find('input:checked').val();
            if (checkbox == 'on') {
                var id = $(actualrow).attr('rutid');
                var grupo = $(actualrow).attr('grupo');
                checked[i] = id + "-" + grupo;
            }
        });

        return checked;
    }

    $('#select_all').on('click', function() {
        var rows = LoteTable.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);

        values = getChecked();

        if (values.length > 0) {

            $("#Facturar").removeAttr("disabled");
            $("#Facturar").css({
                "opacity": ("1")
            });

        } else {
            $("#Facturar").attr("disabled", "disabled");
            $("#Facturar").css({
                "opacity": ("0.2")
            });
        }
    });

    $('#LoteTable tbody').on('click', 'input[type="checkbox"]', function() {
        values = getChecked();

        if (values.length > 0) {

            $("#Facturar").removeAttr("disabled");
            $("#Facturar").css({
                "opacity": ("1")
            });

        } else {
            $("#Facturar").attr("disabled", "disabled");
            $("#Facturar").css({
                "opacity": ("0.2")
            });
        }
    });

    $('body').on('click', '#Facturar', function() {

        Facturas = getChecked();

        swal({
            title: "Deseas facturar este registro?",
            text: "Confirmar facturación!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Facturar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(isConfirm) {
            if (isConfirm) {

                $.ajax({
                    type: "POST",
                    url: "../includes/facturacion/facturas/storeFacturaPorLote.php",
                    data: "facturas=" + Facturas,
                    success: function(response) {

                        if (response.status == 1) {

                            facturas = response.Facturas

                            $.each(facturas, function(index, factura) {

                                Rut = factura.Rut
                                Grupo = factura.Grupo
                                UrlPdf = factura.UrlPdf

                                Row = $('#LoteTable tbody').find('tr[rutid="' + Rut + '"][grupo="' + Grupo + '"]');
                                LoteTable.row($(Row))
                                    .remove()
                                    .draw();

                            });

                            $('[data-toggle="popover"]').popover();
                            getTotales();
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
                    error: function(xhr, status, error) {
                        setTimeout(function() {
                            var err = JSON.parse(xhr.responseText);
                            swal('Solicitud no procesada', err.Message, 'error');
                        }, 1000);
                    }
                });
            }
        });
    });
    $("#TipoLote").on('change', function() {
        var Tipo = $(this).val();
        LoteTable
            .columns(1)
            .search(Tipo)
            .draw();
    });
    $("#TipoIndividual").on('change', function() {
        var Tipo = $(this).val();
        IndividualTable
            .columns(0)
            .search(Tipo)
            .draw();
    });
    $("#TipoInstalacion").on('change', function() {
        var Tipo = $(this).val();
        InstalacionTable
            .columns(0)
            .search(Tipo)
            .draw();
    });
    $('body').on('click', '.OC', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectRutId = ObjectTR.attr("rutid");
        var ObjectGroup = ObjectTR.attr("grupo");
        var ObjectType = ObjectTR.attr("tipo");

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/getOC.php",
            data: "rutid=" + ObjectRutId + "&grupo=" + ObjectGroup + "&tipo=" + ObjectType,
            success: function(response) {
                $('#NumeroOC').val(response.NumeroOC)
                $('#FechaOC').val(response.FechaOC)
                $('#rutidOC').val(ObjectRutId)
                $('#grupoOC').val(ObjectGroup)
                $('#tipoOC').val(ObjectType)
                $('#modalOC').modal('show')
            },
            error: function(xhr, status, error) {
                setTimeout(function() {
                    var err = JSON.parse(xhr.responseText);
                    swal('Solicitud no procesada', err.Message, 'error');
                }, 1000);
            }
        });
    });
    $(document).on('click', '#guardarOC', function() {

        $.postFormValues('../includes/facturacion/facturas/storeOC.php', '#storeOC', function(response) {

            if (response) {

                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Guardado Exitosamente',
                    container: 'floating',
                    timer: 3000
                });
                $('.modal').modal('hide');
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
    $('body').on('click', '.Prefactura', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectRutId = ObjectTR.attr("rutid");
        var ObjectGroup = ObjectTR.attr("grupo");
        var ObjectType = ObjectTR.attr("tipo");

        swal({
            title: "Deseas visualizar como quedara la factura?",
            text: "Confirmar visualización!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Visualizar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: "../includes/facturacion/facturas/showPrefactura.php",
                    data: "rutid=" + ObjectRutId + "&grupo=" + ObjectGroup + "&tipo=" + ObjectType,
                    success: function(response) {

                        if (response.status == 1) {
                            url = "prefacturas/" + response.NombrePdf + ".pdf";
                            window.open(url, '_blank');
                            swal.close();

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
                    error: function(xhr, status, error) {
                        setTimeout(function() {
                            var err = JSON.parse(xhr.responseText);
                            swal('Solicitud no procesada', err.Message, 'error');
                        }, 1000);
                    }
                });
            }
        });
    });
});