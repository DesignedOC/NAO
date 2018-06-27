var map, marker, infoWindow;
var locations = [];

$(function () {
    $(document).on('click', '#btn-valider', function () {
        var nomVern = $('#input-nom-vern').val();
        console.log(nomVern);
        $.ajax({
            url: searchUrl,
            type: "POST",
            dataType: "json",
            data: {"nomVern": nomVern},
            async: true,
            success: function (data) {
                if (data.length == 0) return;
                locations = data;
                console.log(locations);
                map.setCenter(new google.maps.LatLng(locations[0].latitude, locations[0].longitude));
                for (var count = 0; count < locations.length; count++) {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(locations[count].latitude, locations[count].longitude),
                        map: map,
                        title: locations[count].nomVern
                    });
                    google.maps.event.addListener(marker, 'click', (function (marker, count) {
                        return function () {
                            var contentString = '';
                            if (isGranted) {
                                var path = showObservationPath.replace('/0', '/'+locations[count].id);

                                contentString = '<div id="iw-content">'+
                                    '<div class="iw-subTitle">' +
                                    '<p id="title" class="card-title title">'+locations[count].nomVern+'</p>'+
                                    '<p id="author" class="card-title author">Posté par <b>'+locations[count].username+'</b>'+
                                    '<span class="date-pub"> - Validé le '+locations[count].date+'</span></p><hr>'+
                                    '</div>'+
                                    '<img src="" alt="">'+
                                    '<p>'+locations[count].description+'</p>'+
                                    '<div class="card-footer text-center"><a href="'+path+'" class="btn btn-primary text-center">Fiche observation</a></div>'+
                                '</div>';
                            } else {
                                contentString = '<button class="btn btn-primary" data-toggle="modal" data-target="#infoModal">'+
                                                '>> Voir plus'+
                                                '</button>';
                            }
                            infoWindow.setContent(contentString);
                            infoWindow.open(map, marker);
                        }
                    })(marker, count));

                    google.maps.event.addListener(map, 'click', function() {
                        infoWindow.close();
                    });
                }
            },
            error: function () {
                console.log('error');
            }
        });
    });
});

function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 47.12025, lng: 2.123654},
        zoom: 6,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    infoWindow =  new google.maps.InfoWindow({});

    google.maps.event.addListener(infoWindow, 'domready', function() {

        var iwOuter = $('.gm-style-iw');

        var iwBackground = iwOuter.prev();

        iwBackground.children(':nth-child(2)').css({
            'background': '#fff'
        });

        var iwmain = iwBackground.children(':nth-child(2)');

        iwBackground.children(':nth-child(4)').css({
            'display': 'none'
        });

        var iwCloseBtn = iwOuter.next();

    });

    // google.maps.event.addListener(infoWindow, 'domready', function() {
    //     var iwOuter = $('.gm-style-iw');
    //     var iwBackground = iwOuter.prev();
    //     iwBackground.children(':nth-child(2)').css({'display' : 'none'});
    //     iwBackground.children(':nth-child(4)').css({'display' : 'none'});
    //
    //     var iwCloseBtn = iwOuter.next();
    //     iwCloseBtn.css({
    //         opacity: '1',
    //         right: '38px', top: '3px',
    //         border: '7px solid #48b5e9',
    //         'border-radius': '50%',
    //         'box-shadow': '0 0 5px #3990B9'
    //     });
    //     iwCloseBtn.mouseout(function(){
    //         $(this).css({opacity: '1'});
    //     });
    //
    // });
}

google.maps.event.addDomListener(window, 'load', initMap);