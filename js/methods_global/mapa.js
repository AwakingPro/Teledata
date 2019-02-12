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

        Latitud = $('#Latitud').val();
        Longitud = $('#Longitud').val();
        if ($(this).attr('id') == 'Latitud' && Latitud) {
            if (Latitud) {
                if (!validLatitude(Latitud)) {
                    bootbox.alert("Ups! Debe ingresar una Latitud valida");
                    $(this).val('')
                }
            }
        } else if ($(this).attr('id') == 'Longitud' && Longitud) {
            if (!validLongitude(Longitud)) {
                bootbox.alert("Ups! Debe ingresar una Longitud valida");
                $(this).val('')
            }
        }

        if (Latitud && Longitud) {
            Resize(Latitud, Longitud)
        }
    })

Resize = function (Latitud, Longitud){
        Mapa = new google.maps.Map(document.getElementById("Map"), mapOptions)
        mapCenter = new google.maps.LatLng(Latitud, Longitud);

        setTimeout(function() {
            google.maps.event.trigger(Mapa, "resize");
            Mapa.setCenter(mapCenter);
            Mapa.setZoom(Mapa.getZoom());

            marker.setOptions({position: mapCenter});
            
        }, 1000)

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
});