var maxLat = Math.atan(Math.sinh(Math.PI)) * 180 / Math.PI;
var center
var mapOptions
var map
var mapCenter


$(document).ready(function() {
    
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

    $('select[name="Rut"]').load('../ajax/servicios/selectClientes.php', function() {
        $('select[name="Rut"]').selectpicker('refresh');
        var Parametros = window.location.search.substr(1);
        if (Parametros != "") {
            var ParametrosArray = Parametros.split("&");
            for (var i = 0; i < ParametrosArray.length; i++) {
                var Parametro = ParametrosArray[i];
                var ParametroArray = Parametro.split("=");
                switch (ParametroArray[0]) {
                    case "Rut":
                        getCliente(ParametroArray[1])
                        break;
                }
            }
        }
    });

    // $('select[name="TipoFactura"]').load('../ajax/servicios/selectTipoFactura.php', function() {
    // 	$('select[name="TipoFactura"]').selectpicker('refresh');
    // });
    $('select[name="TipoServicio"]').load('../ajax/servicios/selectTipoServicio.php', function() {
        $('select[name="TipoServicio"]').selectpicker('refresh');
    });

    $('select[name="Grupo"]').load('../ajax/servicios/listGrupo.php', function() {
        $('select[name="Grupo"]').val(1000)
        $('select[name="Grupo"]').selectpicker('refresh');
    });

    $('select[name="Region"]').load('../ajax/cliente/getRegiones.php', function(data) {
        $('select[name="Region"]').selectpicker('refresh');
    });
    $('.Region_update').load('../ajax/cliente/getRegiones.php', function(data) {
        $('.Region_update').selectpicker('refresh');
    });

    $('.TipoCliente').load('../ajax/cliente/selectTipoCliente.php', function() {
        $('.TipoCliente').selectpicker('refresh');
    });

    $('.Giro').load('../ajax/cliente/selectGiros.php', function() {
        $('.Giro').selectpicker('refresh');
    });

    $('.ClaseCliente').load('../ajax/cliente/selectClaseCliente.php', function() {
        $('.ClaseCliente').selectpicker('refresh');
    });

    $('.TipoPago').load('../ajax/cliente/selectTipoPago.php', function () {
        $('.TipoPago').selectpicker('refresh');
    });

    $('[name="Rut"]').mask("00000000");
    $('[name="Valor"]').number(true, 2, ',', '.');
    $('[name="Descuento"]').mask('00');
    $('[name="CostoInstalacion"]').number(true, 2, ',', '.');
    $('[name="CostoInstalacionDescuento"]').mask('00');
    
    $('#CostoInstalacionPesos').number(true, 2, '.', ',');
    

    function getServicios() {
        $('.dataServicios').html('<div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div>');
        $.post('../ajax/cliente/dataCliente.php', { rut: $('select[name="Rut"]').selectpicker('val') }, function(data) {
            $('.dataServicios').html('');
            values = $.parseJSON(data);
            $('.dataServicios').html(values[1]);
            $('select[name="TipoFactura"]').empty()
            $('select[name="TipoFactura"]').append(values[2])
            $('select[name="TipoFactura"]').selectpicker('refresh');
            var count = $('.dataServicios > .tabeData tr th').length - 1;
            $('.dataServicios > .tabeData').dataTable({
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

    function isNumber(n) {
        return !isNaN(parseFloat(n)) && isFinite(n);
    }

    function latRange(n) {
        return Math.min(Math.max(parseInt(n), -maxLat), maxLat);
    }

    function lngRange(n) {
        return Math.min(Math.max(parseInt(n), -180), 180);
    }

    $('[name="UsuarioPppoeTeorico"]').on('blur', function(event) {
        var camo = this;
        $.post('../ajax/servicios/UsuarioPppoeTeorico.php', { user: $(this).val() }, function(data) {
            if (data == "true") {
                $(camo).parent('.form-group').addClass('has-error');
                $(camo).val('');
                bootbox.alert('<h3 class="text-center">El usuario Pppoe ya esta registrado.</h3>');

            }
        });
    });

    $('select[name="TipoServicio"]').change(function(event) {

        Latitud = $('#Latitud').val()
        Longitud = $('#Longitud').val()

        switch ($(this).val()) {
            case '1':
                url = "arriendoEquipos.php";
                $('#otrosServicios').show()
                break;
            case '2':
                url = "servicioInternet.php";
                $('#otrosServicios').show()
                break;
            case '3':
                url = "mensualidadPuertoPublicos.php";
                $('#otrosServicios').hide()
                $('#otrosServicios').find('input').val('');
                break;
            case '4':
                url = "mensualidadIPFija.php";
                $('#otrosServicios').hide()
                $('#otrosServicios').find('input').val('');
                break;
            case '5':
                url = "mantencionRed.php";
                $('#otrosServicios').hide()
                $('#otrosServicios').find('input').val('');
                break;
            case '6':
                url = "traficoGenerado.php";
                $('#otrosServicios').hide()
                $('#otrosServicios').find('input').val('');
                break;
            case '7':
                url = "otroServicio.php";
                $('#otrosServicios').hide()
                $('#otrosServicios').find('input').val('');
                break;
            default:
                url = "404.html";
                $('#otrosServicios').hide()
                $('#otrosServicios').find('input').val('');
        }

        $('#Latitud').val(Latitud)
        $('#Longitud').val(Longitud)

        if (Latitud && Longitud) {
            Resize(Latitud, Longitud)
        }

        $('.containerTipoServicioFormulario').load('../clientesServicios/viewTipoServicio/' + url, function() {
            $('select').selectpicker();
            if (url.trim() == 'arriendoEquipos.php' || url.trim() == 'servicioInternet.php') {
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
                    $('.selectpicker').selectpicker('refresh');
                }, 1000);
            }
        });
    });

    $('#BooleanCostoInstalacion').change(function(event) {
        if ($(this).val() == 1) {
            $('#divCostoInstalacion').show();
            $('input[name="CostoInstalacion"]').attr('validate', 'not_null')
        } else {
            $('#divCostoInstalacion').hide();
            $('input[name="CostoInstalacion"]').removeAttr('validate')
        }
    });

    iva_global = 1.19;

    $('#CostoInstalacion').on('change', function() {
        // CostoInstalacion = $(this).val();
        $('#CostoInstalacionPesos').text(formatcurrency(calcularDetalleTmp()));
        $('#CostoInstalacionIva').val($('#CostoInstalacion').val());
    });

    $('#moneda').on('change', function() {
        
        $('#CostoInstalacionPesos').text(formatcurrency(calcularDetalleTmp()));
        $('#CostoInstalacionIva').val($('#CostoInstalacion').val());
    });

    function calcularDetalleTmp() {
        calculaIva = 0;
        CostoInstalacionPesos = $('#CostoInstalacion').val();
        if (CostoInstalacionPesos) {
            CostoInstalacionPesos = CostoInstalacionPesos.replace(',00', '')
            CostoInstalacionPesos = CostoInstalacionPesos.replace('.', '')
            CostoInstalacionPesos = parseFloat(CostoInstalacionPesos)
        } else {
            CostoInstalacionPesos = 0;
        }
        var moneda = $('#moneda').val();
        if (moneda == 2) {    
            CostoInstalacionPesos = CostoInstalacionPesos * ValorUF;
        }else{
            calculaIva = CostoInstalacionPesos * iva_global;
            CostoInstalacionPesos = calculaIva;
        }
        
        return CostoInstalacionPesos;
    }
    function formatcurrency(n) {
        return n.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
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

    var swalFunction = function() {
        Rut = $('#Rut').val()
        swal({
            title: "Desea cobrar de inmediato el costo de instalacion?",
            text: "Confirmar facturación!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Si",
            cancelButtonText: "No",
            closeOnConfirm: true,
            allowOutsideClick: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "../ajax/servicios/updateCostoInstalacion.php",
                    type: 'POST',
                    data: "&id=" + servicio_id,
                    success: function(response) {
                        setTimeout(function() {
                            if (response == 1) {
                                setTimeout(function() {
                                    $('html,body').animate({
                                        scrollTop: $(".panel-heading").offset().top - 90,
                                    }, 1500);
                                }, 1000);
                                bootbox.alert('<h3 class="text-center">El servicio #' + servicio_id + ' se registro con éxito.</h3>');
                                $('#otrosServicios').hide()
                            } else {
                                swal('Solicitud no procesada', 'Ha ocurrido un error, intente nuevamente por favor', 'error');
                            }
                        }, 1000);
                    },
                    error: function() {
                        swal('Solicitud no procesada', 'Ha ocurrido un error, intente nuevamente por favor', 'error');
                    }
                });
            } else {
                bootbox.alert('<h3 class="text-center">El servicio #' + servicio_id + ' se registro con éxito.</h3>');
            }

            $('#formServicio')[0].reset();
            $('.selectpicker').selectpicker('refresh')
            $('#Rut').val(Rut)
            $('#divCostoInstalacion').show()
            $('.selectpicker').selectpicker('refresh')

        });
    };

    $(document).on('click', '.guardarServ', function() {
        BooleanCostoInstalacion = $('#BooleanCostoInstalacion').val();
        Rut = $('#Rut').val()
        $.postFormValues('../ajax/servicios/insertServicio.php', '.container-form', {}, function(data) {
            if (Number(data) > 0) {
                servicio_id = data
                if (BooleanCostoInstalacion == 1) {
                    swalExtend({
                        swalFunction: swalFunction,
                        hasCancelButton: true,
                        buttonNum: 1,
                        buttonColor: ["gray"],
                        buttonNames: ["Cancelar"],
                        clickFunctionList: [
                            function() {
                                $.post('../ajax/cliente/eliminarServicio.php', {
                                    id: servicio_id
                                }, function(data) {
                                    getServicios();
                                    swal.close()
                                });
                            }
                        ]
                    });
                } else {
                    bootbox.alert('<h3 class="text-center">El servicio #' + servicio_id + ' se registro con éxito.</h3>');
                    $('#formServicio')[0].reset();
                    $('.selectpicker').selectpicker('refresh')
                    $('#divCostoInstalacion').show()
                    $('#Rut').val(Rut)
                    $('select[name="Grupo"]').val(1000)
                    $('.selectpicker').selectpicker('refresh')
                    $('#otrosServicios').hide()
                    setTimeout(function() {
                        $('html,body').animate({
                            scrollTop: $(".panel-heading").offset().top - 90,
                        }, 1500);
                    }, 1000);
                }
                getServicios();
            } else {
                bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
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

        Rut = $('#Rut').val()

        $.postFormValues('../ajax/servicios/updateServicio.php', '#showServicio', {}, function(data) {
            if (data) {
                servicio_id = data
                bootbox.alert('<h3 class="text-center">El servicio se actualizo con éxito.</h3>');
                getServicios();
            } else {
                bootbox.alert('<h3 class="text-center">Se produjo un error al actualizar</h3>');
            }
        });
    });

    $(document).on('click', '.agregarTipoFacturacion', function() {
        $('.agregarTipoFacturacion').attr('disabled', 'disabled');
        $.postFormValues('../ajax/servicios/insertTipoFacturacion.php', '.containerTipoFactura', {}, function(data) {
            if (Number(data) > 0) {
                $('select[name="TipoFactura"]').load('../ajax/servicios/selectTipoFactura.php', function() {
                    $('select[name="TipoFactura"]').selectpicker('refresh');
                });
                bootbox.alert('<h3 class="text-center">El registro se realizo con éxito.</h3>');
                $('.modal').modal('hide')
            } else {
                bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
            }
        });
        $('.agregarTipoFacturacion').removeAttr('disabled');
    });

    $(document).on('click', '.agregarGrupo', function() {
        $.postFormValues('../ajax/servicios/insertGrupo.php', '.containerGrupo', {}, function(data) {
            if (Number(data) > 0) {
                $('select[name="Grupo"]').load('../ajax/servicios/listGrupo.php', function() {
                    $('select[name="Grupo"]').selectpicker('refresh');
                });
                bootbox.alert('<h3 class="text-center">Se registro con éxito.</h3>');
            } else {
                bootbox.alert('<h3 class="text-center">Se produjo un error al guardar</h3>');
            }
        });
    });

    $(document).on('click', '.guardarCliente', function() {
        $.postFormValues('../ajax/servicios/insertCliente.php', '.container-form2', {}, function(data) {
            if (Number(data) > 0) {
                $('.modal').modal('hide');
                bootbox.alert('<h3 class="text-center">El cliente con Rut #' + data + ' se registro con éxito.</h3>');
                $('select[name="Rut"]').load('../ajax/servicios/selectClientes.php', function() {
                    $('select[name="Rut"]').selectpicker('refresh');
                    getCliente(data)
                });
            } else {
                bootbox.alert('<h3 class="text-center">Se produjo un error al guardar el cliente.</h3>');
            }
        });
    });
    // refresh el id oculto de tipo Doc
    function getTipoDoc(Rut) {
        $.ajax({
            type: "GET",
            url: "../ajax/servicios/getTipoDoc.php",
            dataType: "json",
            data: "Rut=" + Rut,
            success: function(response) {
                if(response.tipo_cliente != ''){
                    $('#getTipoDoc').val(response.tipo_cliente);
                    setTimeout(() => {
                        $('#getTipoDoc').selectpicker('refresh');
                    }, 1000); 
                }else{
                    bootbox.alert('<h3 class="text-center">No existe el id de tipo Cliente.</h3>');
                }
            }
        });
    }

    function getCliente(Rut) {
        $('#Rut').val(Rut);
        setTimeout(() => {
            $('#Rut').selectpicker('refresh');
            if(Rut != '') {
                getServicios();
            }
        }, 1000); 
    }
    $(document).on('change', 'select[name="Rut"]', function() {
        servicio_rut_dv = $(this).find('option:selected').data('rut');
        $("#servicio_rut_dv").val(servicio_rut_dv);
        
        servicio_nombre_cliente = $(this).find('option:selected').data('nombre-cliente');
        $("#servicio_nombre_cliente").val(servicio_nombre_cliente);
            
        getCliente($(this).val())
        getTipoDoc($(this).val())
    });

    $(document).on('click', '.listDatosTecnicos', function() {
        var id = $(this).attr('attr');
        ListDatosTecnicos(id)
    });

    function ListDatosTecnicos(id) {
        $('.containerListDatosTecnicos').html('<div style="text-align:center; font-size:15px;">Cargando Informacion...</div><div class="spinner loading"></div>');
        $.post('../ajax/cliente/tipolistModal.php', {
            id: id
        }, function(data) {
            $.post('../ajax/cliente/' + data, {
                id: id
            }, function(data) {
                $('.containerListDatosTecnicos').html(data);
                var count = $('.containerListDatosTecnicos > .tabeData tr th').length - 1;
                $('.containerListDatosTecnicos > .tabeData').dataTable({
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
                getServicios();
            });
        });
    }

    $(document).on('click', '.agregarDatosTecnicos', function() {
        $('.containerTipoServicio').html('<div style="text-align:center; font-size:15px;">Cargando Informacion...</div><div class="spinner loading"></div>');
        var id = $(this).attr('attr');

        $.post('../ajax/cliente/tipoViewModal.php', {
            id: id
        }, function(data) {

            $('.containerTipoServicio').load('../clientesServicios/viewTipoServicio/' + data, function() {
                $('[name="idServicio"]').val(id);
                $('#destino_id').val(id)
                $('.selectpicker').selectpicker();
                if (data.trim() == 'arriendoEquipos.php') {

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
                        $('#showServicio').find('#' + name).val('');
                        $('#showServicio').find('#' + name).val(value);
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
                    $.post('../ajax/cliente/eliminarServicio.php', {
                        id: id
                    }, function(data) {
                        getServicios();
                    });
                }
            }
        });
    });

    $(document).on('click', '.guardarDatosTecnicos', function() {
        var url = $('.container-form-datosTecnicos').attr('attr');
        $.postFormValues('../ajax/cliente/' + url, '.container-form-datosTecnicos', {}, function(data) {
            if (Number(data) > 0) {
                var id = $('.containerListDatosTecnicos').attr('idTipoLista');
                $('.modal').modal('hide')
                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Guardado Exitosamente',
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

    $('input[name="Rut"]').on('blur', function () {

        rut = $(this).val()
        input = $(this)

        if (rut) {
            $.post('../ajax/cliente/listCliente.php', { rut: rut }, function (data) {
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
                    }, function (isConfirm) {
                        if (isConfirm) {
                            window.location = "../clientes/listaCliente.php?Rut=" + rut;
                        } else {
                            $(input).val('')
                        }
                    });
                } else {
                    $.post('../ajax/cliente/getDv.php', { rut: rut }, function (data) {
                        $('#Dv').val(data)
                    });
                }
            });
        }
    });

    $(document).on('click', '.estatusServicio', function() {
        
        $('body').removeClass('loaded');
        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = $(this).attr('attr');
        var ObjectCode = ObjectTR.find("td").eq(0).text();
        $('.Codigo').text(ObjectCode);
        $('#servicio_codigo_cliente').val(ObjectCode);
        
        $('.Id').val(ObjectId);

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
        $("#updateEstatus").attr('disabled', 'disabled');
        $('#loader_servicios').html('<div style="text-align:center; font-size:15px;">Enviando Solicitud...</div><div class="spinner loading"></div>');
        $.postFormValues('../ajax/servicios/updateEstatus.php', '#formEstatus', {}, function(data) {
            if (data == 1) {
                $('.modal').modal('hide');
                alertas('success', 'Registro Actualizado Exitosamente.');
            } else if (data == 2) {
                alertas('danger', 'La fecha de activación debe ser mayor al dia de hoy.');
                // bootbox.alert('<h3 class="text-center">La fecha de activación debe ser mayor al dia de hoy.</h3>');
            } else if (data == 3) {
                alertas('danger', 'La fecha de activación es requerida.');
                // bootbox.alert('<h3 class="text-center">La fecha de activación es requerida.</h3>');
            } else if(data == 4) {
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

    $('select[name="TipoCliente"]').on('change', function() {
        if ($(this).val() == "1") {
            $('input[name="Giro"]').removeAttr('validate')
        } else {
            $('input[name="Giro"]').attr('validate', 'not_null')
        }
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

    $(document).on('change', 'select[name="Region"]', function() {
        if ($(this).selectpicker('val') != '') {
            $('select[name="Ciudad"]').load('../ajax/cliente/getCiudades.php', { Region: $(this).selectpicker('val') }, function(data) {
                $('select[name="Ciudad"]').selectpicker('refresh');
            });
        }
    });

    $(document).on('click', '.updateDatosTecnicos', function() {
        $('.containerTipoServicio').html('<div style="text-align:center; font-size:15px;">Cargando Informacion...</div><div class="spinner loading"></div>');
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