$(document).ready(function() {

    google.maps.event.addDomListener(window, 'load', initialize)
    function initialize() {

        center = new google.maps.LatLng(-41.3214705, -73.0138898);

        mapOptions = {
            zoom: 14,
            center: center,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
        Mapa = new google.maps.Map(document.getElementById("Map"), mapOptions)
        marker = new google.maps.Marker({
            map: Mapa,
            draggable: true,
            position: center

        });

        google.maps.event.addListener(marker, 'dragend', function(evt) {
            $('#Latitud').val(evt.latLng.lat())
            $('#Longitud').val(evt.latLng.lng())
        });
    }


    function validLatitude(lat) {
        return isFinite(lat) && Math.abs(lat) <= 90;
    }

    function validLongitude(lng) {
        return isFinite(lng) && Math.abs(lng) <= 180;
    }

    $(".coordenadas").on('blur', function() {

        latitud = $('#Latitud').val();
        longitud = $('#Longitud').val();

        if ($(this).attr('id') == 'Latitud' && latitud) {
            if (latitud) {
                if (!validLatitude(latitud)) {
                    bootbox.alert("Ups! Debe ingresar una latitud valida");
                    $(this).val('')
                }
            }
        } else if ($(this).attr('id') == 'Longitud' && longitud) {
            if (!validLongitude(longitud)) {
                bootbox.alert("Ups! Debe ingresar una longitud valida");
                $(this).val('')
            }
        }

        if (latitud && longitud) {
            Resize(latitud, longitud, Mapa)
            
            // mapCenter = new google.maps.LatLng(latitud, longitud);

            // setTimeout(function() {
            //     google.maps.event.trigger(Mapa, "resize");
            //     Mapa.setCenter(mapCenter);
            //     Mapa.setZoom(Mapa.getZoom());
            // }, 1000)
        }
    })

    // console.log("Mapa iniciado");

Resize = function (Latitud, Longitud){
        // console.log("Mapa Zoom iniciado");

        mapCenter = new google.maps.LatLng(Latitud, Longitud);

        setTimeout(function() {
            google.maps.event.trigger(Mapa, "resize");
            Mapa.setCenter(mapCenter);
            Mapa.setZoom(Mapa.getZoom());

            marker.setOptions({position: mapCenter});
            
        }, 1000)

        
    }
});