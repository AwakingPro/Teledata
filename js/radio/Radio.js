$(document).ready(function(){

    EstacionTable = $('#EstacionTable').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,  
        bInfo:false,
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

    $.ajax({
        type: "POST",
        url: "../includes/radio/showEstaciones.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                var rowNode = EstacionTable.row.add([
                  ''+array.nombre+'',
                  ''+array.direccion+'',
                  ''+array.telefono+'',
                  ''+array.personal+'',
                  ''+array.correo+'',
                  ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-search Find"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id','estacion_'+array.id)
                    .data('personal_id',array.personal_id)
                    .addClass('text-center');

                $('.estacion_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
            });
        
            
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/radio/showInventario.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.producto_id').append('<option value="'+array.id+'" data-content="'+array.mac_address+'"></option>');
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
        
        }
    });

    $.ajax({
        type: "POST",
        url: "../includes/radio/showPersonal.php",
        success: function(response){

            $.each(response.array, function( index, array ) {
                $('.personal_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
        
        }
    });

    $('body').on('click', '#guardarEstacion', function () {


        $.postFormValues('../includes/radio/storeEstacion.php', '#storeEstacion', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Personal = $('#personal_id option[value="'+response.array.personal_id+'"]').first().data('content');

                var rowNode = EstacionTable.row.add([
                  ''+response.array.nombre+'',
                  ''+response.array.direccion+'',
                  ''+response.array.telefono+'',
                  ''+Personal+'',
                  ''+response.array.correo+'',
                  ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-search Find"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id','estacion_'+response.array.id)
                    .data('personal_id',response.array.personal_id)
                    .addClass('text-center');

                $('.estacion_id').append('<option value="'+response.array.id+'" data-content="'+response.array.nombre+'"></option>');
                $('.estacion_id').val(response.array.id);

                $('#storeEstacion')[0].reset();
                $('.selectpicker').selectpicker('render');
                $('.selectpicker').selectpicker('refresh');
                $('.modal').modal('hide');

            }else if(response.status == 2){

                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Debe llenar todos los campos',
                    container : 'floating',
                    timer : 3000
                });

            }else{

                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Ocurrio un error en el Proceso',
                    container : 'floating',
                    timer : 3000
                });

            }
             
        });
    });

    $('#EstacionTable tbody').on( 'click', 'i.fa', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectRow = ObjectTR.attr("id");
        var RowSplit = ObjectRow.split('_');
        var ObjectId = RowSplit[1];
        var ObjectName = ObjectTR.find("td").eq(0).text();
        var ObjectAddress = ObjectTR.find("td").eq(1).text();
        var ObjectTelephone = ObjectTR.find("td").eq(2).text();
        var ObjectPersonal = ObjectTR.data("personal_id");
        var ObjectEmail = ObjectTR.find("td").eq(4).text();
        $('#updateEstacion').find('input[name="id"]').val(ObjectId);
        $('#updateEstacion').find('input[name="nombre"]').val(ObjectName);
        $('#updateEstacion').find('textarea[name="direccion"]').text(ObjectAddress);
        $('#updateEstacion').find('input[name="telefono"]').val(ObjectTelephone);
        $('#updateEstacion').find('select[name="personal_id"]').val(ObjectPersonal);
        $('#updateEstacion').find('input[name="correo"]').val(ObjectEmail);

        if($(this).hasClass('fa-search')){
            $("#EstacionFormUpdate :input").attr("readonly", true);
            $('#span_estacion').text('Ver');
            $('#actualizarEstacion').hide()
            $('#EstacionFormUpdate').modal('show');
        }else if($(this).hasClass('fa-pencil')){
            $("#EstacionFormUpdate :input").attr("readonly", false);
            $('#span_estacion').text('Actualizar');
            $('#actualizarEstacion').show()
            $('#EstacionFormUpdate').modal('show');
        }

        $('.selectpicker').selectpicker('render');
        $('.selectpicker').selectpicker('refresh');
  
    });

    $('body').on('click', '#actualizarEstacion', function () {

        var data = $('#updateEstacion').serialize();
        var array = $('#updateEstacion').serializeArray();

        $.postFormValues('../includes/radio/updateEstacion.php', '#updateEstacion', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Actualizado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Personal = $('#personal_id option[value="'+response.array.personal_id+'"]').first().data('content');

                ObjectTR = $("#estacion_"+response.array.id);
                ObjectTR.data('personal_id', response.array.personal_id)
                ObjectTR.find("td").eq(0).html(response.array.nombre);
                ObjectTR.find("td").eq(1).html(response.array.direccion);
                ObjectTR.find("td").eq(2).html(response.array.telefono);
                ObjectTR.find("td").eq(3).html(Personal);
                ObjectTR.find("td").eq(4).html(response.array.correo);
                
                $('.modal').modal('hide');
                

            }else if(response.status == 2){
                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Debe llenar todos los campos',
                    container : 'floating',
                    timer : 3000
                });
            }else{
                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Ocurrio un error en el Proceso',
                    container : 'floating',
                    timer : 3000
                });
            }
        });
    });

    $('#EstacionTable tbody').on( 'click', '.Remove', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectRow = ObjectTR.attr("id");
        var RowSplit = ObjectRow.split('_');
        var ObjectId = RowSplit[1];

        swal({   
            title: "Desea eliminar este registro?",   
            text: "Confirmar eliminación!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Eliminar!",  
            cancelButtonText: "Cancelar",         
            closeOnConfirm: true 
        },function(isConfirm){   
            if (isConfirm) {
    
                $.ajax({
                    url: "../includes/radio/deleteEstacion.php",
                    type: 'POST',
                    data:"&id="+ObjectId,
                    success:function(response){
                        setTimeout(function() {
                            if(response.status == 1){
                                swal("Exito!","El registro ha sido eliminado!","success");
                                EstacionTable.row($(ObjectTR))
                                    .remove()
                                    .draw();
                                $(".estacion_id option[value='"+ObjectId+"']").remove();
                            }else if(response.status == 3){
                                swal('Solicitud no procesada','Este registro no puede ser eliminado porque posee otros registros asociados','error');
                            }else{
                                swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
                            }
                        }, 1000);  
                    },
                    error:function(){
                        swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
                    }
                });
            }
        });
    });

    IngresoTable = $('#IngresoTable').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,  
        bInfo:false,
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

    $.ajax({
        type: "POST",
        url: "../includes/radio/showIngresos.php",
        success: function(response){

            $.each(response.array, function( index, array ) {

                var rowNode = IngresoTable.row.add([
                  ''+array.estacion+'',
                  ''+array.funcion+'',
                  ''+array.alarma_activada+'',
                  ''+array.direccion_ip+'',
                  ''+array.puerto_acceso+'',
                  ''+array.ancho_canal+'',
                  ''+array.frecuencia+'',
                  ''+array.tx_power+'',
                  ''+array.mac_address+'',
                  ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-search Find"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id','ingreso_'+array.id)
                    .data('estacion_id',array.estacion_id)
                    .addClass('text-center');
            });
        }
    });

    $('body').on('click', '#guardarIngreso', function () {


        $.postFormValues('../includes/radio/storeIngreso.php', '#storeIngreso', function(response){

            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Guardado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Estacion = $('#estacion_id option[value="'+response.array.estacion_id+'"]').first().data('content');
                Producto = $('#producto_id option[value="'+response.array.producto_id+'"]').first().data('content');

                var rowNode = IngresoTable.row.add([
                  ''+Estacion+'',
                  ''+response.array.funcion+'',
                  ''+response.array.alarma_activada+'',
                  ''+response.array.direccion_ip+'',
                  ''+response.array.puerto_acceso+'',
                  ''+response.array.ancho_canal+'',
                  ''+response.array.frecuencia+'',
                  ''+response.array.tx_power+'',
                  ''+Producto+'',
                  ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-search Find"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id','ingreso_'+response.array.id)
                    .data('estacion_id',response.array.estacion_id)
                    .data('producto_id',response.array.producto_id)
                    .addClass('text-center');

                $('#storeIngreso')[0].reset();
                $('.selectpicker').selectpicker('render');
                $('.selectpicker').selectpicker('refresh');
                $('.modal').modal('hide');

            }else if(response.status == 2){

                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Debe llenar todos los campos',
                    container : 'floating',
                    timer : 3000
                });

            }else{

                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Ocurrio un error en el Proceso',
                    container : 'floating',
                    timer : 3000
                });

            }
             
        });
    });

    $('#IngresoTable tbody').on( 'click', 'i.fa', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        ObjectTR.addClass("Selected");
        var ObjectRow = ObjectTR.attr("id");
        var RowSplit = ObjectRow.split('_');
        var ObjectId = RowSplit[1];
        var ObjectStation = ObjectTR.data("estacion_id");
        var ObjectFunction = ObjectTR.find("td").eq(1).text();
        var ObjectIp = ObjectTR.find("td").eq(2).text();
        var ObjectPort = ObjectTR.find("td").eq(3).text();
        var ObjectChannel = ObjectTR.find("td").eq(4).text();
        var ObjectFrecuency = ObjectTR.find("td").eq(5).text();
        var ObjectPower = ObjectTR.find("td").eq(6).text();
        var ObjectProduct = ObjectTR.data("producto_id");

        $('#updateIngreso').find('input[name="id"]').val(ObjectId);
        $('#updateIngreso').find('select[name="estacion_id"]').val(ObjectStation);
        $('#updateIngreso').find('input[name="funcion"]').val(ObjectFunction);
        $('#updateIngreso').find('input[name="direccion_ip"]').val(ObjectIp);
        $('#updateIngreso').find('input[name="puerto_acceso"]').val(ObjectPort);
        $('#updateIngreso').find('input[name="ancho_canal"]').val(ObjectChannel);
        $('#updateIngreso').find('input[name="frecuencia"]').val(ObjectFrecuency);
        $('#updateIngreso').find('input[name="tx_power"]').val(ObjectPower);
        $('#updateIngreso').find('select[name="producto_id"]').val(ObjectProduct);

        if($(this).hasClass('fa-search')){
            $("#IngresoFormUpdate :input").attr("readonly", true);
            $('#span_ingreso').text('Ver');
            $('#actualizarIngreso').hide()
            $('#IngresoFormUpdate').modal('show');
        }else if($(this).hasClass('fa-pencil')){
            $("#IngresoFormUpdate :input").attr("readonly", false);
            $('#span_ingreso').text('Actualizar');
            $('#actualizarIngreso').show()
            $('#IngresoFormUpdate').modal('show');
        }

        $('.selectpicker').selectpicker('render');
        $('.selectpicker').selectpicker('refresh');
  
    });

    $('body').on('click', '#actualizarIngreso', function () {

        $.postFormValues('../includes/radio/updateIngreso.php', '#updateIngreso', function(response){
                    
            if(response.status == 1){

                $.niftyNoty({
                    type: 'success',
                    icon : 'fa fa-check',
                    message : 'Registro Actualizado Exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Estacion = $('#estacion_id option[value="'+response.array.estacion_id+'"]').first().data('content');
                Producto = $('#producto_id option[value="'+response.array.producto_id+'"]').first().data('content');

                ObjectTR = $("#ingreso_"+response.array.id);
                
                ObjectTR.data('estacion_id',response.array.estacion_id)
                ObjectTR.data('producto_id', response.array.producto_id)
                ObjectTR.find("td").eq(0).html(Estacion);
                ObjectTR.find("td").eq(1).html(response.array.funcion);
                ObjectTR.find("td").eq(2).html(response.array.alarma_activada);
                ObjectTR.find("td").eq(3).html(response.array.direccion_ip);
                ObjectTR.find("td").eq(4).html(response.array.puerto_acceso);
                ObjectTR.find("td").eq(5).html(response.array.ancho_canal);
                ObjectTR.find("td").eq(6).html(response.array.frecuencia);
                ObjectTR.find("td").eq(7).html(response.array.tx_power);
                ObjectTR.find("td").eq(8).html(Producto);

                $('.modal').modal('hide');
                

            }else if(response.status == 2){
                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Debe llenar todos los campos',
                    container : 'floating',
                    timer : 3000
                });
            }else{
                $.niftyNoty({
                    type: 'danger',
                    icon : 'fa fa-check',
                    message : 'Ocurrio un error en el Proceso',
                    container : 'floating',
                    timer : 3000
                });
            }
        });   
    });

    $('#IngresoTable tbody').on( 'click', '.Remove', function () {

        var ObjectMe = $(this);
        var ObjectTR = ObjectMe.closest("tr");
        var ObjectRow = ObjectTR.attr("id");
        var RowSplit = ObjectRow.split('_');
        var ObjectId = RowSplit[1];

        swal({   
            title: "Desea eliminar este registro?",   
            text: "Confirmar eliminación!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Eliminar!",  
            cancelButtonText: "Cancelar",         
            closeOnConfirm: true 
        },function(isConfirm){   
            if (isConfirm) {
    
                $.ajax({
                    url: "../includes/radio/deleteIngreso.php",
                    type: 'POST',
                    data:"&id="+ObjectId,
                    success:function(response){
                        setTimeout(function() {
                            if(response.status == 1){
                                swal("Exito!","El registro ha sido eliminado!","success");
                                IngresoTable.row($(ObjectTR))
                                    .remove()
                                    .draw();
                            }else if(response.status == 3){
                                swal('Solicitud no procesada','Este registro no puede ser eliminado porque posee otros registros asociados','error');
                            }else{
                                swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
                            }
                        }, 1000);  
                    },
                    error:function(){
                        swal('Solicitud no procesada','Ha ocurrido un error, intente nuevamente por favor','error');
                    }
                });
            }
        });
    });

    BusquedaIngresoTable = $('#BusquedaIngresoTable').DataTable({
        paging: false,
        iDisplayLength: 100,
        processing: true,
        serverSide: false,  
        bInfo:false,
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

    $('body').on('click', '#buscarRegistro', function () {

        tipo_busqueda_ingreso = $('#tipo_busqueda_ingreso').val();
        input_registro = $('#input_registro').val();

        if(input_registro){

            BusquedaIngresoTable.clear().draw();

            $.ajax({
                type: "POST",
                url: "../includes/radio/buscarRegistro.php",
                data:"&tipo_busqueda_ingreso="+tipo_busqueda_ingreso+"&input_registro="+input_registro,
                success: function(response){

                    if(response.status == 1){

                        $.niftyNoty({
                            type: 'success',
                            icon : 'fa fa-check',
                            message : 'Busqueda Realizada Exitosamente',
                            container : 'floating',
                            timer : 3000
                        });

                        $.each(response.array, function( index, array ) {

                            var rowNode = BusquedaIngresoTable.row.add([
                              ''+array.estacion+'',
                              ''+array.funcion+'',
                              ''+array.alarma_activada+'',
                              ''+array.direccion_ip+'',
                              ''+array.puerto_acceso+'',
                              ''+array.ancho_canal+'',
                              ''+array.frecuencia+'',
                              ''+array.tx_power+'',
                              ''+array.mac_address+'',
                            ]).draw(false).node();

                            $( rowNode )
                                .attr('id','ingreso_'+array.id)
                                .data('estacion_id',array.estacion_id)
                                .addClass('text-center');
                        });
                    }else if(response.status == 2){

                        $.niftyNoty({
                            type: 'danger',
                            icon : 'fa fa-check',
                            message : 'Debe llenar el campo de busqueda',
                            container : 'floating',
                            timer : 3000
                        });

                    }else{

                        $.niftyNoty({
                            type: 'danger',
                            icon : 'fa fa-check',
                            message : 'No se encontraron registros',
                            container : 'floating',
                            timer : 3000
                        });

                    }
                }
            });
        }
    });

    $('#tipo_busqueda_ingreso').on('change', function () {

        $('#input_registro').empty();
        $('#input_registro').append(new Option('Seleccione',''));

        tipo_busqueda_ingreso = $('#tipo_busqueda_ingreso').val();

        if(tipo_busqueda_ingreso){

            $.ajax({
                type: "POST",
                url: "../includes/radio/showSelectpicker.php",
                data:"&tipo_busqueda_ingreso="+tipo_busqueda_ingreso,
                success: function(response){
                    $.each(response.array, function( index, array ) {
                        if(tipo_busqueda_ingreso == 1){
                            $('#input_registro').append('<option value="'+array.estacion+'" data-content="'+array.estacion+'"></option>');
                        }else if(tipo_busqueda_ingreso == 2){
                            $('#input_registro').append('<option value="'+array.direccion_ip+'" data-content="'+array.direccion_ip+'"></option>');
                        }else{
                            $('#input_registro').append('<option value="'+array.mac_address+'" data-content="'+array.mac_address+'"></option>');
                        }
                    });
                }
            })

        }

        setTimeout(function() {       
            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
        }, 1000);

    });
});