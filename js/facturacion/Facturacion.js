$(document).ready(function() {
    IdUsuarioSession = $('#IdUsuarioSession').val()
    
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
    function getTotales() {
        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/getTotalesInstalacion.php",
            beforeSend: function( ) {
                $('#totalFacturasInstalacion').html('<div class="spinner loading-min"></div>');
                $('#cantidadFacturasInstalacion').html('<div class="spinner loading-min"></div>');
                $('#totalBoletasInstalacion').html('<div class="spinner loading-min"></div>');
                $('#cantidadBoletasInstalacion').html('<div class="spinner loading-min"></div>');
              },
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
            url: "../includes/facturacion/facturas/getTotalesIndividual.php",
            beforeSend: function( ) {
                $('#totalFacturasIndividual').html('<div class="spinner loading-min"></div>');
                $('#cantidadFacturasIndividual').html('<div class="spinner loading-min"></div>');
                $('#totalBoletasIndividual').html('<div class="spinner loading-min"></div>');
                $('#cantidadBoletasIndividual').html('<div class="spinner loading-min"></div>');
              },
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
        
        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/getTotalesLote.php",
            beforeSend: function( ) {
                $('#totalFacturasLote').html('<div class="spinner loading-min"></div>');
                $('#cantidadFacturasLote').html('<div class="spinner loading-min"></div>');
                $('#totalBoletasLote').html('<div class="spinner loading-min"></div>');
                $('#cantidadBoletasLote').html('<div class="spinner loading-min"></div>');
              },
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
    }
    function getLotes(){
        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/showLotes.php",
            beforeSend: function( ) {
                $('.LoteTableLoader').html('<tr class="odd"><td valign="top" colspan="12" class="dataTables_empty"><div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div></td></tr>');
              },
            success: function(response) {
                $('.LoteTableLoader').html('');
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
                            .attr('DocumentoIdBsale', data.DocumentoIdBsale)
                            .addClass('text-center')
                    },
                    "columnDefs": [{
                            "targets": 0,
                            "render": function(data, type, row) {
                                if(row.PermitirFactura == 1){
                                    Check = '<input name="select_check" id="select_check_' + data + '" type="checkbox" />';
                                    Icono = '';
                                }else{
                                    Check = '';
                                    Icono = '<i title="Prefacturación servicios mensuales" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-newspaper-o Prefacturacion" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Descargar excel prefacturación" title="" data-container="body"></i>';
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
                                Icono += '<i title="Ver en PDF" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-file-pdf-o Prefactura" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Previsualiza como quedará la factura en PDF" title="Previsualiza como quedara la factura en PDF" data-container="body"></i>'
                                Icono += '<i title="Detalles servicios" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye VisualizarLote" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Ver Detalles" title="" data-container="body"></i>'
                                Icono += '<i title="Orden de compra" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-list-alt OC" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Agregar Orden de Compra" title="" data-container="body"></i>'
                                Icono += '<i title="Referencia" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-info-circle Referencia" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Agregar Referencia" title="" data-container="body"></i>'
                                if(row.PermitirFactura == 1){
                                    //temporal
                                    //comentar el prop y sustituir el not-allowed por pointer de Facturar luego de que se puedan enviar correos 
                                    // $('.VisualizarLote').prop('disabled', true);
                                    // $('.Facturar').prop('disabled', true);
                                    // $('.fa-list-alt').prop('disabled', true);
                                    // $('.Prefacturacion').prop('disabled', true);
                                    // $('.Prefactura').prop('disabled', true);
                                    // $('.Eliminar').prop('disabled', true);
                                    // $('.Referencia').prop('disabled', true);

                                    Icono += '<i title="Facturar" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-money Facturar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Facturar hacia la API de Bsale" title="" data-container="body"></i>'
                                }
                                if(IdUsuarioSession == 109 || IdUsuarioSession == 116 || IdUsuarioSession == 104){
                                    Icono += '<i title="Eliminar" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-trash Eliminar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Eliminar la factura" title="" data-container="body"></i>'
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
        }).done(function( data ) {
            setTimeout(() => {
                $('[data-toggle="popover"]').popover();
            }, 1000);
            $('body').addClass('loaded');
            $('table').css('width', '100%');
          });
    }
    function getInstalaciones(){
        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/showInstalaciones.php",
            beforeSend: function( ) {
                $('.InstalacionTableLoader').html('<tr class="odd"><td valign="top" colspan="12" class="dataTables_empty"><div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div></td></tr>');
              },
            success: function(response) {
                $('.InstalacionTableLoader').html('');
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
                                Icono = '<i title="Ver en PDF" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-file-pdf-o Prefactura" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar"  data-container="body"></i>'
                                Icono += '<i title="Detalles servicio" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye VisualizarInstalacion" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar"  data-container="body"></i>'
                                //temporal
                                //comentar el prop y sustituir el not-allowed por pointer de Facturar luego de que se puedan enviar correos 
                                // $('.Facturar').prop('disabled', true);
                                Icono += '<i title="Facturar" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-money Facturar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Facturar"  data-container="body"></i>'
                                if(IdUsuarioSession == 109 || IdUsuarioSession == 116 || IdUsuarioSession == 104){
                                    Icono += '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-trash Eliminar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Eliminar"  data-container="body"></i>'
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
        }).done(function( data ) {
            setTimeout(() => {
                $('[data-toggle="popover"]').popover();
            }, 1000);
            $('body').addClass('loaded');
            $('table').css('width', '100%');
          });
    }
    function getIndividuales(){
        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/showIndividuales.php",
            beforeSend: function( ) {
                $('.IndividualTableLoader').html('<tr class="odd"><td valign="top" colspan="12" class="dataTables_empty"><div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div></td></tr>');
              },
            success: function(response) {
                $('.IndividualTableLoader').html('');
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
                                Icono += '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-list-alt OC" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Agregar Orden de Compra" title="" data-container="body"></i>'
                                Icono += '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-info-circle Referencia" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Agregar Referencia" title="" data-container="body"></i>'
                                //temporal
                                //comentar el prop y sustituir el not-allowed por pointer de Facturar luego de que se puedan enviar correos 
                                // $('.Facturar').prop('disabled', true);
                                Icono += '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-money Facturar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Facturar" title="" data-container="body"></i>'
                                if(IdUsuarioSession == 109 || IdUsuarioSession == 116 || IdUsuarioSession == 104){
                                    Icono += '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-trash Eliminar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Eliminar" title="" data-container="body"></i>'
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
        }).done(function( data ) {
            setTimeout(() => {
                $('[data-toggle="popover"]').popover();
            }, 1000);
            $('body').addClass('loaded');
            $('table').css('width', '100%');
          });
    }
    function getTables() {
        getLotes();
        getIndividuales();
        getInstalaciones();
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
        console.log('Rut'+ObjectRutId+' Grupo'+ObjectGroup+' Tipo'+ObjectType);
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
        $('#modalDetalleShow').modal('show')
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectRutId = ObjectTR.attr("rutid");

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/showInstalacion.php",
            beforeSend: function( ) {
                $('.ModalTableBody').html('<tr class="odd"><td valign="top" colspan="12" class="dataTables_empty"><div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div></td></tr>');
              },
            data: "id=" + ObjectRutId,
            success: function(response) {
                $('.ModalTableBody').html('');
                ModalTable.clear().draw()

                $.each(response.array, function(index, array) {
                    var StyleEliminarDetalle;
                    var desabilitar;
                    var EliminarDetalle;
                    if(!array.detalleIdBsale && array.totalDetalles > 1){
                        StyleEliminarDetalle = 'style="cursor: pointer; margin: 0 10px; font-size:15px;" ';
                        desabilitar = '';
                        EliminarDetalle = 'EliminarDetalle';
                    }else{
                        StyleEliminarDetalle = 'style="cursor: not-allowed;  margin: 0 10px; font-size:15px; opacity: 0.2; "';
                        desabilitar = 'disabled';
                        EliminarDetalle = '';
                    }
                    var rowNode = ModalTable.row.add([
                        '' + array.Codigo + '',
                        '' + array.Nombre + '',
                        '' + formatcurrency(array.Valor) + '',
                        '' + '<i  id='+array.detalleId+' '+StyleEliminarDetalle+' '+desabilitar+' tipo='+3+' facturaId='+array.facturaId+' class="fa fa-trash '+EliminarDetalle+'" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Eliminar"  data-container="body"></i>' + ''
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

    $('body').on('click', '.fa-newspaper-o', function() {
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
         // globalObjectTRLote para usarla al eliminar un detalle
        // globalObjectTRLote = ObjectTR;
        var ObjectRutId = ObjectTR.attr("rutid");
        var ObjectGroup = ObjectTR.attr("grupo");
        var url = '';
        url = "../ajax/informes/prefacturacion.php?rut="+ObjectRutId+"&grupo="+ObjectGroup;
        window.open(url, '_blank');

    });
    
    $('body').on('click', '.VisualizarLote', function() {
        $('#modalDetalleShow').modal('show')
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
         // globalObjectTRLote para usarla al eliminar un detalle
        // globalObjectTRLote = ObjectTR;
        var ObjectRutId = ObjectTR.attr("rutid");
        var ObjectGroup = ObjectTR.attr("grupo");

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/showLote.php",
            beforeSend: function( ) {
                $('.ModalTableBody').html('<tr class="odd"><td valign="top" colspan="12" class="dataTables_empty"><div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div></td></tr>');
              },
            data: "rut=" + ObjectRutId + "&grupo=" + ObjectGroup,
            success: function(response) {
            $('.ModalTableBody').html('');
            ModalTable.clear().draw()
                $.each(response.array, function(index, array) {
                    
                    var StyleUndoServicio = 'style="cursor: pointer; margin: 0 10px; font-size:15px;" ';
                    var UndoServicio = '';

                    var StyleEliminarDetalle;
                    var desabilitar;
                    var EliminarDetalle;
                    if(!array.detalleIdBsale && array.totalDetalles > 1){
                        StyleEliminarDetalle = 'style="cursor: pointer; margin: 0 10px; font-size:15px;" ';
                        desabilitar = '';
                        EliminarDetalle = 'EliminarDetalle';
                    }else{
                        StyleEliminarDetalle = 'style="cursor: not-allowed;  margin: 0 10px; font-size:15px; opacity: 0.2; "';
                        desabilitar = 'disabled';
                        EliminarDetalle = '';
                    }
                    var rowNode = ModalTable.row.add([
                        '' + array.Codigo + '',
                        '' + array.Concepto + '',
                        '' + formatcurrency(array.Valor) + '',
                        '' + '<i  id='+array.detalleId+' '+StyleEliminarDetalle+' '+desabilitar+' tipo='+2+' facturaId='+array.facturaId+' class="fa fa-trash '+EliminarDetalle+'" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Eliminar"  data-container="body"></i>' + 
                             '<i  id='+array.idServicio+' '+StyleUndoServicio+' '+' tipo='+2+' facturaId='+array.facturaId+' class="fa fa-undo '+UndoServicio+'" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Eliminar"  data-container="body"></i>' + ''
                        
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
        $('#modalDetalleShow').modal('show')
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("rutid");

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/showIndividual.php",
            beforeSend: function( ) {
                $('.ModalTableBody').html('<tr class="odd"><td valign="top" colspan="12" class="dataTables_empty"><div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div></td></tr>');
              },
            data: "id=" + ObjectId,
            success: function(response) {
                $('.ModalTableBody').html('');
                ModalTable.clear().draw()
                $.each(response.array, function(index, array) {
                    var StyleEliminarDetalle;
                    var desabilitar;
                    var EliminarDetalle;
                    if(!array.detalleIdBsale && array.totalDetalles > 1){
                        StyleEliminarDetalle = 'style="cursor: pointer; margin: 0 10px; font-size:15px;" ';
                        desabilitar = '';
                        EliminarDetalle = 'EliminarDetalle';
                    }else{
                        StyleEliminarDetalle = 'style="cursor: not-allowed;  margin: 0 10px; font-size:15px; opacity: 0.2; "';
                        desabilitar = 'disabled';
                        EliminarDetalle = '';
                    }
                    var rowNode = ModalTable.row.add([
                        '' + array.Nombre + '',
                        '' + array.Concepto + '',
                        '' + formatcurrency(array.Valor) + '',
                        '' + '<i  id='+array.detalleId+' '+StyleEliminarDetalle+' '+desabilitar+' tipo='+1+' facturaId='+array.facturaId+' class="fa fa-trash '+EliminarDetalle+'" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Eliminar"  data-container="body"></i>' + ''
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
            //descomentar luego de que funcione el envio de correo
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
        // console.log(Facturas); return;
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

        $.postFormValues('../includes/facturacion/facturas/storeOC.php', '#storeOC', {}, function(response) {

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
                            // url = "prefacturas/" + response.NombrePdf + ".pdf";
                            url = response.NombrePdf;
                            window.open(url, '_blank');
                            swal.close();

                        } else if (response.status == 2) {
                            swal('Solicitud no procesada', 'Debes ingresar el valor UF del mes en curso', 'error');
                        } else if (response.status == 3) {
                            swal('Solicitud no procesada', 'El servicio no existe, por favor actualizar la pagina', 'error');
                        } else if (response.status == 4) {
                            swal('Solicitud no procesada', 'El cliente no existe, por favor actualizar la pagina', 'error');
                        }else if (response.status == 5) {
                            swal('Solicitud no procesada', response.Message, 'error');
                        }else if (response.status == 99) {
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
    $('body').on('click', '.Referencia', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectRutId = ObjectTR.attr("rutid");
        var ObjectGroup = ObjectTR.attr("grupo");
        var ObjectType = ObjectTR.attr("tipo");

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/getReferencia.php",
            data: "rutid=" + ObjectRutId + "&grupo=" + ObjectGroup + "&tipo=" + ObjectType,
            success: function(response) {
                $('#Referencia').val(response.Referencia)
                $('#rutidReferencia').val(ObjectRutId)
                $('#grupoReferencia').val(ObjectGroup)
                $('#tipoReferencia').val(ObjectType)
                $('#modalReferencia').modal('show')
            },
            error: function(xhr, status, error) {
                setTimeout(function() {
                    var err = JSON.parse(xhr.responseText);
                    swal('Solicitud no procesada', err.Message, 'error');
                }, 1000);
            }
        });
    });
    $(document).on('click', '#guardarReferencia', function() {

        $.postFormValues('../includes/facturacion/facturas/storeReferencia.php', '#storeReferencia', {}, function(response) {

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
    $('body').on('click', '.fa-undo', function() {
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectidServicio = $(this).attr("id");
        var idFactura = $(this).attr("facturaId");
        // var ObjectGroup = ObjectTR.attr("grupo");
        var ObjectType = $(this).attr("tipo");
        console.log(' ID Servicio'+ObjectidServicio);
        console.log('TIpo '+ ObjectType);
        console.log('row del detalle '+ObjectTR);

        swal({
            title: "Seguro quieres devolver este servicio a proceso de activación?",
            text: "Confirmar!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Devolver a proceso pendientes!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: "../includes/serviciosControlador/devolverTareaServicioControlador.php",
                    data: "idServicio=" + ObjectidServicio +"&idFactura="+ idFactura+"&TipoFactura="+ObjectType,
                    success: function(response) {
                        // console.log(response); return;
                        if (response.status == 1) {
                            ModalTable.row($(ObjectTR))
                                    .draw();
                            if (ObjectType == 1) {
                                console.log('tipo es '+ ObjectType)
                                getIndividuales();
                            } 
                            else if (ObjectType == 2) {
                                console.log('tipo es '+ ObjectType)
                                getLotes();
                            } else {
                                console.log('tipo es '+ ObjectType)
                                getInstalaciones();
                            }
                            
                            getTotales();
                            $('[data-toggle="popover"]').popover();
                            swal("Éxito!", "El Servicio ha sido Restituido a procesos pendientes!", "success");

                        }else {
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

    $('body').on('click', '.EliminarDetalle', function() {
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectidDetalle = $(this).attr("id");
        var idFactura = $(this).attr("facturaId");
        // var ObjectGroup = ObjectTR.attr("grupo");
        var ObjectType = $(this).attr("tipo");
        console.log('Detalle ID'+ObjectidDetalle);
        console.log('TIpo '+ ObjectType);
        console.log('row del detalle '+ObjectTR);

        swal({
            title: "Seguro quieres eliminar este registro?",
            text: "Confirmar eliminación!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Eliminar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: "../includes/facturacion/facturas/borrarFacturasDetalle.php",
                    data: "idDetalle=" + ObjectidDetalle +"&idFactura="+ idFactura+"&TipoFactura="+ObjectType,
                    success: function(response) {
                        // console.log(response); return;
                        if (response.status == 1) {
                            ModalTable.row($(ObjectTR))
                                    .remove()
                                    .draw();
                            if (ObjectType == 1) {
                                console.log('tipo es '+ ObjectType)
                                getIndividuales();
                            } 
                            else if (ObjectType == 2) {
                                console.log('tipo es '+ ObjectType)
                                getLotes();
                            } else {
                                console.log('tipo es '+ ObjectType)
                                getInstalaciones();
                            }
                            
                            getTotales();
                            $('[data-toggle="popover"]').popover();
                            swal("Éxito!", "El registro ha sido eliminado!", "success");

                        }else {
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

    $('body').on('click', '.Eliminar', function() {
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectRutId = ObjectTR.attr("rutid");
        var ObjectGroup = ObjectTR.attr("grupo");
        var ObjectType = ObjectTR.attr("tipo");

        swal({
            title: "Deseas eliminar este registro?",
            text: "Confirmar eliminación!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Eliminar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: "../includes/facturacion/facturas/deleteFactura.php",
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
                            swal("Éxito!", "El registro ha sido eliminado!", "success");

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