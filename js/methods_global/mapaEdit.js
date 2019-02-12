$(document).ready(function() {

    google.maps.event.addDomListener(window, 'load', initialize)
    function initialize() {
        var latitudEdit = $('#LatitudEdit').val()
        var longitudEdit = $('#LongitudEdit').val();
        ResizeEdit(latitudEdit, longitudEdit)
        var centerEdit = new google.maps.LatLng(latitudEdit, longitudEdit);

        mapOptions = {
            zoom: 14,
            center: centerEdit,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        MapaEdit = new google.maps.Map(document.getElementById("MapEdit"), mapOptions)
        markerEdit = new google.maps.Marker({
            map: MapaEdit,
            draggable: true,
            position: centerEdit

        });

        google.maps.event.addListener(markerEdit, 'dragend', function(evt) {
            $('#LatitudEdit').val(evt.latLng.lat())
            $('#LongitudEdit').val(evt.latLng.lng())
        });
    }

    function validLatitude(lat) {
        return isFinite(lat) && Math.abs(lat) <= 90;
    }

    function validLongitude(lng) {
        return isFinite(lng) && Math.abs(lng) <= 180;
    }

    $(".coordenadasEdit").on('blur', function() {

        var latitudEdit = $('#LatitudEdit').val();
        var longitudEdit = $('#LongitudEdit').val();

        if ($(this).attr('id') == 'LatitudEdit' && latitudEdit) {
            if (latitudEdit) {
                if (!validLatitude(latitudEdit)) {
                    bootbox.alert("Ups! Debe ingresar una latitud valida");
                    $(this).val('')
                }
            }
        } else if ($(this).attr('id') == 'LongitudEdit' && longitudEdit) {
            if (!validLongitude(longitudEdit)) {
                bootbox.alert("Ups! Debe ingresar una longitud valida");
                $(this).val('')
            }
        }

        if (latitudEdit && longitudEdit) {
            
            ResizeEdit(latitudEdit, longitudEdit)
        }
    })

    ResizeEdit = function (latitudEdit, longitudEdit){
            MapaEdit = new google.maps.Map(document.getElementById("MapEdit"), mapOptions)
            mapCenterEdit = new google.maps.LatLng(latitudEdit, longitudEdit);

            markerEdit = new google.maps.Marker({
                map: MapaEdit,
                draggable: true,
                position: mapCenterEdit
    
            });
    
            google.maps.event.addListener(markerEdit, 'dragend', function(evt) {
                $('#LatitudEdit').val(evt.latLng.lat())
                $('#LongitudEdit').val(evt.latLng.lng())
            });

            setTimeout(function() {
                google.maps.event.trigger(MapaEdit, "resize");
                MapaEdit.setCenter(mapCenterEdit);
                MapaEdit.setZoom(MapaEdit.getZoom());

                markerEdit.setOptions({position: mapCenterEdit});
                
            }, 1000)

            
        }
});