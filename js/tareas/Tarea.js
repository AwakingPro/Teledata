var maxLat = Math.atan(Math.sinh(Math.PI)) * 180 / Math.PI;
var center
var mapOptions
var map
var mapCenter

$(document).ready(function() {

    google.maps.event.addDomListener(window, 'load', initialize);

    function initialize() {

        center = new google.maps.LatLng(0, 0);

        mapOptions = {
            zoom: 14,
            center: center,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        Mapa = new google.maps.Map(document.getElementById("Map"), mapOptions);
    }

    $('select').selectpicker({ language: 'ES' });
    $('select').selectpicker('refresh');

    $('[name="Valor"]').number(true, 2, ',', '.');

    $('select[name="Rut"]').load('../ajax/servicios/selectClientes.php', function() {
        $('select[name="Rut"]').selectpicker();
    });

    $('select[name="TipoFactura"]').load('../ajax/servicios/selectTipoFactura.php', function() {
        $('select[name="TipoFactura"]').selectpicker();
    });
    $('select[name="IdServicio"]').load('../ajax/servicios/selectTipoServicio.php', function() {
        $('select[name="IdServicio"]').selectpicker();
    });

    $('select[name="Grupo"]').load('../ajax/servicios/listGrupo.php', function() {
        $('select[name="Grupo"]').selectpicker('refresh');
    });

    $('.date').datetimepicker({
        locale: 'es',
        format: 'DD-MM-YYYY'
    });

    $.ajax({
        type: "POST",
        url: "../includes/inventario/egresos/showEstaciones.php",
        success: function(response) {
            $.each(response.array, function(index, array) {
                $('#EstacionFinal').append('<option value="' + array.id + '" data-content="' + array.nombre + '"></option>');
            });
            $('#EstacionFinal').selectpicker('refresh');
        }
    });

    PorHacerTable = $('#PorHacerTable').DataTable({
        "columnDefs": [{
            "targets": [0],
            "orderable": false
        }],
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,
        bInfo: false,
        // bFilter:false,
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

    AsignadasTable = $('#AsignadasTable').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,
        bInfo: false,
        // bFilter:false,
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

    PendientesTable = $('#PendientesTable').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,
        bInfo: false,
        // bFilter:false,
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

    FinalizadasTable = $('#FinalizadasTable').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,
        bInfo: false,
        // bFilter:false,
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

    $.ajax({
        type: "POST",
        url: "../includes/inventario/bodegas/showPersonal.php",
        success: function(response) {
            $.each(response.array, function(index, array) {
                if(array.tipo_usuario == '1' || array.tipo_usuario == '3')
                    $('.IdUsuarioAsignado').append('<option value="' + array.id + '" data-content="' + array.nombre + '"></option>');
            });
            
            setTimeout(function() {
                $('.IdUsuarioAsignado').selectpicker('refresh');
            }, 500)

        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/tareas/showServicios.php",
        success: function(response) {

            $.each(response.array, function(index, array) {

                if (array.Usuario) {
                    Usuario = array.Usuario
                } else {
                    Usuario = ''
                }

                if (array.EstatusInstalacion == 1) {

                    var rowNode = FinalizadasTable.row.add([
                        '' + Usuario + '',
                        '' + '<span style="cursor: pointer;" attrId = "' + array.IdPersonaEmpresa + '" class="dataClienteTable">' + array.Cliente + '</span>' + '',
                        '' + array.Codigo + '',
                        '' + array.Descripcion + '',
                        '' + array.FechaInstalacion + '',
                        '' + '<i title="Ver" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye Search"></i> <i title="Comparación" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-exchange Compare"></i>' + '',
                    ]).draw(false).node();

                    $(rowNode)
                        .attr('id', array.Id)
                        .addClass('text-center')

                } else if (array.EstatusInstalacion == 2) {

                    var rowNode = PendientesTable.row.add([
                        '' + Usuario + '',
                        '' + '<span style="cursor: pointer;" attrId = "' + array.IdPersonaEmpresa + '" class="dataClienteTable">' + array.Cliente + '</span>' + '',
                        '' + array.Codigo + '',
                        '' + array.Descripcion + '',
                        '' + array.Direccion + '',
                        '' + '<i title="Ver" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye Search"></i> <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-refresh Assign" title="Reasignar"></i> <i title="Editar" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Edit"></i>' + '',
                    ]).draw(false).node();

                    $(rowNode)
                        .attr('id', array.Id)
                        .addClass('text-center')

                    var rowNode = AsignadasTable.row.add([
                        '' + Usuario + '',
                        '' + '<span style="cursor: pointer;" attrId = "' + array.IdPersonaEmpresa + '" class="dataClienteTable">' + array.Cliente + '</span>' + '',
                        '' + array.Codigo + '',
                        '' + array.Descripcion + '',
                        '' + array.Direccion + '',
                        '' + '<i title="Ver" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye Search"></i> <i title="Reasignar" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-refresh Assign"></i> <i title="Editar" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Edit"></i>' + '',
                    ]).draw(false).node();

                    $(rowNode)
                        .attr('id', array.Id)
                        .addClass('text-center')

                } else if (array.EstatusInstalacion == 3) {

                    var rowNode = AsignadasTable.row.add([
                        '' + Usuario + '',
                        '' + '<span style="cursor: pointer;" attrId = "' + array.IdPersonaEmpresa + '" class="dataClienteTable">' + array.Cliente + '</span>' + '',
                        '' + array.Codigo + '',
                        '' + array.Descripcion + '',
                        '' + array.Direccion + '',
                        '' + '<i title="Ver" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye Search"></i> <i title="Reasignar" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-refresh Assign"></i> <i title="Editar" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Edit"></i>' + '',
                    ]).draw(false).node();

                    $(rowNode)
                        .attr('id', array.Id)
                        .addClass('text-center')

                } else {

                    if (array.FechaComprometidaInstalacion && array.FechaComprometidaInstalacion != '0000-00-00' && array.FechaComprometidaInstalacion != '1969-01-31') {
                        FechaComprometidaInstalacion = moment(array.FechaComprometidaInstalacion).format('DD-MM-YYYY');
                    } else {
                        FechaComprometidaInstalacion = ''
                    }

                    var rowNode = PorHacerTable.row.add([
                        '' + '<input name="select_check" id="select_check_"' + array.Id + ' type="checkbox" />' + '',
                        '' + '<span style="cursor: pointer;" attrId = "' + array.IdPersonaEmpresa + '" class="dataClienteTable">' + array.Cliente + '</span>' + '',
                        '' + array.Codigo + '',
                        '' + array.Descripcion + '',
                        '' + array.Direccion + '',
                        '' + FechaComprometidaInstalacion + '',
                        '' + '<i title="Ver" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye Search"></i>' + ''
                    ]).draw(false).node();

                    $(rowNode)
                        .attr('id', array.Id)
                        .addClass('text-center')
                }


            });

            $('body').addClass('loaded');
        }
    });

    $('#AsignarModal').click(function() {

        Tareas = getChecked();
        Tareas = Tareas.join();
        
        $('#Tareas').val(Tareas);

        $('#modalAsignar').modal('show');

    });

    $(document).on('click', '#Asignar', function() {

        $.postFormValues('../includes/tareas/asignarTareas.php', '#asignarTareas', {}, function(response) {

            if (response.status == 1) {

                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Guardado Exitosamente',
                    container: 'floating',
                    timer: 3000
                });

                Usuario = response.Usuario

                $.each(response.array, function(index, Id) {

                    Row = $('#' + Id)
                    Cliente = $(Row).find("td").eq(1).html();
                    Codigo = $(Row).find("td").eq(2).html();
                    Descripcion = $(Row).find("td").eq(3).html();
                    Direccion = $(Row).find("td").eq(4).html();
                    Operacion = '<i title="Ver" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye Search"></i> <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-refresh Assign"></i> <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Edit"></i>';

                    PorHacerTable.row(Row)
                        .remove()
                        .draw();

                    var rowNode = AsignadasTable.row.add([
                        '' + Usuario + '',
                        '' + Cliente + '',
                        '' + Codigo + '',
                        '' + Descripcion + '',
                        '' + Direccion + '',
                        '' + Operacion + '',
                    ]).draw(false).node();

                    $(rowNode)
                        .attr('id', Id)
                        .addClass('text-center')

                });


                $('#asignarTareas')[0].reset();
                $('.selectpicker').selectpicker('refresh')
                $('#select_all').prop('checked', false);
                $("#AsignarModal").attr("disabled", "disabled");
                $("#AsignarModal").css({
                    "opacity": ("0.2")
                });
                $('.modal').modal('hide');

            } else if (response.status == 2) {

                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Debe llenar todos los campos',
                    container: 'floating',
                    timer: 3000
                });

            } else if (response.status == 99) {

                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Debe llenar los datos de los productos',
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

    $(document).on('click', '#Reasignar', function() {

        $.postFormValues('../includes/tareas/reasignarTarea.php', '#reasignarTarea', {}, function(response) {

            if (response.status == 1) {

                $.niftyNoty({
                    type: 'success',
                    icon: 'fa fa-check',
                    message: 'Registro Guardado Exitosamente',
                    container: 'floating',
                    timer: 3000
                });

                Usuario = response.Usuario
                Row = $('#' + response.Id)
                Cliente = $(Row).find("td").eq(0).html(Usuario);

                $('#reasignarTarea')[0].reset();
                $('.selectpicker').selectpicker('refresh')
                $('.modal').modal('hide');

            } else if (response.status == 2) {

                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Debe llenar todos los campos',
                    container: 'floating',
                    timer: 3000
                });

            } else if (response.status == 99) {

                $.niftyNoty({
                    type: 'danger',
                    icon: 'fa fa-check',
                    message: 'Debe llenar los datos de los productos',
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

    $('body').on('click', 'i.fa-pencil', function() {

        $('body').removeClass('loaded');

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectId = ObjectTR.attr("id");
        var ObjectCode = ObjectTR.find("td").eq(2).text();
        $('#storeTarea').find('input[name="Id"]').val(ObjectId);
        $('.Codigo').text(ObjectCode);

        $.ajax({
            type: "POST",
            url: "../includes/tareas/showTarea.php",
            data: "id=" + ObjectId,
            success: function(response) {

                if (response) {

                    if (response.array.FechaInstalacion) {
                        FechaInstalacion = moment(response.array.FechaInstalacion).format('DD-MM-YYYY');
                    } else {
                        FechaInstalacion = ''
                    }

                    $('#modalTarea').find('input[name="FechaInstalacion"]').val(FechaInstalacion)
                    $('#modalTarea').find('select[name="InstaladoPor"]').val(response.array.IdUsuarioAsignado)
                    $('#modalTarea').find('input[name="UsuarioPppoe"]').val(response.array.UsuarioPppoe)
                    $('#modalTarea').find('input[name="UsuarioPppoeTeorico"]').val(response.array.UsuarioPppoeTeorico)
                    $('#modalTarea').find('input[name="SenalTeorica"]').val(response.array.SenalTeorica)
                    $('#modalTarea').find('input[name="SenalFinal"]').val(response.array.SenalFinal)
                    $('#modalTarea').find('input[name="PosibleEstacion"]').val(response.array.PosibleEstacion)
                    $('#modalTarea').find('input[name="EstacionFinal"]').val(response.array.EstacionFinal)
                    $('#modalTarea').find('textarea[name="Comentario"]').text(response.array.Comentario)

                }

                $('select').selectpicker('refresh')
                $('body').addClass('loaded');
                $('#modalTarea').modal('show');

            },
            error: function(xhr, status, error) {
                setTimeout(function() {
                    var err = JSON.parse(xhr.responseText);
                    swal('Solicitud no procesada', err.Message, 'error');
                }, 1000);
            }
        });
    });

    $(document).on('click', '#guardarTarea', function() {
        swal({
            title: "Desea confirmar la fecha de instalación?",
            text: "Esto generara una factura proporcional que no puede ser modificada",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#28a745",
            confirmButtonText: "Si",
            cancelButtonText: "No",
            closeOnConfirm: true,
            allowOutsideClick: false
        }, function(isConfirm) {
            if (isConfirm) {
                $.postFormValues('../includes/tareas/storeTarea.php', '#storeTarea', {}, function(response) {

                    if (response.status == 1) {

                        $.niftyNoty({
                            type: 'success',
                            icon: 'fa fa-check',
                            message: 'Registro Guardado Exitosamente',
                            container: 'floating',
                            timer: 3000
                        });

                        Row = $('#' + response.Id)[0]
                        Usuario = $(Row).find("td").eq(0).html();
                        Cliente = $(Row).find("td").eq(1).html();
                        Codigo = $(Row).find("td").eq(2).html();
                        Descripcion = $(Row).find("td").eq(3).html();
                        FechaInstalacion = $(Row).find("td").eq(4).html();
                        console.log('Row '+ response.Id[0])
                        if (response.Estatus == 1) {

                            var nodes = AsignadasTable.rows().nodes()
                            if ($(nodes).filter('tr#' + response.Id).length == 1) {
                                AsignadasTable.row(Row)
                                    .remove()
                                    .draw();
                            }

                            var nodesPendientesTable = PendientesTable.rows().nodes()
                            if ($(nodesPendientesTable).filter('tr#' + response.Id).length == 1) {
                                PendientesTable.row(Row)
                                    .remove()
                                    .draw();
                            }

                            Operacion = '<i title="Ver"  style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye Search"></i> <i title="Comparación" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-exchange Compare"></i>'

                            var rowNode = FinalizadasTable.row.add([
                                '' + Usuario + '',
                                '' + Cliente + '',
                                '' + Codigo + '',
                                '' + Descripcion + '',
                                '' + FechaInstalacion + '',
                                '' + Operacion + '',
                            ]).draw(false).node();
                            console.log('row '+Row);
                            $(rowNode)
                                .attr('id', response.Id)
                                .addClass('text-center')

                        } else {
                            console.log('Direccion antes '+Direccion)
                            var Direccion = $(Row).find("td").eq(4).html();
                            console.log('Direccion despues '+Direccion)
                            console.log('response.Estatus else es '+ response.Estatus)
                            var nodesPendientesTable = PendientesTable.rows().nodes()
                            if ($(nodesPendientesTable).filter('tr#' + response.Id).length == 0) {

                                Operacion = '<i title="Ver" style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-eye Search"></i> <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-refresh Assign" title="Reasignar"></i> <i style="cursor: pointer; margin: 0 10px; font-size:15px;" title="Editar" class="fa fa-pencil Edit"></i>'
                                
                                var rowNode = PendientesTable.row.add([
                                    '' + Usuario + '',
                                    '' + Cliente + '',
                                    '' + Codigo + '',
                                    '' + Descripcion + '',
                                    '' + Direccion + '',
                                    '' + Operacion + '',
                                ]).draw(false).node();
                                
                                $(rowNode)
                                    .attr('id', response.Id)
                                    .addClass('text-center')
                            }
                        }

                        $('#storeTarea')[0].reset();
                        $('.modal').modal('hide');

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
                            message: 'La fecha de instalación no puede ser mayor a hoy',
                            container: 'floating',
                            timer: 3000
                        });

                    } else if (response.status == 99) {

                        $.niftyNoty({
                            type: 'danger',
                            icon: 'fa fa-check',
                            message: 'Debe llenar los datos de los productos',
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
            }
        });
    });

    $('body').on('click', 'i.fa-refresh', function() {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectId = ObjectTR.attr("id");
        var ObjectCode = ObjectTR.find("td").eq(2).text();
        $('#reasignarTarea').find('input[name="Id"]').val(ObjectId);
        $('.Codigo').text(ObjectCode);

        $('#modalReasignar').modal('show');

    })

    function getChecked() {

        var checked = [];

        $('#PorHacerTable tr').each(function(i, row) {
            var actualrow = $(row);
            checkbox = actualrow.find('input:checked').val();
            if (checkbox == 'on') {
                var id = $(actualrow).attr('id');
                checked[i] = id;
            }
        });

        return checked;
    }

    $('#select_all').on('click', function() {
        var rows = PorHacerTable.rows({ 'search': 'applied' }).nodes();
        
        $('input[type="checkbox"]', rows).prop('checked', this.checked);

        values = getChecked();
        
        if (values.length > 0) {

            $("#AsignarModal").removeAttr("disabled");
            $("#AsignarModal").css({
                "opacity": ("1")
            });

        } else {
            $("#AsignarModal").attr("disabled", "disabled");
            $("#AsignarModal").css({
                "opacity": ("0.2")
            });
        }
    });

    $('#PorHacerTable tbody').on('click', 'input[type="checkbox"]', function() {
        values = getChecked();
        if (values.length > 0) {

            $("#AsignarModal").removeAttr("disabled");
            $("#AsignarModal").css({
                "opacity": ("1")
            });

        } else {
            $("#AsignarModal").attr("disabled", "disabled");
            $("#AsignarModal").css({
                "opacity": ("0.2")
            });
        }
    });

    $(document).on('click', '.Compare', function() {

        $('body').removeClass('loaded');

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("id");
        var ObjectCode = ObjectTR.find("td").eq(2).text();
        $('.Codigo').text(ObjectCode);

        $.ajax({
            type: "POST",
            url: "../includes/tareas/showTarea.php",
            data: "id=" + ObjectId,
            success: function(response) {

                if (response) {
                    $('#modalComparacion').find('#UsuarioPppoeTeorico_update').val(response.array.UsuarioPppoeTeorico)
                    $('#modalComparacion').find('#UsuarioPppoeFinal_update').val(response.array.UsuarioPppoe)

                    $('#modalComparacion').find('#SenalTeorica_update').val(response.array.SenalTeorica)
                    $('#modalComparacion').find('#SenalFinal_update').val(response.array.SenalFinal)

                    $('#modalComparacion').find('#PosibleEstacion_update').val(response.array.PosibleEstacion)
                    $('#modalComparacion').find('#EstacionFinal_update').val(response.array.EstacionFinalNombre)
                }

                $('body').addClass('loaded');

                $('#modalComparacion').modal('show')
            },
            error: function(xhr, status, error) {
                setTimeout(function() {
                    var err = JSON.parse(xhr.responseText);
                    swal('Solicitud no procesada', err.Message, 'error');
                }, 1000);
            }
        });

    });

    $(document).on('click', '.Search', function() {

        $('body').removeClass('loaded');

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectId = ObjectTR.attr("id");
        var ObjectCode = ObjectTR.find("td").eq(2).text();
        $('.Codigo').text(ObjectCode);

        $.ajax({
            type: "POST",
            url: "../includes/tareas/showTarea.php",
            data: "id=" + ObjectId,
            success: function(response) {

                array = response.array

                for (var name in array) {
                    var value = array[name];
                    if (name == "Descripcion" || name == "Direccion") {
                        $('#showServicio').find('#' + name).text(value);
                    } else {
                        $('#showServicio').find('#' + name).val(value);
                    }
                }

                $('select').selectpicker('refresh')

                latitud = $('#showServicio').find('input[name="Latitud"]').val();
                longitud = $('#showServicio').find('input[name="Longitud"]').val();

                if (latitud && longitud) {

                    mapCenter = new google.maps.LatLng(latitud, longitud);

                    setTimeout(function() {
                        google.maps.event.trigger(Mapa, "resize");
                        Mapa.setCenter(mapCenter);
                        Mapa.setZoom(Mapa.getZoom());
                        var marker = new google.maps.Marker({
                            map: Mapa,
                            draggable: true,
                            position: mapCenter
                
                        });
                
                        google.maps.event.addListener(marker, 'dragend', function(evt) {
                            $('#Latitud').val(evt.latLng.lat())
                            $('#Longitud').val(evt.latLng.lng())
                        });
                    }, 1000)
                }

                $('body').addClass('loaded');
                $('#modalServicio').modal('show')
            },
            error: function(xhr, status, error) {
                setTimeout(function() {
                    var err = JSON.parse(xhr.responseText);
                    swal('Solicitud no procesada', err.Message, 'error');
                }, 1000);
            }
        });

    });

    $(document).on('click', '.dataClienteTable', function(event) {
        $('.container-dataCliente').html('<div style="text-align:center; font-size:15px;">Cargando Informacion...</div><div class="spinner loading"></div>');
        $('#InfoClienteTable').modal('show');
        $.post('../ajax/tarea/dataCliente.php', { id: $(this).attr('attrId') }, function(data) {
            $('.container-dataCliente').html(data);
        });
    });

    $('#Estatus').change(function(event) {
        console.log($(this).val());
        if ($(this).val() == 1) {
            $('#Comentario').removeAttr('validate')
        } else {
            $('#Comentario').attr('validate', 'not_null')
        }
    });
});