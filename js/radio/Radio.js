// Calculate maximum latitude value on mercator projection
var maxLat = Math.atan(Math.sinh(Math.PI)) * 180 / Math.PI;
var center
var mapOptions
var map
var mapCenter

$(document).ready(function(){

    google.maps.event.addDomListener(window, 'load', initialize);

    function initialize() {

        center = new google.maps.LatLng(0, 0);

        mapOptions = {
            zoom: 20,
            center: center,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        EstacionFormMap = new google.maps.Map(document.getElementById("EstacionFormMap"), mapOptions);
        EstacionFormSiteMap = new google.maps.Map(document.getElementById("EstacionFormSiteMap"), mapOptions);
        EstacionFormUpdateMap = new google.maps.Map(document.getElementById("EstacionFormUpdateMap"), mapOptions);
        EstacionFormUpdateSiteMap = new google.maps.Map(document.getElementById("EstacionFormUpdateSiteMap"), mapOptions);
    }

    function showMap(lat, lng) {

        // Validate user input as numbers
        lat = (!isNumber(lat) ? 0 : lat);
        lng = (!isNumber(lng) ? 0 : lng);

        // Create LatLng object
        mapCenter = new google.maps.LatLng(lat, lng);

        var marker = new google.maps.Marker({
            position: mapCenter,
            title: 'Marker title',
            map: EstacionFormUpdateMap
        });

        marker.setMap(EstacionFormUpdateMap);

        setTimeout(function() {
            google.maps.event.trigger(EstacionFormUpdateMap, "resize");
            EstacionFormUpdateMap.setCenter(mapCenter);
            EstacionFormUpdateMap.setZoom(EstacionFormUpdateMap.getZoom());
        }, 1000)
    }

    function showMapSite(lat, lng) {

        // Validate user input as numbers
        lat = (!isNumber(lat) ? 0 : lat);
        lng = (!isNumber(lng) ? 0 : lng);

        // Create LatLng object
        mapCenter = new google.maps.LatLng(lat, lng);

        var marker = new google.maps.Marker({
            position: mapCenter,
            title: 'Marker title',
            map: EstacionFormUpdateSiteMap
        });

        marker.setMap(EstacionFormUpdateSiteMap);

        setTimeout(function() {
            google.maps.event.trigger(EstacionFormUpdateSiteMap, "resize");
            EstacionFormUpdateSiteMap.setCenter(mapCenter);
            EstacionFormUpdateSiteMap.setZoom(EstacionFormUpdateSiteMap.getZoom());
        }, 1000)
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

    function validLatitude(lat){    
        return isFinite(lat) && Math.abs(lat) <= 90;
    }

    function validLongitude(lng){ 
        return isFinite(lng) && Math.abs(lng) <= 180;   
    }

    $(".coordenadas").on('blur', function() {
        if($(this).hasClass('insert')){
            if($(this).attr('id') == 'latitud_coordenada' || $(this).attr('id') == 'longitud_coordenada'){

                latitud = $('#storeEstacion').find('input[name="latitud_coordenada"]').val();
                longitud = $('#storeEstacion').find('input[name="longitud_coordenada"]').val();

                if($(this).attr('id') == 'latitud_coordenada' && latitud){
                    if(latitud){
                        if(!validLatitude(latitud)){
                            bootbox.alert("Ups! Debe ingresar una latitud valida");
                            $(this).val('')
                        }
                    }
                }else if($(this).attr('id') == 'longitud_coordenada' && longitud){
                    if(!validLongitude(longitud)){
                        bootbox.alert("Ups! Debe ingresar una longitud valida");
                        $(this).val('')
                    }
                }

                if(latitud && longitud){

                    mapCenter = new google.maps.LatLng(latitud, longitud);

                    // var marker = new google.maps.Marker({
                    //     position: mapCenter,
                    //     title: 'Marker title',
                    //     map: EstacionFormMap
                    // });

                    // marker.setMap(EstacionFormMap);

                    setTimeout(function() {
                        google.maps.event.trigger(EstacionFormMap, "resize");
                        EstacionFormMap.setCenter(mapCenter);
                        EstacionFormMap.setZoom(EstacionFormMap.getZoom());
                    }, 1000)
                }
                
            }else{
                latitud = $('#storeEstacion').find('input[name="latitud_coordenada_site"]').val();
                longitud = $('#storeEstacion').find('input[name="longitud_coordenada_site"]').val();

                if($(this).attr('id') == 'latitud_coordenada_site' && latitud){
                    if(latitud){
                        if(!validLatitude(latitud)){
                            bootbox.alert("Ups! Debe ingresar una latitud valida");
                            $(this).val('')
                        }
                    }
                }else if($(this).attr('id') == 'longitud_coordenada_site' && longitud){
                    if(!validLongitude(longitud)){
                        bootbox.alert("Ups! Debe ingresar una longitud valida");
                        $(this).val('')
                    }
                }

                if(latitud && longitud){

                    mapCenter = new google.maps.LatLng(latitud, longitud);

                    // var marker = new google.maps.Marker({
                    //     position: mapCenter,
                    //     title: 'Marker title',
                    //     map: EstacionFormSiteMap
                    // });

                    // marker.setMap(EstacionFormMap);

                    setTimeout(function() {
                        google.maps.event.trigger(EstacionFormSiteMap, "resize");
                        EstacionFormSiteMap.setCenter(mapCenter);
                        EstacionFormSiteMap.setZoom(EstacionFormSiteMap.getZoom());
                    }, 1000)
                }
            }
        }else{
            if($(this).attr('id') == 'latitud_coordenada' || $(this).attr('id') == 'longitud_coordenada'){

                latitud = $('#updateEstacion').find('input[name="latitud_coordenada"]').val();
                longitud = $('#updateEstacion').find('input[name="longitud_coordenada"]').val();

                if($(this).attr('id') == 'latitud_coordenada' && latitud){
                    if(!validLatitude(latitud)){
                        bootbox.alert("Ups! Debe ingresar una latitud valida");
                        $(this).val('')
                    } 
                }else if($(this).attr('id') == 'longitud_coordenada' && longitud){
                    if(!validLongitude(longitud)){
                        bootbox.alert("Ups! Debe ingresar una longitud valida");
                        $(this).val('')
                    }
                }

                if(latitud && longitud){

                    mapCenter = new google.maps.LatLng(latitud, longitud);

                    // var marker = new google.maps.Marker({
                    //     position: mapCenter,
                    //     title: 'Marker title',
                    //     map: EstacionFormUpdateMap
                    // });

                    // marker.setMap(EstacionFormUpdateMap);

                    setTimeout(function() {
                        google.maps.event.trigger(EstacionFormUpdateMap, "resize");
                        EstacionFormUpdateMap.setCenter(mapCenter);
                        EstacionFormUpdateMap.setZoom(EstacionFormUpdateMap.getZoom());
                    }, 1000)
                }

            }else{
                latitud = $('#updateEstacion').find('input[name="latitud_coordenada_site"]').val();
                longitud = $('#updateEstacion').find('input[name="longitud_coordenada_site"]').val();

                if($(this).attr('id') == 'latitud_coordenada_site' && latitud){
                    if(latitud){
                        if(!validLatitude(latitud)){
                            bootbox.alert("Ups! Debe ingresar una latitud valida");
                            $(this).val('')
                        }
                    }
                }else if($(this).attr('id') == 'longitud_coordenada_site' && longitud){
                    if(!validLongitude(longitud)){
                        bootbox.alert("Ups! Debe ingresar una longitud valida");
                        $(this).val('')
                    }
                }

                if(latitud && longitud){

                    mapCenter = new google.maps.LatLng(latitud, longitud);

                    // var marker = new google.maps.Marker({
                    //     position: mapCenter,
                    //     title: 'Marker title',
                    //     map: EstacionFormUpdateSiteMap
                    // });

                    // marker.setMap(EstacionFormMap);

                    setTimeout(function() {
                        google.maps.event.trigger(EstacionFormUpdateSiteMap, "resize");
                        EstacionFormUpdateSiteMap.setCenter(mapCenter);
                        EstacionFormUpdateSiteMap.setZoom(EstacionFormUpdateSiteMap.getZoom());
                    }, 1000)
                }
            }
        }
    })

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
                  ''+array.contacto+'',
                  ''+array.personal+'',
                  ''+array.correo+'',
                  ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-search Find"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id','estacion_'+array.id)
                    .data('personal_id',array.personal_id)
                    .data('dueno_cerro',array.dueno_cerro)
                    .data('latitud_coordenada',array.latitud_coordenada)
                    .data('longitud_coordenada',array.longitud_coordenada)
                    .data('latitud_coordenada_site',array.latitud_coordenada_site)
                    .data('longitud_coordenada_site',array.longitud_coordenada_site)
                    .data('datos_proveedor_electrico',array.datos_proveedor_electrico)
                    .addClass('text-center');

                $('.estacion_id').append('<option value="'+array.id+'" data-content="'+array.nombre+'"></option>');
            });

            $('.selectpicker').selectpicker('render');
            $('.selectpicker').selectpicker('refresh');
            
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
                    message : 'Registro Guardado exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Personal = $('#personal_id option[value="'+response.array.personal_id+'"]').first().data('content');

                var rowNode = EstacionTable.row.add([
                  ''+response.array.nombre+'',
                  ''+response.array.direccion+'',
                  ''+response.array.telefono+'',
                  ''+response.array.contacto+'',
                  ''+Personal+'',
                  ''+response.array.correo+'',
                  ''+'<i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-search Find"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-pencil Update"></i>' + ' <i style="cursor: pointer; margin: 0 10px; font-size:15px;" class="fa fa-times Remove"></i>'+'',
                ]).draw(false).node();

                $( rowNode )
                    .attr('id','estacion_'+response.array.id)
                    .data('personal_id',response.array.personal_id)
                    .data('dueno_cerro',response.array.dueno_cerro)
                    .data('latitud_coordenada',response.array.latitud_coordenada)
                    .data('longitud_coordenada',response.array.longitud_coordenada)
                    .data('latitud_coordenada_site',response.array.latitud_coordenada_site)
                    .data('longitud_coordenada_site',response.array.longitud_coordenada_site)
                    .data('datos_proveedor_electrico',response.array.datos_proveedor_electrico)
                    .addClass('text-center');

                $('.estacion_id').append('<option value="'+response.array.id+'" data-content="'+response.array.nombre+'"></option>');
                $('.estacion_id').val(response.array.id);
                
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
                    message : 'Ocurrió un error en el Proceso',
                    container : 'floating',
                    timer : 3000
                });

            }
             
        });
    });

    $("#EstacionForm").on("shown.bs.modal", function () { 
        $('#storeEstacion')[0].reset();
        mapCenter = new google.maps.LatLng(0, 0);

        setTimeout(function() {
            google.maps.event.trigger(EstacionFormMap, "resize");
            EstacionFormMap.setCenter(mapCenter);
            EstacionFormMap.setZoom(EstacionFormMap.getZoom());
        }, 1000)

        setTimeout(function() {
            google.maps.event.trigger(EstacionFormSiteMap, "resize");
            EstacionFormSiteMap.setCenter(mapCenter);
            EstacionFormSiteMap.setZoom(EstacionFormSiteMap.getZoom());
        }, 1000)

        $('.selectpicker').selectpicker('render');
        $('.selectpicker').selectpicker('refresh');
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
        var ObjectContact = ObjectTR.find("td").eq(3).text();
        var ObjectEmail = ObjectTR.find("td").eq(4).text();
        var ObjectPersonal = ObjectTR.data("personal_id");

        var ObjectOwner = ObjectTR.data("dueno_cerro");
        var ObjectLatitude = ObjectTR.data("latitud_coordenada");
        var ObjectLongitude = ObjectTR.data("longitud_coordenada");
        var ObjectLatitudeSite = ObjectTR.data("latitud_coordenada_site");
        var ObjectLongitudeSite = ObjectTR.data("longitud_coordenada_site");
        var ObjectDataProvider = ObjectTR.data("datos_proveedor_electrico");

        $('#updateEstacion').find('input[name="id"]').val(ObjectId);
        $('#updateEstacion').find('input[name="nombre"]').val(ObjectName);
        $('#updateEstacion').find('textarea[name="direccion"]').text(ObjectAddress);
        $('#updateEstacion').find('input[name="telefono"]').val(ObjectTelephone);
        $('#updateEstacion').find('input[name="contacto"]').val(ObjectContact);
        $('#updateEstacion').find('input[name="correo"]').val(ObjectEmail);
        $('#updateEstacion').find('select[name="personal_id"]').val(ObjectPersonal);

        $('#updateEstacion').find('input[name="dueno_cerro"]').val(ObjectOwner);
        $('#updateEstacion').find('input[name="latitud_coordenada"]').val(ObjectLatitude);
        $('#updateEstacion').find('input[name="longitud_coordenada"]').val(ObjectLongitude);
        $('#updateEstacion').find('input[name="latitud_coordenada_site"]').val(ObjectLatitudeSite);
        $('#updateEstacion').find('input[name="longitud_coordenada_site"]').val(ObjectLongitudeSite);
        $('#updateEstacion').find('textarea[name="datos_proveedor_electrico"]').text(ObjectDataProvider);

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

        showMap(ObjectLatitude, ObjectLongitude);
        showMapSite(ObjectLatitudeSite, ObjectLongitudeSite);

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
                    message : 'Registro Actualizado exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Personal = $('#personal_id option[value="'+response.array.personal_id+'"]').first().data('content');

                ObjectTR = $("#estacion_"+response.array.id);
                ObjectTR.data('personal_id', response.array.personal_id)
                ObjectTR.data('dueno_cerro', response.array.dueno_cerro)
                ObjectTR.data('latitud_coordenada', response.array.latitud_coordenada)
                ObjectTR.data('longitud_coordenada', response.array.longitud_coordenada)
                ObjectTR.data('latitud_coordenada_site', response.array.latitud_coordenada_site)
                ObjectTR.data('longitud_coordenada_site', response.array.longitud_coordenada_site)
                ObjectTR.data('datos_proveedor_electrico', response.array.datos_proveedor_electrico)
                ObjectTR.find("td").eq(0).html(response.array.nombre);
                ObjectTR.find("td").eq(1).html(response.array.direccion);
                ObjectTR.find("td").eq(2).html(response.array.telefono);
                ObjectTR.find("td").eq(3).html(response.array.contacto);
                ObjectTR.find("td").eq(4).html(response.array.correo);
                ObjectTR.find("td").eq(5).html(Personal);
                
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
                    message : 'Ocurrió un error en el Proceso',
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
                                swal("Éxito!","El registro ha sido eliminado!","success");
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
                  ''+'<a href="http://'+array.direccion_ip+':'+array.puerto_acceso+'" target="_blank">'+array.direccion_ip+'</a>'+'',
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
                    .data('producto_id',array.producto_id)
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
                    message : 'Registro Guardado exitosamente',
                    container : 'floating',
                    timer : 3000
                });

                Estacion = $('#estacion_id option[value="'+response.array.estacion_id+'"]').first().data('content');
                Producto = $('#producto_id option[value="'+response.array.producto_id+'"]').first().data('content');

                var rowNode = IngresoTable.row.add([
                  ''+Estacion+'',
                  ''+response.array.funcion+'',
                  ''+response.array.alarma_activada+'',
                  ''+'<a href="http://'+response.array.direccion_ip+':'+response.array.puerto_acceso+'" target="_blank">'+response.array.direccion_ip+'</a>'+'',
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

                $('#producto_id option[value="'+response.array.producto_id+'"]').remove();

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
                    message : 'Ocurrió un error en el Proceso',
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
        var ObjectAlarm = ObjectTR.find("td").eq(2).text();
        var ObjectIp = ObjectTR.find("td").eq(3).text();
        var ObjectPort = ObjectTR.find("td").eq(4).text();
        var ObjectChannel = ObjectTR.find("td").eq(5).text();
        var ObjectFrecuency = ObjectTR.find("td").eq(6).text();
        var ObjectPower = ObjectTR.find("td").eq(7).text();
        var ObjectProduct = ObjectTR.data("producto_id");

        $('#updateIngreso').find('input[name="id"]').val(ObjectId);
        $('#updateIngreso').find('select[name="estacion_id"]').val(ObjectStation);
        $('#updateIngreso').find('input[name="funcion"]').val(ObjectFunction);
        $('#updateIngreso').find('select[name="alarma_activada"]').val(ObjectAlarm);
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
                    message : 'Registro Actualizado exitosamente',
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
                    message : 'Ocurrió un error en el Proceso',
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
                                swal("Éxito!","El registro ha sido eliminado!","success");
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
                            if ( $("#input_registro option[value='"+array.estacion+"'").length == 0 ){
                                $('#input_registro').append('<option value="'+array.estacion+'" data-content="'+array.estacion+'"></option>');
                            }
                        }else if(tipo_busqueda_ingreso == 2){
                            if ( $("#input_registro option[value='"+array.direccion_ip+"'").length == 0 ){
                                $('#input_registro').append('<option value="'+array.direccion_ip+'" data-content="'+array.direccion_ip+'"></option>');
                            }
                        }else{
                            if ( $("#input_registro option[value='"+array.mac_address+"'").length == 0 ){
                                $('#input_registro').append('<option value="'+array.mac_address+'" data-content="'+array.mac_address+'"></option>');
                            }
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
                            message : 'Búsqueda Realizada exitosamente',
                            container : 'floating',
                            timer : 3000
                        });

                        $.each(response.array, function( index, array ) {

                            var rowNode = BusquedaIngresoTable.row.add([
                              ''+array.estacion+'',
                              ''+array.funcion+'',
                              ''+array.alarma_activada+'',
                              ''+'<a href="http://'+array.direccion_ip+':'+array.puerto_acceso+'" target="_blank">'+array.direccion_ip+'</a>'+'',
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
                            message : 'Debe llenar el campo de búsqueda',
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
});