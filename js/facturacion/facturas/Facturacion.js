$(document).ready(function(){

    // LoteTable = $('#LoteTable').DataTable({
    //     "columnDefs": [ {
    //         "targets": [ 0 ],
    //         "orderable": false
    //     } ],
    //     paging: false,
    //     iDisplayLength: 100,
    //     processing: true,
    //     serverSide: false,
    //     bInfo:false,
    //     // bFilter:false,
    //     order: [[1, 'asc']],
    //     language: {
    //         processing:     "Procesando ...",
    //         search:         'Buscar',
    //         lengthMenu:     "Mostrar _MENU_ Registros",
    //         info:           "Mostrando _START_ a _END_ de _TOTAL_ Registros",
    //         infoEmpty:      "Mostrando 0 a 0 de 0 Registros",
    //         infoFiltered:   "(filtrada de _MAX_ registros en total)",
    //         infoPostFix:    "",
    //         loadingRecords: "...",
    //         zeroRecords:    "No se encontraron registros coincidentes",
    //         emptyTable:     "No hay datos disponibles en la tabla",
    //         paginate: {
    //             first:      "Primero",
    //             previous:   "Anterior",
    //             next:       "Siguiente",
    //             last:       "Ultimo"
    //         },
    //         aria: {
    //             sortAscending:  ": habilitado para ordenar la columna en orden ascendente",
    //             sortDescending: ": habilitado para ordenar la columna en orden descendente"
    //         }
    //     }
    // });

    // IndividualTable = $('#IndividualTable').DataTable({
    //     paging: false,
    //     iDisplayLength: 100,
    //     processing: true,
    //     serverSide: false,
    //     bInfo:false,
    //     // bFilter:false,
    //     order: [[0, 'asc']],
    //     language: {
    //         processing:     "Procesando ...",
    //         search:         'Buscar',
    //         lengthMenu:     "Mostrar _MENU_ Registros",
    //         info:           "Mostrando _START_ a _END_ de _TOTAL_ Registros",
    //         infoEmpty:      "Mostrando 0 a 0 de 0 Registros",
    //         infoFiltered:   "(filtrada de _MAX_ registros en total)",
    //         infoPostFix:    "",
    //         loadingRecords: "...",
    //         zeroRecords:    "No se encontraron registros coincidentes",
    //         emptyTable:     "No hay datos disponibles en la tabla",
    //         paginate: {
    //             first:      "Primero",
    //             previous:   "Anterior",
    //             next:       "Siguiente",
    //             last:       "Ultimo"
    //         },
    //         aria: {
    //             sortAscending:  ": habilitado para ordenar la columna en orden ascendente",
    //             sortDescending: ": habilitado para ordenar la columna en orden descendente"
    //         }
    //     }
    // });

    // InstalacionTable = $('#InstalacionTable').DataTable({
    //     paging: false,
    //     iDisplayLength: 100,
    //     processing: true,
    //     serverSide: false,
    //     bInfo:false,
    //     // bFilter:false,
    //     order: [[0, 'asc']],
    //     language: {
    //         processing:     "Procesando ...",
    //         search:         'Buscar',
    //         lengthMenu:     "Mostrar _MENU_ Registros",
    //         info:           "Mostrando _START_ a _END_ de _TOTAL_ Registros",
    //         infoEmpty:      "Mostrando 0 a 0 de 0 Registros",
    //         infoFiltered:   "(filtrada de _MAX_ registros en total)",
    //         infoPostFix:    "",
    //         loadingRecords: "...",
    //         zeroRecords:    "No se encontraron registros coincidentes",
    //         emptyTable:     "No hay datos disponibles en la tabla",
    //         paginate: {
    //             first:      "Primero",
    //             previous:   "Anterior",
    //             next:       "Siguiente",
    //             last:       "Ultimo"
    //         },
    //         aria: {
    //             sortAscending:  ": habilitado para ordenar la columna en orden ascendente",
    //             sortDescending: ": habilitado para ordenar la columna en orden descendente"
    //         }
    //     }
    // });

    ModalTable = $('#ModalTable').DataTable({
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

    //CONFIGURACION DEL SELECTPICKER, DATETIMEPICKER Y DATA-MASK

    $('.selectpicker').selectpicker();
    $('.date').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY',
        defaultDate: new Date()
    });

    $(".number").mask("000.000.000.000",{reverse: true});
    $("#cantidad").mask("000000");
    $("#impuesto").mask("00");

    function formatcurrency(n) {
        return n.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    }
    $.ajax({
        type: "POST",
        url: "../includes/facturacion/uf/getValue.php",
        success: function(response){
            $('.ValorUF').text(response)
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/facturacion/facturas/showServicios.php",
        success: function(response){

            InstalacionTable = $('#InstalacionTable').DataTable({
                order: [[1, 'desc']],
                data: response.array,
                columns: [
                    { data: 'Tipo' },
                    { data: 'FechaFacturacion' },
                    { data: 'Cliente' },
                    { data: 'Rut' },
                    { data: 'Grupo' },
                    { data: 'ValorPesos' },
                    { data: 'Tipo' },
                ],
                destroy: true,
                'createdRow': function( row, data, dataIndex ) {
                    $(row)
                        .attr('rutid',data.Rut)
                        .attr('grupo',data.Grupo)
                        .attr('tipo',3)
                        .addClass('text-center')
                },
                "columnDefs": [
                    {
                        "targets": 0,
                        "render": function (data, type, row) {
                            if(data == 2){
                                Estatus = "<div style='text-align: center'>Pagada</div>"
                            }else{
                                Estatus = "<div style='text-align: center'>Por Pagar</div>"
                            }
                            return Estatus
                        }
                    },
                    {
                        "targets": 6,
                        "render": function (data, type, row) {
                            if(data == 2){
                                Icono = '<a href="'+row.UrlPdfBsale+'" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>'
                            }else{
                                Icono = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye VisualizarServicio" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i>' + '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-money Facturar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Facturar" title="" data-container="body"></i>'
                            }
                            return "<div style='text-align: center'>"+ Icono +"</div>";
                        }
                    },
                ],
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

            $('[data-toggle="popover"]').popover();
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/facturacion/facturas/showFacturas.php",
        success: function(response){

            IndividualTable = $('#IndividualTable').DataTable({
                order: [[1, 'desc']],
                data: response.array,
                columns: [
                    { data: 'EstatusFacturacion' },
                    { data: 'FechaFacturacion' },
                    { data: 'Cliente' },
                    { data: 'Rut' },
                    { data: 'Grupo' },
                    { data: 'ValorPesos' },
                    { data: 'EstatusFacturacion' },
                ],
                destroy: true,
                'createdRow': function( row, data, dataIndex ) {
                    $(row)
                        .attr('rutid',data.Id)
                        .attr('grupo',data.Grupo)
                        .attr('tipo',2)
                        .addClass('text-center')
                },
                "columnDefs": [
                    {
                        "targets": 0,
                        "render": function (data, type, row) {
                            if(data == 1){
                                Estatus = 'Pagada'
                            }else{
                                Estatus = 'Por Pagar'
                            }
                            return "<div style='text-align: center'>"+ Estatus +"</div>";
                        }
                    },
                    {
                        "targets": 6,
                        "render": function (data, type, row) {
                            if(data == 1){
                                Icono = '<a href="'+row.UrlPdfBsale+'" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>'
                            }else{
                                Icono  = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye VisualizarFactura" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i>' + '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-money Facturar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Facturar" title="" data-container="body"></i>'
                            }
                            return "<div style='text-align: center'>"+ Icono +"</div>";
                        }
                    },
                ],
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

            LoteTable = $('#LoteTable').DataTable({
                order: [[2, 'desc']],
                "columnDefs": [ {
                    "targets": [ 0 ],
                    "orderable": false
                } ],
                data: response.array,
                columns: [
                    { data: 'EstatusFacturacion' },
                    { data: 'EstatusFacturacion' },
                    { data: 'FechaFacturacion' },
                    { data: 'Cliente' },
                    { data: 'Rut' },
                    { data: 'Grupo' },
                    { data: 'ValorPesos' },
                    { data: 'EstatusFacturacion' }
                ],
                destroy: true,
                'createdRow': function( row, data, dataIndex ) {
                    $(row)
                        .attr('rutid',data.Id)
                        .attr('grupo',data.Grupo)
                        .attr('tipo',2)
                        .addClass('text-center')
                },
                "columnDefs": [
                    {
                        "targets": 0,
                        "render": function (data, type, row) {
                            if(data == 1){
                                Check = ''
                            }else{
                                Check = '<input name="select_check" id="select_check_"'+row.Id+' type="checkbox" />'
                            }
                            return "<div style='text-align: center'>"+ Check +"</div>";
                        }
                    },
                    {
                        "targets": 1,
                        "render": function (data, type, row) {
                            if(data == 1){
                                Estatus = 'Pagada'
                            }else{
                                Estatus = 'Por Pagar'
                            }
                            return "<div style='text-align: center'>"+ Estatus +"</div>";
                        }
                    },
                    {
                        "targets": 7,
                        "render": function (data, type, row) {
                            if(data == 2){
                                Icono = '<a href="'+row.UrlPdfBsale+'" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>'
                            }else{
                                Icono = Icono = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye VisualizarFactura" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i>' + '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-money Facturar" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Facturar" title="" data-container="body"></i>'
                            }
                            return "<div style='text-align: center'>"+ Icono +"</div>";
                        }
                    },
                ],
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

            $('[data-toggle="popover"]').popover();

            $('body').addClass('loaded');
            $('table').css('width', '100%');
        }
    });

    $('body').on('click', '.Facturar', function () {

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
        },function(isConfirm){   
            if (isConfirm) {

                $.ajax({
                    type: "POST",
                    url: "../includes/facturacion/facturas/storeFactura.php",
                    data: "rutid="+ObjectRutId+"&grupo="+ObjectGroup+"&tipo="+ObjectType,
                    success: function(response){

                        if(response.status == 1){

                            Id = response.Id
                            UrlPdf = response.UrlPdf

                            if(ObjectType == 2){
                                Row = $('#LoteTable tbody').find('tr[rutid="'+Id+'"]');
                                Row.find("td").eq(0).html('');
                                Row.find("td").eq(1).text('Pagada');
                                Row.find("td").eq(7).html('<a href="'+UrlPdf+'" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>')

                                Row = $('#IndividualTable tbody').find('tr[rutid="'+Id+'"]');
                                Row.find("td").eq(0).text('Pagada');
                                Row.find("td").eq(6).html('<a href="'+UrlPdf+'" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>')
                            }else{
                                $(ObjectMe).closest('td').html('<a href="'+response.UrlPdf+'" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>')
                                ObjectTR.find("td").eq(0).text('Pagada');
                            }
                            
                            $('[data-toggle="popover"]').popover();
                            swal("Éxito!","La factura ha sido generada!","success");

                        }else if(response.status == 2){
                            swal('Solicitud no procesada','Debes ingresar el valor UF del mes en curso','error');
                        }else if(response.status == 3){
                            swal('Solicitud no procesada','El servicio no existe, por favor actualizar la pagina','error');
                        }else if(response.status == 4){
                            swal('Solicitud no procesada','El cliente no existe, por favor actualizar la pagina','error');
                        }else if(response.status == 99){
                            swal('Solicitud no procesada','El servicio cUrl no esta disponible en el servidor, por favor contactar al administrador','error');
                        }else{
                            swal('Solicitud no procesada',response.Message,'error');
                        }
                    },
                    error: function(xhr, status, error){
                        setTimeout(function(){ 
                            var err = JSON.parse(xhr.responseText);
                            swal('Solicitud no procesada',err.Message,'error');
                        }, 1000);
                    }
                });
            }
        });
    });

    $('body').on('click', '.VisualizarServicio', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectRutId = ObjectTR.attr("rutid");
        var ObjectGroup = ObjectTR.attr("grupo");

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/showServicio.php",
            data: "rut="+ObjectRutId+"&grupo="+ObjectGroup,
            success: function(response){

                ModalTable.clear().draw()

                $.each(response.array, function( index, array ) {
                    var rowNode = ModalTable.row.add([
                        ''+array.Codigo+'',
                        ''+array.Nombre+'',
                        ''+array.Descripcion+'',
                        ''+array.ValorUF+'',
                        ''+array.ValorPesos+'',
                    ]).draw(false).node();

                    $( rowNode )
                        .addClass('text-center')
                });

                $('#modalShow').modal('show')
            },
            error: function(xhr, status, error){
                setTimeout(function(){ 
                    var err = JSON.parse(xhr.responseText);
                    swal('Solicitud no procesada',err.Message,'error');
                }, 1000);
            }
        });

    });

    $('body').on('click', '.VisualizarFactura', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectRutId = ObjectTR.attr("rutid");

        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/showFactura.php",
            data: "id="+ObjectRutId,
            success: function(response){

                ModalTable.clear().draw()

                $.each(response.array, function( index, array ) {
                    var rowNode = ModalTable.row.add([
                        ''+array.Nombre+'',
                        ''+array.Descripcion+'',
                        ''+array.ValorUF+'',
                        ''+array.ValorPesos+'',
                    ]).draw(false).node();

                    $( rowNode )
                        .addClass('text-center')
                });

                $('#modalShow').modal('show')
            },
            error: function(xhr, status, error){
                setTimeout(function(){ 
                    var err = JSON.parse(xhr.responseText);
                    swal('Solicitud no procesada',err.Message,'error');
                }, 1000);
            }
        });

    });

    function getChecked(){

        var checked = [];

        $('#LoteTable tr').each(function (i, row) {
            var actualrow = $(row);
            checkbox = actualrow.find('input:checked').val();
            if(checkbox == 'on'){
                var id = $(actualrow).attr('rutid');
                checked[i] = id;
            }
        });

        return checked;
    }

    $('#select_all').on('click', function(){
        var rows = LoteTable.rows({ 'search': 'applied' }).nodes();
        $('input[type="checkbox"]', rows).prop('checked', this.checked);

        values = getChecked();

        if(values.length > 0){

            $("#Facturar").removeAttr("disabled");
            $("#Facturar").css({
                "opacity": ("1")
            });

        }else{
            $("#Facturar").attr("disabled","disabled");
            $("#Facturar").css({
                "opacity": ("0.2")
            });
        }
    });

    $('#LoteTable tbody').on( 'click', 'input[type="checkbox"]', function () {
        values = getChecked();

        if(values.length > 0){

            $("#Facturar").removeAttr("disabled");
            $("#Facturar").css({
                "opacity": ("1")
            });

        }else{
            $("#Facturar").attr("disabled","disabled");
            $("#Facturar").css({
                "opacity": ("0.2")
            });
        }
    });

    $('body').on('click', '#Facturar', function () {

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
        },function(isConfirm){   
            if (isConfirm) {

                $.ajax({
                    type: "POST",
                    url: "../includes/facturacion/facturas/storeFacturaPorLote.php",
                    data: "facturas="+Facturas,
                    success: function(response){

                        if(response.status == 1){

                            facturas = response.Facturas

                            $.each(facturas, function( index, factura ) {

                                Id = factura.Id
                                UrlPdf = factura.UrlPdf

                                Row = $('#LoteTable tbody').find('tr[rutid="'+Id+'"]');
                                Row.find("td").eq(0).html('');
                                Row.find("td").eq(1).text('Pagada');
                                Row.find("td").eq(7).html('<a href="'+UrlPdf+'" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>')

                                Row = $('#IndividualTable tbody').find('tr[rutid="'+Id+'"]');
                                Row.find("td").eq(0).text('Pagada');
                                Row.find("td").eq(6).html('<a href="'+UrlPdf+'" target="_blank"><i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye" data-trigger="hover" data-toggle="popover" data-placement="top" data-content="Visualizar" title="" data-container="body"></i></a>')

                            });

                            $('[data-toggle="popover"]').popover();

                            swal("Éxito!","La factura ha sido generada!","success");

                        }else if(response.status == 2){
                            swal('Solicitud no procesada','Debes ingresar el valor UF del mes en curso','error');
                        }else if(response.status == 3){
                            swal('Solicitud no procesada','El servicio no existe, por favor actualizar la pagina','error');
                        }else if(response.status == 4){
                            swal('Solicitud no procesada','El cliente no existe, por favor actualizar la pagina','error');
                        }else if(response.status == 99){
                            swal('Solicitud no procesada','El servicio cUrl no esta disponible en el servidor, por favor contactar al administrador','error');
                        }else{
                            swal('Solicitud no procesada',response.Message,'error');
                        }
                    },
                    error: function(xhr, status, error){
                        setTimeout(function(){ 
                            var err = JSON.parse(xhr.responseText);
                            swal('Solicitud no procesada',err.Message,'error');
                        }, 1000);
                    }
                });
            }
        });
    });
});