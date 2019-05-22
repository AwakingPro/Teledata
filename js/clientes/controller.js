var maxLat = Math.atan(Math.sinh(Math.PI)) * 180 / Math.PI;
var center
var mapOptions
var map
var mapCenter
var TableContactos

$(document).ready(function() {

    $('select[name="Region"]').load('../ajax/cliente/getRegiones.php', function(data) {
        $('select[name="Region"]').selectpicker('refresh');
    });
    $('.Region_update').load('../ajax/cliente/getRegiones.php', function(data) {
        $('.Region_update').selectpicker('refresh');
    });

    $('select[name="Grupo"]').load('../ajax/servicios/listGrupo.php', function() {
        $('select[name="Grupo"]').selectpicker('refresh');
    });

    $('select[name="TipoContacto"]').load('../ajax/cliente/getTipoContactos.php', function () {
        $('select[name="TipoContacto"]').selectpicker('refresh');
    });
    
    if (($('#demo-dp-component .input-group.date').size() > 0) || ($('.input-daterange').size() > 0)) {
        $.fn.datepicker.dates['es'] = {
            days: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"],
            daysShort: ["Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb", "Dom"],
            daysMin: ["Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa", "Do"],
            months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
            monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
            today: "Hoy"
        };

        $('#demo-dp-component .input-group.date').datepicker({ autoclose: true, format: "yyyy-mm-dd", weekStart: 1, language: 'es' });

        $('.input-daterange').datepicker({
            format: "yyyy/mm/dd",
            weekStart: 1,
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            language: 'es'
        });
    }
    $('body').on('focus', ".date", function() {
        $('.date').datepicker({
            format: "dd-mm-yyyy",
            weekStart: 1,
            todayBtn: "linked",
            autoclose: true,
            todayHighlight: true,
            language: 'es'
        });
    });
    var Parametros = window.location.search.substr(1);
    if (Parametros != "") {
        var ParametrosArray = Parametros.split("&");
        for (var i = 0; i < ParametrosArray.length; i++) {
            var Parametro = ParametrosArray[i];
            var ParametroArray = Parametro.split("=");
            switch (ParametroArray[0]) {
                case "Rut":
                    $.ajax({
                        type: "POST",
                        data: { Rut: ParametroArray[1] },
                        url: "../ajax/cliente/getClienteID.php",
                        async: false,
                        success: function(id) {
                            if (id) {
                                getPersonaempresa(id)
                            }
                        },
                        error: function() {
                            alert('error');
                        }
                    });
                    break;
            }
        }
    }

    function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function latRange(n) {
        return Math.min(Math.max(parseInt(n), -maxLat), maxLat);
    }

    function lngRange(n) {
        return Math.min(Math.max(parseInt(n), -180), 180);
    }

    

    $('[name="Rut"]').mask("00000000");

    $('.TipoPago').load('../ajax/cliente/selectTipoPago.php', function() {
        $('.TipoPago').selectpicker('refresh');
    });

    $('.TipoCliente').load('../ajax/cliente/selectTipoCliente.php', function() {
        $('.TipoCliente').selectpicker('refresh');
    });

    $('.stateCliente').load('../ajax/cliente/selectEstadoCliente.php', function() {
        $('.stateCliente').selectpicker('refresh');
    });

    $('.Giro').load('../ajax/cliente/selectGiros.php', function() {
        $('.Giro').selectpicker('refresh');
    });

    $('.ClaseCliente').load('../ajax/cliente/selectClaseCliente.php', function() {
        $('.ClaseCliente').selectpicker('refresh');
    });

    $('select[name="rutCliente"]').load('../ajax/servicios/selectClientes.php', function() {
        $('select[name="rutCliente"]').selectpicker();
    });

    $('select[name="TipoFactura"]').load('../ajax/servicios/selectTipoFactura.php', function() {
        $('select[name="TipoFactura"]').selectpicker('refresh');
    });

    $('[name="Valor"]').number(true, 2, ',', '.');
    $('[name="Descuento"]').number(true, 0, '.', '');
    $('[name="CostoInstalacion"]').number(true, 2, ',', '.');
    $('[name="CostoInstalacionDescuento"]').number(true, 0, '.', '');

    function loadModalContactos(){
        var valor = -1;
        var url = '../ajax/cliente/listContactos.php';
        var contenedor = '.dataContactos';
        var contenedorTable = '.dataContactos > .tabeData';
        var contenedorTableCampos = '.dataContactos > .tabeData tr th';
        getDataTables(url, valor, contenedor, contenedorTableCampos, contenedorTable);
    }
    loadModalContactos()
    listClientes();
    function listClientes(){
        $('.listaCliente').html('<div class="spinner loading"></div>');
        $('.listaCliente').load('../ajax/cliente/listClientes.php', function() {
            var count = $('.listaCliente > .tabeData tr th').length - 1;
            $('.listaCliente > .tabeData').DataTable({
                "columnDefs": [{
                    'orderable': false,
                    'targets': [count]
                }, ],
                order: [
                    [1, 'asc']
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
        });
    }
    function getServicios(){
        
        var RUT = $('#servicio_rut_dv').val();
        var rut = RUT.split('-');
        $('.dataServicios').html('<div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div>');
        $.post('../ajax/cliente/dataCliente.php', { rut: rut[0] }, function(data) {
            $('.dataContactos').html('<div style="text-align:center; font-size:15px;">Guardando Contacto...</div><div class="spinner loading"></div>');
            $('.dataServicios').html('');
            values = $.parseJSON(data);
            $('.dataServicios').html(values[1]);
            var count = $('.dataServicios > .tabeData tr th').length - 1;
            $('.dataServicios > .tabeData').DataTable({
                "scrollX": true,
                "columnDefs": [{
                    'orderable': false,
                    'targets': [count]
                }, ],
                language: {
                    processing: "Procesando ...",
                    search: '<div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>',
                    searchPlaceholder: "BUSCAR",
                    lengthMenu: "Mostrar _MENU_ Registros",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ Registros",
                    infoEmpty: "Mostrando 0 a 0 de 0 Registros",
                    infoFiltered: "(filtrada de _MAX_ registros en total)",
                    infoPostFix: "",
                    loadingRecords: "...",
                    zeroRecords: "No se encontraron registros coincidentes",
                    emptyTable: "No hay servicios",
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
        });
    }
    

    $(document).on('click', '.guardarCliente', function() {
        tipo = $(this).attr('id')
        extras = JSON.stringify(TableContactos.data().toArray())
        $.postFormValues('../ajax/cliente/insertCliente.php', '.form-cont1', extras, function(data) {
            if (Number(data) > 0) {
                if (tipo == 'guardarCliente') {
                    listClientes();
                    bootbox.alert('<h3 class="text-center">El cliente #' + data + ' se registro con éxito.</h3>');
                    $('#insertCliente')[0].reset();
                    $('.selectpicker').selectpicker('refresh')
                    TableContactos
                        .rows()
                        .remove()
                        .draw();
                } else {
                    window.location = "../servicios?Rut=" + rut;
                }
            } else {
                if (data != "Dv") {
                    bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
                } else {
                    bootbox.alert('<h3 class="text-center">Disculpe el campo Dv es obligatorio.</h3>');
                }
            }
        });
    });

    // $('body').on('focus', ".date", function() {
    //     $('.date').datetimepicker({
    //         locale: 'es',
    //         format: 'DD-MM-YYYY'
    //     });
    // });

    $(document).on('change', '.tipoBusqueda', function() {
        if ($('.tipoBusqueda').selectpicker('val') == '1') {
            $('select[name="rutCliente"]').load('../ajax/cliente/selectRutCliente.php', function() {
                $('select[name="rutCliente"]').selectpicker('refresh');
            });
        } else {
            $('select[name="rutCliente"]').load('../ajax/cliente/selectNombreCliente.php', function() {
                $('select[name="rutCliente"]').selectpicker('refresh');
            });
        }
    });

    $(document).on('change', 'select[name="rutCliente"]', function() {
        if ($(this).selectpicker('val') != '') {
            servicio_rut_dv = $(this).find('option:selected').data('rut');
            $("#servicio_rut_dv").val(servicio_rut_dv);
            
            servicio_nombre_cliente = $(this).find('option:selected').data('nombre-cliente');
            $("#servicio_nombre_cliente").val(servicio_nombre_cliente);
            getServicios();
        }
    });
    
    
    //abreb el dashboard asociado al id del cliente del modulo /clientes/listaCliente.php
    $(document).on('click', '.dashboard', function() {
        var valor = $(this).attr('attr');
        window.open("../clientes/resumenCliente.php?cliente=" + valor, '_blank')
    });

    //agregar y ver contactos del modulo /clientes/listaCliente.php
    $(document).on('click', '.abre-modal-contactos', function() {
        
        $('#modalContactos').modal('show');
        //id del cliente
        var valor = $(this).attr('attr');
        var nombre_cliente = $(this).attr('data-nombre');
        $('.modal-title-contacto').html(nombre_cliente);
        $('#IdClienteOculto').val(valor);
        var url = '../ajax/cliente/listContactos.php';
        var contenedor = '.dataContactos';
        var contenedorTable = '.dataContactos > .tabeData';
        var contenedorTableCampos = '.dataContactos > .tabeData tr th';
        
        getDataTables(url, valor, contenedor, contenedorTableCampos, contenedorTable );
        
    });

    // al cerrar modal
    $('#modalContactos').on('hidden.bs.modal', function () {
        // $('#IdContactoOculto').val('');
        $('.modal-title-accion').html('Agregar Contacto');
        $('#guardarContacto').html('Guardar');
        $('.form-group').removeClass('has-error');
        $('#insertContactos')[0].reset();
        $('.selectpicker').selectpicker('refresh')
        $('#IdContactoOculto').val('');
    });

    $(document).on('click', '.guardarContacto', function() {

        var valor = $('#IdClienteOculto').val();            
        var nombre = $('#NombreContacto').val();
        $('#guardarContacto').attr('disabled', 'disabled');
        
        if(valor){        
            setTimeout(function () {
                if ($('#guardarContacto').is(':disabled')) {
                    $('.dataContactos').html('<div style="text-align:center; font-size:15px;">Guardando Contacto...</div><div class="spinner loading"></div>');
                }
            }, 1000);

            $.postFormValues('../ajax/cliente/insertContacto.php', '.insertContactos', {}, function(data) {
                
                if(data) {
                    if(data == 'Editado') {
                        alertas('success', 'El contacto '+nombre+' se Actualizo con éxito.');
                        $('#IdContactoOculto').val('');
                        $('.modal-title-accion').html('Agregar Contacto');
                        $('#guardarContacto').html('Guardar');
                    }
                    else if(data == 'No Editado') {
                        alertas('warning', 'El contacto '+nombre+' No se Actualizo con éxito.');
                    }
                    else {
                        alertas('success', 'El contacto '+nombre+' se Registro con éxito.');
                    }
                    
                    $('.dataContactos').html('<div style="text-align:center; font-size:15px;">Cargando Información...</div><div class="spinner loading"></div>');
                    tablalistContactos(valor);
                    
                    // bootbox.alert('<h3 class="text-center">El contacto ' + nombre + ' se registro con éxito.</h3>');
                    $('#insertContactos')[0].reset();
                    $('.selectpicker').selectpicker('refresh')
                    $('.form-group').removeClass('has-error');
                }
            });
        }else{
            $.localFormValues('#insertContactos', function (response) {
                for (var [name, value] of response.entries()) {
                    switch (name){
                        case 'NombreContacto':
                            NombreContacto = value
                            break;
                        case 'TipoContacto':
                            TipoContacto = $('#TipoContacto').find("option:selected").text();
                            break;
                        case 'CorreoContacto':
                            CorreoContacto = value
                            break;
                        case 'TelefonoContacto':
                            TelefonoContacto = value
                            break;

                    }
                }
                TableContactos.row.add([
                    '' + NombreContacto + '',
                    '' + TipoContacto + '',
                    '' + CorreoContacto + '',
                    '' + TelefonoContacto + '',
                    '' + '<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times delete-c"></i>' + '',
                ]).draw(false).node();
                $('#insertContactos')[0].reset();
                $('.selectpicker').selectpicker('refresh')
                $('.form-group').removeClass('has-error');
                alertas('success', 'El contacto ' + nombre + ' se Registro con éxito.');
            });
        }
        $('#guardarContacto').attr('disabled', false);
    });

    // muestra datatable pertenecientes al parametro que se envia para Contactos
    function tablalistContactos(valor) {
        var url = '../ajax/cliente/listContactos.php';
        var contenedor = '.dataContactos';
        var contenedorTable = '.dataContactos > .tabeData';
        var contenedorTableCampos = '.dataContactos > .tabeData tr th';
        
        getDataTables(url, valor, contenedor, contenedorTableCampos, contenedorTable );
    };

    // muestra datatable pertenecientes al parametro que se envia para Contactos
    function tablalistContactos2(valor) {
        var url = '../ajax/cliente/listContactos2.php';
        var contenedor = '.dataContactos2';
        var contenedorTable = '.dataContactos2 > .tabeData';
        var contenedorTableCampos = '.dataContactos2 > .tabeData tr th';
        
        getDataTables(url, valor, contenedor, contenedorTableCampos, contenedorTable );
    };

    //actualizar contacto
    $(document).on('click', '.update-c', function(event) {
        id = $(this).attr('id');
        $('.modal-title-accion').html('Actualizar Contacto');
        $('#guardarContacto').html('Actualizar');
        getContacto(id);
    });

    function getContacto(id) {
        $('#insertContactos')[0].reset();
        $.post('../ajax/cliente/dataContactoUpdate.php', { id: id }, function(data) {
            value = $.parseJSON(data);
            $('[name="NombreContacto"]').val(value['DataContacto'][0]['contacto']);
            $('[name="TipoContacto"]').val(value['DataContacto'][0]['tipo_contacto']);
            $('[name="CorreoContacto"]').val(value['DataContacto'][0]['correo']);
            $('[name="TelefonoContacto"]').val(value['DataContacto'][0]['telefono']);
            $('[name="IdContactoOculto"]').val(id);
            $('.selectpicker').selectpicker('refresh')
            
        });
    }

    $(document).on('click', '.delete-c', function() {
        var id = $(this).attr('attr');
        var element = $(this)
        swal({
            title: '¿Esta seguro de querer eliminar los datos?',
            text: "Presione Si de lo contrario Cancel",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si Borrar!'
        }, function (isConfirm) {
            if (isConfirm == true) {
                if(id){
                    $('.dataContactos').html('<div style="text-align:center; font-size:15px;">Eliminando Contacto...</div><div class="spinner loading"></div>');
                    $.post('../ajax/cliente/eliminarContacto.php', { id: id }, function(data) {
                        
                        if(data == true) {
                            alertas('success', 'El contacto se Elimino con éxito.');
                            // bootbox.alert('<h3 class="text-center">El contacto se Elimino con éxito.</h3>');
                            var valor = $('#IdClienteOculto').val();
                            //reresh table Contactos
                            tablalistContactos(valor);
                        }
                        else if(data == false) {
                            alertas('danger', 'El contacto No se Elimino.');
                            // bootbox.alert('<h3 class="text-center">El contacto No se Elimino.</h3>');
                        }
                        else {
                            alertas('danger', data);
                            // bootbox.alert('<h3 class="text-center">'+data+'</h3>');
                        }
                        
                    });
                }else{
                    alertas('success', 'El contacto se Elimino con éxito.');
                    TableContactos
                        .row($(element).parents('tr'))
                        .remove()
                        .draw();
                }
            }
        });
    });

    //ver servicios del modulo /clientes/listaCliente.php
    $(document).on('click', '.verServiciosCliente', function() {
        $('#modalVerServicios').modal('show');
        // parametros para armar la data table
        var id = $(this).attr('attr');
        $("#servicio_rut_dv").val(id);
        var nombre_cliente = $(this).attr('data-nombre'); 
        $("#servicio_nombre_cliente").val(nombre_cliente);
        $('.modal-title-servicio').html(nombre_cliente);
        var url = '../ajax/cliente/dataServicios.php';
        var contenedor = '.dataServicios';
        var contenedorTable = '.dataServicios > .tabeData';
        var contenedorTableCampos = '.dataServicios > .tabeData tr th';

        getDataTables(url, id, contenedor, contenedorTableCampos, contenedorTable );
        
    });

    // funcion para obtener datos con datatable
    function getDataTables(url, id, contenedor, contenedorTableCampos, contenedorTable ){
        $(contenedor).html('<div style="text-align:center; font-size:15px;">Cargando Información...</div><div class="spinner loading"></div>');
        if (id != '') {
            $.post(url, { id: id }, function(data) {
                //aqui faltaria validar si la data es json o no con if para usar los 2 tipos de datos
                // por ahora solo json
                values = $.parseJSON(data);
               
                $(contenedor).html(values);
                var count = $(contenedorTableCampos).length - 1;
                
                TableContactos = $(contenedorTable).DataTable({
                    "columnDefs": [{
                        'orderable': true,
                        'targets': [count]
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
            });
            
        }
        
    }


    $(document).on('click', '.agregarDatosTecnicos', function() {
        $('.containerTipoServicio').html('<div style="text-align:center; font-size:15px;">Cargando Información...</div><div class="spinner loading"></div>');

        var id = $(this).attr('attr');

        $.post('../ajax/cliente/tipoViewModal.php', { id: id }, function(data) {

            $('.containerTipoServicio').load('viewTipoServicio/' + data, function() {
                $('[name="idServicio"]').val(id);
                $('#destino_id').val(id)
                $('select').selectpicker();
                $('.date').datepicker({
                    locale: 'es',
                    format: 'yyyy-mm-dd'
                });
                if (data.trim() == 'arriendoEquipos.php' || data.trim() == 'servicioInternet.php') {

                    $.ajax({
                        type: "POST",
                        url: "../includes/inventario/egresos/getBodega.php",
                        success: function(response) {
                            $.each(response.array, function(index, array) {
                                $('#origen_id').append('<option value="' + array.id + '" data-content="' + array.nombre + '"></option>');
                            });
                        }
                    });

                    setTimeout(function() {
                        $('#origen_id').selectpicker('render');
                        $('#origen_id').selectpicker('refresh');
                    }, 1000);
                }
            });
        });
    });

    $(document).on('click', '.listDatosTecnicos', function() {
        var id = $(this).attr('attr');
        ListDatosTecnicos(id)
    });

    function ListDatosTecnicos(id) {
        $('.containerListDatosTecnicos').html('<div style="text-align:center; font-size:15px;">Cargando Información...</div><div class="spinner loading"></div>');
        $.post('../ajax/cliente/tipolistModal.php', {
            id: id
        }, function(data) {
            $.post('../ajax/cliente/' + data, {
                id: id
            }, function(data) {
                $('.containerListDatosTecnicos').html(data);
                var count = $('.containerListDatosTecnicos > .tabeData tr th').length - 1;
                $('.containerListDatosTecnicos > .tabeData').DataTable({
                    "columnDefs": [{
                        'orderable': false,
                        'targets': [count]
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
                $('.containerListDatosTecnicos').attr('idTipoLista', id);
            });
        });
    }
   
    $(document).on('click', '.guardarDatosTecnicos', function() {
        var url = $('.container-form-datosTecnicos').attr('attr');
        $.postFormValues('../ajax/cliente/' + url, '.container-form-datosTecnicos', {}, function(data) {
            if (Number(data) > 0) {
                var id = $('.containerListDatosTecnicos').attr('idTipoLista');
                $('.modal').modal('hide')
                setTimeout(function() {
                    bootbox.alert('<h3 class="text-center">Registro Guardado Exitosamente.</h3>');
                }, 500)
                setTimeout(function() {
                    $('#verServicios').modal('show')
                    ListDatosTecnicos(id)
                }, 500)
            } else {
                bootbox.alert('<h3 class="text-center">Se produjo un error al guardar.</h3>');
            }
        });
    });

    $(document).on('click', '.eliminarServicio', function() {
        var id = $(this).attr('attr');
        bootbox.confirm({
            message: "<h3 class='text-center'>Esta seguro de querer eliminar los datos</h3>",
            buttons: {
                confirm: {
                    label: 'Si borrar',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No borrar',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result == true) {
                    $.post('../ajax/cliente/eliminarServicio.php', { id: id }, function(data) {
                        getServicios();
                    });
                }
            }
        });
    });

    $(document).on('click', '.delete-personaempresa', function() {
        var id = $(this).attr('attr');
        bootbox.confirm({
            message: "<h3 class='text-center'>Esta seguro de querer eliminar los datos</h3>",
            buttons: {
                confirm: {
                    label: 'Si borrar',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No borrar',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result == true) {
                    $.post('../ajax/cliente/eliminarCliente.php', { id: id }, function(data) {
                        listClientes();
                    });
                }
            }
        });
    });

    $(document).on('click', '.update-personaempresa', function(event) {
        id = $(this).attr('attr');
        tipo = $(this).attr('id');
        tablalistContactos2(id);
        // $('#IdClienteOculto').val(id);
        // var url = '../ajax/cliente/listContactos.php';
        // var contenedor = '.dataContactos';
        // var contenedorTable = '.dataContactos > .tabeData';
        // var contenedorTableCampos = '.dataContactos > .tabeData tr th';
        
        // getDataTables(url, id, contenedor, contenedorTableCampos, contenedorTable );

        if (tipo == 'update') {
            $("#editarCliente :input:not(.btn)").prop("disabled", false);
            $('.actualizarCliente').show();
        } else {
            $("#editarCliente :input:not(.btn)").prop("disabled", true);
            $('.actualizarCliente').hide();
        }
        $('[name="Rut_update"]').prop("disabled", true);
        $('[name="Dv_update"]').prop("disabled", true);
        getPersonaempresa(id)
    });

    function getPersonaempresa(id) {
        $.post('../ajax/cliente/dataClienteUpdate.php', { id: id }, function(data) {
            value = $.parseJSON(data);
            $('[name="Nombre_update"]').val(value[0]['nombre']);
            $('[name="Rut_update"]').val(value[0]['rut']);
            $('[name="Dv_update"]').val(value[0]['dv']);
            $('[name="DireccionComercial_update"]').val(value[0]['direccion']);
            $('[name="Contacto_update"]').val(value[0]['contacto']);
            $('[name="Telefono_update"]').val(value[0]['telefono']);
            $('[name="Correo_update"]').val(value[0]['correo']);
            $('[name="Giro_update"]').val(value[0]['giro']);
            $('[name="Comentario_update"]').val(value[0]['comentario']);
            $('[name="TipoCliente_update"]').val(value[0]['tipo_cliente']);
            $('[name="Alias_update"]').val(value[0]['alias']);
            $('[name="Region_update"]').val(value[0]['region']);
            $('.Region_update').selectpicker('refresh');
            loadCiudades();
            setTimeout(() => {
                $('[name="Ciudad_update"]').val(value[0]['ciudad']);
                $('[name="Ciudad_update"]').selectpicker('refresh');
            }, 2000);
            $('[name="IdCliente"]').val(value[0]['id']);
            $('[name="Giro_update"]').selectpicker('refresh');
            $('[name="TipoCliente_update"]').selectpicker('refresh');
            $('[name="TipoPago_update"]').val(value[0]['tipo_pago_bsale_id']);
            $('[name="TipoPago_update"]').selectpicker('refresh');
            if(value[0]['posee_pac'] == 1){
                $('[name="PoseePac_update').prop('checked',true);
            }else{
                $('[name="PoseePac_update').prop('checked', false);
            }
            if(value[0]['posee_prefactura'] == 1){
                $('[name="PoseePrefactura_update').prop('checked',true);
            }else{
                $('[name="PoseePrefactura_update').prop('checked', false);
            }
            if(value[0]['state'] == null){
                $('[name="stateCliente"]').val('Activo sin emitir docs');
            }
            $('[name="stateCliente"]').val(value[0]['state']);
            $('[name="stateCliente"]').selectpicker('refresh');
            $('[name="stateOculto"]').val(value[0]['state']);

            if(value[0]['cliente_id_bsale']){
                $('[name="cliente_id_bsale"').val(value[0]['cliente_id_bsale'])
            }
            $('#editarCliente').modal('show');
        });
    }

    $(document).on('click', '.actualizarCliente', function() {
        $.postFormValues('../ajax/cliente/updateCliente.php', '.container-form-update', {}, function(data) {
            listClientes();
            $('#editarCliente').modal('hide');
            bootbox.alert('<h3 class="text-center">El cliente se actualizo con éxito.</h3>');
        });
    });

    $(document).on('click', '.delete-arriendo_equipos_datos', function() {
        var id = $(this).attr('attr');
        bootbox.confirm({
            message: "<h3 class='text-center'>Esta seguro de querer eliminar los datos</h3>",
            buttons: {
                confirm: {
                    label: 'Si borrar',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No borrar',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result == true) {
                    $.post('../ajax/cliente/eliminarArriendoEquipo.php', { id: id }, function(data) {
                        ListDatosTecnicos($('.containerListDatosTecnicos').attr('idTipoLista'));
                    });
                }
            }
        });
    });

    $(document).on('click', '.delete-servicio_internet', function() {
        var id = $(this).attr('attr');
        bootbox.confirm({
            message: "<h3 class='text-center'>Esta seguro de querer eliminar los datos</h3>",
            buttons: {
                confirm: {
                    label: 'Si borrar',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No borrar',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result == true) {
                    $.post('../ajax/cliente/eliminarServicioInternet.php', { id: id }, function(data) {
                        ListDatosTecnicos($('.containerListDatosTecnicos').attr('idTipoLista'));
                    });
                }
            }
        });
    });

    $(document).on('click', '.delete-mantencion_red', function() {
        var id = $(this).attr('attr');
        bootbox.confirm({
            message: "<h3 class='text-center'>Esta seguro de querer eliminar los datos</h3>",
            buttons: {
                confirm: {
                    label: 'Si borrar',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No borrar',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result == true) {
                    $.post('../ajax/cliente/eliminarMatencionRed.php', { id: id }, function(data) {
                        ListDatosTecnicos($('.containerListDatosTecnicos').attr('idTipoLista'));
                    });
                }
            }
        });
    });

    $(document).on('click', '.delete-mensualidad_puertos_publicos', function() {
        var id = $(this).attr('attr');
        bootbox.confirm({
            message: "<h3 class='text-center'>Esta seguro de querer eliminar los datos</h3>",
            buttons: {
                confirm: {
                    label: 'Si borrar',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No borrar',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result == true) {
                    $.post('../ajax/cliente/eliminarMensualidadPuertoPublico.php', { id: id }, function(data) {
                        ListDatosTecnicos($('.containerListDatosTecnicos').attr('idTipoLista'));
                    });
                }
            }
        });
    });

    $(document).on('click', '.delete-trafico_generado', function() {
        var id = $(this).attr('attr');
        bootbox.confirm({
            message: "<h3 class='text-center'>Esta seguro de querer eliminar los datos</h3>",
            buttons: {
                confirm: {
                    label: 'Si borrar',
                    className: 'btn-success'
                },
                cancel: {
                    label: 'No borrar',
                    className: 'btn-danger'
                }
            },
            callback: function(result) {
                if (result == true) {
                    $.post('../ajax/cliente/eliminarTraficoGenerado.php', { id: id }, function(data) {
                        ListDatosTecnicos($('.containerListDatosTecnicos').attr('idTipoLista'));
                    });
                }
            }
        });
    });

    $(document).on('change', '#origen_id', function() {

        $('#producto_id').empty();
        $('#producto_id').append(new Option('Seleccione Opción', ''));

        origen_tipo = 1
        origen_id = $(this).val();

        if (origen_id) {

            $.ajax({
                type: "POST",
                url: "../includes/inventario/egresos/getProducto.php",
                data: "&origen_tipo=" + origen_tipo + "&origen_id=" + origen_id,
                success: function(response) {
                    $.each(response.array, function(index, array) {
                        $('#producto_id').append('<option value="' + array.id + '" data-content="' + array.tipo + ' ' + array.marca + ' ' + array.modelo + ' - ' + array.numero_serie + '"></option>');
                    });
                }
            });
        }

        setTimeout(function() {
            $('#producto_id').selectpicker('render');
            $('#producto_id').selectpicker('refresh');
        }, 1000);

    });

    $('input[name="Rut"]').on('blur', function() {

        rut = $(this).val()
        input = $(this)

        if (rut) {
            $.post('../ajax/cliente/listCliente.php', { rut: rut }, function(data) {
                data = $.parseJSON(data);
                if (data.length) {
                    swal({
                        title: "Este rut ya esta registrado",
                        text: "Desea modificarlo?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#28a745",
                        confirmButtonText: "Si",
                        cancelButtonText: "No",
                        closeOnConfirm: true,
                        allowOutsideClick: false
                    }, function(isConfirm) {
                        if (isConfirm) {
                            window.location = "../clientes/listaCliente.php?Rut=" + rut;
                        } else {
                            $(input).val('')
                        }
                    });
                } else {
                    $.post('../ajax/cliente/getDv.php', { rut: rut }, function(data) {
                        $('#Dv').val(data)
                    });
                }
            });
        }
    });

    $('select[name="TipoCliente"]').on('change', function() {
        $('#Giro').empty();
        if ($(this).val() == "1") {
            $('#Giro').append('<option value="SIN GIRO, PERSONA NATURAL" selected="">SIN GIRO, PERSONA NATURAL</option>')
            $('#Giro').removeAttr('validate')
            $('#guardarClienteIrServicio').show();
        } else {
            $('#Giro').load('../ajax/cliente/selectGiros.php', function() {
                $('#Giro').selectpicker('refresh');
            });
            if ($(this).val() == 3) {
                $('#guardarClienteIrServicio').hide();
            } else {
                $('#guardarClienteIrServicio').show();
            }
            $('#Giro').attr('validate', 'not_null')
        }
        $('#Giro').selectpicker('refresh')
    });

    $(document).on('change', '#TipoCliente', function() {
        if ($('.tipoBusqueda').selectpicker('val') == '1') {
            $('select[name="rutCliente"]').load('../ajax/cliente/selectRutCliente.php', function() {
                $('select[name="rutCliente"]').selectpicker('refresh');
            });
        } else {
            $('select[name="rutCliente"]').load('../ajax/cliente/selectNombreCliente.php', function() {
                $('select[name="rutCliente"]').selectpicker('refresh');
            });
        }
    });

    $(document).on('click', '.mostrarDatosTecnicos', function() {

        $('body').removeClass('loaded');

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = $(this).attr('attr');
        var ObjectCode = ObjectTR.find("td").eq(0).text();
        $('.Codigo').text(ObjectCode);
        $('.Id').val(ObjectId);

        $.ajax({
            type: "POST",
            url: "../includes/tareas/showTarea.php",
            data: "id=" + ObjectId,
            success: function(response) {

                array = response.array
                var IdServicio
                for (var name in array) {
                    var value = array[name];
                    if (name == "Descripcion" || name == "Direccion") {
                        $('#showServicio').find('#' + name).text(value);
                    } else {
                        $('#showServicio').find('#' + name).val(value);
                    }
                    if (name == 'IdServicio') {
                        IdServicio = value
                    }
                    if (name == 'CostoInstalacion') {
                        if (value > 0) {
                            $('#showServicio #BooleanCostoInstalacion').val(1);
                            $('#divCostoInstalacionEditar').show();
                            $('#showServicio').find('input[name="CostoInstalacion"]').attr('validate', 'not_null')
                        } else {
                            $('#showServicio #BooleanCostoInstalacion').val(0);
                            $('#divCostoInstalacionEditar').hide();
                            $('#showServicio').find('input[name="CostoInstalacion"]').removeAttr('validate')
                        }
                    }
                }

                $('.selectpicker').selectpicker('refresh')

                var LatitudEdit = $('#showServicio').find('input[name="LatitudEdit"]').val();
                var LongitudEdit = $('#showServicio').find('input[name="LongitudEdit"]').val();
                
                switch (IdServicio) {
                    case '1':
                        $('#otrosServiciosEditar').show()
                        break;
                    case '2':
                        $('#otrosServiciosEditar').show()
                        break;
                    case '3':
                        $('#otrosServiciosEditar').hide()
                        break;
                    case '4':
                        $('#otrosServiciosEditar').hide()
                        break;
                    case '5':
                        $('#otrosServiciosEditar').hide()
                        break;
                    case '6':
                        $('#otrosServiciosEditar').hide()
                        break;
                    default:
                        $('#otrosServiciosEditar').hide()
                }

                //agrega las coordenadas desde la bd
                $('#LatitudEdit').val(array.Latitud)
                $('#LongitudEdit').val(array.Longitud)
                if (array.Latitud && array.Longitud) {
                    ResizeEdit(array.Latitud, array.Longitud)
                }

                $('body').addClass('loaded');
            },
            error: function(xhr, status, error) {
                setTimeout(function() {
                    var err = JSON.parse(xhr.responseText);
                    swal('Solicitud no procesada', err.Message, 'error');
                }, 1000);
            }
        });

    });

    $('#showServicio #BooleanCostoInstalacion').change(function(event) {
        if ($(this).val() == 1) {
            $('#divCostoInstalacionEditar').show();
            $('#showServicio').find('input[name="CostoInstalacion"]').attr('validate', 'not_null')
        } else {
            $('#divCostoInstalacionEditar').hide();
            $('#showServicio').find('input[name="CostoInstalacion"]').removeAttr('validate')
        }
    });

    $(document).on('click', '#updateServ', function() {
        $.postFormValues('../ajax/servicios/updateServicio.php', '#showServicio', {}, function(data) {
            if (data) {
                servicio_id = data
                $('.modal').modal('hide')
                setTimeout(function() {
                    bootbox.alert('<h3 class="text-center">El servicio se actualizo con éxito.</h3>');
                }, 500)
                getServicios();
            } else {
                bootbox.alert('<h3 class="text-center">Se produjo un error al actualizar</h3>');
            }
        });
    });

    $(document).on('click', '.estatusServicio', function() {

        $('body').removeClass('loaded');

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = $(this).attr('attr');
        var ObjectCode = ObjectTR.find("td").eq(0).text();
        $('.Codigo').text(ObjectCode);
        $('.Id').val(ObjectId);
        $('#servicio_codigo_cliente').val(ObjectCode);

        $.ajax({
            type: "POST",
            url: "../ajax/servicios/showEstatus.php",
            data: "id=" + ObjectId,
            success: function(response) {
                response = JSON.parse(response)
                $('#FechaInicioDesactivacion').val('')
                $('#FechaFinalDesactivacion').val('')
                if (response.FechaFinalDesactivacion == '2999/01/31') {
                    $('#Activo').val(0)
                    $('#divFechaActivacion').hide()
                } else if (response.FechaFinalDesactivacion) {
                    $('#Activo').val(2)
                    $('#FechaInicioDesactivacion').val(response.FechaInicioDesactivacion)
                    $('#FechaFinalDesactivacion').val(response.FechaFinalDesactivacion)
                    $('#divFechaActivacion').show()
                } else {
                    $('#Activo').val(1)
                    $('#divFechaActivacion').hide()
                }
                $('#Activo').selectpicker('refresh')
                $('body').addClass('loaded');
            },
            error: function(xhr, status, error) {
                setTimeout(function() {
                    var err = JSON.parse(xhr.responseText);
                    swal('Solicitud no procesada', err.Message, 'error');
                }, 1000);
            }
        });
    });

    $('#Activo').on('change', function() {
        if ($(this).val() == "1") {
            $('#divFechaActivacion').hide()
            $('input[name="FechaInicioDesactivacion"]').removeAttr('validate')
            $('input[name="FechaFinalDesactivacion"]').removeAttr('validate')
        } else if ($(this).val() == "2") {
            $('#divFechaActivacion').show()
            $('input[name="FechaInicioDesactivacion"]').attr('validate', 'not_null')
            $('input[name="FechaFinalDesactivacion"]').attr('validate', 'not_null')
        } else {
            $('#divFechaActivacion').hide()
            $('input[name="FechaInicioDesactivacion"]').val('1970/01/31')
            $('input[name="FechaFinalDesactivacion"]').val('2999/01/31')
        }
    });

    $(document).on('click', '#updateEstatus', function() {
        
        // if ($('#updateEstatus').is(':disabled')) {   
        // }
        $("#updateEstatus").attr('disabled', 'disabled');
        $('#loader_servicios').html('<div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div>');
        $.postFormValues('../ajax/servicios/updateEstatus.php', '#formEstatus', {}, function(data) {
            
            if (data == 1) {
                 alertas('success', 'Registro Actualizado Exitosamente.');
                // setTimeout(function() {
                //     bootbox.alert('<h3 class="text-center">Registro Actualizado Exitosamente.</h3>');
                // }, 500)
            } else if (data == 2) {
                alertas('danger', 'La fecha de activación debe ser mayor al dia de hoy.');
                // bootbox.alert('<h3 class="text-center">La fecha de activación debe ser mayor al dia de hoy.</h3>');
            } else if (data == 3) {
                alertas('danger', 'La fecha de activación es requerida.');
                // bootbox.alert('<h3 class="text-center">La fecha de activación es requerida.</h3>');
            } else if (data == 4) {
                alertas('danger', 'Se Actualizo, pero ocurrio un error al enviar el correo a los encargados del servicio.');
                // bootbox.alert('<h3 class="text-center">Se Actualizo, pero ocurrio un error al enviar el correo a los encargados del servicio.</h3>');
            } else {
                alertas('danger', 'Se produjo un error al guardar.');
                // bootbox.alert('<h3 class="text-center">Se produjo un error al guardar.</h3>');
            }
            $('#loader_servicios').html('');
            $('.dataServicios').html('<div style="text-align:center; font-size:15px;">Cargando Servicios...</div><div class="spinner loading"></div>');
            if(data == 1 || data == 4){
                $('#modalEstatus').modal('hide');
                getServicios();
            }
            $("#updateEstatus").attr('disabled', false);
        });
        
        
    });

    $('body').on('click', '#guardarGiro', function() {

        $.postFormValues('../ajax/cliente/insertGiro.php', '#insertGiro', {}, function(response) {

            response = JSON.parse(response);

            if (response.status == '1') {
                $('#agregarGiro').modal('hide')
                bootbox.alert('Registro Guardado Exitosamente')

                $("#Giro").append('<option value="' + response.nombre + '" selected="">' + response.nombre + '</option>');
                $("#Giro").selectpicker("refresh");

            } else if (response.status == '2') {
                bootbox.alert('Debe llenar todos los campos')
            } else {
                bootbox.alert('Ocurrió un error en el Proceso')
            }
        });
    });

    $(document).on('change', 'select[name="Region"]', function() {
        if ($(this).selectpicker('val') != '') {
            $('select[name="Ciudad"]').load('../ajax/cliente/getCiudades.php', { Region: $(this).selectpicker('val') }, function(data) {
                $('select[name="Ciudad"]').selectpicker('refresh');
            });
        }
    });
    $(document).on('change', '.Region_update', function() {
        loadCiudades();
    });

    function loadCiudades() {
        Region = $('select[name="Region_update"]').val();
        if (Number(Region) > 0) {
            $('select[name="Ciudad_update"]').load('../ajax/cliente/getCiudades.php', { Region: Region }, function(data) {
                $('select[name="Ciudad_update"]').selectpicker('refresh');
            });
        } else {
            $('select[name="Ciudad_update"]').empty();
            $('select[name="Ciudad_update"]').selectpicker('refresh')
        }
    }
    $(document).on('click', '.updateDatosTecnicos', function() {
        $('.containerTipoServicio').html('<div style="text-align:center; font-size:15px;">Cargando Información...</div><div class="spinner loading"></div>');
        var idServicio = $(this).attr('attr');
        var id = $(this).attr('id');
        $.post('../ajax/cliente/tipoViewModal.php', { id: idServicio }, function(data) {
            if (data.trim() == 'arriendoEquipos.php') {
                url = 'getArriendoEquipo.php';
            } else {
                url = 'getServicioInternet.php'
            }
            $.post('../ajax/servicios/' + url, { id: id }, function(response) {
                response = JSON.parse(response)
                response = response[0]
                Velocidad = response.Velocidad;
                Plan = response.Plan;
                $('.containerTipoServicio').load('../clientesServicios/viewTipoServicio/' + data, { Velocidad, Plan, idServicio }, function() {
                    $('[name="idServicio"]').val(id);
                    $('.productos').remove();
                    $('#agregarDatosTecnicos').modal('show')
                });
            });
        });
    });
    $(document).on('click', '.actualizarDatosTecnicos', function() {
        $.postFormValues('../ajax/servicios/updateDatosTecnicos.php', '.container-form-datosTecnicos', {}, function(data) {
            if (Number(data) > 0) {
                var id = $('.containerListDatosTecnicos').attr('idTipoLista');
                $('.modal').modal('hide')
                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Actualizado Exitosamente',
                    container: 'floating',
                    timer: 3000
                });
                setTimeout(function() {
                    $('#verServicios').modal('show')
                    ListDatosTecnicos(id)
                }, 500)
            } else {
                bootbox.alert('<h3 class="text-center">Se produjo un error al guardar.</h3>');
            }
        });
    });
});