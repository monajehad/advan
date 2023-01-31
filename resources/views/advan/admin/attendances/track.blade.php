<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title></title>
    <style>
        /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */

        #map {
            height: 100%;
        }

        /* Optional: Makes the sample page fill the window. */

        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
</head>

<body>
<div id="map"></div>
@php

    if ($attendance->tracking_array)
      {
        $area = json_decode($attendance->tracking_array, true);
        if ($area == null){
            die('no data');
        }
     }

@endphp

<!-- jQuery CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Firebase -->
<script src="https://www.gstatic.com/firebasejs/4.12.1/firebase.js"></script>
<script>
    // Replace your Configuration here..
    var config = {
        apiKey: "AIzaSyCCX19Xk05BHyuOQwYBtL5zEhP8dbVlPjM",
        authDomain: "advancedcompony.firebaseapp.com",
        databaseURL: "https://advancedcompony-default-rtdb.firebaseio.com",
        projectId: "advancedcompony",
        storageBucket: "advancedcompony.appspot.com",
        messagingSenderId: "805421910196",
        appId: "1:805421910196:web:95a54cfa1bd7c79d72afe1",
        measurementId: "G-4BLK12HB5Z"
    };
    firebase.initializeApp(config);
</script>


<script>
    @if($attendance->tracking_array)


    // This example adds an animated symbol to a polyline.

    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: {{$area[0]['latitude']}},
                lng: {{$area[0]['longitude']}}
            },
            zoom: 15,
            mapTypeId: 'terrain'
        });
        var locations = [
                @foreach($hit as $key => $h)
            ['{{$h->clinic->name}}', {{$h->clinic->latitude}}, {{$h->clinic->longitude}}],
            @endforeach
        ];

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
        // Define the symbol, using one of the predefined paths ('CIRCLE')
        // supplied by the Google Maps JavaScript API.
        var lineSymbol = {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 8,
            strokeColor: '#393'
        };

        // Create the polyline and add the symbol to it via the 'icons' property.
        var line = new google.maps.Polyline({
            path: [
                    @php
                        $area = json_decode($attendance->tracking_array, true);
                             foreach($area as $i )
                             {
                    @endphp
                {
                    lat: {{$i['latitude']}},
                    lng: {{$i['longitude']}}
                },
                @php
                    }
                @endphp

            ],
            icons: [{
                icon: lineSymbol,
                offset: '100%'
            }],
            map: map
        });

        animateCircle(line);
    }



    // Use the DOM setInterval() function to change the offset of the symbol
    // at fixed intervals.
    function animateCircle(line) {
        var count = 0;
        window.setInterval(function () {
            count = (count + 1) % 200;

            var icons = line.get('icons');
            icons[0].offset = (count / 2) + '%';
            line.set('icons', icons);
        }, 500);
    }


    @else


    // counter for online cars...
    var cars_count = 0;
    // markers array to store all the markers, so that we could remove marker when any car goes offline and its data will be remove from realtime database...
    var markers;
    var map;
    var coordinates = [];

    function initMap() { // Google Map Initialization...
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: new google.maps.LatLng(31.34554, 35.03226),
            mapTypeId: 'terrain',
        });
    }


    function ShowLocation(lat, lng) {

        if (markers != null) {
            markers.setMap(null);
        }


        var uluru = {
            lat: lat,
            lng: lng
        };
        const image =
            "https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png";

        var icon = { // car icon
            path: 'M29.395,0H17.636c-3.117,0-5.643,3.467-5.643,6.584v34.804c0,3.116,2.526,5.644,5.643,5.644h11.759   c3.116,0,5.644-2.527,5.644-5.644V6.584C35.037,3.467,32.511,0,29.395,0z M34.05,14.188v11.665l-2.729,0.351v-4.806L34.05,14.188z    M32.618,10.773c-1.016,3.9-2.219,8.51-2.219,8.51H16.631l-2.222-8.51C14.41,10.773,23.293,7.755,32.618,10.773z M15.741,21.713   v4.492l-2.73-0.349V14.502L15.741,21.713z M13.011,37.938V27.579l2.73,0.343v8.196L13.011,37.938z M14.568,40.882l2.218-3.336   h13.771l2.219,3.336H14.568z M31.321,35.805v-7.872l2.729-0.355v10.048L31.321,35.805',
            scale: 0.4,
            fillColor: "#427af4", //<-- Car Color, you can change it
            fillOpacity: 1,
            strokeWeight: 1,
            anchor: new google.maps.Point(0, 5),
        };

        var marker = new google.maps.Marker({
            position: uluru,
            title: 'Live Location',
            map: map,
            icon: icon
        });
        // map.setZoom(17);
        map.panTo(marker.position);
        markers = marker; // add marker
    }


    // get firebase database reference.
    var loc_ref = firebase.database().ref("User");
    //------------------------------------------------------------------------------------
    loc_ref.on('value', gotData, errData);
    var curr_lat;
    var curr_lng;

    function gotData(data) {
        var user_id = '{{$attendance->user_id}}';
        console.log(data);
        var loc = data.val();
        curr_lat = loc[user_id].Location.latitude;
        curr_lng = loc[user_id].Location.longitude;
        console.log(curr_lat);
        coordinates.push(new google.maps.LatLng(parseFloat(curr_lat), parseFloat(curr_lng)));
        var coordinatesline = new google.maps.Polyline({
            path: this.coordinates,
            geodesic: true,
            map: this.map,
            strokeColor: '#FF0000',
            strokeOpacity: 1.0,
            strokeWeight: 2
        });
        ShowLocation(parseFloat(curr_lat), parseFloat(curr_lng));
        var locations = [
                @foreach($hit as $key => $h)
            ['{{$h->clinic->name}}', {{$h->clinic->latitude}}, {{$h->clinic->longitude}}],
            @endforeach
        ];

        var infowindow = new google.maps.InfoWindow();

        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map
            });

            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                return function () {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }

    function errData(err) {
        console.log('error: ' + err);
    }

    //---------------------------------------------------------------------------------------
    var getUrlParameter = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
            sURLVariables = sPageURL.split('&amp;'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };


    @endif

    function addMarker(location) {
        marker = new google.maps.Marker({
            position: location,
            map: map
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKmgcHH0et3TnJJ5wGHL7FxRIO9kBgglI&libraries=places&callback=initMap">
</script>

</body>

</html>
