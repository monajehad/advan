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
        .background-white{
            background-color:#ffffff !important;
        }
    </style>
    <div class="card">
        <div class="card-header background-white">
            {{ trans('global.show') }} {{ trans('cruds.hit.title') }}

            <form method="get" style="width: 70vw;">
                <div class="row">
                    <div class="col-12 form-group">
                        <label class="control-label" for="m">المندوب</label>
                        <select class="form-control" name="user">
                            <option value="">اختر مندوب</option>
                            @foreach($users as $value)
                                <option value="{{$value->id}}">{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 form-group">
                        <label class="control-label" for="y">من</label>
                        <input class="form-control datetime  "  id="datetimepicker3" value="{{request()->get('from_date')}}" name="from_date"
                               type="text">

                    </div>
                    <div class="col-6 form-group">
                        <label class="control-label" for="m">الى</label>
                        <input class="form-control datetime  " id="datetimepicker4" value="{{request()->get('to_date')}}" name="to_date"
                               type="text">
                    </div>

                </div>

                <div class="col-4">
                    <label class="control-label">&nbsp;</label><br>
                    <button class="btn btn-primary" type="submit">بحث</button>
                </div>
            </form>
        </div>

        <div class="card-body">
            <div class="form-group">
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.hits.index') }}">
                        العودة للقائمة
                    </a>
                </div>
                <div style="background-color: #f8d576;height: 42px;">
                    <div id="data" class="row">
                    </div>
                </div>
                <div id="map_canvas" style="width:100%; height:450px; border: 2px solid #3872ac;"></div>
                <div class="form-group">
                    <a class="btn btn-default" href="{{ route('admin.hits.index') }}">
                        العودة للقائمة
                    </a>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script
        src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=geometry,places&key=AIzaSyD45sZgAyRbOuURb4fAry_AnqGpo9xTO4U"></script>
    <script>

        function getRandomColor() {
            var letters = '0123456789ABCDEF'.split('');
            var color = '';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.round(Math.random() * 15)];
            }
            return color;
        }

        let users = [];
        let user;
        @foreach($user as $value)
        var pinColor = getRandomColor();
        user = {
            "id": {{$value->user_id}},
            "color": pinColor,
        };
        users.push(user);
        $('#data').append('<div class="col-md" style="padding: 9px;"><img style="width: 16px" src="http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|' + pinColor + '">&#160;&#160;{{$value->user->name}}</div>')
        @endforeach

        var locations = [
                @foreach($hits as $hit)
            ['{{$hit->client->name}}', '{{$hit->client->latitude}}', '{{$hit->client->longitude}}', '{{$hit->address}}', users.find(user => user.id === {{$hit->user_id}}).color, '{{$hit->date_time}}']@if(!$loop->last),@endif
            @endforeach

        ];

        var geocoder;
        var map;
        var bounds = new google.maps.LatLngBounds();

        function initialize() {

            map = new google.maps.Map(
                document.getElementById("map_canvas"), {
                    center: new google.maps.LatLng(31.4582807,34.327475),
                    zoom: 10,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                });
            geocoder = new google.maps.Geocoder();

            for (i = 0; i < locations.length; i++) {


                geocodeAddress(locations, i);
            }
        }

        google.maps.event.addDomListener(window, "load", initialize);

        function geocodeAddress(locations, i) {
            var name = locations[i][0];
            var lat = locations[i][1];
            var lon = locations[i][2];
            var address = locations[i][3];
            var color = locations[i][4];
            var date = locations[i][5];
            var pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + color,
                new google.maps.Size(21, 34),
                new google.maps.Point(0, 0),
                new google.maps.Point(10, 34));  //add this line

            geocoder.geocode({
                    'location': new google.maps.LatLng(lat, lon)
                },

                function (results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        var marker = new google.maps.Marker({
                            icon: pinImage,
                            map: map,
                            position: results[0].geometry.location,
                            title: name,
                            animation: google.maps.Animation.DROP,
                            address: address,
                        })
                        infoWindow(marker, map, name, address, date);
                        bounds.extend(marker.getPosition());
                        map.fitBounds(bounds);
                    }

                    // else {
                    //     alert("geocode of " + address + " failed:" + status);
                    // }
                });
        }

        function infoWindow(marker, map, title, address, date) {
            google.maps.event.addListener(marker, 'click', function () {
                var html = "<div style='text-align: center;padding: 15px;'><h3>" + title + "</h3><p>" + address + "<br>" + date + "</div></p></div>";
                iw = new google.maps.InfoWindow({
                    content: html,
                    maxWidth: 500
                });
                iw.open(map, marker);
            });
        }


        // $('.datetime').datetimepicker({
        //     inline: false,
        //     format:'HH:mm',
        //     icons: {
        //         time: "fa fa-clock-o",
        //         date: "fa fa-calendar",
        //         up: "fa fa-arrow-up",
        //         down: "fa fa-arrow-down",
        //         previous: "fa fa-chevron-left",
        //         next: "fa fa-chevron-right",
        //         today: "fa fa-clock-o",
        //         clear: "fa fa-trash-o"
        //     }
        // });

    </script>
@endsection
