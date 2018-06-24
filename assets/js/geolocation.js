function initialize() {
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 43.5667, lng: 7.1},
        zoom: 13,
        mapTypeId: 'roadmap'
    });

    // Create the search box and link it to the UI element.
    var input = document.getElementById('pac-input');
    var searchBox = new google.maps.places.SearchBox(input);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    // Bias the SearchBox results towards current map's viewport.
    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
    });

    var markers = [];
    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();

        if (places.length == 0) {
            return;
        }

        // Clear out the old markers.
        markers.forEach(function(marker) {
            marker.setMap(null);
        });
        markers = [];

        // For each place, get the icon, name and location.
        var bounds = new google.maps.LatLngBounds();
        places.forEach(function(place) {
            if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
            }
            var icon = {
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
                map: map,
                icon: icon,
                draggable: true,
                title: place.name,
                position: place.geometry.location
            }));

            markers.forEach(function (marker) {
                marker.addListener('dragend', function () {
                    geocodePosition(marker.getPosition());
                })
            });

            if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
            } else {
                bounds.extend(place.geometry.location);
            }

            $('#observation_latitude').val(place.geometry.location.lat());
            $('#observation_longitude').val(place.geometry.location.lng());
        });
        map.fitBounds(bounds);
    });

    // geolocation
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            map.setCenter(pos);
            marker = new google.maps.Marker({
                position: pos,
                draggable:true,
                map: map,
                title: 'Ma position'
            });

            $('#observation_latitude').val(pos.lat);
            $('#observation_longitude').val(pos.lng);

            marker.addListener('dragend', function () {
                geocodePosition(marker.getPosition());
            })
        }, function () {
            handleError(true, infoWindow, map.getCenter());
        });
    } else {
        handleError(false, infoWindow, map.getCenter());
    }
}

function handleError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
        'Erreur: Echec du service de géolocalisation.' :
        'Erreur: Votre navigateur ne supporte pas la géolocalisation.');
    infoWindow.open(map);
}

function geocodePosition(pos) {
    geocoder = new google.maps.Geocoder();
    geocoder.geocode(
        {latLng: pos},
        function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                updatedLocation = results[0].geometry.location;

                $('#observation_latitude').val(updatedLocation.lat());
                $('#observation_longitude').val(updatedLocation.lng());
            }
            else {
                console.log('erreur');
            }
        }
    );
}

google.maps.event.addDomListener(window, 'load', initialize);