@extends('layouts.cpanel.app')

@section('content')
    <style>
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: 0px !important;
            margin-left: 0px !important;
        }
        .datepicker {
            float: right
        }
        .datepicker.dropdown-menu {
            right:auto
        }
    </style>
    <div class="card">
{{--        <div class="card-header">--}}
{{--            {{ trans('global.show') }} {{ trans('cruds.hit.title') }}--}}

{{--            <form method="get">--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12 form-group">--}}
{{--                        <label class="control-label" for="m">المندوب</label>--}}
{{--                        <select class="form-control" name="user">--}}
{{--                            <option value="">اختر مندوب</option>--}}
{{--                            @foreach($users as $value)--}}
{{--                                <option value="{{$value->id}}">{{$value->name}}</option>--}}
{{--                            @endforeach--}}
{{--                        </select>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="col-4">--}}
{{--                    <label class="control-label">&nbsp;</label><br>--}}
{{--                    <button class="btn btn-primary" type="submit">بحث</button>--}}
{{--                </div>--}}
{{--            </form>--}}
{{--        </div>--}}

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.hits.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
                <div style="background-color: #f8d576;height: 42px;">
                    <div id="data" class="row">
                    </div>
                </div>
                <div id="map_canvas" style="width:100%; height:450px; border: 2px solid #3872ac;"></div>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.hits.index') }}">
                        {{ trans('global.back_to_list') }}
                    </a>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script
        src="https://maps.googleapis.com/maps/api/js?libraries=geometry,places&key=AIzaSyDeFvdsmkF_Jxd7Tk0VkxXfMw0IydZiWC4"></script>

    <script src="https://www.gstatic.com/firebasejs/4.12.1/firebase.js"></script>
    <script src="https://cdn.firebase.com/libs/geofire/4.1.2/geofire.min.js"></script>

    <script>
        var markers = [];

        function initialize() {
            var infowindow = new google.maps.InfoWindow();
            var map = new google.maps.Map(
                document.getElementById("map_canvas"), {
                    center: new google.maps.LatLng(31.525808, 34.446834),
                    zoom: 10,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
            // Initialize Firebase
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

            //Create a node at firebase location to add locations as child keys
            var locationsRef = firebase.database().ref("User");
            var bounds = new google.maps.LatLngBounds();
            locationsRef.on('child_added', function(snapshot) {
                if (markers[snapshot.key] !== undefined) {
                    markers[snapshot.key].setMap(null);
                }
                var data = snapshot.val();
                var t = getRandomColor();
                var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + t,
                    new google.maps.Size(21, 34),
                    new google.maps.Point(0, 0),
                    new google.maps.Point(10, 34));

                $('#data').append('<div class="col-md" style="padding: 9px;"><img style="width: 16px" src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|' + t + '">&#160;&#160;'+data.Location.name+' </div>')




                var position = new google.maps.LatLng(data.Location.latitude, data.Location.longitude);
                markers[snapshot.key] = new google.maps.Marker({
                    position: position,
                    map: map,
                    icon: pinImage,
                });

                markers[snapshot.key].addListener('click', (function(data) {
                    return function(e) {
                        var html = "<div style='text-align: center;padding: 15px;'><h3>" + data.Location.name + "</h3><p>" + this.getPosition().toUrlValue(6) +"</div></p></div>";
                        infowindow.setContent(html);
                        infowindow.open(map, this);
                    }
                }(data)));
            });

            locationsRef.on('child_changed', function (snapshot) {
                var data = snapshot.val();
                var position = new google.maps.LatLng(snapshot.val().Location.latitude, snapshot.val().Location.longitude);
                markers[snapshot.key].setPosition(position);
                markers[snapshot.key].addListener('click', (function(data) {
                    return function(e) {
                        var html = "<div style='text-align: center;padding: 15px;'><h3>" + data.Location.name + "</h3><p>" + this.getPosition().toUrlValue(6) +"</div></p></div>";
                        infowindow.setContent(html);
                        infowindow.open(map, this);
                    }
                }(data)));
            });
            locationsRef.on('child_removed', function (snapshot) {
                if (marker[snapshot.key] !== undefined) {
                    marker[snapshot.key].setMap(null);
                }
            });
        }
        google.maps.event.addDomListener(window, "load", initialize);

        function getRandomColor() {
            var letters = '0123456789ABCDEF'.split('');
            var color = '';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.round(Math.random() * 15)];
            }
            return color;
        }
    </script>
@endsection
