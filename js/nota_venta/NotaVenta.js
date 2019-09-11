$(document).ready(function() {

    var neto_nota = 0
    var iva_nota = 0
    var total_nota = 0
    iva_global = 0.19;
    $.ajax({
        type: "POST",
        url: "../includes/inventario/bodegas/showPersonal.php",
        success: function(response) {
            var nombreUsuarioSession;

            $.each(response.array, function(index, array) {
                if(array.id == idUsuarioSession){
                    $('#solicitado_por').prepend('<option value="' + array.id + '">' + array.nombre + '</option>');
                    $('#solicitado_por').val(nombreUsuarioSession);
                }
                
                $('#solicitado_por').append('<option value="' + array.id + '">' + array.nombre + '</option>');
            });
            $.each(response.array, function(index, array) {
                $('#solicitado_por_update').append('<option value="' + array.id + '">' + array.nombre + '</option>');
            });

            
            setTimeout(function() {
                $('.selectpicker').selectpicker('refresh');
            }, 500)

        }
    });

    // inicio tabla detalle servicios
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
            emptyTable: "No tiene servicios activos para cobrar",
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
    // fin tabla detalle servicios
    
    
    // inicio mostrar servicios del cliente en tabla
    function getServiciosFacturados(RUT){
        $.ajax({
            type: "POST",
            url: "../includes/facturacion/facturas/getServiciosFacturados.php",
            data: "RUT=" + RUT,
            success: function(response) {
                TablaFacturaDetalle.clear().draw()
                if(response.array.length > 0) {
                    $.each(response.array, function(index, array) {
                        var rowNode = TablaFacturaDetalle.row.add([
                            '' + '<div><input class="select-checkbox" name="select_check" id="select_check_' + array.IdServicio + '" type="checkbox" /></div>' +'',
                            
                            '' + array.Codigo + '',
                            '' + array.Descripcion + '',
                            '' + formatcurrency(array.ValorUF) + '',
                            // '' + '<div class"input-group"><input class="form-control" name="valor_detalle" id="valor_detalle" value="'+formatcurrency(array.ValorUF)+'" type="text" /></div>' +'',
                        ]).draw(false).node();
    
                        $(rowNode)
                            .attr('IdServicio', array.IdServicio)
                            .addClass('text-center')
                            .attr('ValorUF', array.ValorUF)
                            .addClass('text-center')
                            .attr('FechaUltimoCobro', array.FechaUltimoCobro)
                            .addClass('text-center')
                            .attr('TipoFactura', array.TipoFactura)
                            .addClass('text-center')
                    });
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
    // fin mostrar servicios del cliente en tabla

    DetalleTableTmp = $('#DetalleTableTmp').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,
        bInfo: true,
        bFilter: false,
        columnDefs: [
            { targets: 'no-sort', orderable: false }
          ],
        colReorder: true,
        // order: [
        //     [0, 'asc']
        // ],
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

    getProductos()
    getNotaVentas();

    function getProductos() {
        $('#concepto_tmp').empty();
        $('#concepto_tmp').append(new Option('Seleccione Concepto', ''));
        $.ajax({
            type: "POST",
            url: "../includes/nota_venta/getProductos.php",
            success: function(response) {
                $.each(response.array, function(index, array) {
                    $('#concepto_tmp').append("<option value='" + array.producto + "'>" + array.producto + "</option>");
                });
            }
        })
        setTimeout(function() {
            $('#concepto_tmp').selectpicker('refresh');
        }, 1000);
    }

    $('#formCliente')[0].reset();
    $('#formDetalleTmp')[0].reset();
    $('#automatico').prop('checked', true);
    $('#label_automatico').addClass('active')

    //CONFIGURACION DEL SELECTPICKER, DATETIMEPICKER Y DATA-MASK

    $('.selectpicker').selectpicker();
    $('.number').number(true, 0, ',', '.');
    $("#cantidad_tmp").mask("000000");
    $("#cantidad").mask("000000");

    $('#fecha').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY',
        defaultDate: new Date()
    });
    $('#fecha_oc').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY'
    });
    $('#fecha_hes').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY'
    });
    $('#fecha_update').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY'
    });
    $('#fecha_oc_update').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY'
    });
    $('#fecha_hes_update').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY'
    });

    $.ajax({
        type: "POST",
        url: "../includes/nota_venta/getClientes.php",
        success: function(response) {

            $.each(response.array, function(index, array) {
                $('#personaempresa_id').append('<option value="' + array.rut + '">' + array.rut + ' ' + array.nombre + ' - ' + array.tipo_cliente + '</option>');
            });
            $.each(response.array, function(index, array) {
                $('#personaempresa_id_update').append('<option value="' + array.rut + '">' + array.rut + ' ' + array.nombre + ' - ' + array.tipo_cliente + '</option>');
            });

            $('.selectpicker').selectpicker('refresh');

        }
    });

    deleteDetalles();

    function getNotaVentas() {
        $.ajax({
            type: "POST",
            url: "../includes/nota_venta/getNotaVentas.php",
            success: function(response) {
                NotaVentaTable = $('#NotaVentaTable').DataTable({
                    stateSave: false,
                    order: [
                        [2, 'desc']
                    ],
                    data: response,
                    columns: [
                        { data: 'rut' },
                        { data: 'cliente' },
                        { data: 'fecha' },
                        { data: 'numero_oc' },
                        { data: 'numero_hes'},
                        { data: 'solicitado_por' },
                        { data: 'total' },
                        { data: 'total_descuento'},
                        { data: 'id' }
                    ],
                    destroy: true,
                    'createdRow': function(row, data, dataIndex) {
                        $(row)
                            .attr('id', data.id)
                            .addClass('text-center')
                    },
                    "columnDefs": [{
                            "targets": 2,
                            "render": function(data, type, row) {
                                fecha = moment(data).format('DD-MM-YYYY')
                                // return "<div style='text-align: center'>" + fecha + "</div>";
                                return "<div style='text-align: center;' ><span style='display: none;'>"+ data + "</span>"+fecha+"</div>";
                            }
                        },
                        {
                            "targets": 6,
                            "render": function(data, type, row) {
                                if(row.total_descuento > 0){
                                    var descuentoPunto = '0.';
                                    descuentoPunto = descuentoPunto + row.total_descuento;
                                    DescuentoTotal = row.total * descuentoPunto;
                                    data = parseInt(row.total) - parseInt(DescuentoTotal);  
                                }
                                total = formatcurrency(data)
                                return "<div style='text-align: center'>" + total + "</div>";
                            }
                        },
                        {
                            "targets": 8,
                            "render": function(data, type, row) {
                                Ver = '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye View"></i>';
                                if (row.estatus_facturacion == 0) {
                                    Editar = ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Edit"></i>'
                                    if(row.total != 0 ){
                                        Generar = ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-file-excel-o Generate"></i>'
                                    }else{
                                        Generar = ''
                                    }
                                    Eliminar = ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times RemoveNota"></i>'
                                } else {
                                    Editar = '';
                                    Generar = ''
                                    Eliminar = ''
                                }
                                return "<div style='text-align: center'>" + Ver + " " + Editar + " " + Generar + " " + Eliminar + "</div>";
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

    $('input[name=switch_tipo]').on('change', function() {
        value = $("input[name='switch_tipo']:checked").val()
        $('#concepto_container').empty();
        if (value == 1) {
            $('#label_manual').removeClass('active')
            $('#label_automatico').addClass('active')
            append = '<select class="selectpicker form-control" name="concepto_tmp" id="concepto_tmp"  data-live-search="true" data-container="body" validate="not_null" data-nombre="Concepto"></select>'
            $('#concepto_container').append(append)
            getProductos()
        } else {
            $('#label_automatico').removeClass('active')
            $('#label_manual').addClass('active')
            append = '<input id="concepto_tmp" name="concepto_tmp" class="form-control input-sm" validate="not_null" data-nombre="Concepto">'
            $('#concepto_container').append(append)
        }

        $('#precio_tmp').val('')
        $('#total_tmp').val('')

        $('.selectpicker').selectpicker('refresh')

    });

    $('#personaempresa_id').on('change', function() {
        if ($(this).val()) {
            var RUT = $(this).val();
            getServiciosFacturados(RUT);
            datos = $('#formCliente').serialize();

            $.ajax({
                type: "POST",
                url: "../includes/nota_venta/getCliente.php",
                data: datos,
                success: function(response) {

                    $('#giro').val(response.array[0].giro);
                    $('#direccion').val(response.array[0].direccion);
                    $('#contacto').val(response.array[0].contacto);
                    $('#rut').val(response.array[0].rut + '-' + response.array[0].dv);
                }
            });
        } else {
            $('#precio_tmp').val('')
            $('#total_tmp').val('')
        }

        $('#cantidad_tmp').val(1)
    });

    $('#numero_oc').change(function(event) {
        if ($(this).val() == '') {
            $('#fecha_oc').removeAttr('validate')
        } else {
            $('#fecha_oc').attr('validate', 'not_null')
        }
    });
    $('#numero_hes').change(function(event) {
        if ($(this).val() == '') {
            $('#fecha_hes').removeAttr('validate')
        } else {
            $('#fecha_hes').attr('validate', 'not_null')
        }
    });

    $('#concepto_tmp').on('change', function() {
        calcularDetalleTmp()
    });
    $('#precio_tmp').on('change', function() {
        // $('#precio_tmp').number(true,  ',', '.');
        calcularDetalleTmp()
    });
    $('#moneda_tmp').on('change', function() {
        calcularDetalleTmp()
    });
    $('#cantidad_tmp').on('change', function() {
        calcularDetalleTmp()
    });

    function calcularDetalleTmp() {
        cantidad = parseInt($('#cantidad_tmp').val())
        var calculaIva = '';
        var totalFinal = '';
        if (!cantidad) {
            cantidad = 0;
        }
        precio = $('#precio_tmp').val();
        if (precio) {
            var separador = ",";
            // precio = precio.replace(',00', '.')
            // precio = precio.replace('.', '')
            precio = precio.split(separador);
            if(precio.length == 2){
                precio = precio[0]+'.'+precio[1];
                precio = NumConDecimales(precio);
            }else{
                precio = NumConDecimales(precio);
            }
            
        } else {
            precio = 0;
        }

        moneda = $('#moneda_tmp').val()
        if (moneda == 2) {
            precio = precio * ValorUF;
            // precio = Math.round(precio);
            // precio = precio;
            // return
        }
        valor = precio * cantidad;
        calculaIva = valor * iva_global;
        totalFinal = valor + calculaIva;
        concepto = $('#concepto_tmp').val()
        if (valor >= 0 && concepto) {
            $('#insertDetalleTmp').prop('disabled', false);
        } else {
            $('#insertDetalleTmp').prop('disabled', true);
        }
        $('#total_tmp').val(totalFinal);
        // $('#total_tmp').val(formatcurrency(valor))
    }

    $('body').on('click', '#insertDetalleTmp', function() {
        $.postFormValues('../includes/nota_venta/insertDetalleTmp.php', '#formDetalleTmp', {}, function(response) {

            if (response.status == 1) {

                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Guardado Temporalmente',
                    container: 'floating',
                    timer: 3000
                });

                precio = parseFloat(response.array.precio)
                cantidad = response.array.cantidad
                neto = precio * cantidad
                iva = neto * 0.19
                neto_nota = neto_nota + neto
                iva_nota = iva_nota + Math.round(iva);
                total = parseFloat(response.array.total)
                total_nota = total_nota + total

                $('#neto_nota').text(formatcurrency(neto_nota))
                $('#iva_nota').text(formatcurrency(iva_nota))
                $('#total_nota').text(formatcurrency(total_nota))

                var rowNode = DetalleTableTmp.row.add([
                    '' + response.array.concepto + '',
                    '' + formatcurrency(precio) + '',
                    '' + response.array.cantidad + '',
                    '' + formatcurrency(total) + '',
                    '' + formatcurrency(response.array.descuento) + '',
                    '' + '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times deleteDetalleTmp"></i>' + '',
                ]).draw(false).node();

                $(rowNode)
                    .attr('id', response.array.id)
                    .addClass('text-center')

                $('#formDetalleTmp')[0].reset();
                $('#cantidad_tmp').val(1)
                $('.selectpicker').selectpicker('refresh');

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
                    message: 'El precio debe ser mayor a 0',
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

    $('body').on('click', '.deleteDetalleTmp', function() {

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
                    url: "../includes/nota_venta/deleteDetalleTmp.php",
                    type: 'POST',
                    data: "&id=" + ObjectId,
                    success: function(response) {
                        setTimeout(function() {
                            if (response.status == 1) {

                                cantidad = parseInt(response.array[0].cantidad)
                                precio = parseFloat(response.array[0].precio)
                                neto = precio * cantidad
                                iva = neto * 0.19

                                neto_nota = neto_nota - neto
                                iva_nota = iva_nota - Math.round(iva);

                                total = parseFloat(response.array[0].total)
                                total_nota = total_nota - total

                                $('#neto_nota').text(formatcurrency(neto_nota))
                                $('#iva_nota').text(formatcurrency(iva_nota))
                                $('#total_nota').text(formatcurrency(total_nota))

                                DetalleTableTmp.row($(ObjectTR))
                                    .remove()
                                    .draw();

                            } else if (response.status == 3) {
                                swal('Solicitud no procesada', 'Este registro no puede ser eliminado porque ha sido eliminado de la base de datos', 'error');
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

    $('body').on('click', '#insertNotaVenta', function() {
        
        //envio el id servicio y la la fecha ultimo cobro para actualizarlos si es necesario
        FacturaDetalle = getCheckedDetalles('#TablaFacturaDetalle');
        // console.log(FacturaDetalle); return;
        $('#ServiciosSeleccionados').val(FacturaDetalle);
        $.postFormValues('../includes/nota_venta/insertNotaVenta.php', '#formCliente', {}, function(response) {
            $('#insertNotaVenta').attr('disabled', true);
            if (response.status == 1) {
                TablaFacturaDetalle
                .rows()
                .remove()
                .draw();
                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Guardado Exitosamente',
                    container: 'floating',
                    timer: 3000
                });
                getNotaVentas();
                $('#cancelar').click()

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
                    message: 'Debes agregar un detalle',
                    container: 'floating',
                    timer: 3000
                });

            } else if (response.status == 4) {

                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Error al actualizar el servicio',
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
            $('#insertNotaVenta').attr('disabled', false);
        });
    });

    function getCheckedDetalles(idtabla) {
        var checked = [];
        $(idtabla+' tr ').each(function(i, row) {
            var actualrow = $(row);
            checkbox = actualrow.find('input:checked').val();
            if (checkbox == 'on') {
            var id = $(actualrow).attr('idservicio');
            var fechaUltimoCobro = $(actualrow).attr('fechaultimocobro');
            var tipoFactura = $(actualrow).attr('tipofactura');
            checked[i] = id+'/'+fechaUltimoCobro+'/'+tipoFactura;
            }
        });

        return checked;
    }

    $('#cancelar').on('click', function() {
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
        $('#formDetalleTmp')[0].reset();

        neto_nota = 0
        iva_nota = 0
        total_nota = 0

        $('#concepto_tmp').selectpicker('refresh');

        DetalleTableTmp
            .clear()
            .draw();

        $.post('../includes/nota_venta/deleteDetalles.php');
    }

    $('body').on('click', '.RemoveNota', function() {

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
                    url: "../includes/nota_venta/deleteNotaVenta.php",
                    type: 'POST',
                    data: "&id=" + ObjectId,
                    success: function(response) {
                        setTimeout(function() {
                            if (response.status == 1) {
                                swal("Éxito!", "El registro ha sido eliminado!", "success");
                                getNotaVentas();
                            } else if (response.status == 3) {
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

    $('body').on('click', '.View', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("id");

        window.open("../ajax/nota_venta/generarNotaVenta.php?id=" + ObjectId, '_blank');
    });

    $('body').on('click', '.Generate', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("id");

        swal({
            title: "Deseas generar la nota de venta?",
            text: "Confirmar la nota venta!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Generar!",
            cancelButtonText: "Cancelar",
            showLoaderOnConfirm: true,
            closeOnConfirm: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    type: "POST",
                    url: "../includes/nota_venta/generarFactura.php",
                    data: {
                        id: ObjectId
                    },
                    success: function(response) {

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

    $('body').on('click', '.Edit', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("id");
        $.ajax({
            type: "POST",
            url: "../includes/nota_venta/getNotaVenta.php",
            data: {
                id: ObjectId
            },
            success: function(response) {
                getDetalles(ObjectId)
                $('input[name="nota_venta_id"]').val(ObjectId);
                $('#personaempresa_id_update').val(response.rut)
                $('#fecha_update').val(response.fecha)
                $('#numero_oc_update').val(response.numero_oc)
                $('#fecha_oc_update').val(response.fecha_oc)
                $('#numero_hes_update').val(response.numero_hes)
                $('#fecha_hes_update').val(response.fecha_hes)
                $('#solicitado_por_update').val(response.solicitado_por)
                $('.selectpicker').selectpicker('refresh');
                $('#modalNotaVenta').modal('show')
            }
        });
    });

    function getDetalles(ObjectId){
        $.ajax({
            type: "POST",
            url: "../includes/nota_venta/getDetalles.php",
            data: {
                id: ObjectId
            },
            success: function(response) {
                
                DetalleTable = $('#DetalleTable').DataTable({
                    order: [
                        [0, 'asc']
                    ],
                    data: response,
                    columns: [
                        { data: 'concepto' },
                        { data: 'precio' },
                        { data: 'cantidad' },
                        { data: 'total' },
                        { data: 'descuento' },
                        { data: 'id' }
                    ],
                    destroy: true,
                    'createdRow': function(row, data, dataIndex) {
                        $(row)
                            .attr('id', data.id)
                            .addClass('text-center')
                    },
                    "columnDefs": [{
                            "targets": 1,
                            "render": function(data, type, row) {
                                value = formatcurrency(data)
                                return "<div style='text-align: center'>" + value + "</div>";
                            }
                        },{
                            "targets": 3,
                            "render": function(data, type, row) {
                                value = formatcurrency(data)
                                return "<div style='text-align: center'>" + value + "</div>";
                            }
                        },{
                            "targets": 5,
                            "render": function(data, type, row) {
                                Editar = ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil editDetalle"></i>'
                                Eliminar = ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times deleteDetalle"></i>'
                                return "<div style='text-align: center'>" + Editar + " " + Eliminar + "</div>";
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

    $('#numero_oc_update').change(function(event) {
        if ($(this).val() == '') {
            $('#fecha_oc_update').removeAttr('validate')
        } else {
            $('#fecha_oc_update').attr('validate', 'not_null')
        }
    });
    $('#numero_hes_update').change(function(event) {
        if ($(this).val() == '') {
            $('#fecha_hes_update').removeAttr('validate')
        } else {
            $('#fecha_hes_update').attr('validate', 'not_null')
        }
    });

    $('#concepto').on('change', function() {
        calcularDetalle()
    });
    $('#precio').on('change', function() {
        calcularDetalle()
    });
    $('#moneda').on('change', function() {
        calcularDetalle()
    });
    $('#cantidad').on('change', function() {
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
        moneda = $('#moneda').val()
        if (moneda == 2) {
            precio = precio * ValorUF
            precio = Math.round(precio)
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

    $('body').on('click', '#insertDetalle', function() {
        $.postFormValues('../includes/nota_venta/insertDetalle.php', '#formDetalle', {}, function(response) {

            if (response.status == 1) {

                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Guardado Exitosamente',
                    container: 'floating',
                    timer: 3000
                });
                nota_venta_id = $('#nota_venta_id').val()
                getDetalles(nota_venta_id)
                getNotaVentas();

                $('#formDetalle')[0].reset();
                $('#cantidad').val(1)
                $('.selectpicker').selectpicker('refresh');

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

    $('body').on('click', '.deleteDetalle', function() {

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
                    url: "../includes/nota_venta/deleteDetalle.php",
                    type: 'POST',
                    data: "&id=" + ObjectId,
                    success: function(response) {
                        setTimeout(function() {
                            if (response.status == 1) {
                                nota_venta_id = $('#nota_venta_id').val()
                                getDetalles(nota_venta_id)
                                getNotaVentas();
                            } else if (response.status == 3) {
                                swal('Solicitud no procesada', 'Este registro no puede ser eliminado porque ha sido eliminado de la base de datos', 'error');
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

    $('body').on('click', '#updateNotaVenta', function() {

        $.postFormValues('../includes/nota_venta/updateNotaVenta.php', '#formNotaVenta', {}, function(response) {

            if (response.status == 1) {

                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Guardado Exitosamente',
                    container: 'floating',
                    timer: 3000
                });
                $('.modal').modal('hide')
                getNotaVentas();

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
                    message: 'Debes agregar un detalle',
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

    $('body').on('click', '.editDetalle', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("id");
        $.ajax({
            type: "POST",
            url: "../includes/nota_venta/getDetalle.php",
            data: {
                id: ObjectId
            },
            success: function(response) {
                $('input[name="detalle_id"]').val(ObjectId);
                $('input[name="concepto_update"]').val(response.concepto);
                $('input[name="precio_update"]').val(response.precio);
                $('input[name="cantidad_update"]').val(response.cantidad);
                $('input[name="moneda_update"]').val(1);
                $('input[name="total_update"]').val(formatcurrency(response.total));
                $('input[name="descuento_update"]').val(response.descuento);
                $('input[name="moneda_update"]').selectpicker('refresh')
                $('#modalDetalle').modal('show')
            }
        });
    });

    $('#concepto_update').on('change', function() {
        calcularDetalleUpdate()
    });
    $('#precio_update').on('change', function() {
        calcularDetalleUpdate()
    });
    $('#moneda_update').on('change', function() {
        calcularDetalleUpdate()
    });
    $('#cantidad_update').on('change', function() {
        calcularDetalleUpdate()
    });

    function calcularDetalleUpdate() {
        cantidad = parseInt($('#cantidad_update').val())
        if (!cantidad) {
            cantidad = 0;
        }
        precio = $('#precio_update').val()
        if (precio) {
            precio = precio.replace(',00', '')
            precio = precio.replace('.', '')
            precio = parseFloat(precio)
        } else {
            precio = 0;
        }
        moneda = $('#moneda_update').val()
        if (moneda == 2) {
            precio = precio * ValorUF
            precio = Math.round(precio)
        }
        valor = precio * cantidad
        concepto = $('#concepto_update').val()
        if (valor > 0 && concepto) {
            $('#updateDetalle').prop('disabled', false);
        } else {
            $('#updateDetalle').prop('disabled', true);
        }
        $('#total_update').val(formatcurrency(valor))
    }

    $('body').on('click', '#updateDetalle', function() {

        $.postFormValues('../includes/nota_venta/updateDetalle.php', '#formDetalleUpdate', {}, function(response) {

            if (response.status == 1) {
                getNotaVentas();
                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Actualizado Exitosamente',
                    container: 'floating',
                    timer: 3000
                });
                ObjectId = $('input[name="nota_venta_id"]').val();
                getDetalles(ObjectId);
                $('#modalDetalle').modal('hide')

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
                    message: 'Debes agregar un detalle',
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

    function formatcurrency(n) {
        return n.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
    }
});